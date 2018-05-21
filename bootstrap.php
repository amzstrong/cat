<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2018/4/19
 * Time: 下午10:40
 */


ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('Asia/Shanghai');
defined('APP_PATH') or define('APP_PATH', __DIR__);
defined('debug_mod') or define('debug_mod', true);
require_once(APP_PATH . '/vendor/autoload.php');
require_once(APP_PATH . '/lib/AutoLoader.php');
try {
    $env = parse_ini_file(APP_PATH . '/conf/env.ini', true);
} catch (Exception $e) {
    throw new Exception('Error Reading Config File', 10000);
}
defined("ENV") or define("ENV", $env["env"]);
defined("CONF_PATH") or define("CONF_PATH", APP_PATH . "/conf/" . ENV);
\cat\lib\Autoloader::loadCommon(APP_PATH . "/common");