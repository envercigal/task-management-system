<?php

namespace App\Services;

class DifficultyTaskAssignerStrategy implements TaskAssignerInterface
{
    public function assignTasks(array $tasks , array $developers): array
    {
        $week = 1;
        $weeklyAssignments = [];

        while (!empty($tasks)) {
            $weeklyAssignments[$week] = [];

            // Geliştiricilerin saatlerini haftalık olarak sıfırla
            foreach ($developers as $developer) {
                $developer->resetAvailableHours();
            }

            foreach ($tasks as $index => $task) {
                // En uygun geliştiriciyi bul
                $bestDeveloper = $this->findBestDeveloper($task['value'], $developers);

                if ($bestDeveloper) {
                    // Görevi en iyi geliştiriciye ata
                    $assignment = $bestDeveloper->assignTask($task['value']);
                    $weeklyAssignments[$week][] = [
                        'task_id' => $task['id'],
                        'developer' => $assignment['developer'],
                        'time_required' => $assignment['time_required'],
                        'remaining_hours' => $assignment['remaining_hours'],
                    ];

                    unset($tasks[$index]);
                } else {
                    break;
                }
            }
            $tasks = array_values($tasks);
            $week++;
        }

        return $weeklyAssignments;
    }

    private function findBestDeveloper($taskValue, $developers)
    {
        $bestDeveloper = null;

        foreach ($developers as $developer) {
            if ($developer->canTakeTask($taskValue)) {
                if (!$bestDeveloper || $developer->availableHours > $bestDeveloper->availableHours) {
                    $bestDeveloper = $developer;
                }
            }
        }

        return $bestDeveloper;
    }
}
