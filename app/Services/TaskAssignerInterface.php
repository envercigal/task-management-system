<?php

namespace app\Services;
interface TaskAssignerInterface
{
    public function assignTasks(array $tasks, array $developers): array;
}
