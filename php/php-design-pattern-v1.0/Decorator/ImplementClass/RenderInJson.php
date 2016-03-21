<?php
namespace Decorator\ImplementClass;

use Decorator\AbstractClass\Decorator;

class RenderInJson extends Decorator
{
    public function renderData()
    {
        // TODO: Implement renderData() method.
        $output = $this->wrapped->renderData();
        return json_encode($output);
    }
}