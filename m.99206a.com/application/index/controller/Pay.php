<?php
namespace app\index\controller;
use app\index\Base;
use app\index\Login;
use think\Db;
class pay extends Base {    //如果继承Login会导致无法充值回调无法通知到notify（）
    
    /*
     * 充值中心
     * 表结构set支付方式,set_config通道,thirdcode中间表,thirdpay线路
    */
    public function index(){

        //$_SESSION = ["front" => [ "uid" => 4,"username" =>  "test001","gid" => 7,] ]
        /*
        $uid = session('uid');
        if($uid){           
            if(config('pay_use_alone')){
                //原支付中心没有前台用户表(无法登陆,没有uid这样的session成员),用户名提交后保存在订单中
            }
            $username = session('username');
            $this->assign('username',$username);  
        }
        */

        $username = session('username');
        $this->assign('username',$username); 
        return $this->fetch();
    }
    
    public function member(){
        $username = session('username');
        if(!session('username')){
            echo "<script type='text/javascript'>alert('请登录之后再进行充值!');window.parent.location='/';</script>";
            exit();
        }


        $gid = session('gid') ? session('gid') : 1 ;
        $huikuan = db('huikuan_bank')->where(['card_group'=>$gid,'type'=>'bank'])->find();

        $alipay = db('huikuan_bank')->where(['card_group'=>$gid,'type'=>"alipay"])->find();
        $wechat = db('huikuan_bank')->where(['card_group'=>$gid,'type'=>"wechat"])->find();
        $qq = db('huikuan_bank')->where(['card_group'=>$gid,'type'=>"qq"])->find();

        $alipay_line = $wechat_line = $qqpay_line = $jdpay_line = $unionpay_line = [];
        if($this->request->isMobile()){
            $v = db('vc_set')->where('name', '手机APP')->find();

            $rows = db('vc_set_config')->join('vc_thirdcode', 'vc_thirdcode.set_configid=vc_set_config.id')->field('*,vc_set_config.code setconfigcode')->where(['setid' => $v['id'], 'status' => 0,'name'=>['like', '%支付宝%']])->select();

            foreach ($rows as $key=>$val) {
                $third = db('vc_thirdpay')->where(['id' => $val['thirdid']])->find();
                if(!$third){
                    continue;
                }
                $val['type'] = $third['type'];
                $val['name'] = "线路" . $this->numToWord($third['id']);
                $alipay_line[] = $val;
            }

            $rows = db('vc_set_config')->join('vc_thirdcode', 'vc_thirdcode.set_configid=vc_set_config.id')->field('*,vc_set_config.code setconfigcode')->where(['setid' => $v['id'], 'status' => 0,'name'=>['like', '%微信%']])->select();
            //$wechat_line = db('vc_thirdcode')->join('vc_thirdpay','vc_thirdcode.thirdid=vc_thirdpay.id')->where(['status'=>0])->select();
            foreach ($rows as $key=>$val) {
                $third = db('vc_thirdpay')->where(['id' => $val['thirdid']])->find();
                if(!$third){
                    continue;
                }
                $val['type'] = $third['type'];
                $val['name'] = "线路" . $this->numToWord($third['id']);
                $wechat_line[] = $val;
            }

            $rows = db('vc_set_config')->join('vc_thirdcode', 'vc_thirdcode.set_configid=vc_set_config.id')->field('*,vc_set_config.code setconfigcode')->where(['setid' => $v['id'], 'status' => 0,'name'=>['like', '%QQ%']])->select();
            foreach ($rows as $key=>$val) {
                $third = db('vc_thirdpay')->where(['id' => $val['thirdid']])->find();
                if(!$third){
                    continue;
                }
                $val['type'] = $third['type'];
                $val['name'] = "线路" . $this->numToWord($third['id']);
                $qqpay_line[] = $val;
            }

            $rows = db('vc_set_config')->join('vc_thirdcode', 'vc_thirdcode.set_configid=vc_set_config.id')->field('*,vc_set_config.code setconfigcode')->where(['setid' => $v['id'], 'status' => 0,'name'=>['like', '%京东%']])->select();
            foreach ($rows as $key=>$val) {
                $third = db('vc_thirdpay')->where(['id' => $val['thirdid']])->find();
                if(!$third){
                    continue;
                }
                $val['type'] = $third['type'];
                $val['name'] = "线路" . $this->numToWord($third['id']);
                $jdpay_line[] = $val;
            }

            $rows = db('vc_set_config')->join('vc_thirdcode', 'vc_thirdcode.set_configid=vc_set_config.id')->field('*,vc_set_config.code setconfigcode')->where(['setid' => $v['id'], 'status' => 0,'name'=>['like', '%银联%']])->select();
            foreach ($rows as $key=>$val) {
                $third = db('vc_thirdpay')->where(['id' => $val['thirdid']])->find();
                if(!$third){
                    continue;
                }
                $val['type'] = $third['type'];
                $val['name'] = "线路" . $this->numToWord($third['id']);
                $unionpay_line[] = $val;
            }
        }else {
            $v = db('vc_set')->where('name', '网银')->find();
            $banks = db('vc_set_config')->where(['set_id' => $v['id']])->select();
            //根据thirdcode表结构,此查询条件可能返回多条记录,这里只取一条(一个set_configid对应多个code)

            $v = db('vc_set')->where('name', '支付宝')->find();
            $alipay_line = db('vc_thirdcode')->join('vc_thirdpay', 'vc_thirdcode.thirdid=vc_thirdpay.id')->where(['setid' => $v['id'], 'status' => 0])->select();
            foreach ($alipay_line as &$val) {
                $val['name'] = "线路" . $this->numToWord($val['id']);
                $setconfig = db('vc_set_config')->where(['id' => $val['set_configid']])->find();
                $val['setconfigcode'] = $setconfig['code'];
            }

            $v = db('vc_set')->where('name', '微信')->find();
            $wechat_line = db('vc_thirdcode')->join('vc_thirdpay', 'vc_thirdcode.thirdid=vc_thirdpay.id')->where(['setid' => $v['id'], 'status' => 0])->select();
            //$wechat_line = db('vc_thirdcode')->join('vc_thirdpay','vc_thirdcode.thirdid=vc_thirdpay.id')->where(['status'=>0])->select();
            //var_dump($wechat_line);die;
            foreach ($wechat_line as &$val) {
                $val['name'] = "线路" . $this->numToWord($val['id']);
                $setconfig = db('vc_set_config')->where(['id' => $val['set_configid']])->find();
                $val['setconfigcode'] = $setconfig['code'];
            }

            $v = db('vc_set')->where('name', 'QQ钱包')->find();
            $qqpay_line = db('vc_thirdcode')->join('vc_thirdpay', 'vc_thirdcode.thirdid=vc_thirdpay.id')->where(['setid' => $v['id'], 'status' => 0])->select();
            foreach ($qqpay_line as &$val) {
                $val['name'] = "线路" . $this->numToWord($val['id']);
                $setconfig = db('vc_set_config')->where(['id' => $val['set_configid']])->find();
                $val['setconfigcode'] = $setconfig['code'];
            }

            $v = db('vc_set')->where('name', '京东')->find();
            $jdpay_line = db('vc_thirdcode')->join('vc_thirdpay', 'vc_thirdcode.thirdid=vc_thirdpay.id')->where(['setid' => $v['id'], 'status' => 0])->select();
            foreach ($jdpay_line as &$val) {
                $val['name'] = "线路" . $this->numToWord($val['id']);
                $setconfig = db('vc_set_config')->where(['id' => $val['set_configid']])->find();
                $val['setconfigcode'] = $setconfig['code'];
            }

            $v = db('vc_set')->where('name', '银联支付')->find();
            $unionpay_line = db('vc_thirdcode')->join('vc_thirdpay', 'vc_thirdcode.thirdid=vc_thirdpay.id')->where(['setid' => $v['id'], 'status' => 0])->select();
            foreach ($unionpay_line as &$val) {
                $val['name'] = "线路" . $this->numToWord($val['id']);
                $setconfig = db('vc_set_config')->where(['id' => $val['set_configid']])->find();
                $val['setconfigcode'] = $setconfig['code'];
            }
            $this->assign('banks',$banks);
        }

        $this->assign('alipay_line',$alipay_line);
        $this->assign('wechat_line',$wechat_line);
        $this->assign('qqpay_line',$qqpay_line);
        $this->assign('jdpay_line',$jdpay_line);
        $this->assign('unionpay_line',$unionpay_line);
        $this->assign('huikuan',$huikuan);
        $this->assign('qq',$qq);
        $this->assign('wechat',$wechat);
        $this->assign('alipay',$alipay);
        $this->assign('username',$username);
        $this->assign('gid',session('gid'));
        return $this->fetch();
    }
    
