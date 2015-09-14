<?php
namespace AbstractFactory\AbstractClass;

use AbstractFactory\Contracts\MediaInterface;

abstract class Text implements MediaInterface
{
    protected $text;

    public function __construct($text)
    {
        $this->text = (string) $text;
    }
}
