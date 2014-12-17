<?php
/** Simple Rules Engine **/
class Factory {
    protected static $rules = array();
    public static function Rule ($rule) {
        if (!isset(self::$rules[$rule])) {
            self::$rules[$rule] = new Rule($rule);
        }

        return self::$rules[$rule];
    }
}

class Rule {
    public function __construct ($rule) {
        $this->rule = $rule;
        $this->value = null;

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
    public function _ ($lambda) {
        return function ($context) use ($lambda) {
            static $object;
            if (is_null($object)) {
                $object = $lambda($context);
            }
            return $object;
        };
    }
}
