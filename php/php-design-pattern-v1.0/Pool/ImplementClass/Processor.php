<?php
namespace ImplementClass;

use ImplementClass\Pool;

class Processor
{
    private $pool;
    private $processing;
    private $maxProcesses;
    private $waitingQueue;

    public function __construct(Pool $pool)
    {
        $this->pool = $pool;
    }
    private function pushToWaitingQueue($image)
    {
        $this->waitingQueue[] = $image;
    }

    private function popFromWaitingQueue()
    {
        return array_pop($this->waitingQueue);
    }

    private function createWorker($image)
    {
        $worker = $this->pool->get();
        $worker->run($image, array($this, 'processDone'));
    }

    public function process($image)
    {
        if ($this->processing++ < $this->maxProcesses) {
            $this->createWorker($image);
        } else {
            $this->pushToWaitingQueue($image);
        }
    }

    public function processDone($worker)
    {
        $this->processing--;
        $this->pool->dispose($worker);
        if (count($this->waitingQueue) > 0) {
            $this->createWorker($this->popFromWaitingQueue());
        }
    }
}
