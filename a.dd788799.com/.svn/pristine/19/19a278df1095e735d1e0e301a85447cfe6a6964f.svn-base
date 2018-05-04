<?php

namespace bong\service;

use Hashids\Hashids;

class HashidsManager
{
    protected $hashers = [];

    public function hasher($name = 'default')
    {
        return isset($this->hashers[$name])
                    ? $this->hashers[$name]
                    : $this->hashers[$name] = $this->resolve($name);
    }

    protected function resolve($name)
    {
        $config = config('hashid.'.$name);
        $hasher = new Hashids($config['salt'],$config['length'],$config['alphabet']);
        return $hasher;
    }

}
