<?php
namespace AbstractClass;

use Contracts\MediaInterface;

abstract class Text implements MediaInterface
{
    protected $text;

    public function __construct($text)
    {
        $this->text = (string) $text;
    }
}