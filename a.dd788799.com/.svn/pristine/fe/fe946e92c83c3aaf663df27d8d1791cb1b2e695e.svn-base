<?php

namespace bong\service\queue\Jobs;

use bong\service\queue\Jobs\Job;

use bong\service\queue\Contracts\Job as JobContract;

use bong\service\queue\Driver\DatabaseQueue;


class DatabaseJob extends Job implements JobContract
{
    protected $database;

    //find得到的数组(object)转换后的stdClass
    protected $job;

    public function __construct(DatabaseQueue $database, $job, $queue)
    {
        $this->database = $database;
        $this->job = $job;
        $this->queue = $queue;
    }

    public function release($delay = 0)
    {
        parent::release($delay);

        $this->delete();

        return $this->database->release($this->queue, $this->job, $delay);
    }

    public function delete()
    {
        parent::delete();

        $this->database->deleteReserved($this->queue, $this->job->id);
    }

    public function attempts()
    {
        return (int) $this->job->attempts;
    }

    public function getJobId()
    {
        return $this->job->id;
    }

    public function getRawBody()
    {
        return $this->job->payload;
    }
}
