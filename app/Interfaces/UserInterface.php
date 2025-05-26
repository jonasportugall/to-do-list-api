<?php

namespace App\Interfaces;
use App\Models\User;
use App\DTOs\StoreUserDTO;

interface UserInterface{
    public function store(StoreUserDTO $storeUserDTO);
}