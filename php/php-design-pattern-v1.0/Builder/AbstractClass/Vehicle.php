<?php
namespace Builder\AbstractClass;

abstract class Vehicle
{
    protected $data;

    public function setPart($key, $value)
    {
        $this->data[$key] = $value;
    }
}
