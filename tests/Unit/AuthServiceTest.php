<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\DTOs\StoreUserDTO;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\WithFaker;

use Mockery;

class AuthServiceTest extends TestCase
{
   public function test_register_user_and_return_user_and_login_token(){

        $dto = new StoreUserDTO(name:"Jonas Campos P",email:"jonas@gmail.com",password:"12345678");

        $userRepositoryInterfaceMock = Mockery::mock(UserRepositoryInterface::class);

        $fakeUser = Mockery::mock(User::class)->makePartial();
        $fakeUser->shouldReceive('createToken')
            ->once()
            ->with('auth_access_token')
            ->andReturn((object)['plainTextToken' => 'fake_token_123']);
        $fakeUser->name = $dto->name;
        $fakeUser->email = $dto->email;
        $fakeUser->id = 'uuid-fake-id';

        $userRepositoryInterfaceMock
                    ->shouldReceive('store')
                    ->once()
                    ->with($dto)
                    ->andReturn($fakeUser);


        $authService = new AuthService( $userRepositoryInterfaceMock );

        $result = $authService->register( $dto );

        $this->assertEquals([
            'user'=> [
                'id'   => 'uuid-fake-id',
                'name' => 'Jonas Campos P',
                'email'=> 'jonas@gmail.com'
            ],
            'token' => 'fake_token_123'
        ], $result);
   }

   protected function tearDown(): void{
        Mockery::close();//close all createds mocks
        parent::tearDown();
   }
}
