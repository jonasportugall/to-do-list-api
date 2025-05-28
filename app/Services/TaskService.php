<?php

namespace App\Services;
use App\Interfaces\TaskRepositoryInterface;
use App\Http\Requests\StoreTaskRequest;
use App\DTOs\StoreTaskDTO;
use App\DTOs\UpdateTaskStatusDTO;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\TaskNotFoundException;

class TaskService{

    private $taskRepositoryInterface;

    public function __construct(TaskRepositoryInterface $taskRepositoryInterface)
    {
        $this->taskRepositoryInterface = $taskRepositoryInterface;
    }

    public function store(StoreTaskDTO $storeTaskDTO)
    {
        $userId = Auth::user()->id;
        return $this->taskRepositoryInterface->store($storeTaskDTO, $userId);
    }

    public function getAll()
    {
        $userId = Auth::user()->id;
        return $this->taskRepositoryInterface->getAll($userId);
    }

    public function updateStatus(UpdateTaskStatusDTO $dto, $taskId)
    {
        $task = $this->taskRepositoryInterface->getTaskById($taskId);
        if (!$task) {
            throw new TaskNotFoundException();
        }

        $task->status = $dto->status;
        $this->taskRepositoryInterface->save($task);

        return $task;
    }
    
    public function delete($taskId)
    {
        $task = $this->taskRepositoryInterface->getTaskById($taskId);
        if(!$task)throw new TaskNotFoundException();

        $this->taskRepositoryInterface->delete($task);
    }

    public function filterByStatus($status)
    {
        $userId = Auth::user()->id;
        return $this->taskRepositoryInterface->getAllByStatusAndUserId($status,$userId);
    }


}