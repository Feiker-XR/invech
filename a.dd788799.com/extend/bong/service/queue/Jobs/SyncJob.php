<?php

namespace bong\service\queue\Jobs;

use bong\service\queue\Jobs\Job;

use bong\service\queue\Contracts\Job as JobContract;

class SyncJob extends Job implements JobContract
{
    protected $job;

    protected $payload;


    public function __construct($payload, $queue)
    {
        $this->queue = $queue;
        $this->payload = $payload;
    }

    public function release($delay = 0)
    {
        parent::release($delay);
    }

    public function attempts()
    {
        return 1;
    }

    public function getJobId()
    {
        return '';
    }

    public function getRawBody()
    {
        return $this->payload;
    }

    public function getQueue()
    {
        return 'sync';
    }
}
