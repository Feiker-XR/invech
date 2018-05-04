<?php

namespace bong\service\queue;

use Exception;
use ReflectionClass;
use bong\service\queue\Contracts\Job;

class CallQueuedHandler
{

    public function __construct()
    {

    }

    public function call(Job $job, array $data)
    {

        $command = unserialize($data['command']);
        
        //$job 放入 command->job
        //if (in_array(InteractsWithQueue::class, 
        //class_uses_recursive(get_class($command)))) {
            $command->setJob($job);
        //}
            
        call_user_func_array(
            [$command, 'handle'],[]
        );

        if (! $job->isDeletedOrReleased()) {
            $job->delete();
        }
    }

    public function failed(array $data, $e)
    {
        $command = unserialize($data['command']);

        if (method_exists($command, 'failed')) {
            $command->failed($e);
        }
    }
}