    /*
     * 支付方式列表,ajax
    */
    public function open(){
        $set = db('vc_set')->where("setclass = 0 and status = 0")->order("sort")->select();
        $num = count($set);                
        //return json(['stat'=>0,'num'=>$num,'set' => $set,]);        
        return ['stat'=>0,'num'=>$num,'set' => $set,];
    }   

    /*
     * 支付方式列表,手机版
    */
    public function appopen(){
        $set = db('vc_set')->where("setclass = 1 and status = 0")->order("sort")->find();//db中只有一种手机分类名为 手机APP

        $setconfig = db('vc_set_config')->where('set_id',$set['id'])->select();

        $num = count($setconfig);
        return ['stat'=>0,'num'=>$num,'value' => $setconfig,];
    } 

    /*
     * 一种支付方式,ajax
     */
    public function get_set(){
        $setid = input('setid');
        $set = db('vc_set')->where(['id'=>$setid,])->find();
        return ['stat'=>0,'value' => $set,];
    }

    /*
     * 一种支付的所有线路,ajax
     */
    public function code(){
        $setid = input('setid');

        //判断通道数量
        $scnum = db('vc_set_config')->where(['set_id' => $setid])->count();
        
        if($scnum>1){
            $set_config = db('vc_set_config')->where(['set_id' => $setid])->select();
            //$set_config = $set_config->toArray();
    
            foreach ($set_config as $k=>$v){
                $thirdcode = db('vc_thirdcode')->where(['set_configid'=>$v['id'],'status'=>'0',])->find();
                //根据thirdcode表结构,此查询条件可能返回多条记录,这里只取一条(一个set_configid对应多个code)
                if($thirdcode){
                   // if($thirdcode['thirdid'] == '21' && Session('gid') != '5'){
                    //    continue;
                    //}
                    $result[$k]['id'] = $thirdcode['id'];
                    $result[$k]['setid'] = $thirdcode['setid'];
                    $result[$k]['set_configid'] = $thirdcode['set_configid'];
                    $result[$k]['thirdid'] = $thirdcode['thirdid'];
                    $result[$k]['code'] = $thirdcode['code'];
                    $result[$k]['min'] = $thirdcode['min'];
                    $result[$k]['max'] = $thirdcode['max'];
                    $result[$k]['add_time'] = $thirdcode['add_time'];
                    $result[$k]['update_time'] = $thirdcode['update_time'];
                    $result[$k]['status'] = $thirdcode['status'];
                    $setconfig = db('vc_set_config')->where(['id' => $thirdcode['set_configid']])->find();
                    $result[$k]['img'] = $setconfig['img'];
                    $result[$k]['cashier'] = $thirdcode['cashier'];
                }
            }
            $num = count($result);
            $result = array_merge($result);//重排数组下标
        }else {
            $thirdcode = db('vc_thirdcode')->where('setid = '.$setid.' and status = 0')->order('thirdid')->select();
            foreach ($thirdcode as $k=>$v){
                //if($v['thirdid'] == '21' && Session('gid') != '5'){
               //     continue;
               // }
                $result[$k]['id'] = $v['id'];
                $result[$k]['setid'] = $v['setid'];
                $result[$k]['set_configid'] = $v['set_configid'];
                $result[$k]['thirdid'] = $v['thirdid'];
                $result[$k]['code'] = $v['code'];
                $result[$k]['min'] = $v['min'];
                $result[$k]['max'] = $v['max'];
                $result[$k]['add_time'] = $v['add_time'];
                $result[$k]['update_time'] = $v['update_time'];
                if($v['thirdid']) $name = "线路".$this->numToWord($v['thirdid']);
                $result[$k]['name'] = $name;
                $setconfig = db('vc_set_config')->where(['id' => $v['set_configid']])->find();                
                $result[$k]['setconfigcode'] = $setconfig['code'];
                $thirdpay = db('vc_thirdpay')->where(['id' => $v['thirdid']])->find();
                $result[$k]['type'] = $thirdpay['type'];
                $result[$k]['cashier'] = $v['cashier'];
            }
            $num = count($result);
        }
        if(!$result){
            $data = [
                    'stat' => 1,
                    'msg'=>'您好，该支付方式正在维护中，请选择其它支付方式，或稍后访问！',
                ];
        }else {
            $data = [
                    'stat' => 0,
                    'num' => $num,
                    'scnum'=>$scnum,
                    'value'=>$result,
                ];
        }
        return $data;
    }

