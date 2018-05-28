<?php

namespace bong\service\broadcast;

class PublicChannel extends Channel
{
    public function __construct($name)
    {
        parent::__construct('public-'.$name);
    }
}
