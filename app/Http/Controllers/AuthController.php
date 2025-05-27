<?php

namespace App\Http\Controllers;
use App\Services\AuthService;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginRequest;

class AuthController
{
    private $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function login(){

    }

    public function register(StoreUserRequest $request){
        $response = $this->authService->register( $request->toDTO() );
        return response()->json($response, 201);
    }



    



}
