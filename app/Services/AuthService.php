<?php

namespace App\Services;
use App\Interfaces\UserInterface;

class AuthService{

    private $userInterface;

    public function __construct(UserInterface $userInterface){
        $this->userInterface = $userInterface;
    }


}