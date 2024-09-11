<?php

nameSpace App\Services\Providers;

use App\Adapters\Task1ProviderProviderAdapter;
use App\Adapters\Task2ProviderProviderAdapter;
use App\Adapters\TaskProviderAdapter;

class TaskProviderFactory
{
    public static function createProvider(string $provider): TaskProviderAdapter
    {
        return match ($provider) {
            'Task1Provider' => new Task1ProviderProviderAdapter(new TaskProvider1()),
            'Task2Provider' => new Task2ProviderProviderAdapter(new TaskProvider2()),
            default => throw new \Exception("Provider {$provider} not supported"),
        };
    }

}
