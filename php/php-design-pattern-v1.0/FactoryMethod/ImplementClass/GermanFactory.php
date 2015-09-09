<?php
namespace ImplementClass;

use AbstractClass\FactoryMethod;

class GermanFactory extends FactoryMethod
{
    protected function createVehide($type)
    {
        // TODO: Implement createVehide() method.
        switch($type) {
            case parent::CHEAP:
                return new Bicycle();
                break;
            case parent::FAST:
                $obj = new Porsche();
                $obj->addTuningAMG();
                return $obj;
                break;
            default:
                throw new \InvalidArgumentException("$type is not a valid vehicle");
        }
    }
}
