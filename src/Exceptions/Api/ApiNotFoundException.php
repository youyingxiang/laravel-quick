<?php
/**
 * Created by PhpStorm.
 * User: youxingxiang
 * Date: 2019/9/29
 * Time: 11:19 AM
 */

namespace Yxx\LaravelQuick\Exceptions\Api;

use Yxx\LaravelQuick\Exceptions\ApiException;

class ApiNotFoundException extends ApiException
{

    public function render()
    {
        $this->noFound($this->getMessage());
        return parent::render();
    }
}
