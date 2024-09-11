<?php

namespace App\Http\Controllers;

use App\Services\TaskAssigmentStrategies\DifficultyTaskAssignerStrategy;
use App\Services\TaskAssigmentStrategies\TaskAssigner;
use App\Services\TaskService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class TaskController extends Controller
{
    public function index(TaskService $taskService): View|Factory|Application
    {
        return view('tasks', [
            'tasks' => $taskService->assignTasks(new TaskAssigner(new DifficultyTaskAssignerStrategy)),
        ]);
    }
}
