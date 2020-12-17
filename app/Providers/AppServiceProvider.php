<?php

namespace App\Providers;

use App\Models\XmlProcess;
use App\Observers\XmlProcessObserver;
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

        $this->app->bind(
            'App\Repositories\Contracts\PeopleRepositoryInterface',
            'App\Repositories\Eloquent\PeopleRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\PeoplePhoneRepositoryInterface',
            'App\Repositories\Eloquent\PeoplePhoneRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ShiporderRepositoryInterface',
            'App\Repositories\Eloquent\ShiporderRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ShiporderItemRepositoryInterface',
            'App\Repositories\Eloquent\ShiporderItemRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\XmlProcessRepositoryInterface',
            'App\Repositories\Eloquent\XmlProcessRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        XmlProcess::observe(XmlProcessObserver::class);
    }
}
