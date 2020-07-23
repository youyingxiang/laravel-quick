<?php

namespace Yxx\LaravelQuick\Repositories;

use Illuminate\Support\Traits\Macroable;

class BaseRepository
{
    public static function make(...$params)
    {
        return new static(...$params);
    }
}
