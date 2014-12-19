<?php

if (!defined('__IMPORTER_LOADED__')) {
    function import ($library) {
        $library = strtolower(str_replace('.', '/', $library));

        $file = dirname(__FILE__) . "/{$library}/load.php";
        if (file_exists($file)) {
            include $file;
        }
    }
    define('__IMPORTER_LOADED__', true);
}
