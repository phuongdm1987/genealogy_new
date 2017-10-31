<?php

namespace Genealogy\Providers;

use Illuminate\Support\ServiceProvider;

class EducationServiceProvider extends ServiceProvider
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
            \Genealogy\Hocs\Educations\EducationRepository::class,
            \Genealogy\Hocs\Educations\DbEducationRepository::class
        );
    }
}
