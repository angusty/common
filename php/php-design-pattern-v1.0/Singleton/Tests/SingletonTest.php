<?php
namespace Singleton\Tests;

use Singleton\ImplementClass\Singleton;

class SingletonTest extends \PHPUnit_Framework_TestCase
{
    public function testUniqueness()
    {
        $firstCall = Singleton::getInstance();
        $this->assertInstanceOf('Singleton\ImplementClass\Singleton', $firstCall);
        $secondCall = Singleton::getInstance();
        $this->assertSame($firstCall, $secondCall);
    }

    public function testNoConstructor()
    {
        $obj = Singleton::getInstance();
        $ref1 = new \ReflectionObject($obj);
        $meth = $ref1->getMethod('__construct');
        $this->assertTrue($meth->isPrivate());
//        $this->assertTrue($meth->isProtected());
    }
}
