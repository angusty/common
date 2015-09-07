<?php
namespace ImplementClass\JSON;

use AbstractClass\Text as BaseText;

class Text extends BaseText
{
    /**
     * some crude rendering from JSON or html output (depended on concrete class)
     *
     * @return string
     */
    public function render()
    {
        // TODO: Implement render() method.
        return json_encode(array('content' => $this->text));
    }

}