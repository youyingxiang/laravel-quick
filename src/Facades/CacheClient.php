<?php
namespace Yxx\LaravelQuick\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @see \Illuminate\Cache\CacheManager
 * @see \Illuminate\Cache\Repository
 */
class CacheClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'quick.cache.service';
    }
}
