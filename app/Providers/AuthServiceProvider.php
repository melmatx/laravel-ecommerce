<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        Gate::define('view-cart', fn($user = null) => !isset($user) || $user->role != 'seller');
        Gate::define('manage-products', fn($user) => in_array($user->role, ['seller', 'admin']));
        Gate::define('manage-categories', fn($user) => $user->role === 'admin');
    }
}
