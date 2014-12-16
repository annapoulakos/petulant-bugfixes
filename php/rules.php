<?php

/** Simple Rules Engine **/

class Container {
    protected $_data = array();
    public function __set ($key, $value) {
        $this->_data[$key] = $value;
    }
    public function __get ($key) {
        if (!isset($this->_data[$key])) {
            throw new Exception ("{$key} is not a valid key");
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

class Factory {
    protected static $rules = array();
    public static function Rule ($rule, $value = null) {
        if (!isset(self::$rules[$rule])) {
            self::$rules[$rule] = new Rule($value);
        }

        return self::$rules[$rule];
    }
}

class Rule extends Container {
    public function __construct ($value) {
        $this->value = $value;

        $this->condition = function ($c) {
            return false;
        };
        $this->then = function ($c) {
            // Add default logging here?
        };
    }

    public function execute () {
        if ($this->condition) {
            $this->then;
        }
    }
}

$v = 25;
$rule = Factory::Rule('Less than or equal to 50', $v);

$rule->condition = function ($context) {
    return $context->less_than(50) or $context->equals(50);
};

$rule->then = function ($context) {
    $context->value = 50;
};

$rule->execute();

$v = 100;

$rule2 = Factory::Rule('Greater than or equal to 50', $v);
$rule2->condition = function ($context) {
    return $context->greater_than(50) or $context->equals(50);
};

$rule2->then = function ($context) {
    $context->value = 50;
};

$rule2->execute();
