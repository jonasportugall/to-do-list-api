<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
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

            return response()->json($task, 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Creted Task Failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getAll()
    {
        try {
            $tasks = $this->taskService->getAll();
            return response()->json($tasks, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }

    public function updateStatus(UpdateTaskStatusRequest $request, $taskId)
    {
        $task = $this->taskService->updateStatus($request->toDTO(), $taskId);
        return response()->json($task, 200);
        
    }

}
