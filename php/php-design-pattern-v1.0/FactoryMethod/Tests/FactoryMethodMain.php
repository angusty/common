<?php
namespace FactoryMethod\Tests;

use FactoryMethod\ImplementClass\GermanFactory;
use FactoryMethod\ImplementClass\ItalianFactory;

class FactoryMethodMain
{
    public static function index()
    {
        $italian = new ItalianFactory();
        $obj1 = $italian->create(1);
        var_dump($obj1);
        $obj2 = $italian->create(2);
        var_dump($obj2);
        $german = new GermanFactory();
        $obj3 = $german->create(1);
        $obj4 = $german->create(2);
        var_dump($obj3);
        var_dump($obj4);
        $obj5 = new \ReflectionClass('FactoryMethod\ImplementClass\ItalianFactory');
//        $obj6 = $obj5->newInstance()->create(1);
        $obj6 = \ReflectionClass::export('FactoryMethod\ImplementClass\ItalianFactory', true);
        var_dump($obj6);
    }
}
$root_dir = dirname(dirname(__DIR__));
require_once $root_dir . '/vendor/autoload.php';
FactoryMethodMain::index();
