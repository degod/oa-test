<?php

namespace App\Providers;

use App\Repositories\Project\ProjectRepository;
use App\Repositories\Project\ProjectRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('role', function ($role) {
            return Auth::check() && Auth::user()->role === $role;
        });
    }
}
