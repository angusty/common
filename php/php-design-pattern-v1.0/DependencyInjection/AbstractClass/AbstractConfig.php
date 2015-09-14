<?php
namespace DependencyInjection\AbstractClass;

abstract class AbstractConfig
{
    protected $storage = array();

    public function __construct($storage)
    {
        $this->storage = $storage;
    }
}
