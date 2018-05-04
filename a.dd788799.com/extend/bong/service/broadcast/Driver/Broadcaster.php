<?php

namespace bong\service\broadcast\Driver;

use ReflectionFunction;
use bong\foundation\Str;
use bong\service\broadcast\Contracts\Broadcaster as BroadcasterContract;

abstract class Broadcaster implements BroadcasterContract
{
    protected $channels = [];

    protected function formatChannels(array $channels)
    {
        return array_map(function ($channel) {
            return (string) $channel;
        }, $channels);
    }

    public function channel($channel, callable $callback)
    {
        $this->channels[$channel] = $callback;

        return $this;
    }

    protected function verifyUserCanAccessChannel($request, $channel)
    {
        foreach ($this->channels as $pattern => $callback) {
            if (! Str::is(preg_replace('/\{(.*?)\}/', '*', $pattern), $channel)) {
                continue;
            }

            $parameters = $this->extractAuthParameters($pattern, $channel, $callback);

            if ($result = $callback($request->uid, ...$parameters)) {
                return $this->validAuthenticationResponse($request, $result);
            }
        }

        throw new \Exception('channel auth failed!');
    }

    protected function extractAuthParameters($pattern, $channel, $callback)
    {
        $callbackParameters = (new ReflectionFunction($callback))->getParameters();

        $keys = $this->extractChannelKeys($pattern, $channel);

        //collection没有values取值函数,
        $collection = collection($this->extractChannelKeys($pattern, $channel))->filter(function ($value, $key) {
            return !is_numeric($key);
        });
        
        //return $collection->values()->all();
        return array_values($collection->all());
    }

    protected function extractChannelKeys($pattern, $channel)
    {
        preg_match('/^'.preg_replace('/\{(.*?)\}/', '(?<$1>[^\.]+)', $pattern).'/', $channel, $keys);

        return $keys;
    }
}
