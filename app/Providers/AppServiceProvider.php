<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ActivityRepositoryInterface',
            'App\Repositories\Eloquent\ActivityRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\RoleRepositoryInterface',
            'App\Repositories\Eloquent\RoleRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\PermissionRepositoryInterface',
            'App\Repositories\Eloquent\PermissionRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
