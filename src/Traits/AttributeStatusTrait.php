<?php

namespace Yxx\LaravelQuick\Traits;

/**
 * Trait StatusAttributeTrait
 *
 * @package App\Traits
 */
trait AttributeStatusTrait
{

    public static function getStatusArrAttribute()
    {
        return (new static())->getStatusLists();
    }

    /**
     * @return mixed
     */
    public function getStatusLists()
    {
        return $this->statusLists ?: ['停用', '启用'];
    }

    public function getStatusTextAttribute()
    {
        return $this->getStatusArrAttribute()[$this->status];
    }

    /**
     * 状态范围查询（可传参指定要限定的状态范围，默认为大于0的内容）
     *
     * @param       $query
     * @param array $status
     *
     * @return mixed
     */
    public function scopeStatus($query, $status = [])
    {
        if (!is_array($status)) {
            $status = str2arr($status);
        }
        if (!empty($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', '>', 0);
    }
}
