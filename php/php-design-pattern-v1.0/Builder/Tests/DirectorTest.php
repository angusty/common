<?php
namespace Tests;

use Contracts\BuilderInterface;
use ImplementClass\BikeBuilder;
use ImplementClass\CarBuilder;
use ImplementClass\Director;

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
        $this->assertInstanceOf('AbstractClass\Vehicle', $newVehicle);
    }
}