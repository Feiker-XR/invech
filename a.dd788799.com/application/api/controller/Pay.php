<?php

namespace app\api\controller;
use app\api\Base;
use app\api\error\CodeBase;

use app\common\model\PaySet as PaySetModel;
use app\common\model\PayChannel as PayChannelModel;
use app\common\model\PayThird as PayThirdModel;
use app\common\model\Order as OrderModel;

use think\Response;

class pay extends Base{
    
    public function code(){
        //$user = $this->request->user();
        $data = PaySetModel::code();	
        return $this->apiReturn([],$data);
    }

    public function pay(){
        $error = CodeBase::$error;
        try{
            $data = $this->user->pay();   
        }catch(\Exception $e){
            $error[API_MSG_NAME] = $e->getMessage();
            return $this->apiReturn($error);
        }
        return $this->apiReturn([],$data);
    }

    public function pay_content($orderid){       
        $order = OrderModel::get($orderid);
        $html = $order->pay_content??'';        
        return Response::create($html, 'html');
    }

    public function orderPayed(){
        $error = CodeBase::$error;

        $orderid = input('orderid');
        if(!$orderid){
            $error[API_MSG_NAME] = '订单号不能为空!';
            return $this->apiReturn($error);
        }
        $order = OrderModel::get($orderid);
        if(!$order){
            $error[API_MSG_NAME] = '订单不存在!';
            return $this->apiReturn($error);
        }
        return $this->apiReturn([],['order_state'=>$order->status]);
    }

}