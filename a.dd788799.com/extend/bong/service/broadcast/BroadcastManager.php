<?php

namespace bong\service\broadcast;

use app\common\Contracts\Factory as FactoryContract;

use bong\service\broadcast\Contracts\ShouldBroadcastNow;
use bong\service\broadcast\Contracts\ShouldBroadcast;

use Pusher\Pusher;

use bong\service\broadcast\Driver\LogBroadcaster;
use bong\service\broadcast\Driver\PusherBroadcaster;
use bong\service\broadcast\BroadcastEvent;

class BroadcastManager implements FactoryContract
{
    protected $drivers = [];

    public function __construct()
    {
    }

    public function driver($name = null)
    {
        $name = $name??config('broadcast.driver');

        return isset($this->drivers[$name])
                    ? $this->drivers[$name]
                    : $this->drivers[$name] = $this->resolve($name);
    }

    protected function resolve($name)
    {
        $configs = config('broadcast.configs');
        $config = $configs[$name];
        $driver_name = "bong\\service\\broadcast\\Driver\\" . ucfirst($name) . 'Broadcaster';
        $driver = new $driver_name($config);
        return $driver;
    }

    public function __call($method, $parameters)
    {
        return $this->driver()->$method(...$parameters);
    }

    public function queue($event)
    {
        $driver = $event instanceof ShouldBroadcastNow ? 'sync' : null;
        $queue = $event->queue??null;
        container('queue')->driver($driver)->pushOn(
            $queue, new BroadcastEvent(clone $event)
        );
    }
}
