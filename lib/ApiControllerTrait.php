<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/5/25
 * Time: 下午6:12
 */
namespace cat\lib;

trait ApiControllerTrait {
    
    use BaseHttpTrait;
    
    public function success($data = null, $statusCode = 0, $msg = "ok") {
        $return               = [];
        $return["statusCode"] = $statusCode;
        $return["data"]       = $data;
        $return["msg"]        = $msg;
        $this->getResponse()->header("Content-type", "application/json");
        echo json_encode($return);
        return;
    }
    
    public function failed($msg = "failed", $statusCode = -1) {
        $return               = [];
        $return["statusCode"] = $statusCode;
        $return["data"]       = null;
        $return["msg"]        = $msg;
        $this->getResponse()->header("Content-type", "application/json");
        echo json_encode($return);
        return;
    }
    
    public function successJsonp($statusCode = 0, $msg = "success", $data = null) {
        $callback             = $this->getQuery('callback');
        $return               = [];
        $return["statusCode"] = $statusCode;
        $return["data"]       = $data;
        $return["msg"]        = $msg;
        if ($callback) {
            echo $callback . "(" . json_encode($return) . ")";
        } else {
            echo json_encode($return);
        }
        return;
    }
    
    public function failedJsonp($statusCode = -1, $msg = "failed") {
        $callback             = $this->getQuery('callback');
        $return               = [];
        $return["statusCode"] = $statusCode;
        $return["data"]       = null;
        $return["msg"]        = $msg;
        if ($callback) {
            echo $callback . "(" . json_encode($return) . ")";
        } else {
            echo json_encode($return);
        }
        return;
    }
}