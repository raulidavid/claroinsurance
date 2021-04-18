<?php

namespace Madsis\User\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Madsis\User\Bouncer;
use Madsis\User\Facades\Bouncer as BouncerFacade;
use Madsis\User\Http\Middleware\Bouncer as BouncerMiddleware;

class UserServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        include __DIR__ . '/../Http/helpers.php';
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'user');
        $router->aliasMiddleware('admin', BouncerMiddleware::class);

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function register()
    {
        $this->registerBouncer();
    }

    protected function registerBouncer()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Bouncer', BouncerFacade::class);

        $this->app->singleton('bouncer', function () {
            return new Bouncer();
        });
    }
}
