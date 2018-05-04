<?php

namespace app\events;

use bong\service\broadcast\Contracts\ShouldBroadcast;
use bong\service\broadcast\Contracts\ShouldBroadcastNow;
use bong\service\broadcast\PrivateChannel;

//class BroadEvent implements ShouldBroadcast
class BroadEvent implements ShouldBroadcastNow
{
    public $obj;
    public $queue = 'test2'; //队列名;

    public function __construct($obj)
    {
        $this->obj = $obj;
    }

    
    /*事件名,默认当前事件的全路径类名
    public function broadcastAs()
    {
        return 'event_name';
    }
    */

    //广播渠道,可以返回数组,
    public function broadcastOn()
    {
        return new PrivateChannel('user.order.'.$this->obj->uid);
    }

    /*数据负载,默认事件的所有public属性;
    public function broadcastWith(){
    	return [];
    }
    */
}
