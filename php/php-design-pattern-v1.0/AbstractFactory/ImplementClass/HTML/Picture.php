<?php
namespace ImplementClass\HTML;

use AbstractClass\Picture as BasePicture;

class Picture extends BasePicture
{
    /**
     * some crude rendering from JSON or html output (depended on concrete class)
     *
     * @return string
     */
    public function render()
    {
        // TODO: Implement render() method.
        return sprintf('<img src="%s" title="%s" />', $this->path, $this->name);
    }
}
