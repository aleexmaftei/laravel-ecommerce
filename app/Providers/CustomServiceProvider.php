<?php

namespace App\Providers;

use App\Services\NotificationService;
use App\Services\OrderPlacedService;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductService::class);
        $this->app->bind(UserService::class);
        $this->app->bind(OrderPlacedService::class);
        $this->app->bind(NotificationService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
