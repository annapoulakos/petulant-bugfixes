<?php

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
