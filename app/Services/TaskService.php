<?php

namespace App\Services;
use App\Interfaces\TaskInterface;

class TaskService{

    private $taskInterface;

    public function __construct(TaskInterface $taskInterface){
        $this->taskInterface = $taskInterface;
    }


}