<?php
namespace Prototype\Tests;

use Prototype\ImplementClass\BarBookPrototype;
use Prototype\ImplementClass\FooBookPrototype;

class BookPrototypeMain
{
    public static function index()
    {
        $fooPrototype = new FooBookPrototype();
        $barPrototype = new BarBookPrototype();

        for ($i = 0; $i < 10000; $i++) {
            $book = clone $fooPrototype;
            $book->setTitle('Foo Book No ' . $i);
        }

        for ($i = 0; $i < 5000; $i++) {
            $book = clone $barPrototype;
            $book->setTitle('Bar Book No ' . $i);
        }
    }
}

$root_dir = dirname(dirname(__DIR__));
require_once $root_dir . '/vendor/autoload.php';
BookPrototypeMain::index();
