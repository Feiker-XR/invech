<?php
namespace app\admin\controller;
use app\admin\Login;
//use app\index\model\Type;
//use app\common\model\Money as MoneyModel;
//model不放在module目录下,可以用,但不能直接使用model帮助函数;
use app\common\model\Money as MoneyModel;
use app\common\model\Order as OrderModel;

class Money extends Login{
  
    public function index(){
		$this->view->page_header = '资金列表';
		    $request = request();
       	$list = MoneyModel::getList($request);
      	$this->assign('list',$list);
      	$names = MoneyModel::NAME_ARRAY;
      	$this->assign('names',$names);
      	$urls = MoneyModel::URL_ARRAY;
      	$this->assign('urls',$urls);
		    return $this->fetch();
    }
    
}