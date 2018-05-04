<?php

namespace bong\service\queue\Jobs;

abstract class Job
{
    protected $instance;

    protected $deleted = false;

    protected $released = false;

    protected $failed = false;

    protected $queue;

    abstract public function getRawBody();

    public function fire()
    {
        $payload = $this->payload();

        list($class, $method) = parse_callback($payload['job']);

        ($this->instance = $this->resolve($class))->{$method}($this, $payload['data']);
    }

    public function payload()
    {
        return $payload = json_decode($this->getRawBody(), true);
    }
    
    protected function resolve($class)
    {
        return container($class);
    }

    public function delete()
    {
        $this->deleted = true;
    }

    public function isDeleted()
    {
        return $this->deleted;
    }

    public function release($delay = 0)
    {
        $this->released = true;
    }

    public function isReleased()
    {
        return $this->released;
    }

    public function isDeletedOrReleased()
    {
        return $this->isDeleted() || $this->isReleased();
    }

    public function hasFailed()
    {
        return $this->failed;
    }

    public function markAsFailed()
    {
        $this->failed = true;
    }

    public function failed($e)
    {
        $this->markAsFailed();
    }

    public function maxTries()
    {
        return $this->payload()['maxTries'] ?? null;
    }

    public function timeout()
    {
        return $this->payload()['timeout'] ?? null;
    }

    public function timeoutAt()
    {
        return $this->payload()['timeoutAt'] ?? null;
    }

    public function getName()
    {
        return $this->payload()['job'];
    }

    public function getQueue()
    {
        return $this->queue;
    }

}
