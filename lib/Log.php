<?php

namespace cat\lib;

class Log {
    
    public static function log($text) {
        $path = "";
        $text = var_export($text, true);
        file_put_contents($path, date("Y-m-d H:i:s") . "  " . $text . "\r\n", FILE_APPEND);
    }
    
}