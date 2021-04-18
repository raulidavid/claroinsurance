<?php

namespace Madsis\Api\Providers;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Http/routes.php');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
}
