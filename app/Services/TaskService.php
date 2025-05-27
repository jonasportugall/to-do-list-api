<?php

namespace App\Services;
use App\Interfaces\TaskRepositoryInterface;
use App\Http\Requests\StoreTaskRequest;
use App\DTOs\StoreTaskDTO;
use Illuminate\Support\Facades\Auth;

class TaskService{

    private $taskRepositoryInterface;

    public function __construct(TaskRepositoryInterface $taskRepositoryInterface){
        $this->taskRepositoryInterface = $taskRepositoryInterface;
    }

    public function store(StoreTaskDTO $storeTaskDTO)
    {
        try {
            $userId = Auth::user()->id;
            $task = $this->taskRepositoryInterface->store($storeTaskDTO, $userId);
            return $task;
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to register task: ' . $e->getMessage(), 500);
        }
    }

    public function getAll()
    {
        try {
            $userId = Auth::user()->id;
            return $this->taskRepositoryInterface->getAll($userId);
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to retrieve tasks: ' . $e->getMessage(), 500);
        }
    }




}