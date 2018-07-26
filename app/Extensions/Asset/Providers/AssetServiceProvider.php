<?php

namespace App\Extensions\Asset\Providers;

use Illuminate\Support\ServiceProvider;

// 资金
class AssetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // 设置所有bc数学函数的默认小数点保留位数
        bcscale(4);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('asset', function ($app) {
            return new \App\Extensions\Asset\Asset;
        });
    }
}
