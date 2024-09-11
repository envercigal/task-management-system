<?php

namespace App\Adapters;

use App\Dtos\TaskDto;
use App\Services\Providers\TaskProvider;
use Illuminate\Support\Collection;

class Task1ProviderProviderAdapter implements TaskProviderAdapter
{
    public function __construct(private TaskProvider $taskService) {}

    public function getTasks(): Collection
    {
        $data = $this->taskService->execute();
        $collection = collect();

        if (empty($data)) {
            return collect();
        }

        foreach ($data as $task) {
            $task = new TaskDto($task['value'], $task['estimated_duration'], 'TaskProvider1', $task['id']);
            $collection->push($task);
        }

        return $collection;
    }
}
