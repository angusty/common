<?php
namespace Bridge\Tests;

use Bridge\ImplementClass\Assemble;
use Bridge\ImplementClass\Car;
use Bridge\ImplementClass\Motorcycle;
use Bridge\ImplementClass\Produce;

class BridgeMain
{
    public static function index()
    {
        $assemble = new Assemble();
        $produce = new Produce();
        $car = new Car($assemble, $produce);
        $car->manufacture();
        echo '<hr>';
        $motorcycle = new Motorcycle($assemble, $produce);
//        $motorcycle->manufacture();
    }
}

$root_dir = dirname(dirname(__DIR__));
require_once $root_dir . '/vendor/autoload.php';
BridgeMain::index();
