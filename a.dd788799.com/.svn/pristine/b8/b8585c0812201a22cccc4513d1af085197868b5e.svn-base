<?php
namespace app\admin\controller;
use app\admin\Login;
use app\common\model\Order as OrderModel;
use think\Cache;
class Order extends Login{
      /**
     *菜单入口:订单列表
    */  
    

    public function index(){
        $this->view->page_header = '充值订单列表';
        $request = request();
        $list = OrderModel::getList($request);
        $this->assign('list',$list);
        return $this->fetch();
    }

       
}