<?php

namespace Madsis\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        /*
        $this->publishes([
            __DIR__ . '/../../publishable/assets' => public_path('themes/default/assets'),
        ], 'public');*/

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'auth');

        // $this->composeView();

        // Paginator::defaultView('shop::partials.pagination');
        // Paginator::defaultSimpleView('shop::partials.pagination');
    }

    /*

    public function register()
    {
        $this->registerConfig();
    }

    protected function composeView()
    {
        view()->composer('shop::customers.account.partials.sidemenu', function ($view) {
            $tree = Tree::create();

            foreach (config('menu.customer') as $item) {
                $tree->add($item, 'menu');
            }

            $tree->items = core()->sortItems($tree->items);

            $view->with('menu', $tree);
        });
    }

    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/menu.php', 'menu.customer'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );
    }*/
}