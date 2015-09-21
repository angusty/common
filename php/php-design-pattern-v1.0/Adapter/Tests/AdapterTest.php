<?php
namespace Adapter\Tests;

use Adapter\Contracts\PaperBookInterface;
use Adapter\ImplementClass\Book;
use Adapter\ImplementClass\EbookAdapter;
use Adapter\ImplementClass\Kindle;

class AdapterTest extends \PHPUnit_Framework_TestCase
{
    public function getEbooks()
    {
        return [
            [new Book()],
            [new EbookAdapter(new Kindle())]
        ];
    }

    /**
     * @param PaperBookInterface $book
     * @dataProvider getEbooks
     */
    public function testIAmOldClient(PaperBookInterface $book)
    {
        $this->assertTrue(method_exists($book, 'open'));
        $this->assertTrue(method_exists($book, 'turnPage'));
    }
}
