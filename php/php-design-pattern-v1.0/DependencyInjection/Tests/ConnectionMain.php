<?php
namespace DependencyInjection\Tests;

use DependencyInjection\ImplementClass\Connection;
use DependencyInjection\ImplementClass\ArrayConfig;

class ConnectionMain
{
    public static function index()
    {
        $config_array = array('test' => 'test');
        $config = new ArrayConfig($config_array);
        $config->set('host', '127.0.0.1');
        $connect = new Connection($config);
//        $connect->connect();
        var_dump($config);
        var_dump($connect->getHost());
    }
}

$root_dir = dirname(dirname(__DIR__));

require_once $root_dir . '/vendor/autoload.php';
ConnectionMain::index();
