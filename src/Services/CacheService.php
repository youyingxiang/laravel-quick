<?php

namespace Yxx\LaravelQuick\Services;

use Carbon\Carbon;
use DateInterval;
use DateTimeInterface;

/**
 * Class CacheService
 * @method rememberForever($key, \Closure $param)
 * @method setDefaultCacheTime(\Illuminate\Config\Repository $config)
 * @method getDefaultCacheTime()
 * @method increment($key, int $value)
 * @method decrement($key, int $value)
 * @method remember($fmt, int $int, \Closure $param)
 */
class CacheService extends BaseService
{

    public function __construct()
    {
        // 默认缓存有效期
        $this->setDefaultCacheTime(config('global.redis_key_expire'));
    }

    /**
     * @param      $key
     * @param      $field
     * @param      $increment
     * @param null $ttl
     */
    public function hIncrBy($key, $field, $increment, $ttl = NULL)
    {
        \RedisClient::hIncrBy(\Cache::getPrefix() . $key, $field, $increment);
        if ($ttl) {
            $seconds = $this->getSeconds($ttl);
            $this->redisExpire($key, $seconds);
        }
    }

    /**
     * @param $sKey
     * @param $field
     *
     * @return array|mixed|string
     */
    public function hGet($sKey, $field)
    {
        $sData = \RedisClient::hGet(\Cache::getPrefix() . $sKey, $field);
        if ($sData) {
            $aData = json_decode($sData, true);
            if ($aData && (is_object($aData)) || (is_array($aData) && !empty($aData))) {
                $result = $aData;
            } else {
                $result = $sData;
            }
            return $result;
        } else {
            return NULL;
        }
    }

    public function hDel($key, $hashKey1, $hashKey2 = NULL, $hashKeyN = NULL)
    {
        return \RedisClient::hDel(\Cache::getPrefix() . $key, $hashKey1, $hashKey2, $hashKeyN);
    }

    public function hLen($sKey)
    {
        return \RedisClient::hLen(\Cache::getPrefix() . $sKey);
    }

    /**
     * @param $sKey
     * @param $field
     *
     * @return bool
     */
    public function hExists($sKey, $field)
    {
        return \RedisClient::hExists($sKey, $field);
    }

    /**
     * @param      $sKey
     * @param      $field
     * @param      $content
     * @param null $time
     *
     * @return bool|int
     */
    public function hSet($sKey, $field, $content, $time = NULL)
    {
        if (is_array($content) || is_object($content)) {
            $bRes = \RedisClient::hSet(\Cache::getPrefix() . $sKey, $field, json_encode($content, true));
        } else {
            $bRes = \RedisClient::hSet(\Cache::getPrefix() . $sKey, $field, $content);
        }
        self::redisExpire($sKey, $time);
        return $bRes;
    }


    public function lRem($sKey, $value, $count)
    {
        return \RedisClient::lRem(\Cache::getPrefix() . $sKey, $count, $value);
    }

    /**
     * @param $sKey
     * @param $start
     * @param $end
     *
     * @return array
     */
    public function lRange($sKey, $start, $end)
    {
        return \RedisClient::lRange(\Cache::getPrefix() . $sKey, $start, $end);
    }

    public function lLen($sKey)
    {
        return \RedisClient::lLen(\Cache::getPrefix() . $sKey);
    }

    public function lPush($sKey, $value)
    {
        return \RedisClient::lPush(\Cache::getPrefix() . $sKey, $value);
    }

    public function rPush($sKey, $value)
    {
        return \RedisClient::rPush(\Cache::getPrefix() . $sKey, $value);
    }

    public function rPop($sKey)
    {
        return \RedisClient::rPop(\Cache::getPrefix() . $sKey);
    }

    public function lPop($sKey)
    {
        return \RedisClient::lPop(\Cache::getPrefix() . $sKey);
    }

    public function pfAdd($sKey, $value)
    {
        return \RedisClient::pfAdd(\Cache::getPrefix() . $sKey, $value);
    }

    public function pfCount($sKey)
    {
        return \RedisClient::pfCount(\Cache::getPrefix() . $sKey);
    }

    public function zAdd($sKey, $score1, $value1)
    {
        \RedisClient::zAdd(\Cache::getPrefix() . $sKey, $score1, $value1);
        return;
    }

    public function zCount($sKey, $start, $end)
    {
        return \RedisClient::zCount(\Cache::getPrefix() . $sKey, $start, $end);
    }

    public function zRemRangeByScore($sKey, $start, $end)
    {
        return \RedisClient::zRemRangeByScore(\Cache::getPrefix() . $sKey, $start, $end);
    }

    /**
     * @param $key
     * @param $ttl
     */
    public function redisExpire($key, $ttl)
    {
        \RedisClient::expire(\Cache::getPrefix() . $key, $ttl ?: $this->getDefaultCacheTime());
    }

    public function incrementEx($key, $value = 1, $ttl = NULL)
    {
        $res = $this->increment($key, $value);
        $seconds = $this->getSeconds($ttl);
        $this->redisExpire($key, $seconds);
        return $res;
    }

    public function decrementEx($key, $value = 1, $ttl = NULL)
    {
        $res = $this->decrement($key, $value);
        $seconds = $this->getSeconds($ttl);
        $this->redisExpire($key, $seconds);
        return $res;
    }


    public function sAdd($key, $value)
    {
        return \RedisClient::sAdd(\Cache::getPrefix() . $key, $value);
    }

    public function sCard($key)
    {
        return \RedisClient::sCard(\Cache::getPrefix() . $key);
    }

    public function flushAll()
    {
        return \RedisClient::flushAll();
    }

    public function sRandMember($key)
    {
        return \RedisClient::sRandMember(\Cache::getPrefix() . $key);
    }

    public function __call($method, $arguments)
    {
        return \Cache::$method(... $arguments);
    }

    protected function parseDateInterval($delay)
    {
        if ($delay instanceof DateInterval) {
            $delay = Carbon::now()->add($delay);
        }
        return $delay;
    }

    protected function getSeconds($ttl)
    {
        $duration = $this->parseDateInterval($ttl);

        if ($duration instanceof DateTimeInterface) {
            $duration = Carbon::now()->diffInRealSeconds($duration, false);
        }

        return (int)$duration > 0 ? $duration : 0;
    }
}
