<?php

namespace App\Providers;

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

        // Si roles == 1, es Admin
        Gate::define('es-admin', function ($user) {
            return $user->roles === 1;
        });

        // Si roles == 2, es Usuario
        Gate::define('es-user', function ($user) {
            return $user->roles === 2;
        });

        // Si roles == 3, es Configurador
        Gate::define('es-config', function ($user) {
            return $user->roles === 3;
        });
    }
}