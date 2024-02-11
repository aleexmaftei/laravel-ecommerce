<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Enums\RoleEnum;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define("can-edit-product", static function(User $user, Product $product) {
            return $user->id === RoleEnum::ADMIN->value || $product->user()->value("id") === $user->id;
        });

        Gate::define("can-delete-product", static function(User $user) {
            return $user->id === RoleEnum::ADMIN->value;
        });
    }
}
