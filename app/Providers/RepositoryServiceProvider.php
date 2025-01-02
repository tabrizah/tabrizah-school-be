<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Repositories\SystemLogRepositoryInterface;
use App\Repositories\SystemLogRepository;
use App\Interfaces\Services\SystemLogServiceInterface;
use App\Services\SystemLogService;
use App\Interfaces\Repositories\AuthRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Interfaces\Services\AuthServiceInterface;
use App\Services\AuthService;
use App\Interfaces\Repositories\UserProfileRepositoryInterface;
use App\Repositories\UserProfileRepository;
use App\Interfaces\Services\UserProfileServiceInterface;
use App\Services\UserProfileService;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SystemLogRepositoryInterface::class, SystemLogRepository::class);
        $this->app->bind(SystemLogServiceInterface::class, SystemLogService::class);
        
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        
        $this->app->bind(UserProfileRepositoryInterface::class, UserProfileRepository::class);
        $this->app->bind(UserProfileServiceInterface::class, UserProfileService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
