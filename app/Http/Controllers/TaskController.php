<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Services\TaskAssigmentStrategies\DifficultyTaskAssignerStrategy;
use App\Services\TaskAssigmentStrategies\TaskAssigner;
use App\Services\TaskService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class TaskController extends Controller
{
    public function index(): View|Factory|Application
    {
        $taskService = new TaskService(new TaskRepository);

        return view('tasks', [
            'tasks' => $taskService->assignTasks(new TaskAssigner(new DifficultyTaskAssignerStrategy)),
        ]);
    }
}
