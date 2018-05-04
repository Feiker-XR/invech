<?php

namespace app\Pay;

use Closure;

use app\Pay\Contracts\Factory as FactoryContract;

class PayManager implements FactoryContract
{
    protected $drivers = [];


    public function __construct()
    {
    
    }

    public function driver($name = null)
    {
        if (is_null($name)) {
            throw new \Exception("Pay driver [{$name}] is not defined.");
        }

        return isset($this->drivers[$name])
                    ? $this->drivers[$name]
                    : $this->drivers[$name] = $this->resolve($name);
    }

    protected function resolve($name)
    {

        $config = db('pay_third')->where('type',$name)->find();

        if (is_null($config)) {
            throw new \Exception("Pay driver [{$name}] is not configed.");
        }

        $driver_name = '\\app\\Pay\\Driver\\'.ucwords($name);
        $driver = new $driver_name($config);

        return $driver;
    }

    public function __call($method, $parameters)
    {
        return $this->driver()->{$method}(...$parameters);
    }

}
