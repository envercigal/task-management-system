<?php

namespace App\Services\TaskAssigmentStrategies;
interface TaskAssignerInterface
{
    public function assignTasks(array $tasks, array $developers, int $workHourPerWeek): array;
}
