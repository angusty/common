<?php
namespace ImplementClass;

use AbstractClass\FactoryMethod;

class ItalianFactory extends FactoryMethod
{
    protected function createVehide($type)
    {
        // TODO: Implement createVehide() method.
        switch($type) {
            case parent::CHEAP:
                return new Bicycle();
                break;
            case parent::FAST:
                return new Ferrari();
                break;
            default:
                throw new \InvalidArgumentException("$type is not a valid vehicle");
        }
    }
}
