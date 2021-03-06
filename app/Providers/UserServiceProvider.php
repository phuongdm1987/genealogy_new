<?php

namespace Genealogy\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \Genealogy\Hocs\Users\UserRepository::class,
            \Genealogy\Hocs\Users\DbUserRepository::class
        );
    }
}
