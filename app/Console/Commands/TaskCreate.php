<?php

namespace App\Console\Commands;

use App\Repositories\TaskRepository;
use App\Services\Providers\TaskProviderFactory;
use App\Services\TaskService;
use Illuminate\Console\Command;

class TaskCreate extends Command
{
    private $providers = ['Task1Provider', 'Task2Provider'];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:task-create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle()
    {
        $taskService = new TaskService(new TaskRepository);

        foreach ($this->providers as $provider) {
            $provider = TaskProviderFactory::createProvider($provider);
            $taskService->addTasks($provider->getTasks());
        }

        $taskService->save();
    }
}
