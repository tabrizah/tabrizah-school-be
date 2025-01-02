<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Repositories\SystemLogRepositoryInterface;
use App\Repositories\SystemLogRepository;
use App\Interfaces\Services\SystemLogServiceInterface;
use App\Services\SystemLogService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SystemLogRepositoryInterface::class, SystemLogRepository::class);
        $this->app->bind(SystemLogServiceInterface::class, SystemLogService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
