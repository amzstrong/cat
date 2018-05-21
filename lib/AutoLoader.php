<?php

namespace cat\lib;

/**
 * Autoload.
 */
class Autoloader {
    /**
     * Autoload root path.
     *
     * @var string
     */
    protected static $_autoloadRootPath = '';
    
    /**
     * Set autoload root path.
     *
     * @param string $root_path
     * @return void
     */
    public static function setRootPath($root_path) {
        self::$_autoloadRootPath = $root_path;
    }
    
    /**
     * Load files by namespace.
     *
     * @param string $name
     * @return boolean
     */
    public static function loadByNamespace($name) {
        
        $class_path = str_replace('\\', DIRECTORY_SEPARATOR, $name);
        
        if (strpos($name, 'cat\\') === 0) {
            
            $class_file = APP_PATH . substr($class_path, strlen('cat')) . '.php';
            
        } else {
            
            if (self::$_autoloadRootPath) {
                $class_file = self::$_autoloadRootPath . DIRECTORY_SEPARATOR . $class_path . '.php';
            }
            if (empty($class_file) || !is_file($class_file)) {
                $class_file = APP_PATH . DIRECTORY_SEPARATOR . "$class_path.php";
            }
        }
        if (is_file($class_file)) {
            require_once($class_file);
            if (class_exists($name, false)) {
                return true;
            }
        }
        return false;
    }
    
    public static function loadCommon($dir = APP_PATH . '/common') {
        $handle = opendir($dir);
        if ($handle) {
            while (($file = readdir($handle)) !== false) {
                if ($file != '.' && $file != '..') {
                    $cur_path = $dir . DIRECTORY_SEPARATOR . $file;
                    if (is_dir($cur_path)) {
                        self::loadCommon($cur_path);
                    } else {
                        include_once $cur_path;
                    }
                }
            }
            closedir($handle);
        }
        return true;
        
    }
}

spl_autoload_register('\cat\lib\Autoloader::loadByNamespace');
