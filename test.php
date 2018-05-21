<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/5/21
 * Time: 下午3:34
 */

require_once(__DIR__ . "/bootstrap.php");
print_r(__DIR__ . "/bootstrap.php");
//AA();
$data = parse_ini_file(__DIR__ . "/conf/env.ini", true);

print_r($data);