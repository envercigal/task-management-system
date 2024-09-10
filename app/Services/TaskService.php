<?php


namespace App\Services;

use App\Dtos\DeveloperDto;
use App\Dtos\TaskDto;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskService {
    private Collection $tasks;

    public function __construct() {
        $this->tasks = collect();
    }

    public function addTasks(Collection $tasks): self
    {
        if ($this->tasks->isEmpty()) {
            $this->tasks = $tasks;

            return $this;
        }


        $this->tasks = $this->tasks->merge($tasks);

        return $this;
    }

    public function save():void
    {
        if ($this->tasks->isEmpty()) {
            return;
        }

        Task::upsert(
            $this->tasks->map(fn(TaskDto $taskDto) => $taskDto->toArray())->toArray(),
            ['id'] // Assuming the 'id' is the unique key for the upsert
        );
    }

    public function assignTasks (TaskAssignerInterface $taskAssigner): self
    {
        $tasks = Task::all();
        $developers = $this->getDevelopers();
        $assignedTasks = $taskAssigner->assignTasks($tasks->toArray(), $developers);
        dd($assignedTasks);
    }


    private function getDevelopers(): array
    {
       return [
            new DeveloperDto('DEV1', 1),
            new DeveloperDto('DEV2', 2),
            new DeveloperDto('DEV3', 3),
        ];
    }
}
