<?php

namespace bong\foundation;

use think\db\Query;

class QueryWrapper
{
    protected $query = null;
    protected $options = null;
    protected $aggregations = ['sum','count','min','max','avg',];

    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    public function __call($method, $args)
    {
        if(in_array($method,$this->aggregations)){
            $options = $this->query->getOptions();
            $ret = call_user_func_array([$this->query, $method], $args);
            $this->query->options($options);
            return $ret;
        }
        return call_user_func_array([$this->query, $method], $args);
    } 
}
