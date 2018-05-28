<?php

namespace app\events;
use app\common\model\Data;
use app\common\model\LotteryData;
use bong\service\broadcast\Contracts\ShouldBroadcast;
use bong\service\broadcast\PrivateChannel;
use bong\service\broadcast\PublicChannel;

class BroadLotteryEvent implements ShouldBroadcast
{
    public $obj;
    public $queue = 'BroadLottery'; //队列名;

    public function __construct(LotteryData $data)
    {
        $this->obj = $data;
    }

    public function broadcastAs()
    {
        return 'lottery.open';
    }

    //广播渠道,可以返回数组,
    public function broadcastOn()
    {
        return new PublicChannel('lottery.open.'.$this->obj->code);
    }

    //数据负载,默认事件的所有public属性;
    public function broadcastWith(){
    	return ['code'=>$this->obj->getData()];
    }
}
