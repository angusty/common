<?php
namespace Tests;

use AbstractClass\BookPrototype;
use ImplementClass\BarBookPrototype;
use ImplementClass\FooBookPrototype;

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

    }
}
