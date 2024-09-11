<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    public function all(): Collection
    {
        return Task::all();
    }

    public function upsert(array $data): void
    {
        Task::upsert(
            $data,
            ['provider_id', 'provider']
        );
    }
}
