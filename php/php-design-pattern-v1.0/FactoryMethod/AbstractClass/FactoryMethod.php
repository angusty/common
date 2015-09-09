<?php
namespace AbstractClass;

use Contracts\VehicleInterface;

abstract class FactoryMethod
{
    const  CHEAP = 1;
    const FAST = 2;
    abstract protected function createVehide($type);
    public function create($type)
    {
        $obj = $this->createVehide($type);
        $obj->setColor('#foo');
        return $obj;
    }
}
