<?php
namespace SIEC\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'SIEC\Model' => 'SIEC\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();
        /*Route::group([ 'middleware' => 'cors'], function() {
            
        });*/
        /*
        Passport::routes();    

        Passport::personalAccessTokensExpireIn(now()->addHours(24));
        Passport::refreshTokensExpireIn(now()->addDays(30));


        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));*/
    }
}
