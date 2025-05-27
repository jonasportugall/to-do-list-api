<?php

namespace App\Interfaces;
use App\Models\Task;
use App\DTOs\StoreTaskDTO;

interface TaskRepositoryInterface{
    public function store(StoreTaskDTO $storeTaskDTO,$userId);
    public function getAll($userId);
}