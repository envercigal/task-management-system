<?php

namespace App\Adapters;

use Illuminate\Support\Collection;

interface TaskProviderAdapter {
    public function getTasks(): Collection;
}
