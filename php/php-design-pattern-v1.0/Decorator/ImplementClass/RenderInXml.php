<?php
namespace Decorator\ImplementClass;

use Decorator\AbstractClass\Decorator;
use DOMDocument;

class RenderInXml extends Decorator
{
    public function renderData()
    {
        // TODO: Implement renderData() method.
        $output = $this->wrapped->renderData();
        $doc = new DOMDocument();
        foreach ($output as $key => $val) {
            $doc->appendChild($doc->createElement($key, $val));
        }
        return $doc->saveXML();
    }
}
