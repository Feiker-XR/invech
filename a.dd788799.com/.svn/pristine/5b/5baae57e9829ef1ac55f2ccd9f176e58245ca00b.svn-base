<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Cache;
use app\common\model\Bet as BetModel;
class Bet extends Login{
    
    public function index(){
    	$this->view->page_header = '注单列表';
    	$request   =   request();
    	$list      =   BetModel::getList($request);
        $this->assign('list',$list);
        return $this->fetch();
    }
   
}