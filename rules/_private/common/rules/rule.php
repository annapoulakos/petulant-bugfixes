<?php

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

        return $this->context;
    }
}
