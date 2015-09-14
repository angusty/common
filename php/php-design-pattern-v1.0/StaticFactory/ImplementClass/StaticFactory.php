<?php
namespace StaticFactory\ImplementClass;

class StaticFactory
{
    public static function factory($type)
    {
        $className = __NAMESPACE__ . '\Format' . ucfirst($type);
        if (!class_exists($className)) {
            throw new \InvalidArgumentException('Missing format class.');
        }
        return new $className();
    }
}
