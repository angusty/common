<?php
class ConcreteComponent implements Component
{
    public function operation()
    {
        echo __CLASS__ . '原始操作  ';
    }
}
