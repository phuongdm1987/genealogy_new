<?php

namespace Genealogy\Providers;

use Illuminate\Support\ServiceProvider;

class EmploymentServiceProvider extends ServiceProvider
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
            \Genealogy\Hocs\Employments\EmploymentRepository::class,
            \Genealogy\Hocs\Employments\DbEmploymentRepository::class
        );
    }
}
