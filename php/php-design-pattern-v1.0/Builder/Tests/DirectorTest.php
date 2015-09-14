<?php
namespace Builder\Tests;

use Builder\Contracts\BuilderInterface;
use Builder\ImplementClass\BikeBuilder;
use Builder\ImplementClass\CarBuilder;
use Builder\ImplementClass\Director;

class DirectorTest extends \PHPUnit_Framework_TestCase
{
    protected $director;

    protected function setUp()
    {
        $this->director = new Director();
    }

    public function getBuilder()
    {
        return array(
            array(new CarBuilder()),
            array(new BikeBuilder())
        );
    }

    /**
     * @param BuilderInterface $builder
     *
     * @dataProvider getBuilder
     */
    public function testBuilder(BuilderInterface $builder)
    {
        $newVehicle = $this->director->builder($builder);
        $this->assertInstanceOf('Builder\AbstractClass\Vehicle', $newVehicle);
    }
}
