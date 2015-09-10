<?php
namespace ImplementClass;

class Processor
{
    private $pool;
    private $processing;
    private $maxProcesses;

    public function __construct($pool)
    {
        $this->pool = $pool;
    }

    public function process($image)
    {

    }

    private function createWorker($image)
    {

    }

    public function processDone($worker)
    {

    }

    private function pushToWaitingQueue($img)
    {

    }

    private function popFromWaitingQueue()
    {

    }
}
