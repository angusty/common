<?php
namespace Adapter\Tests;

use Adapter\ImplementClass\EbookAdapter;
use Adapter\ImplementClass\Kindle;

class AdapterMain
{
    public static function index()
    {
        $kindle = new Kindle();
        $ebook_adapter = new EbookAdapter($kindle);
        $open = $ebook_adapter->open();
        $turn_page = $ebook_adapter->turnPage();
        var_dump($kindle->pressStart());
        var_dump($ebook_adapter);
        var_dump($open);
        var_dump($turn_page);
    }
}

$root_dir = dirname(dirname(__DIR__));
require_once $root_dir . '/vendor/autoload.php';
AdapterMain::index();
