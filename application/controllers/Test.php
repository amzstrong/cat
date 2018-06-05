<?php

class TestController extends \Yaf_Controller_Abstract {
    use \cat\lib\ApiControllerTrait;
    
    public function init() {
        if ($this->getRequest()->isXmlHttpRequest()) {
            Yaf_Dispatcher::getInstance()->autoRender(FALSE);
        }
        
        Yaf_Dispatcher::getInstance()->autoRender(FALSE);
        
    }
    
    public function testAction() {
        $get  = $this->getQuery();
        $file = $this->getFiles();
        $post = $this->getPost();
        print_r($file);
        print_r($post);
        print_r($get);
        return;
    }
    
    public function indexAction() {//默认Action
        
    }
    
    
}
