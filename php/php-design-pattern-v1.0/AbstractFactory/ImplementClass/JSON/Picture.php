<?php
namespace ImplementClass\JSON;

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
        return json_encode(array('title' => $this->name, 'path' => $this->path));
    }

}