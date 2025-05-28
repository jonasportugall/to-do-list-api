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
        $task = $this->taskService->store($request->toDTO());
        return response()->json($task, 201);
    }

    public function getAll()
    {
        $tasks = $this->taskService->getAll();
        return response()->json($tasks, 200);
    }

    public function updateStatus(UpdateTaskStatusRequest $request, $taskId)
    {
        $task = $this->taskService->updateStatus($request->toDTO(), $taskId);
        return response()->json($task, 200);
    }

    public function delete($taskId){
        $this->taskService->delete( $taskId );
        return response()->json('Task deleted successful', 200);
    }

    public function filterByStatus($status)
    {
        $tasks = $this->taskService->filterByStatus($status);
        return response()->json($tasks, 200);
    }

}
