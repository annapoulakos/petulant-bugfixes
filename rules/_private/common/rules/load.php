<?php

if (!defined('__RULES_LOADED__')) {
    import('common.core');

    $includes = array(
        'factory',
        'rule',
        'rule_group'
        );
    array_walk($includes, function ($v) {
        include dirname(__FILE__). "/{$v}.php";
    });

    array_walk(glob(dirname(__FILE__). '/rules/*.php'), function ($v) {
        include $v;
    });

    define('__RULES_LOADED__', true);
}
