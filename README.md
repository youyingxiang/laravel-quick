# laravel-quick

**laravel-quick** 封装了一些我们开发中常见的工具，使开发变得更高效

## 安装
- 生成翻译好的中文包 `php artisan vendor:publish --provider="Yxx\\LaravelQuick\\LaravelQuickServiceProvider"`
## 怎么使用
```$xslt
// api 返回状态码

// 异常使用例子
use Yxx\LaravelQuick\Exceptions\Api\ApiNotFoundException;
// 请求参数错误
throw new ApiRequestException();
// 404 未找到
throw new ApiNotFoundException();
// 系统错误
throw new ApiSystemException()
// 未授权
throw new ApiUnAuthException()
// 返回

//自定义错误继承Yxx\LaravelQuick\Exceptions自己参照对应代码自定义

// api接口使用
use Yxx\LaravelQuick\Traits\JsonResponseTrait

// 成功
return $this->success("消息",['name'=>"张三"]);
// 失败
return $this->error("错误");
// 自定义
return $this->apiResponse(Response::HTTP_BAD_GATEWAY,"502错误");

// 缓存的使用（封装了redis的一些方法）
use Yxx\LaravelQuick\Facades\CacheClient;

CacheClient::hSet("test","1","张三");
CacheClient::hGet("test","1");
CacheClient::lPush("test","1");

具体参考Yxx\LaravelQuick\Services\CacheService里面的方法....
```

## artisan 命令
- 创建 Trait `php artisan quick:create-trait test`
- 创建 Service  `php artisan quick:create-service Test/TestService`
- 创建 Repository `php artisan quick:create-repository Test`

