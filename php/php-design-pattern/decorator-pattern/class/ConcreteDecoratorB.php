<?php
class ConcreteDecoratorB extends Decorator
{
    public function operation()
    {
        parent::operation();
        $this->addedOperationB();
    }

    public function addedOperationB()
    {
        echo __CLASS__ . ' 我是新增的操作B';
    }
}
