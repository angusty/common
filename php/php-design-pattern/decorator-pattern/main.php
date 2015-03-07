<?php
require_once __DIR__ . '/autoload.php';
$component = new ConcreteComponent();
$decoratorA = new ConcreteDecoratorA($component);
$decoratorB = new ConcreteDecoratorB($component);

$decoratorA->operation();
echo '<br>', '------next------', '<br>';
$decoratorB->operation();
