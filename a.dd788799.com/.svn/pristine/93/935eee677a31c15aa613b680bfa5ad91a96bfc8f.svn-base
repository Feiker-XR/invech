<?php
namespace app\admin\controller;
use app\admin\Login;
use app\common\model\Commission as CommissionModel;
class Commission extends Login{
    
    public function index(){
    	$this->view->page_header = '分佣列表';
    	$request   =   request();
    	$list      =   CommissionModel::getList($request);
        $this->assign('list',$list);
        return $this->fetch();
    }
   
}