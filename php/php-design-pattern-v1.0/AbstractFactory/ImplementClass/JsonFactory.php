<?php
namespace ImplementClass;

use Contracts\AbstractFactory;
use ImplementClass\JSON\Text;
use ImplementClass\JSON\Picture;

class JsonFactory implements AbstractFactory
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