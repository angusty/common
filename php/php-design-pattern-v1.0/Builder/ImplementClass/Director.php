<?php
namespace ImplementClass;

use Contracts\BuilderInterface;

class Director
{
    public function builder(BuilderInterface $builder)
    {
        $builder->createVehicle();
        $builder->addWheel();
        $builder->addEngine();
        $builder->addDoors();
        return $builder->getVehicle();
    }
}