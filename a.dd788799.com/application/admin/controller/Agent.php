<?php
namespace app\admin\controller;
use app\admin\Login;
use app\common\model\Member as UserModel;
class Agent extends Login{

    public function index(){
    	$this->view->page_header = '代理列表';
        //$list      =   UserModel::scope('AgentScope')->paginate(); 
        $list      =   UserModel::AgentScope()->paginate(); 
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function money(){
        $this->view->page_header = '代理佣金';
    }
}