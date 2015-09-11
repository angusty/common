<?php
namespace ImplementClass;

class Worker
{
    public function __construct()
    {

    }

    public function run($image, array $callback)
    {
        call_user_func($callback, $this);
    }
}