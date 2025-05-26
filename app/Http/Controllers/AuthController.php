<?php

namespace App\Http\Controllers;
use App\Services\AuthService;

class AuthController
{
    private $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }


    public function register(StoreUserRequest $request){
        return $this->authService->register( $request->toDTO() );
    }



    



}
