<?php

namespace App\Providers;

use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\IBaseRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\ICategoryRepository;
use App\Repositories\DeliveryLocation\DeliveryLocationRepository;
use App\Repositories\DeliveryLocation\IDeliveryLocationRepository;
use App\Repositories\OrderPlaced\IOrderPlacedRepository;
use App\Repositories\OrderPlaced\OrderPlacedRepository;
use App\Repositories\Product\IProductRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IBaseRepository::class, BaseRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IOrderPlacedRepository::class, OrderPlacedRepository::class);
        $this->app->bind(IDeliveryLocationRepository::class, DeliveryLocationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
