<?php

namespace App\Repositories;
use App\Models\Task;
use App\Interfaces\TaskRepositoryInterface;
use App\DTOs\StoreTaskDTO;

class TaskRepository implements TaskRepositoryInterface{
    
    public function store(StoreTaskDTO $storeTaskDTO,$userId){
        return Task::create([
            'title' => $storeTaskDTO->title,
            'description'=>$storeTaskDTO->description,
            'status'=>'pending',
            'user_id'=>$userId
        ]);
    }

    public function getAll($userId){
        return Task::where('user_id' , $userId)->get();
    }

    public function getTaskById( $taskId ){
        return Task::where('id',$taskId)->first();
    }

    public function save(Task $task){
       return $task->save();
    }

    public function delete(Task $task){
        $task->delete();
    }

    public function getAllByStatusAndUserId($status,$userId){
        return Task::where('status',$status)
                   ->where('user_id',$userId)
                   ->orderBy('created_at','desc')
                   ->get();
    }



}