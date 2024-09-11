<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    public function all(): Collection;

    public function upsert(array $data): void;
}
