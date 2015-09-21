<?php
namespace Bridge\ImplementClass;

use Bridge\Contracts\Workshop;

class Produce implements
    Workshop
{
    public function work()
    {
        // TODO: Implement work() method.
        echo __CLASS__, '<br>';
    }
}
