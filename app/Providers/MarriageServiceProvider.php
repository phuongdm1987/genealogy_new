<?php

namespace Genealogy\Providers;

use Illuminate\Support\ServiceProvider;

class MarriageServiceProvider extends ServiceProvider
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
            \Genealogy\Hocs\Marriages\MarriageRepository::class,
            \Genealogy\Hocs\Marriages\DbMarriageRepository::class
        );
    }
}
