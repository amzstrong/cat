<?php

class HttpServer {
    public static $instance;
    public $http;
    public static $get;
    public static $post;
    public static $header;
    public static $server;
    public static $yaf_instance = null;
    
    
    public function __construct($port = 9503) {
        echo "###HttpServer::start on ####\n";
        define("APP_PATH", __DIR__);
        
        $http = new swoole_http_server("127.0.0.1", $port);
        $http->set(
            array(
                'worker_num' => 10,
                'daemonize' => false,
                'max_request' => 10000,
                'dispatch_mode' => 1
            )
        );
        self::yafInstance();
        $http->on('request', array($this, "onRequest"));
        $http->start();
    }
    
    
    public function onRequest($request, $response) {
        if (isset($request->server)) {
            HttpServer::$server = $request->server;
        } else {
            HttpServer::$server = [];
        }
        if (isset($request->header)) {
            HttpServer::$header = $request->header;
        } else {
            HttpServer::$header = [];
        }
        if (isset($request->get)) {
            HttpServer::$get = $request->get;
        } else {
            HttpServer::$get = [];
        }
        if (isset($request->post)) {
            HttpServer::$post = $request->post;
        } else {
            HttpServer::$post = [];
        }
        
        if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
            return $response->end();
        }
        $this->handle($request, $response);
    }
    
    public function handle($request, $response) {
        ob_start();
        try {
            $request_uri = $request->server['request_uri'];
            $request     = new Yaf_Request_Http($request_uri);
            self::$yaf_instance->getDispatcher()->dispatch($request);
        } catch (\Yaf\Exception $e) {
            var_dump($e);
        }
        $result = ob_get_contents();
        ob_end_clean();
        $response->end($result);
    }
    
    
    public static function getInstance() {
        if (empty(self::$server)) {
            self::$server = new self();
        }
        return self::$server;
    }
    
    public static function yafInstance() {
        if (empty(self::$yaf_instance)) {
            self::$yaf_instance = new Yaf_Application(APP_PATH . "/conf/application.ini");
        }
        return self::$yaf_instance;
    }
}


HttpServer::getInstance();