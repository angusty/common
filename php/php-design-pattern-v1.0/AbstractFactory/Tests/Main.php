<?php
namespace Tests;
use ImplementClass\HtmlFactory;
use ImplementClass\JsonFactory;

class Main
{
    public function index()
    {
        $htmlfactory = new HtmlFactory();
        $img_url = 'http://cms.csdnimg.cn/article/201404/29/535f579acd116.jpg';
        $html_text_demo = $htmlfactory->createText('this is my test!!');
        $html_picture_demo = $htmlfactory->createPicture($img_url, '苹果logo');
        $jsonfactory = new JsonFactory();
        $json_text_demo = $jsonfactory->createText('this is my test!!');
        $json_picture_demo = $jsonfactory->createPicture($img_url, '苹果logo');
        echo 'html: ', '<br>';
        echo $html_text_demo->render(), '<br>';
        echo $html_picture_demo->render(), '<br>';
//        var_dump($html_text_demo->render());
//        var_dump($html_picture_demo->render());
        echo '<hr>';
        echo 'json: ', '<br>';
        echo $json_text_demo->render(), '<br>';
        echo $json_picture_demo->render();
//        var_dump($json_text_demo->render());
//        var_dump($json_picture_demo->render());
    }
}

$root_dir = dirname(dirname(__DIR__));
require_once $root_dir . '/vendor/autoload.php';
$main = new Main();
$main->index();