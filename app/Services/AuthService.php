<?php

namespace App\Services;
use App\Interfaces\UserRepositoryInterface;
use App\DTOs\StoreUserDTO;
use App\DTOs\LoginDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService{

    private $userRepositoryInterface;

    public function __construct(userRepositoryInterface $userRepositoryInterface){
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function login(LoginDTO $loginDTO)
    {
        $user = $this->userRepositoryInterface->getUserByEmail($loginDTO->email);
    
        if (!$user || !Hash::check($loginDTO->password, $user->password)) {
            throw new \RuntimeException('Invalid credentials');
        }
    
        $token = $this->generateUserAccessToken($user);
    
        return [
            'user'  => $user->only(['id','name','email']),
            'token' => $token
        ];
    }
    
    public function register(StoreUserDTO $storeUserDTO)
    {
        try {
            $user = $this->userRepositoryInterface->store($storeUserDTO);

            $accessToken = $this->generateUserAccessToken($user);

            return [
                'user'  => $user->only(['id', 'name', 'email']),
                'token' => $accessToken
            ];
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to register user: ' . $e->getMessage(), 500);
        }
    }

    public function generateUserAccessToken(User $user){
        return $user->createToken('auth_access_token')->plainTextToken;
    }

}