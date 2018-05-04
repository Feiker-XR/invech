<?php

namespace app\v1\controller;
use app\v1\Base;
use app\v1\Login;

class pay extends Login{
    
    public function companycode(){
        $gid = session('gid') ? session('gid') : 1 ;
        $groups = db('huikuan_bank')->where('useable',1)->group('code')->where('card_group',$gid)->field('code')->select();
        foreach($groups as &$group){
            $group['channels'] =  db('huikuan_bank')->where('useable',1)->where('code',$group['code'])->where('card_group',$gid)->select();
        }
        return ['status'=>0,'msg'=>'','data'=>$groups];
    }

    public function hk_money(){
        date_default_timezone_set('PRC');

        $param = $this->request->param();

        try{
            db()->startTrans();
            $assets = $this->user['money'];
            $money = $param['v_amount'];
            $bank = $param['IntoBank'];
            $date = $param['cn_date'];
            $date1 = $date;
            $manner = $param['InType'];
            $address = $param['v_site'];
            if($manner == '网银转账'){
                $manner .= ' 持卡人姓名'.$param['v_Name'];
            }
            if($manner == "0"){
                $manner = $param['IntoType'];
            }
            $tmpdate = date("Y-m-d H:i:s");

            $data['assets'] = $assets;
            $data['money'] = $money;
            $data['bank'] = $bank;
            $data['date'] = $date;
            $data['manner'] = $manner;
            $data['address'] = $address;
            $data['adddate'] = $tmpdate;
            $data['status'] = 0;
            $data['uid'] = $this->uid;
            $data['lsh'] = $this->user['username'].'_'.date("YmdHis");
            $data['balance'] = $assets;

            db('huikuan')->insert($data);
            db()->commit();

            return ['status'=>0,'msg'=>"恭喜您，汇款信息提交成功。我们将尽快审核，谢谢您对我们的支持。",'data'=>''];
            
        }catch(\think\Exception $e){
            db()->rollback();
            return ['status'=>1,'msg'=>'系统错误:'.$e->getMessage().',您提交的转账信息失败!','data'=>''];
            $this->error('系统错误:'.$e->getMessage().',您提交的转账信息失败!');
        }

    }

    /*
     * 手机站所有支付的所有线路,ajax
     */
    public function appcode(){

        $set = db('vc_set')->where("setclass = 1 and status = 0")->order("sort")->find();//db中只有一种手机分类名为 手机APP

        $setconfigs = db('vc_set_config')->where('set_id',$set['id'])->field('id,name,code')->select();

        foreach($setconfigs as &$sc){
            $thirdcodes = db('vc_thirdcode')->where('set_configid',$sc['id'])
            ->where('status',0)->order('thirdid')->field('thirdid,min,max')->select();  

            foreach ($thirdcodes as &$code){
                $code['name'] = "线路".$this->numToWord($code['thirdid']);
                $code['min'] = $code['min'];
                $code['max'] = $code['max'];
            }
            
            $sc['channels'] = $thirdcodes;
        }

        return ['status'=>0,'msg'=>'','data'=>$setconfigs,];
    }

    private function numToWord($num)
    {
        $chiNum = array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九');
        $chiUni = array('','十', '百', '千', '万', '亿', '十', '百', '千');
        
        $chiStr = '';
        
        $num_str = (string)$num;
        
        $count = strlen($num_str);
        $last_flag = true; //上一个 是否为0
        $zero_flag = true; //是否第一个
        $temp_num = null; //临时数字
        
        $chiStr = '';//拼接结果
        if ($count == 2) {//两位数
            $temp_num = $num_str[0];
            $chiStr = $temp_num == 1 ? $chiUni[1] : $chiNum[$temp_num].$chiUni[1];
            $temp_num = $num_str[1];
            $chiStr .= $temp_num == 0 ? '' : $chiNum[$temp_num];
        }else if($count > 2){
            $index = 0;
            for ($i=$count-1; $i >= 0 ; $i--) {
                $temp_num = $num_str[$i];
                if ($temp_num == 0) {
                    if (!$zero_flag && !$last_flag ) {
                        $chiStr = $chiNum[$temp_num]. $chiStr;
                        $last_flag = true;
                    }
                }else{
                    $chiStr = $chiNum[$temp_num].$chiUni[$index%9] .$chiStr;
                    
                    $zero_flag = false;
                    $last_flag = false;
                }
                $index ++;
            }
        }else{
            $chiStr = $chiNum[$num_str[0]];
        }
        return $chiStr;
    }
    
