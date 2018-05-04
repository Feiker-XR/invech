<?php

namespace bong\service;
use \think\Cache;

class RateLimiter
{

    protected $cache;

    public function __construct()
    {
        $this->cache = Cache::init();
    }

    public function tooManyAttempts($key, $maxAttempts, $decayMinutes = 1)
    {
        $attempts = $this->attempts($key);
        if ($attempts >= $maxAttempts) {
            if ($this->cache->has($key.':timer')) {
                return true;
            }

            $this->resetAttempts($key);
        }

        return false;
    }

    public function hit($key, $decayMinutes = 1)
    {
        $time = time();
        $timer = $key.':timer';
        if(!cache('?'.$timer)){
            $ret = cache($timer,$time+$decayMinutes*60,$decayMinutes*60);
            $ret = cache($key,0,$decayMinutes*60);
        }

        //inc,不存在$key,$key设置为1,存在则设置为+1;
        //问题是inc会设置key为永久有效,总是存在$key,需要在前面初始化key为0
        $hits = (int)$this->cache->inc($key);

        return $hits;
    }

    public function attempts($key)
    {   
        $timer = $key.':timer';
        if(!cache('?'.$timer)){
            return 0;
        }        
        return $this->cache->get($key, 0);
    }

    public function resetAttempts($key)
    {
        return $this->cache->rm($key);
    }

    public function retriesLeft($key, $maxAttempts)
    {
        $attempts = $this->attempts($key);

        return $maxAttempts - $attempts;
    }

    public function clear($key)
    {
        $this->resetAttempts($key);

        $this->cache->rm($key.':timer');
    }

    public function availableIn($key)
    {
        return $this->cache->get($key.':timer') - time();
    }
}
