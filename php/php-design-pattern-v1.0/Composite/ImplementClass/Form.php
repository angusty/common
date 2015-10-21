<?php
namespace Composite\ImplementClass;

use Composite\AbstractClass\FormElement;

class Form extends FormElement
{
    protected $elements;

    public function render($indent = 0)
    {
        // TODO: Implement render() method.
        $formCode = '';
        foreach($this->elements as $element) {
            $formCode .= $element->render($indent + 1) . PHP_EOL;
        }
        return $formCode;
    }

    public function addElement(FormElement $element)
    {
        $this->elements[] = $element;
    }
}
