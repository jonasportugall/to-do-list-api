<?php

namespace App\Repositories;
use App\Models\User;
use App\Interfaces\UserRepositoryInterface;
use App\DTOs\StoreUserDTO;

class UserRepository implements UserRepositoryInterface{

    public function store(StoreUserDTO $storeUserDTO){
        return User::create([
            'name'=>$storeUserDTO->name,
            'email'=>$storeUserDTO->email,
            'password' => bcrypt($storeUserDTO->password),
        ]);
    }
}