    /*
     * 一种支付的所有线路,ajax
     */
    public function appcode(){
        $scid = input('scid');
 
        $thirdcode = db('vc_thirdcode')->where('set_configid',$scid)
        ->where('status',0)->order('thirdid')->select();

        if($thirdcode){
            foreach ($thirdcode as $k=>$v){
                $result[$k]['id'] = $v['id'];
                $result[$k]['setid'] = $v['setid'];
                $result[$k]['set_configid'] = $v['set_configid'];
                $result[$k]['thirdid'] = $v['thirdid'];
                if($v['thirdid']) $name = "线路".$this->numToWord($v['thirdid']);
                $result[$k]['name'] = $name;
                $result[$k]['code'] = $v['code'];
                $result[$k]['min'] = $v['min'];
                $result[$k]['max'] = $v['max'];
                $result[$k]['add_time'] = $v['add_time'];
                $result[$k]['update_time'] = $v['update_time'];
                $result[$k]['status'] = $v['status'];
                $setconfig = db('vc_set_config')->where('id',$v['set_configid'])->find();
                $result[$k]['setconfigcode'] = $setconfig['code'];
                $thirdpay = db('vc_thirdpay')->where('id',$v['thirdid'])->find();
                $result[$k]['type'] = $thirdpay['type'];
                $result[$k]['cashier'] = $v['cashier'];
            }
            $num = count($result);
            return ['stat' => 0,'num' => $num,'value'=>$result,];
        }else{
            return ['stat' => 1,'msg'=>'您好，该支付方式正在维护中，请选择其它支付方式，或稍后访问！',];
        }
    }

