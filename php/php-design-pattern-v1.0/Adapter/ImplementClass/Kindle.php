<?php
namespace Adapter\ImplementClass;

use Adapter\Contracts\EBookInterface;

class Kindle implements
    EBookInterface
{
    public function pressNext()
    {
        // TODO: Implement pressNext() method.
        return __CLASS__ . ' is pressNext';
    }

    public function pressStart()
    {
        // TODO: Implement pressStart() method.
        return __CLASS__ . ' is pressStart';
    }
}
