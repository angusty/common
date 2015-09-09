<?php
namespace ImplementClass;

use Contracts\VehicleInterface;

class Ferrari implements VehicleInterface
{
    protected $color;

    public function setColor($rgb)
    {
        // TODO: Implement setColor() method.
        $this->color = $rgb;
    }
}
