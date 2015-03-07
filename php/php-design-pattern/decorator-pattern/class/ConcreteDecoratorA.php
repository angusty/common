<?php
class ConcreteDecoratorA extends Decorator
{
    public function operation()
    {
        parent::operation();
        $this->addedOperationA();
    }

    public function addedOperationA()
    {
        echo __CLASS__ . ' 我是新增的操作A';
    }
}
