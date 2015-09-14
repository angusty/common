<?php
namespace Singleton\ImplementClass;

class Singleton
{
    private static $instance;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function __clone()
    {

    }

    protected function __wakeup()
    {

    }
}
