<?php
namespace Prototype\ImplementClass;

use Prototype\AbstractClass\BookPrototype;

class BarBookPrototype extends  BookPrototype
{
    protected $category = 'Bar';

    public function __clone()
    {
        // TODO: Implement __clone() method.
        echo $this->category, ' is clone <br>';
    }

}