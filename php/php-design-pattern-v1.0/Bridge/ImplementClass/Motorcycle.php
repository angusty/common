<?php
namespace Bridge\ImplementClass;

use Bridge\AbstractFactory\Vehicle;
use Bridge\Contracts\Workshop;

class Motorcycle extends Vehicle
{
    public function __construct(Workshop $workShop1, Workshop $workShop2)
    {
        parent::__constuct($workShop1, $workShop2);
    }

    public function manufacture()
    {
        echo __CLASS__, '<br>';
        $this->workShop1->work();
        $this->workShop2->work();
    }
}
