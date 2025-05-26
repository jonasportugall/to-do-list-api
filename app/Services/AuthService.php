<?php

namespace App\Services;
use App\Interfaces\UserInterface;
use App\DTOs\StoreUserDTO;

class AuthService{

    private $userInterface;

    public function __construct(UserInterface $userInterface){
        $this->userInterface = $userInterface;
    }

    public function register(StoreUserDTO $storeUserDTO){
        $user = $this->userInterface->store( $storeUserDTO );
        $accessToken = $this->generateUserAccessToken( $user ); //To do authomatically login after register of user
        
        return [
            'user'  => $user->only(['id','name','email']),
            'token' => $accessToken
        ];
    }

    private function generateUserAccessToken(User $user){
        return $user->createToken('auth_access_token')->plainTextToken;
    }

}