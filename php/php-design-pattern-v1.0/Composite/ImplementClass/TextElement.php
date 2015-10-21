<?php
namespace Composite\ImplementClass;

use Composite\AbstractClass\FormElement;

class TextElement extends FormElement
{
    public function render($indent = 0)
    {
        // TODO: Implement render() method.
        return str_repeat('  ', $indent) . 'this is a text element';

    }

}