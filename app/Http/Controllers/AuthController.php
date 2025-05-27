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

    public function login(LoginRequest $request){
        try {

            $response = $this->authService->login($request->toDTO());
            return response()->json($response, 200);

        } catch (\RuntimeException $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'An error occurred while attempting to login.',
                'error_cause' => $e->getMessage()
            ], 500);
        }
    }

    public function register(StoreUserRequest $request)
    {
        try {
            $response = $this->authService->register($request->toDTO());
            return response()->json($response, 201);
            
        } catch (\RuntimeException $e) {
            return response()->json([
                'message' => 'Registration failed',
                'error_cause' => $e->getMessage()
            ], 500);
        }
    }


}
