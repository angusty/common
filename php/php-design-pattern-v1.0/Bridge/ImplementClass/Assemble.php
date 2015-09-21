<?php
namespace Bridge\ImplementClass;

use Bridge\Contracts\Workshop;

class Assemble implements
    Workshop
{
    public function work()
    {
        // TODO: Implement work() method.
        echo __CLASS__, '<br>';
    }
}
