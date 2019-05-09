<?php

namespace Hosein\Aboutus;

use Illuminate\Support\ServiceProvider;

class AboutusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'AboutView');
        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/AboutView'),
        ],"aboutview");
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->publishes([
            __DIR__.'/Migrations' => database_path('/migrations')
        ], 'aboutmigrations');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
