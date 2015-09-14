<?php
namespace FactoryMethod\ImplementClass;

use FactoryMethod\Contracts\VehicleInterface;

class Bicycle implements VehicleInterface
{
    protected $color;

    public function setColor($rgb)
    {
        // TODO: Implement setColor() method.
        $this->color = $rgb;
    }
}
