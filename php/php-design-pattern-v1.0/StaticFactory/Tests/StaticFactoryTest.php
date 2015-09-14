<?php
namespace StaticFactory\Tests;

use StaticFactory\ImplementClass\StaticFactory;

class StaticFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function getTypeList()
    {
        return array(
            array('string'),
            array('number')
        );
    }

    /**
     * @param $type
     * @dataProvider getTypeList
     */
    public function testCreation($type)
    {
        $type_obj = StaticFactory::factory($type);
        $this->assertInstanceOf('StaticFactory\Contracts\FormatterInterface', $type_obj);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage "yes" is invalid argument
     */
    public function testException()
    {
        StaticFactory::factory("yes");
    }
}
