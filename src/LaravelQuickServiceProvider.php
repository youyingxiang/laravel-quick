<?php
/**
 * Created by PhpStorm.
 * User: youxingxiang
 * Date: 2020/7/23
 * Time: 9:17 AM
 */

namespace Yxx\LaravelQuick;

use Illuminate\Support\ServiceProvider;
use Yxx\LaravelQuick\Services\CacheService;

class LaravelQuickServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerServices();
    }

    public function boot()
    {
        $this->registerPublishing();
    }

    protected function registerServices()
    {
        $this->app->singleton('quick.cache.service', CacheService::class);
    }

    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config' => config_path()]);
            $this->publishes([__DIR__ . '/../resources/lang' => resource_path('lang')]);
        }
    }
}
