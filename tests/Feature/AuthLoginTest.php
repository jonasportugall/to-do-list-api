<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AuthLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_returns_token_and_user_when_credentials_are_correct()
    {
        $user = User::factory()->create([
            'name'=>'Teste',
            'email' => 'jonas@example.com',
            'password' => Hash::make('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'jonas@example.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'user' => ['id', 'name', 'email'],
            'token'
        ]);
    }

    public function test_login_fails_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'jonas@example.com',
            'password' => Hash::make('correct-password')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'jonas@example.com',
            'password' => 'wrong-password'
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Invalid credentials'
        ]);
    }
}