    /*
     * (一种支付的)一种渠道的所有线路,ajax
     */
    function code_all(){
        $setconfigid = input('setconfigid');                
        $thirdcode = db('vc_thirdcode')->where('set_configid = '.$setconfigid.' and status = 0')->order('order','desc')->select();
        $result = [];
        foreach ($thirdcode as $k=>$v){
            $result[$k]['id'] = $v['id'];
            $result[$k]['setid'] = $v['setid'];
            $result[$k]['set_configid'] = $v['set_configid'];
            $result[$k]['thirdid'] = $v['thirdid'];
            $result[$k]['code'] = $v['code'];
            $result[$k]['max'] = $v['max'];
            $result[$k]['min'] = $v['min'];
            $result[$k]['status'] = $v['status'];
            $result[$k]['add_time'] = $v['add_time'];
            $result[$k]['update_time'] = $v['update_time'];                        $result[$k]['cashier'] = $v['cashier'];
            if($v['thirdid']) $name = "线路".$this->numToWord($v['thirdid']);
            $result[$k]['name'] = $name;
            $setconfig = db('vc_set_config')->where(['id' => $v['set_configid']])->find();
            $result[$k]['setconfigcode'] = $setconfig['code'];
            $thirdpay = db('vc_thirdpay')->where(['id' => $v['thirdid']])->find();            
            $result[$k]['type'] = $thirdpay['type'];
        }
        $num = count($result);
        if($thirdcode){
            $data = [
                    'stat' => 0,
                    'num' => $num,
                    'value'=>$result,
                ];
        }else {
            $data =[
                    'stat' => 1,
                    'msg'=>'您好，该支付方式正在维护中，请选择其它支付方式，或稍后访问！',
                ];
        }
        return $data;
    }

