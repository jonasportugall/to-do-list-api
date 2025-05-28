<?php

namespace App\Interfaces;
use App\Models\Task;
use App\DTOs\StoreTaskDTO;
use App\DTOs\UpdateTaskStatusDTO;

interface TaskRepositoryInterface{
    public function store(StoreTaskDTO $storeTaskDTO,$userId);
    public function getAll($userId);
    public function save(Task $task);
    public function getTaskById( $taskId );
    public function delete(Task $taskId);
}