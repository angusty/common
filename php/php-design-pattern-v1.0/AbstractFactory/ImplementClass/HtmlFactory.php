<?php
namespace AbstractFactory\ImplementClass;

use AbstractFactory\Contracts\AbstractFactory;
use AbstractFactory\ImplementClass\HTML\Text;
use AbstractFactory\ImplementClass\HTML\Picture;

class HtmlFactory implements AbstractFactory
{
    /**
     * Creates a text component
     *
     * @param string $content
     *
     * @return Text
     */
    public function createText($content)
    {
        // TODO: Implement createText() method.
        return new Text($content);
    }

    /**
     * Creates a picture component
     *
     * @param string $path
     * @param string $name
     *
     * @return Picture
     */
    public function createPicture($path, $name = '')
    {
        // TODO: Implement createPicture() method.
        return new Picture($path, $name);
    }
}
