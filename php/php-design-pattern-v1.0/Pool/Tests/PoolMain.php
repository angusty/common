<?php
namespace Tests;

use ImplementClass\Pool;

class PoolMain
{
    public static function index()
    {
        $pool = new Pool('Tests\MyTest');
        $obj = $pool->get();
//        var_dump($obj);
        $obj->test = 'new1';
        $pool->dispose($obj);
        $obj->test = 'new2';
//        var_dump($obj);
//        $pool->dispose($obj);
        var_dump($pool->instances);
        var_dump($pool->get());
        var_dump($pool->get());
        var_dump($pool->get());
    }
}

class MyTest
{
    public $test = 'old1';
    public $one = 'old2';
    public function test()
    {
        echo 'hello world';
    }
}

$root_dir = dirname(dirname(__DIR__));
require_once $root_dir . '/vendor/autoload.php';

PoolMain::index();
