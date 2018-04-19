<?php

class IndexController extends Yaf_Controller_Abstract {
    public function indexAction() {//默认Action
        $id = $_GET['id'];
        $d  = $_GET['d'];
        var_export($id);
        var_export($d);
        $this->getView()->assign("content", "Hello World");
    }
}
