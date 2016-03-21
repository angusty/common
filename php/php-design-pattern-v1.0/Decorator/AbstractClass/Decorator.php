<?php
namespace Decorator\AbstractClass;

use Decorator\Contracts\RendererInterface;

abstract class Decorator implements RendererInterface
{
    /**
     * @var \Decorator\Contracts\RendererInterface
     */
    protected $wrapped;

    public function __construct(RendererInterface $wrapped)
    {
        $this->wrapped = $wrapped;
    }
}
