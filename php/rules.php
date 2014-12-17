<?php

/** Simple Rules Engine **/
class Container {
    protected $_data = array();
    public function __set ($key, $value) {
        $this->_data[$key] = $value;
    }
    public function __get ($key) {
        if (!isset($this->_data[$key])) {
            throw new Exception("{$key} is not a valid key.");
        }
        if (is_callable($this->_data[$key])) {
            return $this->_data[$key]($this);
        }
        return $this->_data[$key];
    }
}

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

class RuleGroup extends Container {
    public function __construct ($name) {
        $this->group_name = $name;
    }

    public function set_rules ($rules) {
        $this->rules = $rules;
    }

    public function execute ($value) {
        foreach ($this->rules as $rule) {
            $rule->value = $value;
            $rule->execute();
            $value = $rule->value;
        }

        return $value;
    }
}

class Rule extends Container {
    public function __construct ($rule) {
        $this->rule = $rule;

        $this->condition = function ($context) {
            return false;
        };
        $this->then = function ($context) {};
    }
    public function execute () {
        if ($this->condition) {
            $this->then;
        }
    }

}