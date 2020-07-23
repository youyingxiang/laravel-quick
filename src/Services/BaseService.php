<?php

namespace Yxx\LaravelQuick\Services;

use Illuminate\Support\Traits\Macroable;

class BaseService
{
    use Macroable;
    /**
     * @param mixed ...$params
     * @return BaseService
     */
    public static function make(...$params)
    {
        return new static(...$params);
    }
}
