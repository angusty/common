<?php
namespace SimpleFactory\ImplementClass;

class ConcreteFactory
{
    protected $typeList = array();

    public function __construct()
    {
        $this->typeList = array(
            'bicycle' => __NAMESPACE__ . '\Bicycle',
            'other' => __NAMESPACE__ . '\Scooter'
        );
    }

    public function createVehicle($type)
    {
        if (!array_key_exists($type, $this->typeList)) {
            throw new \InvalidArgumentException("$type is not valid valid vehicle");
        }
        $className = $this->typeList[$type];
        return new $className();
    }
}
