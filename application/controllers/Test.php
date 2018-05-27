<?php

class TestController extends Yaf_Controller_Abstract {
    public function init() {
        if ($this->getRequest()->isXmlHttpRequest()) {
            Yaf_Dispatcher::getInstance()->autoRender(FALSE);
        }

        Yaf_Dispatcher::getInstance()->autoRender(FALSE);

    }

    public function indexAction() {//默认Action
        \cat\application\library\Handle::test();
        $this->getView()->assign("content", "Hello World");
//        $this->getResponse()->setBody("Hello World");
    }
}
