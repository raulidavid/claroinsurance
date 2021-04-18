<?php

namespace Madsis\Postulant\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class PostulantServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'postulant');
    }

}
