<?php
namespace app\agent\controller;
use app\agent\Login;
use think\Cache;

use app\common\model\Member as UserModel;
use app\common\model\MemberLevel as LevelModel;
use bong\service\JsonExtra;
use app\common\model\ActionLog as LogModel;

class Bet extends Login{

    public function index(){
        $this->view->page_header = '投注记录';
        $agent = request()->user();        
        $list = $agent->getBetList();
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function daily_report(){
        $this->view->page_header = '投注日报表';
        $agent = request()->user();
        $query = $agent->getBetDailyAllBuild();
        $list = $query->paginate();
        $this->assign('list',$list);
        return $this->fetch();
    }
  
}