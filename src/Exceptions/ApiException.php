<?php

namespace Yxx\LaravelQuick\Exceptions;

use Illuminate\Support\Traits\Macroable;
use Yxx\LaravelQuick\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

class ApiException extends Exception
{
    use JsonResponseTrait, Macroable;

    // 不论对错，返回的http status code均为200，在返回的json中code为负数时表示错误信息，大于0表示成功
    // 错误信息中把 http status code变为负数表示对应的含义，如 -404 表示 No Found
    const DB_ERROR = -FoundationResponse::HTTP_NOT_IMPLEMENTED;
    const AUTH_ERROR = -FoundationResponse::HTTP_UNAUTHORIZED;
    const PERMISSION_ERROR = -FoundationResponse::HTTP_FORBIDDEN;
    const NO_FOUND_ERROR = -FoundationResponse::HTTP_NOT_FOUND;
    const SYS_ERROR = -FoundationResponse::HTTP_INTERNAL_SERVER_ERROR;
    const BAD_REQUEST = -FoundationResponse::HTTP_BAD_REQUEST;

    public $errorData = NULL;

    public function __construct($message = "", $code = self::SYS_ERROR, $data = NULL, Exception $previous = NULL)
    {
        parent::__construct($message, $code, $previous);
        $this->errorData = $data;
    }

    public function noFound($message = '')
    {
        $this->message = $message ?: '没有找到对象';
        $this->code    = self::NO_FOUND_ERROR;
        return $this;
    }

    public function unauthorized($message = '')
    {
        $this->message = $message ?: '验证失败，请先登录';
        $this->code    = self::AUTH_ERROR;
        return $this;
    }

    public function requestError($message = '')
    {
        $this->message = $message ?: '参数错误';
        $this->code    = self::BAD_REQUEST;
        return $this;
    }

    public function forbidden()
    {
        $this->message = '权限不足';
        $this->code    = self::PERMISSION_ERROR;
        return $this;
    }

    public function dbError()
    {
        $this->message = '数据库错误';
        $this->code    = self::DB_ERROR;
        return $this;
    }

    public function sysError($message = '')
    {
        $this->message = $message ?: '系统错误';
        $this->code    = self::SYS_ERROR;
        return $this;
    }

    public function render()
    {
        if (request()->pjax()) {
            $error = new MessageBag([
                'title' => '错误',
                'message' => $this->getMessage(),
            ]);
            return back()->withInput()->with(compact('error'));
        } else {
            if (request()->input('_editable')) {
                return $this->apiResponse($this->getCode(), $this->getMessage(), $this->errorData, [
                    'status' => false,
                    'errors' => [$this->getMessage()],
                ]);
            } else {
                return $this->apiResponse($this->getCode(), $this->getMessage(), $this->errorData);
            }
        }
    }
}
