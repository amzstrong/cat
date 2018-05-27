<?php
namespace cat\lib;

class HttpServer {
    protected $argv;
    protected $port;
    protected $instance;
    protected $get;
    protected $post;
    protected $header;
    protected $server;
    protected $yaf_instance = null;
    protected $options
        = array(
            'worker_num' => 10,
            'daemonize' => false,
            'max_request' => 100000,
            'dispatch_mode' => 3,
            'debug_mode' => 0
        );
    
    public function __construct($port = 9503) {
        $this->getYafInstance();
        $this->loadBootstrap();
        $this->loadConfig();
        $this->port = $port;
    }
    
    protected function runSwoole() {
        $this->server = new \swoole_http_server("0.0.0.0", $this->port);
        $this->server->set($this->options);
        $this->server->on('request', array($this, "onRequest"));
        $this->server->start();
    }
    
    public function run() {
        $this->parseCommand();
        echo "###HttpServer::start on $this->port####\n";
        $this->runSwoole();
    }
    
    /**
     * 加载入口文件
     */
    protected function loadBootstrap() {
        $bootstrap = __DIR__ . "/../bootstrap.php";
        include_once $bootstrap;
    }
    
    /**
     * 加载一些配置
     */
    protected function loadConfig() {
        
    }
    
    /**
     * 获取yaf实例
     */
    protected function getYafInstance() {
        $this->yaf_instance = new \Yaf_Application(CONF_PATH . "/application.ini");
    }
    
    
    protected function parseCommand() {
        $argv      = $this->argv;
        $cmd       = isset($argv[1]) ? $argv[1] : "";
        $cmd_sux   = isset($argv[2]) ? $argv[2] : "";
        $startFile = $argv[0]??"";
        $command   = $cmd . $cmd_sux;
        switch ($command) {
            case "start":
                $this->options["daemonize"] = false;
                break;
            case "start-d":
                $this->options["daemonize"] = true;
                break;
            case "stop":
                exec("ps aux | grep $startFile | grep -v grep | awk '{print $2}' |xargs kill -SIGTERM");
                exit();
                break;
            default:
                echo "Usage(php  yourfile start|start -d|restart -d|stop)" . PHP_EOL;
                exit();
            //@posix_kill($master_pid, 0)
        }
    }
    
    
    /**
     * 设置命令参数
     * @param array $argv
     */
    public function setArgv(array $argv) {
        $this->argv = $argv;
    }
    
    /**
     * 设置加载配置
     * @param array $options
     */
    public function setOptions(array $options = []) {
        $this->options = $options;
    }
    
    public function onRequest($request, $response) {
        if (isset($request->server)) {
            $this->server = $request->server;
        } else {
            $this->server = [];
        }
        if (isset($request->header)) {
            $this->header = $request->header;
        } else {
            $this->header = [];
        }
        if (isset($request->get)) {
            $this->get = $request->get;
        } else {
            $this->get = [];
        }
        if (isset($request->post)) {
            $this->post = $request->post;
        } else {
            $this->post = [];
        }
        
        if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
            return $response->end();
        }
        $this->handle($request, $response);
    }
    
    protected function handle($request, $response) {
        ob_start();
        try {
            $request_uri = $request->server['request_uri'];
            $request     = new \Yaf_Request_Http($request_uri);
            $this->yaf_instance->getDispatcher()->dispatch($request);
        } catch (\Yaf_Exception $e) {
            var_dump($e);
        }
        $result = ob_get_contents();
        ob_end_clean();
        $response->end($result);
    }
    
    
}

