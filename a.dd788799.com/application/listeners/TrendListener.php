<?php

namespace app\listeners;

use app\common\model\LotteryData;

use bong\service\queue\Contracts\ShouldQueue;

class TrendListener //implements ShouldQueue
{

    //public $queue = '';

	//删除缓存
    public function onAction(LotteryData $ld, ...$extra){
    	$ld->rmCachedTrend();
    }

}


