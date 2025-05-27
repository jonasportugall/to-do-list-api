<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;

use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskRepositoryInterface::class,TaskRepository::class);  
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class); 
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //To custom Personal Access Token of Sanctum token
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
