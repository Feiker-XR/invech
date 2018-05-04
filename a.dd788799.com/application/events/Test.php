<?php

namespace app\events;

class Test
{
    protected $obj;
    
    public function __construct($obj)
    {
        $this->obj = $obj;
    }

}
