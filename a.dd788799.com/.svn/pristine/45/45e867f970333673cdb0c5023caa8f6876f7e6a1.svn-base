<?php
namespace app\index\controller;
use app\index\Base;
use think\Db;

use app\common\model\PaySet;
use app\common\model\Order;


class Pay extends Base{
    
    use \app\Pay\PayControllerTrait;

    public function _initialize(){    
          parent::_initialize();    
          $title = '充值中心';
          $this->assign('title',$title);
    }

    public function index(){
        return $this->fetch();
    }

    public function code(){
        config('default_return_type','json');
        $data = PaySet::code();
        //echo json_encode($data);
        return $this->success('成功!','',$data);
    }
    
    /*
     * 充值处理;规定ajax方式处理;网站和app统一
    */
    public function pay(){
        config('default_return_type','json');
        try{
            $data = $this->user->pay();    
        }catch(\Exception $e){
            return $this->error($e->getMessage());
        }
        return $this->success('','',$data);
    }

    //IOS webview 处理
    public function pay_content($orderid){
        $order = Order::get($orderid);
        echo $order['pay_content']? $order['pay_content']  : '';
    }

    /*
     * 查询订单是否已支付,用于扫码后自动跳转,后期改为事件广播
     status=1表示已支付;-1表示请求错误
    */
    public function orderPayed(){
        $orderid = input('orderid');
        if(!$orderid){
            return $this->error('订单号不能为空!');
        }
        $order = Order::where('id',$orderid)->find();
        if(!$order){
            return $this->error('订单不存在!');
        }
        return $this->success('','',['order_state'=>$order->status]);
    }

}