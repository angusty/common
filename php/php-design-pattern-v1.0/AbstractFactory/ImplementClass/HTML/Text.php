<?php
namespace ImplementClass\HTML;

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
        return '<div>' . htmlspecialchars($this->text) . '</div>';
    }

}