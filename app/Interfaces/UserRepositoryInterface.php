<?php

namespace App\Interfaces;
use App\Models\User;
use App\DTOs\StoreUserDTO;

interface UserRepositoryInterface{
    public function store(StoreUserDTO $storeUserDTO);
}