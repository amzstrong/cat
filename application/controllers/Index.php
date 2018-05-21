<?php

class IndexController extends Yaf_Controller_Abstract {
    public function indexAction() {//默认Action
        $id = $_GET['id'];
        $d  = $_GET['d'];
        var_export($id);
        var_export($d);
        $res = [];
//        $db  = new PDO("mysql:dbname=test;host=127.0.0.1", "root", "root");
//        foreach (range(1, 5) as $k => $v) {
//            $res[] = $db->query("select * from user where id =$v")->fetchAll(\PDO::FETCH_ASSOC);
//        }
//        print_r($res);
        $this->getView()->assign("content", "Hello World");
    }
    
    public function testAction() {//默认Action
        $id = $_GET['id'];
        $d  = $_GET['d'];
        var_export($id);
        var_export($d);
        $this->getView()->assign("content", "Hello World");
    }
}





