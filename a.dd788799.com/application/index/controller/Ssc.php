<?php 
namespace app\index\controller;
use app\common\model\LotteryData;
use app\common\model\LotteryTime;
use app\index\Base;

use app\common\model\Type;

class Ssc extends Base{
    
    public function index(){
        return $this->fetch();
    }
    
    public function main(){
    	// 所有的可用彩种
		$lotterys = collection(Type::getAll())->toArray();

		// 彩种类型
    	$lotteryType = Type::TYPE_ARRAY;

    	// 热门彩种
		$hotLottery = [];
		foreach($lotterys as $lItem){
			$hotLottery[$lItem['type']][] = $lItem;
		}

		 $this->view->pusher_app_key = env('broadcast.pusher_app_key');
        $this->view->pusher_cluster = env('broadcast.pusher_cluster');
		$this->assign('lotterys', $lotterys);
		$this->assign('lotteryType', $lotteryType);
		$this->assign('hotLottery', $hotLottery);

		return $this->fetch();
    }
    
    public function gcdt(){
        $this->assign("types", Type::getAll());
        return $this->fetch();
    }
    
    public function zsIndex(){
		// 所有的可用彩种
		$lotterys = collection(Type::getAll())->toArray();
		$this->assign('lotterys', $lotterys);

        return $this->fetch();
    }
    
    public function kjjg(){
        return $this->fetch();
    }
    
    public function getPlanOpenDataHistory(){
        $data = LotteryData::getHistory('cqssc')->items();
        $new = $r = [];
        foreach ($data as $row){
            $r['number'] = $row['phase'];
            $r['openCode'] = $row['data'];
            $r['openTime'] = $row['created_at'];
            $r['playGroupId'] = null;
            $new[] = $r;
        }
        return ['result'=>1, 'sscHistoryList'=>json_encode($new)];
    }
}

