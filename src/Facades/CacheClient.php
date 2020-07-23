<?php
namespace Yxx\LaravelQuick\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class  CacheClient
 * @method static \Yxx\LaravelQuick\Services\CacheService          rememberForever($key, \Closure $param)
 * @method static \Yxx\LaravelQuick\Services\CacheService          setDefaultCacheTime(\Illuminate\Config\Repository $config)
 * @method static \Yxx\LaravelQuick\Services\CacheService          getDefaultCacheTime()
 * @method static \Yxx\LaravelQuick\Services\CacheService          increment($key, int $value)
 * @method static \Yxx\LaravelQuick\Services\CacheService          decrement($key, int $value)
 * @method static \Yxx\LaravelQuick\Services\CacheService          remember($fmt, int $int, \Closure $param)
 * @method static \Yxx\LaravelQuick\Services\CacheService          hGet($sKey, $field)
 * @method static \Yxx\LaravelQuick\Services\CacheService          hSet($sKey, $field, $content, $time = NULL)
 * @method static \Yxx\LaravelQuick\Services\CacheService          hDel($key, $hashKey1, $hashKey2 = NULL, $hashKeyN = NULL)
 * @method static \Yxx\LaravelQuick\Services\CacheService          hIncrBy($key, $field, $increment, $ttl = NULL)
 * @method static \Yxx\LaravelQuick\Services\CacheService          hLen($sKey)
 * @method static \Yxx\LaravelQuick\Services\CacheService          hExists($sKey, $field)
 * @method static \Yxx\LaravelQuick\Services\CacheService          lRem($sKey, $value, $count)
 * @method static \Yxx\LaravelQuick\Services\CacheService          lRange($sKey, $start, $end)
 * @method static \Yxx\LaravelQuick\Services\CacheService          lLen($sKey)
 * @method static \Yxx\LaravelQuick\Services\CacheService          lPush($sKey, $value)
 * @method static \Yxx\LaravelQuick\Services\CacheService          rPush($sKey, $value)
 * @method static \Yxx\LaravelQuick\Services\CacheService          rPop($sKey)
 * @method static \Yxx\LaravelQuick\Services\CacheService          lPop($sKey)
 * @method static \Yxx\LaravelQuick\Services\CacheService          pfAdd($sKey, $value)
 * @method static \Yxx\LaravelQuick\Services\CacheService          pfCount($sKey)
 * @method static \Yxx\LaravelQuick\Services\CacheService          zAdd($sKey, $score1, $value1)
 * @method static \Yxx\LaravelQuick\Services\CacheService          zCount($sKey, $start, $end)
 * @method static \Yxx\LaravelQuick\Services\CacheService          zRemRangeByScore($sKey, $start, $end)
 * @method static \Yxx\LaravelQuick\Services\CacheService          redisExpire($key, $ttl)
 * @method static \Yxx\LaravelQuick\Services\CacheService          incrementEx($key, $value = 1, $ttl = NULL)
 * @method static \Yxx\LaravelQuick\Services\CacheService          decrementEx($key, $value = 1, $ttl = NULL)
 * @method static \Yxx\LaravelQuick\Services\CacheService          flushAll()
 * @method static \Yxx\LaravelQuick\Services\CacheService          sCard($sKey)
 * @method static \Yxx\LaravelQuick\Services\CacheService          sAdd($key, $value)
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
