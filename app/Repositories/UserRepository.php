<?php

namespace App\Repositories;
use App\Models\User;
use App\Interfaces\UserInterface;
use App\DTOs\StoreUserDTO;

class UserRepository implements UserInterface{

    public function store(StoreUserDTO $storeUserDTO){
        return User::create([
            'name'=>$storeUserDTO->name,
            'email'=>$storeUserDTO->email,
            'password' => bcrypt($storeUserDTO->password),
        ]);
    }
}