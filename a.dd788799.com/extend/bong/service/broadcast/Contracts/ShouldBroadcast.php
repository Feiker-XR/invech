<?php

namespace bong\service\broadcast\Contracts;

interface ShouldBroadcast
{
    public function broadcastOn();
}
