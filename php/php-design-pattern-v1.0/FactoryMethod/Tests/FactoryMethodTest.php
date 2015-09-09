<?php
namespace Tests;

use AbstractClass\FactoryMethod;
use ImplementClass\GermanFactory;
use ImplementClass\ItalianFactory;

class FactoryMethodTest extends \PHPUnit_Framework_TestCase
{
    protected $type = array(
        FactoryMethod::CHEAP,
        FactoryMethod::FAST
    );

    public function getShop()
    {
        return array(
            array(new GermanFactory()),
            array(new ItalianFactory())
        );
    }

    /**
     * @param FactoryMethod $shop
     * @dataProvider getShop
     */
    public function testCreation(FactoryMethod $shop)
    {
        foreach ($this->type as $type) {
            $vehicle = $shop->create($type);
            $this->assertInstanceOf('Contracts\VehicleInterface', $vehicle);
        }
    }

    /**
     * @param FactoryMethod $shop
     * @dataProvider getShop
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage hello world is not a valid vehicle
     */
    public function testUnknowType(FactoryMethod $shop)
    {
        $shop->create('hello world');
    }

    public function getFactories()
    {
        return array(
            array(new ItalianFactory()),
            array(new GermanFactory()),
            array(new GermanFactory()),
        );
    }

    /**
     * @param FactoryMethod $factory
     * @dataProvider getFactories
     */
    public function testComponentCreation(FactoryMethod $factory)
    {
        $vehicles = array(
            $factory->create(1),
            $factory->create(2)
        );
        $this->assertContainsOnly('Contracts\VehicleInterface', $vehicles);
    }
}
