<?php
namespace DependencyInjection\Contracts;

interface Parameters
{
    /**
     * @param string|int $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param string|int $key
     * @param mixed $value
     * @return mixed
     */
    public function set($key, $value);
}
