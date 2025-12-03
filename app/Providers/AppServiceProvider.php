<?php

namespace App\Providers;

use App\Service\AuthServiceImpl;
use App\Service\Contract\AuthServiceInterface;
use App\Service\Contract\KelasServiceInterface;
use App\Service\KelasServiceImpl;
use App\Service\MateriService;
use App\Service\MateriServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthServiceImpl::class);
        $this->app->bind(KelasServiceInterface::class, KelasServiceImpl::class);
        $this->app->bind(MateriServiceInterface::class, MateriService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
