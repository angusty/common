<?php
namespace FactoryMethod\ImplementClass;

use FactoryMethod\Contracts\VehicleInterface;

class Porsche implements VehicleInterface
{
    protected $color;

    public function setColor($rgb)
    {
        // TODO: Implement setColor() method.
        $this->color = $rgb;
    }

    public function addTuningAMG()
    {
//        echo 'add Tuning AMG';
    }
}
