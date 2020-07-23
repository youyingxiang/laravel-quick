<?php
/**
 * Created by PhpStorm.
 * User: youxingxiang
 * Date: 2020/7/23
 * Time: 9:17 AM
 */

namespace Yxx\LaravelQuick;

use Illuminate\Support\ServiceProvider;

class LaravelQuickServiceProvider extends ServiceProvider
{
    public function register()
    {
        dd('123');
    }

    public function boot()
    {
        dd('2134');
    }
}
