<?php
namespace AbstractFactory\Contracts;

interface MediaInterface
{
    /**
     * some crude rendering from JSON or html output (depended on concrete class)
     *
     * @return string
     */
    public function render();
}
