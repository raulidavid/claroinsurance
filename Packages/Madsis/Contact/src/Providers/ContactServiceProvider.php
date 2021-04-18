<?php

namespace Madsis\Contact\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class ContactServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'contact');
    }
}
