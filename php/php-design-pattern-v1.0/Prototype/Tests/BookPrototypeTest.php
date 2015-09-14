<?php
namespace Prototype\Tests;

use Prototype\AbstractClass\BookPrototype;
use Prototype\ImplementClass\BarBookPrototype;
use Prototype\ImplementClass\FooBookPrototype;

class BookPrototypeTest extends \PHPUnit_Framework_TestCase
{
    public function getPrototype()
    {
        return array(
            array(
                new BarBookPrototype(),
                new FooBookPrototype()
            )
        );
    }

    /**
     * @param BookPrototype $book
     * @dataProvider getPrototype
     */
    public function testCloneComponent(BookPrototype $book)
    {
        $books = array(
            clone $book
        );
        $this->assertContainsOnly('Prototype\AbstractClass\BookPrototype', $books);
    }
}
