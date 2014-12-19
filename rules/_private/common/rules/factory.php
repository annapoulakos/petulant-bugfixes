<?php

class Factory {
    protected static $rules = array();
    public static function Rule ($rule) {
        if (!isset(self::$rules[$rule])) {
            self::$rules[$rule] = new Rule($rule);
        }
        return self::$rules[$rule];
    }
    protected static $rule_groups = array();
    public static function RuleGroup ($group) {
        if (!isset(self::$rule_groups[$group])) {
            self::$rule_groups[$group] = new RuleGroup($group);
        }
        return self::$rule_groups[$group];
    }
}
