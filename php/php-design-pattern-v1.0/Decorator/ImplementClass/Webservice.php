<?php
namespace Decorator\ImplementClass;

use Decorator\Contracts\RendererInterface;

class Webservice implements RendererInterface
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function renderData()
    {
        // TODO: Implement renderData() method.
        return $this->data;
    }
}