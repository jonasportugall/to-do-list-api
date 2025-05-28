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

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     tags={"Tasks"},
     *     summary="Create task",
     *     description="Endpoint to create new task",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title"},
     *             @OA\Property(
     *                 property="title",
     *                 type="string",
     *                 minLength=3,
     *                 maxLength=255,
     *                 example="Comprar leite"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string",
     *                 minLength=3,
     *                 maxLength=500,
     *                 example="Ir ao supermercado e comprar leite integral"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tarefa criada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Comprar leite"),
     *             @OA\Property(property="description", type="string", example="Ir ao supermercado e comprar leite integral"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-28T10:00:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-28T10:00:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Dados inválidos"
     *     ),
     *     security={{"sanctum":{}}}
     * )
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->store($request->toDTO());
        return response()->json($task, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{taskId}/status",
     *     tags={"Tasks"},
     *     summary="Update task status",
     *     description="Updates the status of a task by its ID",
     *     @OA\Parameter(
     *         name="taskId",
     *         in="path",
     *         required=true,
     *         description="ID of the task to be updated",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 enum={"pending", "in_progress", "completed", "cancelled"},
     *                 example="completed",
     *                 description="New status for the task"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task status updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Buy groceries"),
     *             @OA\Property(property="description", type="string", example="Go to the supermarket and buy milk"),
     *             @OA\Property(property="status", type="string", example="completed"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-28T10:00:00Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-28T12:00:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     ),
     *     security={{"sanctum":{}}}
     * )
     */
    public function updateStatus(UpdateTaskStatusRequest $request, $taskId)
    {
        $task = $this->taskService->updateStatus($request->toDTO(), $taskId);
        return response()->json($task, 200);
    }
    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     tags={"Tasks"},
     *     summary="Retrieve all tasks",
     *     description="Returns a list of all tasks",
     *     @OA\Response(
     *         response=200,
     *         description="List of tasks retrieved successfully",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Buy groceries"),
     *                 @OA\Property(property="description", type="string", example="Go to the supermarket and buy milk"),
     *                 @OA\Property(property="status", type="string", example="pending"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-28T10:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-28T10:00:00Z")
     *             )
     *         )
     *     ),
     *     security={{"sanctum":{}}}
     * )
     */
    public function getAll()
    {
        $tasks = $this->taskService->getAll();
        return response()->json($tasks, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{taskId}",
     *     tags={"Tasks"},
     *     summary="Delete a task",
     *     description="Deletes a task by its ID",
     *     @OA\Parameter(
     *         name="taskId",
     *         in="path",
     *         required=true,
     *         description="ID of the task to be deleted",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task deleted successfully",
     *         @OA\JsonContent(
     *             type="string",
     *             example="Task deleted successfully"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     ),
     *     security={{"sanctum":{}}}
     * )
     */
    public function delete($taskId)
    {
        $this->taskService->delete( $taskId );
        return response()->json('Task deleted successful', 200);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/status/{status}",
     *     tags={"Tasks"},
     *     summary="Filter tasks by status",
     *     description="Returns a list of tasks filtered by their status",
     *     @OA\Parameter(
     *         name="status",
     *         in="path",
     *         required=true,
     *         description="Status of the tasks (e.g., pending, completed)",
     *         @OA\Schema(type="string", example="pending")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Filtered list of tasks by status",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=2),
     *                 @OA\Property(property="title", type="string", example="Do homework"),
     *                 @OA\Property(property="description", type="string", example="Math and science assignments"),
     *                 @OA\Property(property="status", type="string", example="completed"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-27T14:20:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-28T11:00:00Z")
     *             )
     *         )
     *     ),
     *     security={{"sanctum":{}}}
     * )
     */
    public function filterByStatus($status)
    {
        $tasks = $this->taskService->filterByStatus($status);
        return response()->json($tasks, 200);
    }

}
