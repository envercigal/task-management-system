<?php

namespace App\Services\TaskAssigmentStrategies;
interface TaskAssignerStrategy
{
    public function assignTasks(array $tasks, array $developers, int $workHourPerWeek): array;
}
