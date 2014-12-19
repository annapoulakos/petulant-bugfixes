<?php

if (!defined('__CORE_LOADED__')) {
    function core_autoload ($class) {
        $class = strtolower($class);
        if (file_exists(dirname(__FILE__). "/classes/{$class}.php")) {
            include dirname(__FILE__). "/classes/{$class}.php";
        }
    }

    spl_autoload_register('core_autoload', true, true);

    define('__CORE_LOADED__', true);
}
