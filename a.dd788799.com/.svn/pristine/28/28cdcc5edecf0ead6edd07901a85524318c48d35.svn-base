<?php

namespace bong\service\queue\Jobs;

use bong\service\queue\Jobs\Job;

use bong\service\queue\Contracts\Job as JobContract;

use bong\service\queue\Driver\RedisQueue;


class RedisJob extends Job implements JobContract
{

    protected $redis;

    protected $job;

    protected $decoded;

    protected $reserved;

    public function __construct(RedisQueue $redis, $job, $reserved, $queue)
    {
        $this->job = $job;
        $this->redis = $redis;
        $this->queue = $queue;
        $this->reserved = $reserved;
        $this->decoded = $this->payload();
        $this->uuid = uniqid($queue) . '.' . microtime(true);
    }

    public function getRawBody()
    {
        return $this->job;
    }

    public function delete()
    {
        parent::delete();

        $this->redis->deleteReserved($this->queue, $this);
    }

    public function release($delay = 0)
    {
        parent::release($delay);

        $this->redis->deleteAndRelease($this->queue, $this, $delay);
    }

    public function attempts()
    {
        return ($this->decoded['attempts'] ?? null) + 1;
    }

    public function getJobId()
    {
        return $this->decoded['id'] ?? null;
    }

    public function getRedisQueue()
    {
        return $this->redis;
    }

    public function getReservedJob()
    {
        return $this->reserved;
    }
}
