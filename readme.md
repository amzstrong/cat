# swoole+yaf 集合在一起做http服务

## 文件目录

### --cat
### ----application
#### ----controllers
#### ----modules
#### ----views
### ----common
### ----conf
### ----lib
### ----vender
### ----bootstrap.php


## server示例
```
<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/5/21
 * Time: 下午2:18
 */


require_once(__DIR__ . '/../bootstrap.php');

$http = new \cat\lib\HttpServer(8088);
$http->setArgv($argv);//设置命令行参数
$http->setOptions(["log_file" => "/var/tmp/http_test.log", 'debug_mode' => 0]);
$http->run();

```

php server.php start -d   //启动一个deamon进程

会提示用法
Usage(php  yourfile start|start -d|stop)

## controllers 示例

```
<?php

class TestController extends \Yaf_Controller_Abstract {
    public function init() {

        Yaf_Dispatcher::getInstance()->autoRender(FALSE);//关闭页面自动渲染

    }

    public function testAction() {
        $a = ["data" => 555];
        echo json_encode($a);
        return;//注意swoole中不能使用die,exit等函数
    }
}

```
swoole中yaf基本操作和在fpm模式下基本差不多,注意不能用die,exit,一些全局变量$_SEVER也有不同,具体见swoole官方文档。


## 压力测试
机器 单核+2g(本地测试)


ab -n 10000 -c 10 -k  http://127.0.0.1:8088/test/test/


结果
```
Server Software:        swoole-http-server
Server Hostname:        127.0.0.1
Server Port:            8088

Document Path:          /test/test/
Document Length:        12 bytes

Concurrency Level:      10
Time taken for tests:   0.469 seconds
Complete requests:      10000
Failed requests:        0
Write errors:           0
Keep-Alive requests:    10000
Total transferred:      1650000 bytes
HTML transferred:       120000 bytes
Requests per second:    21326.78 [#/sec] (mean)
Time per request:       0.469 [ms] (mean)
Time per request:       0.047 [ms] (mean, across all concurrent requests)
Transfer rate:          3436.44 [Kbytes/sec] received

```

压测结果看起来不错

