<?php

namespace App\Services;

use App\Dtos\DeveloperDto;
use App\Dtos\TaskDto;
use App\Repositories\TaskRepositoryInterface;
use App\Services\TaskAssigmentStrategies\TaskAssigner;
use Illuminate\Support\Collection;

class TaskService
{
    private Collection $tasks;

    private TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->tasks = collect();
        $this->taskRepository = $taskRepository;
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

    public function save(): void
    {
        if ($this->tasks->isEmpty()) {
            return;
        }

        $this->taskRepository->upsert(
            $this->tasks->map(fn (TaskDto $taskDto) => $taskDto->toArray())->toArray()
        );
    }

    public function assignTasks(TaskAssigner $taskAssigner): array
    {
        $tasks = $this->taskRepository->all();
        $developers = $this->getDevelopers();

        return $taskAssigner->assignTasks($tasks->toArray(), $developers, 45);
    }

    /* Mock developer data*/

    private function getDevelopers(): array
    {
        return [
            new DeveloperDto('DEV1', 1),
            new DeveloperDto('DEV2', 2),
            new DeveloperDto('DEV3', 3),
            new DeveloperDto('DEV4', 4),
            new DeveloperDto('DEV5', 5),
        ];
    }
}
