<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/5/21
 * Time: 下午2:18
 */


require_once(__DIR__ . '/../bootstrap.php');

$http = new \cat\lib\HttpServer(8088);
$http->setArgv($argv);
$http->setOptions(["log_file" => "/var/tmp/http_test.log", 'debug_mode' => 0]);
$http->run();
