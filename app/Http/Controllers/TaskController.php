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
     *     summary="Criar uma nova tarefa",
     *     description="Endpoint para criar uma nova tarefa",
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

    public function delete($taskId)
    {
        $this->taskService->delete( $taskId );
        return response()->json('Task deleted successful', 200);
    }

    public function filterByStatus($status)
    {
        $tasks = $this->taskService->filterByStatus($status);
        return response()->json($tasks, 200);
    }

}
