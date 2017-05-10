<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\BasicShop\Wechat\Wechat;

class WechatServiceProvider extends ServiceProvider
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
        $this->app->singleton('wechat', function ($app) {
            return new Wechat();
        });
    }
}
