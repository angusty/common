<?php
namespace Builder\Tests;

use Builder\ImplementClass\BikeBuilder;
use Builder\ImplementClass\CarBuilder;
use Builder\ImplementClass\Director;

class BuilderMain
{
    public static function index()
    {
        $director = new Director();
        $builder = new BikeBuilder();
        $bike = $director->builder($builder);
        var_dump($bike);
        $builder = new CarBuilder();
        $car = $director->builder($builder);
        var_dump($car);

    }
}

$root_dir = dirname(dirname(__DIR__));
require_once $root_dir . '/vendor/autoload.php';
BuilderMain::index();
