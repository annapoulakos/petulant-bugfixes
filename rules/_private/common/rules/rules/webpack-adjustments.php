<?php


/**
 * This rule requires value in the following format:
 * {
 *  delivery_date: "2014-01-01",
 *  year: "2014",
 *  is_webpack: true|false
 * }
 */
$rule = Factory::Rule('Webpack: Set Mid-Year Delivery Date');
$rule->condition = function ($self) {
    return $self->context->is_webpack == 'Y' or $self->context->is_webpack;
};

$rule->then = function ($self) {
    $self->context->delivery_date = $self->context->year . '-06-30';
};
