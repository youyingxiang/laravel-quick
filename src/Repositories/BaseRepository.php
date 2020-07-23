<?php

namespace Yxx\LaravelQuick\Repositories;

class BaseRepository
{
    public static function make(...$params)
    {
        return new static(...$params);
    }
}