    private function numToWord($num)
    {
        if($num == '') $num = 0;
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
    *
    */
    private function msg_jump($msg,$url){
        return request()->isAjax()?['status'=>'error', 'msg'=>$msg, 'url'=>$url]:"<script>alert('$msg');window.location.href='$url';</script>";
    }

    /*
     * 查询订单是否已支付,用于扫码后自动跳转,
     status=1表示已支付;-1表示请求错误
    */
    public function orderPayed(){
        $orderid = input('orderid');
        if(!$orderid){
            return ['status'=>-1,'msg'=>'订单号不能为空!'];
        }
        $order = db('vc_order')->where('order_id',$orderid)->find();
        if(!$order){
            return ['status'=>-1,'msg'=>'订单不存在!'];
        }
        $status = $order['order_state'];//order_state=1支付,0未支付
        return ['status'=>$status];
    }

    /*
     * 充值处理
    */
    public function pay(){
        date_default_timezone_set('PRC');
		//使用k_user,需要验证用户名是否存在
		$uid = session('uid');
		if($uid){
		    $user = db('k_user')->where('uid',$uid)->find();
		    $username = $user['username'];
		}else{
		    $username = input('username');
		    //if(!ereg("^[0-9a-zA-Z]*$",$username)){
		    if(!preg_match("/^[0-9a-zA-Z]*$/",$username)){
		        return $this->msg_jump('会员帐号只能由数字、大小写字母组成!', url('index'));		        
		    }
		    if(config('pay_use_alone')){
		        $uid = 0;
		    }else{
		        $user = db('k_user')->where('username',$username)->find();
		        if(!$user){
		            return $this->msg_jump('用户名不存在!', url('member'));
		        }
		        $uid = $user['uid'];
		    }

		}

		$bankcode		=	input('sccode');//set_config.code
		//ALIPAY   支付宝
		//WECHAT   微信支付
		//BANK     手机网银
		//WAP      微信APP
		$thirdtype	=	input('thirdtype');//thirdpay.type
		$tcode		=	input('tcode');//thirdcode.code
		$thirdid	=	input('thirdid');//thirdpay.id
		$setconfigid = $scid 		=	input('scid');
        //$transamt = isset($_POST["coin"])? trim($_POST["coin"]):trim($_POST["money"]);
        //$transamt = isset($_POST["coin"])? trim($_POST["coin"]):0;
        $transamt = input("coin")??0;

		$thirdpay = db('vc_thirdpay')->where('id',$thirdid)->find();

		$thirdcode = db('vc_thirdcode')
		->where(['set_configid'=>$setconfigid,'thirdid'=>$thirdid,])->find();
		//var_dump($setconfigid,$thirdid,$thirdcode);die;

		if(/*is_int($transamt)&&*/1==$thirdcode['money_decimal']){
		    $point = rand(1, 99);
		    $transamt += $point/100;
		}
		
		if($transamt<$thirdcode['min']){
			$str = '参数错误:不能低于最低充值金额:'.$thirdcode['min'].'元';
			return request()->isAjax()?['status'=>'error', 'msg'=>$str]:"<script>alert('$str');window.history.go(-1);</script>";
		}
		if($transamt>$thirdcode['max']){
			$str = '参数错误:不能高于最高充值金额:'.$thirdcode['max'].'元';
			return request()->isAjax()?['status'=>'error', 'msg'=>$str]:"<script>alert('$str');window.history.go(-1);</script>";
		}

//k_money表uid,m_value,m_value1,m_order,status,m_make_time,balance(余额),q_qian(充值前),h_qian(充值后)
//两张订单表,支付成功后,k_money中添加一条status=ok的记录

        $pay = $thirdtype;
        $payway = '\\app\\pay\\' . $pay;
        if(!class_exists($payway)){
            if($transamt>$thirdcode['max']){
                $str = '参数错误:该支付通道不存在';
                return request()->isAjax()?['status'=>'error', 'msg'=>$str]:"<script>alert('$str');window.history.go(-1);</script>";
            }
        }
        $payer = new $payway (); 

        //"{"id":"1","setid":"1","set_configid":"1","thirdid":"1","code":"992","min":"20","max":"5000","add_time":"1496899758","update_time":null,"name":"线路一","setconfigcode":"ALIPAY","type":"lbpay"}"
        //"code":"992"渠道不放入订单表,进入参数,
        //setconfigcode 即 sscode,bankcode 放入订单表,
        $orderid = $payer->orderno();
		$order = [
				'order_id' => $orderid,
		        'uid'       => $uid,
				'user_name' => $username,
				'order_money' => $transamt,
				'order_time' => time(),
				'order_state' => 0,
				'state' => 0,		 
				'pay_type' => $bankcode,//通道的code		
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
			'tcode'=>$tcode,
			'order_id'=>$order['order_id'],
			'order_money'=>$order['order_money'],
			'pay_type'=>$order['pay_type'],

			];

		$payer->params($params);
        return $payer->pay();
    }
    
    /*
     * 异步通知总入口  pay/notify/thirdtype/$thirdtype
     * 原通知是多入口,在vc_thirdpay表中配置如下 
     * https://pay1.zf590.com/api/dlpay/callbackurl.php
     * https://pay1.zf590.com/api/dlpay/callbackurl.php
     */
    public function notify(){      
        file_put_contents(LOG_PATH.'/charge_callback_log.txt', http_build_query($_REQUEST)."\r\n",FILE_APPEND);
        $thirdtype	=	input('thirdtype');
        $pay = $thirdtype;
        $payway = '\\app\\pay\\' . $pay;
        $payer = new $payway (); 

        $params = db('vc_thirdpay')->where('type',$pay)->find();     
        $payer->params($params);

        if($payer->check_success()){
            $orderid = $payer->orderid();
            $transid = $payer->transid();
            $this->business($orderid,$transid); 
            $payer->success();
        }else{
            echo "验签失败!";
        }
    }


    //支付成功返回地址
    public function succ(){
        file_put_contents(LOG_PATH.'/charge_callback_log.txt', input('thirdtype').':'.http_build_query($_REQUEST)."\r\n",FILE_APPEND);

        $thirdtype	=	input('thirdtype');
        $pay = $thirdtype;
        $payway = '\\app\\pay\\' . $pay;
        $payer = new $payway ();

        $params = db('vc_thirdpay')->where('type',$pay)->find();
        $payer->params($params);

        if($payer->check_success()){
            $orderid = $payer->orderid();
            $transid = $payer->transid();
            $this->business($orderid,$transid);
            $userinfo = Db('k_user')->where('uid', session('uid'))->find();
            $this->success('充值成功，您的当前余额为：'.$userinfo['money'].'元','/');
        }else{
            $this->error('充值出现问题，请联系客服','/');
        }
    }
    
    /*
     * 业务流程
    */
    private function business($orderid,$transid=''){
        date_default_timezone_set('PRC');
        //原业务逻辑,修改订单表的order_state,pay_order字段
        if(config('pay_use_alone')){


            $orderid = input('orderid');
            db('vc_order')->where(['order_id'=>$orderid])
            ->update(['order_state' => 1,'pay_order' => $transid]);
            return;
        }
        
        //$orderid = input('orderid');
        //原order表的pay_order保存的是 商户订单号 和 $orderid相同,
        //现在改为pay_order保存支付订单号,由payer提供
        
        Db::startTrans();
        $order = Db::table('vc_order')->lock(true)->where('order_id','eq',$orderid)->find();
        //$order = db('vc_order')->lock(true)->where(['order_id'=>$orderid])->find();
        try{                        
            $rows = Db::table('vc_order')->where(['order_id'=>$orderid])->where('order_state','neq',1)
            ->update(['order_state' => 1,'pay_order' => $transid]);
           if($rows == 1){
               $user = Db::table('k_user')->where(['uid'=>$order['uid']])->find();
               
               //k_money表uid,m_value,m_value1,m_order,status,m_make_time,balance(余额),q_qian(充值前),h_qian(充值后)
               //两张订单表,支付成功后,k_money中添加一条status=ok的记录
               $orderinfo = db('k_money')->where(['m_order'=>$orderid])->find();
               if($orderinfo){
                   Db::rollback();
               }else{
                   $money_data = [
                       'uid'           =>  $order['uid'],
                       'm_value'       =>  $order['order_money'],
                       'm_value1'      =>  0,
                       'm_order'       =>  $orderid,//商户订单号
                       'status'        =>  1,
                       'm_make_time'   =>  date('Y-m-d H:i:s'),
                       'balance'       =>  $user['money']+$order['order_money'],
                       'q_qian'        =>  $user['money'],
                       'h_qian'        =>  $user['money']+$order['order_money'],
                       'type'          => '100',
                       'about'       => $order['pay_api'],
                   ];
                   db('k_money')->insert($money_data);
                   //添加用户账户余额
                   db('k_user')->where(['uid'=>$order['uid']])->setInc('money',$order['order_money']);
                   Db::commit();
                   $log_info = '支付成功且充值成功!订单号：' . $orderid. '订单金额：' . $order['order_money'];
                   sys_log($order['uid'], $log_info); 
               }
           }else{
               Db::rollback();
               //echo "订单已经支付成功!";
           }
        }catch (\Exception $e) {
            Db::rollback();
            $log_info = '支付成功但充值失败!订单号：' . $orderid. '订单金额：' . $order['order_money'];
            sys_log($order['uid'], $log_info); 
        }
    }
}