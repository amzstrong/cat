<?php


class UserController extends \Yaf_Controller_Abstract {

    use \cat\lib\ApiControllerTrait;

    public function init() {
        \Yaf_Dispatcher::getInstance()->disableView();
    }

    public function indexAction() {//默认Action
        \cat\application\library\Handle::test();
        print_r(Yaf_Application::app()->getConfig());
    }
}
