<?php
namespace Decorator\Tests;

use Decorator\ImplementClass\RenderInJson;
use Decorator\ImplementClass\RenderInXml;
use Decorator\ImplementClass\Webservice;
use PHPUnit_Framework_TestCase;

class DecoratorTest extends PHPUnit_Framework_TestCase
{
    protected $service;

    protected function setUp()
    {
        $this->service = new WebService(['foo' => 'bar']);
    }

    public function testJsonDecorator()
    {
        $service = new RenderInJson($this->service);
//        $this->assertEquals('{"foo": "bar"}', $service->renderData());
        $this->assertJsonStringEqualsJsonString('{"foo": "bar"}', $service->renderData());
    }

    public function testXmlDecorator()
    {
        $service = new RenderInXml($this->service);
        $xml = '<?xml version="1.0" ?><foo>bar</foo>';
        $this->assertXmlStringEqualsXmlString($xml, $service->renderData());
    }
}
