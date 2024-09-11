<?php

namespace App\Services\TaskAssigmentStrategies;

use App\Dtos\DeveloperDto;

class DifficultyTaskAssignerStrategy implements TaskAssignerInterface
{
    public function assignTasks(array $tasks, array $developers, int $workHourPerWeek): array
    {
        $developers = $this->orderDeveloperByCapacity($developers);
        $works = [];
        $totalTaskHour = $this->totalTaskHour($tasks);
        $jobTotalWeekCount = ceil($totalTaskHour / $this->getWorkHourPerWeek($developers));

        for ($i = 1; $i <= $jobTotalWeekCount; $i++) {
            $tasks = $this->orderTaskByValue($tasks);
            $totalSubmittedWorkHour = 0;

            foreach ($tasks as &$task) {
                if ($totalSubmittedWorkHour >= $this->getWorkHourPerWeek($developers)) {
                    break;
                }

                /** @var DeveloperDto $developer */
                foreach ($developers as &$developer) {
                    $userWorkHourByWeek = array_reduce($works, function ($carry, $work) use ($developer, $i) {
                        return $work['name'] === $developer->name && $work['week_number'] === $i ? $carry + $work['hour'] : $carry;
                    }, 0);

                    if ((empty($task['developer_name'])) && $userWorkHourByWeek + $task['estimated_duration'] <= 45) {
                        $works[] = [
                            'name' => $developer->name,
                            'task_id' => $task['id'],
                            'week_number' => $i,
                            'hour' => $task['estimated_duration'],
                        ];

                        $task['developer_name'] = $developer->name;
                        $totalSubmittedWorkHour += $task['estimated_duration'];
                        if ($totalSubmittedWorkHour >= $workHourPerWeek) {
                            break;
                        }
                    }
                }
            }
        }

        return $this->groupByWeek($works);
    }


    public function getWorkHourPerWeek(array $developers): int
    {
        return count($developers) * 45;
    }

    public function orderDeveloperByCapacity(array $tasks): array{
        usort($tasks, function ($a, $b) {
            return $b->capacityPerHour - $a->capacityPerHour;
        });

        return $tasks;
    }

    public function totalTaskHour(array $tasks): int
    {
        return array_reduce($tasks, function ($carry, $task) {
            return $carry + $task['estimated_duration'];
        }, 0);
    }

    public function groupByWeek(array $tasks): array{
       return array_reduce($tasks, function ($result, $item) {
            $result[$item['week_number']][] = $item;
            return $result;
        }, []);
    }

    public function orderTaskByValue(array $tasks): array
    {
        usort($tasks, function ($a, $b) {
            return $b['value'] - $a['value'];
        });

        return $tasks;
    }
}
