<?php

namespace app\Pay;
use app\common\model\Order;

//此处实现 与 input('thirdtype') 以及 Order::where('orderno') 耦合
//后期再优化支付模块;
//比如 business作为事件发送出去'order.notify';
//BonusEventSubscriber 仅作为红利事件处理; 普通事件处理在app\required\events中;

trait PayControllerTrait
{    
    /*
     * 异步通知总入口  pay/notify/thirdtype/$thirdtype
     */
    public function notify(){    
        $log = dirname(__FILE__).'/log.txt';  
        file_put_contents($log, http_build_query($_REQUEST)."\r\n",FILE_APPEND);

        $thirdtype  =   input('thirdtype');
        $pay = pay($thirdtype);
  
        if($pay->check_success()){
            $orderno = $pay->orderno();
            $out_trade_no = $pay->out_trade_no();        
            $this->business($orderno,$out_trade_no); 
            $pay->success();
        }else{
            echo "验签失败!";
        }
    }
    
    /*
     * 业务流程
    */
    private function business($orderno,$out_trade_no=''){

        $order = Order::where('orderno',$orderno)->find();
        if($order && $order->user){
            $order->user->notify($order,$out_trade_no);
        }

    }

}
