<?php

class TestController extends \Yaf_Controller_Abstract {
    public function init() {
        if ($this->getRequest()->isXmlHttpRequest()) {
            Yaf_Dispatcher::getInstance()->autoRender(FALSE);
        }

        Yaf_Dispatcher::getInstance()->autoRender(FALSE);

    }

    public function testAction() {
        $a = ["data" => 555];
        echo json_encode($a);
        return;
    }

    public function indexAction() {//默认Action
//        \cat\application\library\Handle::test();
        $ip = swoole_get_local_ip();
//        print_r($ip);
        $a = ["data" => 555];
        echo json_encode($a);
        return;

        $this->getView()->assign("content", "Hello World");
//        $this->getResponse()->setBody("Hello World");
    }
}