    /*
     * 充值处理
    */
    public function pay(){

        date_default_timezone_set('PRC');
		//使用k_user,需要验证用户名是否存在
		$uid  = session('uid') ? session('uid') : 1;
		$user = db('k_user')->where('uid',$uid)->find();
        $transamt = input("coin") ? input("coin") :0 ;

        $scid = input("scid/d");
        $thirdid = input("thirdid/d");

        if(!$scid){
            return ['status'=>1,'msg'=>'scid参数不能为空!'];
        }
        $sc = db('vc_set_config')->where('id',$scid)->find();
        if(!$sc){
            return ['status'=>1,'msg'=>'scid参数不合法!'];
        }

        if(!$thirdid){
            return ['status'=>1,'msg'=>'thirdid参数不能为空!'];
        }
        $thirdpay = db('vc_thirdpay')->where('id',$thirdid)->find();
        if(!$thirdpay){
            return ['status'=>1,'msg'=>'thirdid参数不合法!'];
        }

        $thirdcode = db('vc_thirdcode')
        ->where(['set_configid'=>$scid,'thirdid'=>$thirdid,])->find();

        if(!$thirdcode){
            return ['status'=>1,'msg'=>'找不到对应支付渠道!'];
        }

		if($transamt<$thirdcode['min']){
			$msg = '参数错误:不能低于最低充值金额:'.$thirdcode['min'].'元';
			return ['status'=>1,'msg'=>$msg];
		}
		if($transamt>$thirdcode['max']){
			$msg = '参数错误:不能高于最高充值金额:'.$thirdcode['max'].'元';
			return ['status'=>1,'msg'=>$msg];
		}
        if(/*is_int($transamt)&&*/1==$thirdcode['money_decimal']){
            $point = rand(1, 99);
            $transamt += $point/100;
        }

//k_money表uid,m_value,m_value1,m_order,status,m_make_time,balance(余额),q_qian(充值前),h_qian(充值后)
//两张订单表,支付成功后,k_money中添加一条status=ok的记录

        $pay = $thirdpay['type'];
        $payway = '\\app\\apipay\\' . $pay; 
        $payer = new $payway (); 

        //"{"id":"1","setid":"1","set_configid":"1","thirdid":"1","code":"992","min":"20","max":"5000","add_time":"1496899758","update_time":null,"name":"线路一","setconfigcode":"ALIPAY","type":"lbpay"}"
        //"code":"992"渠道不放入订单表,进入参数,
        //setconfigcode 即 sscode,bankcode 放入订单表,
        $orderid = $payer->orderno();

		$order = [
				'order_id' => $orderid,
		        'uid'       => $uid,
				'user_name' => $user['username'],
				'order_money' => $transamt,
				'order_time' => time(),
				'order_state' => 0,
				'state' => 0,		 
				'pay_type' => $sc['code'],	
				'pay_api' => $thirdpay['name'],
				'pay_order' => '',   //待更新
				];
		db('vc_order')->insert($order);

		$params = [
			'pid'=>$thirdpay['pid'],
			'pkey'=>$thirdpay['pkey'],
			'purl'=>$thirdpay['purl'],
			'hrefbackurl'=>$thirdpay['hrefbackurl'],
			'callbackurl'=>$thirdpay['callbackurl'],
			'queryurl'=>$thirdpay['queryurl'],
            'seckey'=>$thirdpay['seckey'],
            'pubkey'=>$thirdpay['pubkey'], 
            'prikey'=>$thirdpay['prikey'],              
			'tcode'=>$thirdcode['code'],
			'order_id'=>$order['order_id'],
			'order_money'=>$order['order_money'],
			'pay_type'=>$order['pay_type'],
			];	
		$payer->params($params);
        return $payer->pay();
    }

    public function pay_content($order_id){
        $order = db('vc_order')->where('order_id',$order_id)->find();
        echo $order['pay_content']? $order['pay_content']  : '';
    }

    public function get_money(){
        
        $user = db('k_user')->where('uid',$this->uid)->find();
        if($this->user['pay_card']=='' || $this->user['pay_num']=='' || $this->user['pay_address']==''){
            $msg = "请先设置您的财务资料在进行操作";
            return ['status'=>1,'msg'=>$msg,'data'=>null,];
        }
        if($_POST){
            

            $payvalue = trim(doubleval($_POST["pay_value"]));
            db()->startTrans();//开启事务
            
            if($user['money'] < $payvalue){
                db()->rollback();
                $msg = "取款金额不能大于账户余额!";
                return ['status'=>1,'msg'=>$msg,'data'=>null,];
            }
            $qkpwd = md5(trim($_POST['qk_pwd']));
            if($qkpwd!=$user['qk_pwd']){
                db()->rollback();
                $msg = "资金密码不正确!";
                return ['status'=>1,'msg'=>$msg,'data'=>null,];
            }
            //当天提款次数
            $date_s = date("Y-m-d")." 00:00:00";
            $date_e = date("Y-m-d")." 23:59:59";
            $where = ' uid = ' .$user['uid']. ' and status=2 and m_value<0 and m_make_time >'."'$date_s'".' and m_make_time <'."'$date_e'";     
            $count = db('k_money')->where($where)->count();//当天提款次数
            
            if($count>=3){
                db()->rollback();
                $msg = "您的本次提款申请失败，由于银行系统管制，每个帐号每天限制只能提款3次。";
                return ['status'=>1,'msg'=>$msg,'data'=>null,];
            }
            
            try {
                $pay_value =    0-$payvalue; //把金额置成带符号数字
                $order = date("YmdHis")."_".$user['username'];
                $value = $user['money'] - $payvalue;
                $data_user['money'] = $value;
                $data['uid'] = $user['uid'];
                $data['m_value'] = $pay_value;
                $data['status'] = 2;
                $data['m_order'] = $order;
                $data['pay_card'] = $user['pay_card'];
                $data['pay_num'] = $user['pay_num'];
                $data['pay_address'] = $user['pay_address'];
                $data['type'] = '900';
                $data['pay_name'] = $user['pay_name'];
                $data['about'] = '';
                $res = db('k_user')->where('uid',$user['uid'])->update($data_user);
                $sign = db('k_money')->insert($data);
                
                db()->commit();  //事务成功    
                $msg = "提款申请已经提交，等待财务人员给您转账。您可以到历史报表中查询您的取款状态！";
                return ['status'=>0,'msg'=>$msg,'data'=>null,];

            }catch(Exception $e){
                db()->rollback();  //数据回滚
                $msg = "由于网络堵塞，本次申请提款失败。请您稍候再试，或联系在线客服。";   
                return ['status'=>0,'msg'=>$msg,'data'=>null,];             

            }
        }
    }
}