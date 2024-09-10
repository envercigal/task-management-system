<?php

namespace App\Http\Controllers;

use App\Services\DifficultyTaskAssignerStrategy;
use App\Services\TaskService;

class TaskController extends Controller {
    public function index(TaskService $taskService) {
        $taskService->assignTasks(new DifficultyTaskAssignerStrategy());
    }
}
