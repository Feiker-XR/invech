<?php
namespace app\common\model\member;

use app\common\model\PayWay;
use app\common\model\PayThird;
use app\common\model\PayChannel;
use app\common\model\Order;
use app\common\model\Config;

trait PayTrait
{
    //-------------前台----------------
    public function pay(){        

        return transaction(function(){

            date_default_timezone_set('PRC');

            $way_id     =   input('way_id');
            $local_code =   input('local_code');

            $third_id    =   input('third_id');
            $thirdtype  =   input('third_type');
            $pay_code      =   input('pay_code');        
            
            $amount = input("amount/i");
            
            if($amount <= 0){
                $str = '充值金额有误';
                throw new \Exception($str);               
            }
            
            $third = PayThird::get($third_id);
            if(!$third){
                $str = '第三方支付id有误';
                throw new \Exception($str);               
            }
            $channel = PayChannel::where('way_id',$way_id)->where('third_id',$third_id)->find();
            if(!$channel){
                $str = '指定的第三方支付没有对应指定的支付方式的渠道';
                throw new \Exception($str);              
            }
            if($amount < $channel->min){
                $str = '参数错误:不能低于最低充值金额:'.$channel->min.'元';
                throw new \Exception($str);    
            }
            if($amount > $channel->max){
                $str = '参数错误:不能高于最高充值金额:'.$channel->max.'元';
                throw new \Exception($str);
            }
            
            $pay = pay($thirdtype);
            $orderno = $pay->genOrderno();                   
            $order = Order::create([
                        'uid'       => $this->id,
                        'orderno'   => $orderno,
                        'amount'    => $amount,
                        //'business'  => 'recharge',
                        //'item_type'=> null,废弃
                        //'item_id'=> null,废弃字段
                        //'status'    => 0,
                        //'order_time' => date('Y-m-d H:i:s'),废弃字段,created_at
                        //'pay_time'  => null,付款时间              
                        'pay_name'  => $pay->getName(),
                        'pay_type'  => $thirdtype,
                        'pay_code'  => $pay_code,
                        'local_code' => $local_code,
                    ]);
            $params = compact('orderno','pay_code','amount');
            $ret = $pay->pay($params);
            if($ret['mode']=='html'){
                //ios的webview直接加载html有问题;这里转为html的url,让safari打开url;
                $order->save(['pay_content'=>$ret['content'],]);
                $ret['content'] = url('pay/pay_content',['orderid'=>$order->id],true,true);
            }
            return $ret;
        });
    }

    public function notify($order,$out_trade_no){

        return transaction(function() use($order,$out_trade_no) {            
            date_default_timezone_set('PRC');
            if($order->status == 1)return;

            $order->status = 1;
            $order->out_trade_no = $out_trade_no;
            $order->save();

            $this->incBalance($order->amount,'recharge',$order->id,'充值');

            $betFlowRate = Config::getByName('betFlowRate');
            $audit = $betFlowRate * $order->amount;
            $this->incAuditFlow($audit);

            event('user.recharge',[$this,$order]);
        });
        
    }
}
