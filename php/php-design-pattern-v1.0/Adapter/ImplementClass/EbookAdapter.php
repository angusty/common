<?php
namespace Adapter\ImplementClass;

use Adapter\Contracts\EBookInterface;
use Adapter\Contracts\PaperBookInterface;

class EbookAdapter implements
    PaperBookInterface
{
    protected $eBook;

    public function __construct(EBookInterface $eBook)
    {
        $this->eBook = $eBook;
    }

    public function turnPage()
    {
        // TODO: Implement turnPage() method.
        return $this->eBook->pressStart();
    }

    public function open()
    {
        // TODO: Implement open() method.
        return $this->eBook->pressNext();
    }
}
