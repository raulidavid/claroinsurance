<?php

namespace SIEC\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
    }

    public function register()
    {
        if ($this->app->environment(['production'])) {
            $this->app->register(\Rollbar\Laravel\RollbarServiceProvider::class);
        }
    }
}
