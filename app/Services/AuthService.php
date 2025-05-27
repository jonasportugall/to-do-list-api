<?php

namespace App\Services;
use App\Interfaces\UserRepositoryInterface;
use App\DTOs\StoreUserDTO;
use App\Models\User;

class AuthService{

    private $userRepositoryInterface;

    public function __construct(userRepositoryInterface $userRepositoryInterface){
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function register(StoreUserDTO $storeUserDTO){
        $user = $this->userRepositoryInterface->store( $storeUserDTO );
        $accessToken = $this->generateUserAccessToken( $user ); //To do authomatically login after register of user
        
        return [
            'user'  => $user->only(['id','name','email']),
            'token' => $accessToken
        ];
    }

    public function generateUserAccessToken(User $user){
        return $user->createToken('auth_access_token')->plainTextToken;
    }

}