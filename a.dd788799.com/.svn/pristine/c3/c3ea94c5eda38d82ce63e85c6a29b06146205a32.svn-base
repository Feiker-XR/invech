<?php

namespace bong\service\queue;

abstract class Queue
{

    protected $driver;//$connectionName; database,sync

    public function pushOn($queue, $job, $data = '')
    {
        return $this->push($job, $data, $queue);
    }

    public function bulk($jobs, $data = '', $queue = null)
    {
        foreach ((array) $jobs as $job) {
            $this->push($job, $data, $queue);
        }
    }

    protected function createPayload($job, $data = '')
    {
        $payload = json_encode($this->createPayloadArray($job, $data));

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \Exception(
                'Unable to JSON encode payload. Error code: '.json_last_error()
            );
        }

        return $payload;
    }

    protected function createPayloadArray($job, $data = '')
    {
        return is_object($job)
                    ? $this->createObjectPayload($job)
                    : $this->createStringPayload($job, $data);
    }

    protected function createObjectPayload($job)
    {
        $payload = [
            'displayName' => $this->getDisplayName($job),
            'job' => 'bong\service\queue\CallQueuedHandler@call',
            'maxTries' => $job->tries ?? null,
            'timeout' => $job->timeout ?? null,
            'timeoutAt' => null,
            'data' => [
                'commandName' => get_class($job),
                'command' => serialize(clone $job),
            ],
        ];
        return $payload;
    }

    protected function getDisplayName($job)
    {
        return method_exists($job, 'displayName')
                        ? $job->displayName() : get_class($job);
    }

    protected function createStringPayload($job, $data)
    {
        return [
            'displayName' => is_string($job) ? explode('@', $job)[0] : null,
            'job' => $job, 'maxTries' => null,
            'timeout' => null, 'data' => $data,
        ];
    }

    protected function availableAt($delay = 0){
        //return date('Y-m-d H:i:s',time() + $delay);
        return time() + $delay;
    }

    

}
