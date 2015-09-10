<?php
namespace ImplementClass;

class Pool
{
    private $instances;
    private $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function get()
    {

    }

    public function dispose($instance)
    {

    }
}
