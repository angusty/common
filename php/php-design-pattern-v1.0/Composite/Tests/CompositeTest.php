<?php
namespace Composite\Tests;

use Composite\ImplementClass\Form;
use Composite\ImplementClass\InputElement;
use Composite\ImplementClass\TextElement;

class CompositeTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $form = new Form();
        $form->addElement(new TextElement());
        $form->addElement(new InputElement());

        $embed = new Form();
        $embed->addElement(new TextElement());
        $embed->addElement(new InputElement());

        $form->addElement($embed);

        $this->assertRegExp('#^\s{4}#m', $form->render());
    }

    public function testFormImplementsFormElement()
    {
        $class_name = 'Composite\ImplementClass\Form';
        $abstract_name = 'Composite\AbstractClass\FormElement';
        $this->assertTrue(is_subclass_of($class_name, $abstract_name));
    }
}