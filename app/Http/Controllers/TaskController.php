<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\DTOs\StoreTaskDTO;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService){
        $this->taskService = $taskService;
    }

    public function store(StoreTaskRequest $request)
    {
        try {
            
            $task = $this->taskService->store($request->toDTO());

            return response()->json([
                'task' => $task,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Creted Task Failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
