<?php
namespace Bridge\AbstractFactory;

use Bridge\Contracts\Workshop;

abstract class Vehicle
{
    protected $workShop1;
    protected $workShop2;
    protected function __constuct(Workshop $workShop1, Workshop $workShop2)
    {
        $this->workShop1 = $workShop1;
        $this->workShop2 = $workShop2;
    }

    public function manufacture()
    {

    }
}
