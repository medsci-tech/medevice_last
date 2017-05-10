<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\BasicShop\UCenter\UCenter;

class UCenterProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ucenter', function ($app) {
            return new UCenter();
        });
    }
}
