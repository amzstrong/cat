<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/5/21
 * Time: 下午3:34
 */
$file = fopen("composer.json", "r");
$user = array();
$i    = 0;
//输出文本中所有的行，直到文件结束为止。
while (!feof($file)) {
    $user[$i] = fgets($file);//fgets()函数从文件指针中读取一行
    $i++;
}
fclose($file);
$user = array_filter($user);
print_r($user);
die;
require_once(__DIR__ . "/bootstrap.php");
print_r(__DIR__ . "/bootstrap.php");
//AA();
$data = parse_ini_file(__DIR__ . "/conf/env.ini", true);

print_r($data);