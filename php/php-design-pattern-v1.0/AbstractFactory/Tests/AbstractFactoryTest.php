<?php
namespace Tests;

use ImplementClass\HtmlFactory;
use ImplementClass\JsonFactory;
use Contracts\AbstractFactory;

class AbstractFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function getFactories()
    {
        return array(
            array(new JsonFactory()),
            array(new HtmlFactory())
        );
    }

    /**
     *  @dataProvider getFactories
     */
    public function testComponentCreation(AbstractFactory $factory)
    {
        $img_url = 'http://cms.csdnimg.cn/article/201404/29/535f579acd116.jpg';
        $article = array(
            $factory->createText('this is text!'),
            $factory->createPicture($img_url, '苹果的logo!!'),
            $factory->createText('foot this text!!!')
        );
        $this->assertContainsOnly('Contracts\MediaInterface', $article);
    }
}
