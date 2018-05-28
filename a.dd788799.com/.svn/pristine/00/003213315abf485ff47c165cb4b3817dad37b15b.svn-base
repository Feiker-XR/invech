<?php
namespace app\admin\controller;

use app\admin\Login;
use app\common\model\BetLottery as BetLotteryModel;
use app\common\model\Type as TypeModel;

class BetLottery extends Login{
    
    public function index(){
        
        //用户,彩种,开奖期数,派奖时间,撤销状态 查找
        $list = BetLotteryModel::getAllList();
        $this->assign('list',$list);
        
        $types = TypeModel::idMaps();
        $this->assign('types',$types);

        return $this->fetch();

    }

}