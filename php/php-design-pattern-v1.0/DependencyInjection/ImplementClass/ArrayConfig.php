<?php
namespace DependencyInjection\ImplementClass;

use DependencyInjection\AbstractClass\AbstractConfig;
use DependencyInjection\Contracts\Parameters;

class ArrayConfig extends AbstractConfig implements
    Parameters
{
    public function get($key, $default = null)
    {
        // TODO: Implement get() method.
        if (isset($this->storage[$key])) {
            return $this->storage[$key];
        }
        return $default;
    }

    public function set($key, $value)
    {
        // TODO: Implement set() method.
        $this->storage[$key] = $value;
    }
}
