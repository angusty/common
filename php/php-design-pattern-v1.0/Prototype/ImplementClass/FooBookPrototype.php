<?php
namespace Prototype\ImplementClass;

use Prototype\AbstractClass\BookPrototype;

class FooBookPrototype extends BookPrototype
{
    protected $category = 'Foo';

    public function __clone()
    {
        // TODO: Implement __clone() method.
        echo $this->category, ' is clone <br>';
    }

}