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
        $this->assertContainsOnly('Contracts/MediaInterface', $article);
    }

//    public function getFactories()
//    {
//        return array(
//            array(new JsonFactory()),
//            array(new HtmlFactory())
//        );
//    }

    /**
     * This is the client of factories. Note that the client does not
     * care which factory is given to him, he can create any component he
     * wants and render how he wants.
     *
     * @dataProvider getFactories
     */
//    public function testComponentCreation(AbstractFactory $factory)
//    {
//        $article = array(
//            $factory->createText('Lorem Ipsum'),
//            $factory->createPicture('/image.jpg', 'caption'),
//            $factory->createText('footnotes')
//        );
//
//        $this->assertContainsOnly('Contracts/MediaInterface', $article);
//
//        /* this is the time to look at the Builder pattern. This pattern
//         * helps you to create complex object like that article above with
//         * a given Abstract Factory
//         */
//    }
}