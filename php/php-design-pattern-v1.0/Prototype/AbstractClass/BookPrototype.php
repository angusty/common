<?php
namespace AbstractClass;

abstract class BookPrototype
{
    protected $title;
    protected $category;

    abstract public function __clone();

    public function getTitle()
    {
        return isset($this->title) ? $this->title : null;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
}
