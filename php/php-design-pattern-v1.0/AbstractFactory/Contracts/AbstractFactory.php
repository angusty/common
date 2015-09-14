<?php
namespace AbstractFactory\Contracts;

interface AbstractFactory
{
    /**
     * Creates a text component
     *
     * @param string $content
     *
     * @return Text
     */
    public function createText($content);

    /**
     * Creates a picture component
     *
     * @param string $path
     * @param string $name
     *
     * @return Picture
     */
    public function createPicture($path, $name = '');
}
