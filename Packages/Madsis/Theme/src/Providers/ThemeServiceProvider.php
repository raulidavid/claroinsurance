<?php

namespace Madsis\Theme\Providers;

use Illuminate\Support\ServiceProvider;
use Madsis\Theme\Themes;
use Madsis\Theme\Facades\Themes as ThemeFacade;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../Http/helpers.php';
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('themes', function () {
            return new Themes();
        });

        $this->app->singleton('view.finder', function ($app) {
            return new \Madsis\Theme\ThemeViewFinder(
                $app['files'],
                $app['config']['view.paths'],
                null
            );
        });
    }
}
