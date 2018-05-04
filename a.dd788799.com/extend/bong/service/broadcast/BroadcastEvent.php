<?php

namespace bong\service\broadcast;

use ReflectionClass;
use ReflectionProperty;
use bong\service\queue\Contracts\ShouldQueue;
use bong\service\queue\traits\InteractsWithQueue;
use bong\service\broadcast\Contracts\Broadcaster;


class BroadcastEvent implements ShouldQueue
{
    use InteractsWithQueue;

    public $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function handle()
    {
        $name = method_exists($this->event, 'broadcastAs')
                ? $this->event->broadcastAs() : get_class($this->event);

        $channels = $this->event->broadcastOn();
        if(!is_array($channels)){
            $channels = [$channels];
        }

        container('broadcast')->broadcast(
            $channels, $name,
            $this->getPayloadFromEvent($this->event)
        );
    }

    protected function getPayloadFromEvent($event)
    {
        if (method_exists($event, 'broadcastWith')) {
            return $event->broadcastWith();
        }

        $payload = [];

        foreach ((new ReflectionClass($event))->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $payload[$property->getName()] = $property->getValue($event);
        }

        //unset($payload['broadcastQueue']);
        unset($payload['queue']);

        return $payload;
    }

    public function displayName()
    {
        return get_class($this->event);
    }

    public function __clone()
    {
        $this->event = clone $this->event;
    }
}
