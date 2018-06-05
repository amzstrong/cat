<?php

namespace cat\lib;


trait BaseHttpTrait {
    
    
    public function getResponse() {
        return \Yaf_Registry::get('SWOOLE_HTTP_RESPONSE');
    }
    
    public function getRequestServer() {
        return \Yaf_Registry::get('REQUEST_SERVER');
    }
    
    public function getServer($param = null) {
        $server = \Yaf_Registry::get('REQUEST_SERVER');
        
        if (null === $param) {
            return $server;
        }
        
        if (isset($server[$param])) {
            return $server[$param];
        }
        
        return false;
    }
    
    
    public function getHeader($param = null) {
        $header = \Yaf_Registry::get('REQUEST_HEADER');
        
        if (null === $param) {
            return $header;
        }
        
        if (isset($header[$param])) {
            return $header[$param];
        }
        
        return false;
    }
    
    public function getQuery($param = null) {
        $get = \Yaf_Registry::get('REQUEST_GET');
        
        if (null === $param) {
            return $get;
        }
        
        if (isset($get[$param])) {
            return $get[$param];
        }
        
        return false;
    }
    
    
    public function getPost($param = null) {
        $post = \Yaf_Registry::get('REQUEST_POST');
        
        if (null === $param) {
            return $post;
        }
        
        if (isset($post[$param])) {
            return $post[$param];
        }
        
        return false;
    }
    
    
    public function getCookie($param = null) {
        $cookie = \Yaf_Registry::get('REQUEST_COOKIE');
        
        if (null === $param) {
            return $cookie;
        }
        
        if (isset($cookie[$param])) {
            return $cookie[$param];
        }
        
        return false;
    }
    
    
    public function getFiles($param = null) {
        $files = \Yaf_Registry::get('REQUEST_FILES');
        
        if (null === $param) {
            return $files;
        }
        
        if (isset($files[$param])) {
            return $files[$param];
        }
        
        return false;
    }
    
    public function getRawContent() {
        return \Yaf_Registry::get('REQUEST_RAW_CONTENT');
    }
    
    public function setHeader($key, $value) {
        if (empty($key) && empty($value)) {
            return false;
        }
        
        $responseObj = \Yaf_Registry::get('SWOOLE_HTTP_RESPONSE');
        return $responseObj->header($key, $value);
    }
    
    
    public function setCookie($key, $value = '', $expire = 0, $path = '/',
                              $domain = '', $secure = false, $httponly = false) {
        if (empty($key)) {
            return false;
        }
        
        $responseObj = \Yaf_Registry::get('SWOOLE_HTTP_RESPONSE');
        return $responseObj->cookie($key, $value, $expire, $path, $domain, $secure, $httponly);
    }
    
    
    public function setHttpCode($code) {
        if (empty($code) || $code < 0) {
            return false;
        }
        
        $responseObj = \Yaf_Registry::get('SWOOLE_HTTP_RESPONSE');
        return $responseObj->status($code);
    }
    
    
}