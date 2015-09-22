<?php
namespace Bridge\Tests;

use Bridge\Contracts\Workshop;
use Bridge\ImplementClass\Assemble;
use Bridge\ImplementClass\Car;
use Bridge\ImplementClass\Motorcycle;
use Bridge\ImplementClass\Produce;

class BridgeTest extends \PHPUnit_Framework_TestCase
{
    public function getWorkshops()
    {
        return [
            [new Assemble(), new Produce()]
        ];
    }

    /**
     * @param Workshop $workshop1
     * @param Workshop $workshop2
     * @dataProvider getWorkshops
     */
    public function testIsUseInVehicle(Workshop $workshop1, Workshop $workshop2)
    {
        $car = new Car($workshop1, $workshop2);
        $car->manufacture();
        $this->expectOutputString('Bridge\\ImplementClass\\Car<br>Bridge\\ImplementClass\\Assemble<br>Bridge\\ImplementClass\\Produce<br>');
    }
}
