<?php

include dirname(__FILE__). '/_private/bootstrap.php';
import('common.rules');

function _log($message) {
    $template = '<div>%s</div>';
    echo sprintf($template, $message);
}

function execute_rule ($rule, $context) {
    echo '<fieldset><legend>' . $rule->rule . '</legend>';
    _log('Context Prior');
    _log('<pre>' . print_r($context, true). '</pre>');
    _log('Context After');
    $rule->context = $context;
    $context = $rule->execute();
    _log('<pre>' . print_r($context, true). '</pre>');
    echo '</fieldset>';

    return $context;
}

$context = new Container;
$context->value = 60;

$rule = Factory::Rule('Value < 100? value * 2');
$rule->condition = function ($self) {
    echo sprintf($template, $self->context->value);
    return $self->context->value < 100;
};

$rule->then = function ($self) {
    echo sprintf($template, $self->context->value);
    $self->context->value = $self->context->value * 2;
    echo sprintf($template, $self->context->value);
};

$rule = Factory::Rule('Value > 100? value / 2');
$rule->condition = function ($self) {
    return $self->context->value > 100;
};

$rule->then = function ($self) {
    $self->context->value = $self->context->value / 2;
};


$rule = Factory::Rule('Value < 100? value * 2');
$context = execute_rule($rule, $context);

$rule = Factory::Rule('Value > 100? value / 2');
$context = execute_rule($rule, $context);

$pack_context = new Container;
$pack_context->delivery_date = '2014-11-11';
$pack_context->year = '2014';
$pack_context->is_webpack = false;

$rule = Factory::Rule('Webpack: Set Mid-Year Delivery Date');
$pack_context = execute_rule($rule, $pack_context);

$pack_context->is_webpack = true;
$pack_context = execute_rule($rule, $pack_context);
