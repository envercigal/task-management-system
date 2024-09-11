<?php

namespace App\Services\TaskAssigmentStrategies;

class TaskAssigner {
    private TaskAssignerStrategy $taskAssigner;

    public function __construct(TaskAssignerStrategy $taskAssigner) {
        $this->taskAssigner = $taskAssigner;
    }

    public function assignTasks(array $tasks, array $developers, int $workHourPerWeek): array
    {
        return $this->taskAssigner->assignTasks($tasks, $developers, $workHourPerWeek);
    }
}
