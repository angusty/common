<?php
namespace Tests;

use ImplementClass\BikeBuilder;
use ImplementClass\CarBuilder;
use ImplementClass\Director;

class BuilderMain
{
    public function index()
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

$buildermain = new BuilderMain();
$buildermain->index();
