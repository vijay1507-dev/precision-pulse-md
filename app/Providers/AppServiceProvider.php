<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrap();
        //Passport::ignoreRoutes();

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

      Passport::enablePasswordGrant();
      Passport::tokensExpireIn(now()->addMinutes(60));
    
    }
}
