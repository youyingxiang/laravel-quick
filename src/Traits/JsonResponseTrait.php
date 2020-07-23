<?php

namespace Yxx\LaravelQuick\Traits;


use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

/**
 * Class JsonResponseTrait
 *
 * @package App\Traits
 */
trait JsonResponseTrait
{

    private $redirect_url;

    /**
     * @param int $code
     * @param string $message
     * @param null $data
     *
     * @return array
     */
    protected function apiArray($code = FoundationResponse::HTTP_OK, $message = '', $data = NULL, $attach = [])
    {
        if (is_array($code)) {
            $res = [
                'code' => $code['code'],
                'message' => $code['message'],
                'data' => $code['data'],
            ];
        } else {
            $res = [
                'code' => $code,
                'message' => $message,
                'data' => $data,
            ];
        }
        return array_merge($res, $attach);
    }


    /**
     * @param int $code
     * @param string $message
     * @param null $data
     *
     * @return \Illuminate\Http\JsonResponse
     * 返回值规范说明:
     * 1、成功正数（多种成功情况，不同的正数数字标示,原则上是不样的message对应不同的code）
     * 2、报错、失败、异常负数（返回数据集，但数据集为[]或null，不属于报错、失败、异常，所以视为成功，仅仅暂无数据而已）
     * 3、404、403、500等http status code可以均直接加上`-`号(如:-404),作为错误code,方便大家一目了然
     */
    protected function apiResponse($code = FoundationResponse::HTTP_OK, $message = '', $data = NULL, $attach = [])
    {
        $res = $this->apiArray($code, $message, $data, $attach);
        if ($this->redirect_url) {
            $res['redirect_url'] = $this->redirect_url;
        }
        return Response::json($res)->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * @param string $message
     * @param null $data
     * @param int $code
     * @param array $attach
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($message = '', $data = NULL, $code = FoundationResponse::HTTP_OK, $attach = [])
    {
        return $this->apiResponse($code, $message ?: 'Success', $data, $attach);
    }

    /**
     * @param string $message
     * @param null $data
     * @param int $code
     * @param array $attach
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($message = 'Error', $data = NULL, $code = -1, $attach = [])
    {
        return $this->apiResponse($code, $message, $data, $attach);
    }

    /**
     * 设置 data.url 的值
     *
     * @param       $url
     * @param array $param
     *
     * @return $this
     */
    protected function redirectUrl($url, $param = [])
    {
        $this->redirect_url = url($url, $param);
        return $this;
    }
}
