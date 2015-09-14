<?php
namespace Builder\ImplementClass;

use Builder\Contracts\BuilderInterface;

class CarBuilder implements BuilderInterface
{
    protected $car;

    public function createVehicle()
    {
        // TODO: Implement createVehicle() method.
        $this->car = new Car();
    }

    public function addWheel()
    {
        // TODO: Implement addWheel() method.
        $this->car->setPart('LZ1', new Wheel());
        $this->car->setPart('LZ2', new Wheel());
        $this->car->setPart('LZ3', new Wheel());
        $this->car->setPart('LZ4', new Wheel());
    }

    public function addEngine()
    {
        // TODO: Implement addEngine() method.
        $this->car->setPart('ENGINE', new Engine());
    }

    public function addDoors()
    {
        // TODO: Implement addDoors() method.
        $this->car->setPart('DOOR1', new Door());
        $this->car->setPart('DOOR2', new Door());
    }

    public function getVehicle()
    {
        // TODO: Implement getVehicle() method.
        return $this->car;
    }
}
