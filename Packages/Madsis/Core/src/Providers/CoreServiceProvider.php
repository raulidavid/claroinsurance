<?php

namespace Madsis\Core\Providers;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Event;
use Madsis\Theme\ViewRenderEventManager;
// use Madsis\Core\View\Compilers\BladeCompiler;
use Madsis\Core\Console\Commands\BookingCron;
use Madsis\Core\Core;
use Madsis\Core\Exceptions\Handler;
use Madsis\Core\Facades\Core as CoreFacade;
use Madsis\Core\Models\SliderProxy;
use Madsis\Core\Observers\SliderObserver;
use Madsis\Core\Console\Commands\BagistoVersion;
use Madsis\Core\Console\Commands\Install;
use Madsis\Core\Console\Commands\ExchangeRateUpdate;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        include __DIR__ . '/../Http/helpers.php';

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->registerEloquentFactoriesFrom(__DIR__ . '/../Database/Factories');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'core');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'core');
        /*
        Validator::extend('slug', 'Madsis\Core\Contracts\Validations\Slug@passes');

        Validator::extend('code', 'Madsis\Core\Contracts\Validations\Code@passes');

        Validator::extend('decimal', 'Madsis\Core\Contracts\Validations\Decimal@passes');
        */
        $this->publishes([
            dirname(__DIR__) . '/Config/concord.php' => config_path('concord.php'),
            dirname(__DIR__) . '/Config/scout.php' => config_path('scout.php'),
        ]);
        /*
        $this->app->bind(
            ExceptionHandler::class,
            Handler::class
        );

        SliderProxy::observe(SliderObserver::class);

        Event::listen('bagisto.shop.layout.body.after', static function(ViewRenderEventManager $viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('core::blade.tracer.style');
        });

        Event::listen('bagisto.admin.layout.head', static function(ViewRenderEventManager $viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('core::blade.tracer.style');
        });*/
    }

    public function register()
    {
        $this->registerFacades();

        $this->registerCommands();

        // $this->registerBladeCompiler();
    }

    protected function registerFacades()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('core', CoreFacade::class);

        $this->app->singleton('core', function () {
            return app()->make(Core::class);
        });
    }

    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                BagistoVersion::class,
                Install::class,
                ExchangeRateUpdate::class,
                BookingCron::class
            ]);
        }
    }

    protected function registerEloquentFactoriesFrom($path): void
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }

    public function registerBladeCompiler()
    {
        $this->app->singleton('blade.compiler', function ($app) {
            return new BladeCompiler($app['files'], $app['config']['view.compiled']);
        });
    }
}
