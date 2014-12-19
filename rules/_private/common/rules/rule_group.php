<?php

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
