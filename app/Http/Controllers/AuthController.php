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

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auths"},
     *     summary="Login to user",
     *     description="Authentication to users",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Logged successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="Bearer eyJ0eXAiOiJKV1Qi...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inválid credentials"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Inválid datas"
     *     ),
     * )
     */
    public function login(LoginRequest $request){
        $response = $this->authService->login($request->toDTO());
        return response()->json($response, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Auths"},
     *     summary="Register fo user",
     *     description="Endpoint to create the user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password", "password_confirmation", "role_ids"},
     *             @OA\Property(property="name", type="string", example="jonas"),
     *             @OA\Property(property="email", type="string", format="email", example="jonascportugal30@gmail.com"),
     *             @OA\Property(property="password", type="string", format="password", example="12345678"),
     *             @OA\Property(property="password_confirmation", type="string", format="password", example="12345678"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User Registered successful",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="Bearer eyJ0eXAiOiJKV1Qi...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Inválid datas",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(property="email", type="array", @OA\Items(type="string", example="The email field is required."))
     *             )
     *         )
     *     )
     * )
     */
    public function register(StoreUserRequest $request)
    {
        $response = $this->authService->register($request->toDTO());
        return response()->json($response, 201);
    }


}
