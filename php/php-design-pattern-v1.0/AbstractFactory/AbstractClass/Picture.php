<?php
namespace AbstractClass;

use Contracts\MediaInterface;

abstract class Picture implements MediaInterface
{
    protected $path;

    protected $name;

    public function __construct($path, $name='')
    {
        $this->name = (string) $name;
        $this->path = (string) $path;
    }
}
