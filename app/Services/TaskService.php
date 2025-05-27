<?php

namespace App\Services;
use App\Interfaces\TaskRepositoryInterface;

class TaskService{

    private $taskRepositoryInterface;

    public function __construct(TaskRepositoryInterface $taskRepositoryInterface){
        $this->taskRepositoryInterface = $taskRepositoryInterface;
    }


}