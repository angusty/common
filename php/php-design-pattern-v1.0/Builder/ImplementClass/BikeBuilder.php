<?php
namespace ImplementClass;

use Contracts\BuilderInterface;

class BikeBuilder implements BuilderInterface
{
    protected $bike;

    public function createVehicle()
    {
        // TODO: Implement createVehicle() method.
        $this->bike = new Bike();
    }

    public function addWheel()
    {
        // TODO: Implement addWheel() method.
        $this->bike->setPart('LZ1', new Wheel());
        $this->bike->setPart('LZ2', new Wheel());
    }

    public function addEngine()
    {
        // TODO: Implement addEngine() method.
        $this->bike->setPart('ENGINE', new Engine());
    }

    public function addDoors()
    {
        // TODO: Implement addDoors() method.
//        $this->bike->setPart('DOOR1', new Door());
//        $this->bike->setPart('DOOR2', new Door());
    }

    public function getVehicle()
    {
        // TODO: Implement getVehicle() method.
        return $this->bike;
    }
}
