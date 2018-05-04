<?php
namespace app\index\controller;
use app\index\Login;
use app\index\Base;
use think\Db;
use think\Session;
use app\live\agGame;
use app\live\mgGame;
use app\live\bbingame;
use app\live\ptGame;
use app\live\sunbet;
use app\live\ptGamePlayer;
use app\live\oggame;
use think\Request;

class User extends Login{
    
    public function index(){
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	$Args1 = isset($_GET['Args1']) ? $_GET['Args1'] : 1;
    	$Args2 = isset($_GET['Args2']) ? $_GET['Args2'] : 0;
    	$Args1 = is_numeric($Args1) ? $Args1 : 1;
    	$Args2 = is_numeric($Args2) ? $Args2 : 0;
    	
    	$this->assign('Args1',$Args1);
    	$this->assign('Args2',$Args2);
    	$this->assign('user',$user);
        return $this->fetch('index');
    }
    
    public function home(){
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();

    	$this->assign('user',$user);    
    	return $this->fetch('home');
    }
    
    public function get_money(){ //申请提现
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	if($user['pay_card']=='' || $user['pay_num']=='' || $user['pay_address']==''){
    	    message("请先设置您的财务资料在进行操作","/user/Set_Card");
    	}
		if($_POST){
		    
            if(request()->isMobile()){
                $vlcodes = $_POST['vlcodes'] ?? '';
                if(!captcha_check($vlcodes, "mobile_get_money")){
                    message("验证码错误!");
                }
            }
			$payvalue = trim(doubleval($_POST["pay_value"]));
			Db::startTrans();//开启事务
			$user = Db::table('k_user')->lock(true)->where(array('uid'=>$uid))->find();
			if($user['money'] < $payvalue){
			    Db::rollback();
				message("取款金额不能大于账户余额!");
			}
			$qkpwd = md5(trim($_POST['qk_pwd']));
			if($qkpwd!=$user['qk_pwd']){
			    Db::rollback();
				message("资金密码不正确!");
			}
			//当天提款次数
			$date_s = date("Y-m-d")." 00:00:00";
			$date_e = date("Y-m-d")." 23:59:59";
			$where = ' uid = ' .$user['uid']. ' and status=2 and m_value<0 and m_make_time >'."'$date_s'".' and m_make_time <'."'$date_e'";		
			$count = Db::table('k_money')->where($where)->count();//当天提款次数
			
			if($count>=3){
			    Db::rollback();
				message("您的本次提款申请失败，由于银行系统管制，每个帐号每天限制只能提款3次。");
			}
			
			try {
				$pay_value =	0-$payvalue; //把金额置成带符号数字
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
				$res = Db::table('k_user')->where('uid','=',$user['uid'])->update($data_user);
				$sign = Db::table('k_money')->insert($data);
				
				Db::commit();  //事务成功    
				message("提款申请已经提交，等待财务人员给您转账。\\n您可以到历史报表中查询您的取款状态！","/user/data_t_money");
			}catch(\Exception $e){
				Db::rollback();  //数据回滚
				message("由于网络堵塞，本次申请提款失败。\\n请您稍候再试，或联系在线客服。");
			}
		}
		
    	$this->assign('user',$user); 
    	return $this->fetch('get_money');
    }
    
    public function set_card(){ //设置收款信息
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	if(isset($_POST['vlcodes'])){
    	    if(!captcha_check(input('vlcodes'))){
    	        $this->error('验证码错误!');
    	    }
    	}
    	
    	if($_POST){
    	    $paycard = trim(input('pay_card'));
    	    $paynum= trim(input('pay_num'));
    		if(!is_numeric($paynum)){
    			message("银行账号必须为数字");
    		}
    		if($this->request->isMobile()){
    		    $address_1 = trim(input('add1'));
    		    $address_2 = trim(input('add2'));
    		    $address_3 = trim(input('add3'));
    		    $address = $address_1.$address_2.$address_3;
    		    $moneypass = trim(input('qk_pwd'));
    		}else{
    		    $address_1 = trim(input('Address_1'));
    		    $address_2 = trim(input('Address_2'));
    		    $address_3 = trim(input('Address_3'));
    		    $address_4 = trim(input('Address_4'));
    		    $address = $address_1.$address_2.$address_3.$address_4;
    		    $moneypass = trim(input('MoneyPass'));
    		}
    		
    		
    		
    		if($user['qk_pwd']!=md5($moneypass)){
    			echo "<script>alert('资金密码错误');location.href='/user/set_card';</script>";exit();
    		}
     		$data = array(
    				'pay_card'=>$paycard,
    				'pay_num'=>$paynum,
    				'pay_address'=>$address,
    		);
    		$update = Db::table('k_user')->where('uid','=',$user['uid'])->update($data);
    		if($update==true){
    			echo "<script>alert('收款银行设置成功');location.href='/user/get_money';</script>";exit();
    		}else{
    			echo "<script>alert('收款银行设置失败');location.href='/user/userinfo';</script>";exit();
    		}
    	}
    	$this->assign('user',$user);  
    	return $this->fetch('set_card');
    }
    
    public function set_money(){ //账户充值
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	
    	$webpay = Db::table('web_pay')->where('ok','=','1')->select();
    	
    	$this->assign('webpay',$webpay);
    	$this->assign('user',$user);
    	return $this->fetch('set_money');
    }
    
    
    public function huikuan_new(){
        $cards = Db::table('huikuan_bank')->select();
        $list = array();
        foreach ($cards as $v){
            $list[$v['card_group']]['cards'][] = $v;
        }
        $bank = $list[Session('gid')]['cards'] ?? [];
        $this->assign('bank',$bank);
        return $this->fetch();
    }
    
    public function huikuan_form(){
        $id = $this->request->param('id');
        $gid = Session('gid');
        $info = Db::table('huikuan_bank') -> where('id','eq',$id)->where('card_group','eq',$gid)->find();
        $this->assign('info',$info);
        $cards = Db::table('huikuan_bank')->select();
        $list = array();
        foreach ($cards as $v){
            $list[$v['card_group']]['cards'][] = $v;
        }
        $bank = $list[Session('gid')]['cards'] ?? [];
        $this->assign('bank',$bank);
        return $this->fetch();
    }
    
    public function hk_money(){
        $cards = Db::table('huikuan_bank')->select();
        $list = array();
        foreach ($cards as $v){
            $list[$v['card_group']]['cards'][] = $v;
        }
        $bank = $list[Session('gid')]['cards'] ?? [];
        $this->assign('bank',$bank);
        return $this->fetch();
    }
    
    public function huikuan_2($id=0){
        $id = intval($id);
        $gid = Session('gid');
        $info = Db::table('huikuan_bank') -> where('id','eq',$id)->where('card_group','eq',$gid)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }
    
    public function hk_money_set(){
        date_default_timezone_set('PRC');
        $uid =Session('uid');
        $param = $this->request->param();
        if($param['into']){
            try{
                Db::startTrans();
                $assets = Db::table('k_user')->where('uid','eq',$uid)->field(['money'])->limit('1')->find();
                $money = $param['v_amount'];
                $bank = $param['IntoBank'];
                $date = $param['cn_date'];
                //$date1 = $date." ".$param["s_h"].":".$param["s_i"].":00";
                $manner = $param['InType'];
                $address = $param['v_site'];
                if($manner == '网银转账'){
                    $manner .= '<br/> 持卡人姓名'.$param['v_Name'];
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
                $data['uid'] = $uid;
                $data['lsh'] = Session('username').'_'.date("YmdHis");
                $data['balance'] = $assets;
                Db::table('huikuan')->insert($data);
                Db::commit();
                $this->success("恭喜您，汇款信息提交成功。我们将尽快审核，谢谢您对我们的支持。");
            }catch(\think\Exception $e){
                Db::rollback();
                $this->error('系统错误:'.$e->getMessage().',您提交的转账信息失败!');
            }
        }
    }

    public function userinfo(){ //额度转换

        date_default_timezone_set('PRC');
        $uid = session('uid');
        $user = db('k_user')->where('uid',$uid)->find();
        $userinfo = $user;

        //用户名
        $username  = session('username');
        $password = substr(md5(md5($username)),3,12);

        if (mb_substr($username,-3,3,'utf-8') != 'hga') {
            $temp_username = $username . 'hga';
        } else {
            $temp_username = $username;
        }
        $mg_username = $username.'@hga';

        if(request()->isGet()){
            //维护信息
            $agWeihu = $naWeihu = $mgWeihu = $bbinWeihu = $ptWeihu = $ogWeihu = $ntWeihu = $sbWeihu = 0;
            $fengpans = db('k_fengpan')->select();
            foreach($fengpans as $fengpan){
                switch ($fengpan['name']){
                    case 'agzr':
                        $agWeihu = $fengpan['weihu'];
                    case 'nazr':
                        $naWeihu = $fengpan['weihu'];
                    case 'mgzr':
                        $mgWeihu = $fengpan['weihu'];
                    case 'bbzr':
                        $bbinWeihu = $fengpan['weihu'];
                    case 'ptzr':
                        $ptWeihu = $fengpan['weihu'];
                    case 'ogzr':
                        $ogWeihu = $fengpan['weihu'];
                    case 'ntzr':
                        $ntWeihu = $fengpan['weihu'];
                }
            }
            $this->assign('agWeihu',$agWeihu);
            $this->assign('naWeihu',$naWeihu);
            $this->assign('mgWeihu',$mgWeihu);
            $this->assign('bbinWeihu',$bbinWeihu);
            $this->assign('ptWeihu',$ptWeihu);
            $this->assign('ogWeihu',$ogWeihu);
            $this->assign('ntWeihu',$ntWeihu);
            $this->assign('sbWeihu',$sbWeihu);//表中没有申博的

            $this->assign('temp_username',$temp_username);
            $this->assign('mg_username',$mg_username);

            $this->assign('user',$user);
            $this->assign('userinfo',$userinfo);

            if(request()->isMobile()){
                // $balance_ag = $this->balance('agzr');
                // $balance_bb = $this->balance('bbzr');
                //$balance_og = $this->balance('ogzr');
                //$balance_ag = $this->balance('agzr');
                //$balance_mg = $this->balance('mgzr');//代处理
                //$balance_sb = $this->balance('sbzr');//处理中
                //$balance_pt = $this->balance('ptzr');
                $balance_bb = 0;//$balance_bb['money'];
                $balance_og = 0;//$balance_og['money'];
                $balance_ag = 0;//$balance_ag['money'];
                $balance_mg = 0;//$balance_mg['money'];
                //$balance_sb = $balance_sb['money'];
                $balance_pt = 0;//$balance_pt['money'];
                /*
                $balance_bb = '0.00';
                $balance_og = '0.00';
                $balance_ag = '0.00';
                */
                //$balance_mg = '0.00';
                $balance_sb = '0.00';
                //$balance_pt = '0.00';

                $this->assign('balance_bb',$balance_bb);
                $this->assign('balance_og',$balance_og);
                $this->assign('balance_ag',$balance_ag);
                $this->assign('balance_mg',$balance_mg);
                $this->assign('balance_sb',$balance_sb);
                $this->assign('balance_pt',$balance_pt);
            }
            return $this->fetch();
        }else{

            $zz_type=input("zz_type/d");
            $zz_money=input("zz_money/d");
            if($zz_money<1)
            {
                message("转账金额最低为：1元，请重新输入");
            }

            $t_type="d";
            switch ($zz_type)
            {
                case 12:
                case 111:
                case 13:
                case 14:
                case 19:
                case 17:
                case 16:
                case 77:
                    $transfer_type = "IN";
                    break;
                case 22:
                case 211:
                case 23:
                case 24:
                case 29:
                case 27:
                case 26:
                case 87:
                    $transfer_type = "OUT";
                    break;
                default:
                    message("转账类型非法！");
                    return false;
                    break;
            }

            if (14 == $zz_type || $zz_type == 24) {
                $type="NA";
            } else if (12 == $zz_type || $zz_type == 22) {
                $type="AG";
            } else if (18 == $zz_type || $zz_type == 28) {
                $type="NT";
            } else if (111 == $zz_type || $zz_type == 211) {
                $type="BBIN";
            } else if (13 == $zz_type || $zz_type == 23) {
                $type="MG";
            }  else if (17 == $zz_type || $zz_type == 27) {
                $type="OG";
            }else if (16 == $zz_type || $zz_type == 26) {
                $type="sbet";
            }else if (77 == $zz_type || $zz_type == 87) {
                $type="PT";
            }else {
                message("类型错误！");
                return false;
            }
            // 检查 AG,MG,BB,NA总的余额， 转入的时候， 是要扣除总余额的
            $targetTmp = strtoupper($type);
            if ($targetTmp == 'BBIN') {
                $targetTmp = 'BB';
            }

            if ($transfer_type=="IN") {
                // 检查 AG,MG,BB,NA总的余额， 转入的时候， 是要扣除总余额的
                $web_zzzzz = db('web_zzzzz')->where('name',$targetTmp)->find();
                $muqian = $web_zzzzz['muqian'];
                if ($muqian < $zz_money) {
                    message("您申请转入的真人娱乐额度不足请联系客服！");
                }

                Db::startTrans();
                try {
                    db('web_zzzzz')->where('name', $targetTmp)->setInc('xiaofei', $zz_money);
                    db('web_zzzzz')->where('name', $targetTmp)->setDec('muqian', $zz_money);
                    $status = 1;
                    $about = "转入" . $targetTmp;
                    $order = date("YmdHis") . "_" . session('username');

                    $insert_data = [
                        'uid' => $uid,
                        'm_value' => $zz_money,
                        'status' => $status,
                        'm_order' => $order,
                        'pay_card' => $userinfo["pay_card"],
                        'pay_num' => $userinfo["pay_num"],
                        'pay_address' => $userinfo["pay_address"],
                        'pay_name' => $userinfo['pay_name'],
                        'about' => $about,
                        'assets' => $userinfo["money"],
                        'balance' => $userinfo["money"] + $zz_money,
                        'type' => input('zz_type'),
                    ];
                    db('k_money')->insert($insert_data);

                    $userinfo = db('k_user')->where('uid', $uid)->find();

                    if ($userinfo['money'] < $zz_money) {     //在改钱最近的地方查看余额是否充足,避免并发访问导致刚刚查询时余额充足，执行到这步时已经被改掉
                        db::rollback();
                        message("体育/彩票额度不足！");
                    }
                    db('k_user')->where('uid', $uid)->setDec('money', $zz_money);

                    $billno = '';
                    $inStatus = 0;
                    //NA
                    if(14 == $zz_type){
                        /*
                        $userParms = array("userName"=>$temp_username,"amount"=>$zz_money);
                        $inStatus = NAUtil::na_palyer_trans_deposit($userParms);
                        $type="NA";
                        */
                        message("NA平台接口开发中！");
                    }
                    //AG
                    else if(12 == $zz_type){
                        $type="AG";
                        $billno = "HGA{$uid}AG".time().rand(10,99);

                        $result = agGame::regUser($temp_username);
                        if(!$result['Code']){
                            $trans_result = agGame::depositToAG($temp_username,$zz_money,$billno);
                            if($trans_result == true){
                                $inStatus = 1;
                            }
                        }

                        //$inStatus = 1;
                    }else if(17 == $zz_type){ //og
                        $type="OG";
                        $billno ='jinpai'. rand(10,9999).date("mdHis");
                        if(strval(oggame::CheckAndCreateAccount($temp_username, 'oga123456'))){
                            $trans_result = oggame::TransferCredit($temp_username,"oga123456",$billno,'IN',$zz_money);
                            if($trans_result === '1'){
                                $inStatus = 1;
                            }elseif($trans_result == '2'){
                                oggame::ConfirmTransferCredit($temp_username,"oga123456",$billno,'IN',$zz_money);
                                $inStatus = 1;
                            }
                        }
                    }
                    //NT
                    else if(18 == $zz_type){
                        /*
                        $type="NT";
                        $inParms = array("userID"=>$temp_username,"amount"=>$zz_money,"transactionID"=>$billno);
                        $trans_result = NASlotUtil::accountCredit($inParms);
                        if($trans_result == 200){
                            $inStatus = 1;
                        }
                        */
                        message("NT平台接口开发中！");
                    }//BBIN
                    else if(16 == $zz_type){ //sbet

                        $type="sbet";
                        $billno =$username."-addmoney-".time();
                        //if(time() - session('sunbetTokenTime') > 3600 || session('authtoken') == ""){
                        if( (time() - session('sunbetTokenTime')?:0) > 3600){
                            $token = sunbet::getToken();
                            if($token){
                                session('sunbetTokenTime',time());
                                session('sunbetToken',$token);
                                $authtoken = sunbet::authorize(session('sunbetToken'),$temp_username);
                                session('authtoken',$authtoken);
                            }else{
                                message('获取token失败');
                            }
                        }
                        $trans_result = sunbet::addMoney(session('sunbetToken'), $zz_money,$temp_username);
                        //{"bal":70.00,"cur":"RMB","txid":"test001jsa-addmoney-1502270331","ptxid":"a2275094-e37c-e711-80be-0050568c10c1","dup":false}"
                        $trans_result = json_decode($trans_result);
                        if($trans_result && !@$trans_result->err){
                            $billno = $trans_result->txid;
                            $inStatus = 1;
                        }
                    }else if(111 == $zz_type){
                        $billno = $uid.time();
                        bbingame::CreateMember($temp_username,$password);
                        $type="BBIN";
                        $trans_result = bbingame::Transfer($temp_username,$zz_money,$billno,$act = 'IN');
                        if($trans_result === true){
                            $inStatus = 1;
                        }

                    }//MG
                    else if(13 == $zz_type){
                        $type="MG";
                        //$trans_result = $mgapi->deposit($mg_username,$zz_money,$qGuid);
                        $mg_username =  $username.'@hga';
                        $billno ='mg'. rand(10,9999).date("mdHis");//订单号杜撰
                        $account_id = '';//'小罗说有固定生成规则'
                        //$account_ext_ref = 'lisi5787@hga';
                        $account_ext_ref = $mg_username;
                        //$auth = 'Basic R2FtaW5nTWFzdGVyMUNOWV9hdXRoOjlGSE9SUWRHVFp3cURYRkBeaVpeS1JNZ1U=';
                        $auth = mgGame::authenticate();
                        $auth = $auth['body']['access_token'];
                        $trans_result = mgGame::createTranscation($auth,$zz_money,$billno,0,$account_ext_ref, $account_id);

                        if($trans_result['success'] == true){
                            $inStatus = 1;
                        }
                        /*
                        if($trans_result['Code'] == 6){
                            $mgguid = $mgapi->getGUID();
                            $qGuid =$mgguid['Data'];
                            $guids = array(time(),$qGuid);
                            $_SESSION["userGUID"]= $guids;
                        }
                        */
                    }else if(77 == $zz_type){
                        //PT
                        $type="PT";
                        $billno ='pt'. rand(10,9999).date("mdHis");//订单号杜撰
                        $ret = ptGamePlayer::create($temp_username);
                        $ret = ptGamePlayer::deposit($temp_username,$zz_money,$billno);
                        if(isset($ret['result']) && isset($ret['result']['result']) && $ret['result']['result'] == 'Deposit OK'){
                            $inStatus = 1;
                        }else{
                            message($ret["errorcode"].$ret["error"]);
                        }
                    }else{
                        Db::rollback();
                        message("转账类型错误");
                    }

                    if($inStatus !== 1){
                        Db::rollback();
                        message("转账失败，请联系客服！");
                    }

                    $new_money = $user['money'] - abs($zz_money);
                    $data = array(
                        'uid' => $uid,
                        'username' => $username,
                        'old_money' => $user['money'],
                        'amount' => $zz_money,
                        'new_money' => $new_money,
                        'type' => $zz_type,
                        'info' => '转入' . $targetTmp,
                        'actionTime' => time(),
                        'result' => '转账成功',
                        'billNO' => $billno,
                        'status' => 1,
                    );
                    db('zz_info')->insert($data);
                    /*$moneyB = $moneyA - $zz_money; //转账后额度
                    //写入转账记录
                    $zr_username = $temp_username;
                    $zz_time = date("Y-m-d H:i:s");

                    $data = [
                        'live_type' => $type,
                        'zz_type' => $zz_type,
                        'uid' => $uid,
                        'username' => $username,
                        'zr_username' => $zr_username,
                        'zz_money' => $zz_money,
                        'ok' => 1,
                        'result' => '转账成功',
                        'zz_num' => 0,
                        'zz_time' => $zz_time,
                        'billno' => $billno,
                        'moneyA' => $moneyA,
                        'moneyB' => $moneyB,
                    ];
            db('ag_zhenren_zz')->insert($data);*/
                    //往AG真人转账表中添加记录不合理,这里自行注释掉;
                }catch (\Exception $e){
                    Db::rollback();
                    message("转账失败，请检查体育/彩票额度是否充足或联系客服");
                }
                Db::commit();
                message("转账成功,转账金额为".intval($zz_money));
            }elseif($transfer_type=="OUT"){
                Db::startTrans();
                try {
                    db('web_zzzzz')->where('name', $targetTmp)->setDec('xiaofei', $zz_money);
                    db('web_zzzzz')->where('name', $targetTmp)->setInc('muqian', $zz_money);

                    $status = 1;
                    $about = $targetTmp . "转出";
                    $order = date("YmdHis") . "_" . $user['username'];

                    $insert_data = array(
                        'uid' => $uid,
                        'm_value' => $zz_money,
                        'status' => $status,
                        'm_order' => $order,
                        'pay_card' => $userinfo["pay_card"],
                        'pay_num' => $userinfo["pay_num"],
                        'pay_address' => $userinfo["pay_address"],
                        'pay_name' => $userinfo['pay_name'],
                        'about' => $about,
                        'assets' => $userinfo["money"],
                        'balance' => $userinfo["money"] + $zz_money,
                        'type' => input('zz_type'),
                    );
                    db('k_money')->insert($insert_data);

                    db('k_user')->where('uid', $uid)->setInc('money', $zz_money);
                    $outStatus = 0;
                    $billno = '';
                    //NA
                    if (24 == $zz_type) {
                        /*
                        $userParms = array("userName"=>$temp_username,"amount"=>$zz_money);
                        $outStatus = NAUtil::na_palyer_trans_withdrawal($userParms);
                        $type="NA";
                        */
                        message('NA平台接口开发中！');
                    } //AG
                    else if (22 == $zz_type) {
                        $type = "AG";
                        $billno = "HGA{$uid}AG" . time() . rand(10, 99);
                        $result = agGame::regUser($temp_username);
                        if (!$result['Code']) {
                            $trans_result = agGame::AGToWithdrawal($temp_username, $zz_money, $billno);
                            if ($trans_result == '1') {
                                $outStatus = 1;
                            }
                        }
                    } else if (26 == $zz_type) {
                        $type = "sbet";
                        //if(time() - session('sunbetTokenTime') > 3600 || session('authtoken') == ""){
                        if ((time() - session('sunbetTokenTime') ?: 0) > 3600) {
                            $token = sunbet::getToken();
                            if ($token) {
                                session('sunbetTokenTime', time());
                                session('sunbetToken', $token);
                                $authtoken = sunbet::authorize(session('sunbetToken'), $temp_username);
                                session('authtoken', $authtoken);
                            } else {
                                message('获取token失败');
                            }
                        }
                        $trans_result = sunbet::reduceMoney(session('sunbetToken'), $zz_money, $temp_username);
                        $trans_result = json_decode($trans_result);
                        if ($trans_result && !@$trans_result->err) {
                            $billno = $billNO = $trans_result->txid;
                            $outStatus = 1;
                        }
                    } else if (27 == $zz_type) { //og
                        /*
                        $type="OG";
                        $billNO = $billno ='jinpai'. rand(10,9999).date("mdHis");
                        $trans_result = oggame::TransferCredit($temp_username,"oga123456",$billno,'OUT',$zz_money);
                        if($trans_result == '1'){
                            $outStatus = 1;
                        }
                        */
                        $type = "OG";
                        $billno = $billno = 'jinpai' . rand(10, 9999) . date("mdHis");
                        if (strval(oggame::CheckAndCreateAccount($temp_username, 'oga123456'))) {
                            $trans_result = oggame::TransferCredit($temp_username, "oga123456", $billno, 'OUT', $zz_money);
                            if ($trans_result === '1') {
                                $outStatus = 1;
                            } elseif ($trans_result === '2') {
                                oggame::ConfirmTransferCredit($temp_username, "oga123456", $billno, 'OUT', $zz_money);
                                $outStatus = 1;
                            }
                        }
                    }//NT
                    else if (28 == $zz_type) {
                        /*
                        $type="NT";
                        $outParms = array("userID"=>$temp_username,"amount"=>$zz_money,"transactionID"=>$billno);
                        $trans_result = NASlotUtil::accountDebit($outParms);
                        if($trans_result == 200){
                            $outStatus = 1;
                        }
                        */
                        message('NT平台接口开发中!');
                    }//BBIN
                    else if (211 == $zz_type) {
                        bbinGame::CreateMember($temp_username, $password);
                        $type = "BBIN";
                        $billno = '0' . $uid . time();
                        //$trans_result = $bbapi->withdrawal($temp_username,$zz_money,$billno);
                        $trans_result = bbingame::Transfer($temp_username, $zz_money, $billno, $act = 'OUT');
                        if ($trans_result == true) {
                            $outStatus = 1;
                        }

                    } //MG
                    else if (23 == $zz_type) {
                        $type = "MG";
                        $billno = 'mg' . rand(10, 9999) . date("mdHis");//订单号杜撰
                        $account_id = '';//'小罗说有固定生成规则'
                        //$account_ext_ref = 'lisi5787@hga';
                        $mg_username = $username . '@hga';
                        $account_ext_ref = $mg_username;
                        //$auth = 'Basic R2FtaW5nTWFzdGVyMUNOWV9hdXRoOjlGSE9SUWRHVFp3cURYRkBeaVpeS1JNZ1U=';
                        $auth = mgGame::authenticate();
                        $auth = $auth['body']['access_token'];
                        $trans_result = mgGame::createTranscation($auth, $zz_money, $billno, 1, $account_ext_ref, $account_id);

                        if ($trans_result['success'] == true) {
                            $outStatus = 1;
                        }
                    } else if (87 == $zz_type) {
                        //PT
                        $type = "PT";
                        $billno = 'pt' . rand(10, 9999) . date("mdHis");//订单号杜撰
                        $ret = ptGamePlayer::create($temp_username);
                        $ret = ptGamePlayer::withdraw($temp_username, $zz_money, $billno);
                        if (isset($ret['result']) && isset($ret['result']['result']) && $ret['result']['result'] == 'Withdraw OK') {
                            $outStatus = 1;
                        } else {
                            message($ret["errorcode"] . $ret["error"]);

                        }
                    }

                    if ($outStatus !== 1) {
                        Db::rollback();
                        message("真人点数不足，转账失败！");
                    }

                    $new_money = $user['money'] + $zz_money;
                    $data = array(
                        'uid' => $uid,
                        'username' => $username,
                        'old_money' => $user['money'],
                        'amount' => $zz_money,
                        'new_money' => $new_money,
                        'type' => $zz_type,
                        'info' => $targetTmp . '转出',
                        'actionTime' => time(),
                        'result' => '转账成功',
                        'billNO' => $billno,
                        'status' => 1,
                    );
                    db('zz_info')->insert($data);

                    /*$moneyB = $moneyA+$zz_money; //转账后额度
                    //写入转账记录

                    $zr_username = $temp_username;
                    $zz_time = date("Y-m-d H:i:s");

                    $data = [
                        'live_type' =>  'AG',
                        'zz_type'   =>  $zz_type,
                        'uid'       =>  $uid,
                        'username'  =>  $username,
                        'zr_username'   =>  $zr_username,
                        'zz_money'  =>  $zz_money,
                        'ok'        =>  1,
                        'result'    =>  '转账成功',
                        'zz_num'    =>  0,
                        'zz_time'   =>  $zz_time,
                        'billno'    =>  $billno,
                        'moneyA'    =>  $moneyA,
                        'moneyB'    =>  $moneyB,
                    ];
                    db('ag_zhenren_zz')->insert($data);*/
                }catch (\Exception $e){
                    Db::rollback();
                    message("转账失败，请联系客服");
                }
                Db::commit();
                message("转账成功,转账金额为".intval($zz_money));
            }
        }
    }
    
    public function balance($type){//ajax余额查询
        $uid = session('uid');
        $user = db('k_user')->where('uid',$uid)->find();
        $userinfo = $user;
        
        //用户名
        $username  = session('username');
        $password = substr(md5(md5($username)),3,12);
        
        if (mb_substr($username,-3,3,'utf-8') != 'hga') {
            $temp_username = $username . 'hga';
        } else {
            $temp_username = $username;
        }
        $mg_username = $username.'@hga';
        
        //$zrtype = input('type');
        $zrtype = $type;
        switch ($zrtype){
            case 'bbzr':
            	bbingame::CreateMember($temp_username,$password);
                $bbRet = bbingame::CheckUsrBalance($temp_username);
                //dump($bbRet);return $bbRet;
                if($bbRet === false){
                    return ['status' => 1,"msg"=>'未知，请联系管理员！'];
                }else{
                    $bb_balance = $bbRet;
                    return ['status' => 0, 'money'=>sprintf("%.2f",$bb_balance),'type' =>'bbzr'];
                }                
            case 'ogzr':
            	oggame::CheckAndCreateAccount($temp_username, 'oga123456');
                //查询OG金额
                if ($temp_username != '') {
                    $og_balance = oggame::GetBalance($temp_username,'oga123456'); //og::getUserInfo($user['og_username']);
                } else {
                    $og_balance ='0.00';
                }
                return ['status'=>0, 'money'=>sprintf("%.2f", $og_balance),'type'=>'ogzr'];
            case 'agzr':
            	$result = agGame::regUser($temp_username);
                //查询ag金额
                $ag_balance =agGame::inquireBalance($temp_username);
                //dump($ag_balance);return $ag_balance;                                
                return ['status' => 0,'money'=>sprintf("%.2f", $ag_balance),'type'=>'agzr'];
            case 'na':
                return ['money'=>sprintf("%.2f", '0.00'),'type'=>'nazr'];
                /*
                $userParms = array("userName"=>$temp_username);
                $na_balance = $isWeihu?'维护中': NAUtil::na_palyer_balance($userParms);
                if(''==$na_balance){
                    if($isWeihu){
                        $na_balance = "维护中";
                    }else{
                        $sql		=	"SELECT password as s FROM `k_user` where uid=$uid ";
                        $query		=	$mysqli->query($sql);
                        $rs			=	$query->fetch_array();
                        $userPwd	=	$rs['s'];
                        $userPwd = substr(md5($temp_username),16);
                        NAUtil::create_na_user(array("userName"=>$temp_username,"userPwd"=>$userPwd,"userType"=>"1"));
                        $na_balance = NAUtil::na_palyer_balance($userParms);
                    }
                    
                }
                echo json_encode(array('money'=>sprintf("%.2f", $na_balance),'type'=>'nazr'));
                break;
                */
            case 'mgzr':
                //$mgRet = $mgapi->balance($mg_username,$qGuid);
                $auth = mgGame::authenticate();
                $auth = $auth['body']['access_token'];
                //$account_ext_ref = 'lisi5787@hga';
                $account_ext_ref = $mg_username;
            	@mgGame::createMember($auth,$mg_username,$password,$account_ext_ref);
                $mgRet = @mgGame::getBalance($auth,$account_ext_ref);
                //dump($mgRet);return $mgRet;
                if($mgRet['success'] == false){
                    $msg = $mgRet['body']['code'] . $mgRet['body']['message'];
                    return ['status' => 1,'msg' => $msg];
                }else{
                    $mg_balance = $mgRet['body'][0]['credit_balance'];
                }
                return ['status' => 0 ,'money'=> sprintf("%.2f",$mg_balance),'type'=>'mgzr'];
            case 'sbzr':
                //if(time() - session('sunbetTokenTime') > 3600){
                if( (time() - session('sunbetTokenTime')?:0) > 3600){
                    $token = sunbet::getToken();
                    if($token){
                        session('sunbetTokenTime',time());
                        session('sunbetToken',$token);
                        $authtoken = sunbet::authorize(session('sunbetToken'),$temp_username);
                        session('authtoken',$authtoken);
                    }else{
                        return ['status'=>1,'msg'=>'获取token失败'];
                    }
                }
                if(session('?sunbetToken')){
                  	sunbet::create($temp_username,$password);
                    $sb_balance = sunbet::getBalance(session('sunbetToken'),$temp_username);
                    $sb_balance = $sb_balance->bal;
                }else{
                    $sb_balance = '0.00';
                }
                return ['status'=>0, 'money'=> sprintf("%.2f",$sb_balance),'type'=>'sbzr'];
            case 'ptzr':
                $ret = @ptGamePlayer::create($temp_username);
                $ret = @ptGamePlayer::balance($temp_username);
                if(@$ret['error']){
                    return ['status' => 1,"msg"=>$ret["errorcode"].$ret["error"],"money"=>0,];
                }else{
                    $pt_balance = $ret['result']['balance'];
                    return ['status' => 0, 'money'=>sprintf("%.2f",$pt_balance),'type' =>'ptzr'];
                }     
        }
    }
    
    public function data_t_money(){//提现记录
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	
    	$where = ' uid = "'.$user['uid'].'" and m_value < 0 ';
    	$num = Db::table('k_money')->where($where)->count();//总数
    	$money = Db::table('k_money')->where($where)->order('m_id desc')->paginate(15,$num);
    	$page = $money->render();
		
    	$this->assign('user',$user);
    	$this->assign('money',$money);
    	$this->assign('page',$page);
    	return $this->fetch('data_t_money');
    }
    
    public function data_money(){  //充值记录
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	
    	$where = ' uid = "'.$user['uid'].'" and m_value > 0 and (type = 1 or type = 100)';
    	//echo $where;
    	$num = Db::table('k_money')->where($where)->count();//总数
    	$money = Db::table('k_money')->where($where)->order('m_id desc')->paginate(15,$num);
    	//var_dump($money);exit;
    	$page = $money->render();
    	
    	$this->assign('user',$user);
    	$this->assign('money',$money);
    	$this->assign('page',$page);
    	return $this->fetch('data_money');
    }
    
    public function data_h_money(){ //汇款记录
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	
    	$num = Db::table('huikuan')->where(array('uid'=>$uid))->count();//总数
    	$huikuan = Db::table('huikuan')->where(array('uid'=>$uid))->order('id desc')->paginate(2,$num);
    	$page = $huikuan->render();
    	
    	$this->assign('huikuan',$huikuan);
    	$this->assign('user',$user);
    	$this->assign('page',$page);
    	return $this->fetch('data_h_money');
    }
    
    public function zr_data_money(){  //转换记录
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	
    	$num = Db::table('zz_info')->where(array('uid'=>$uid))->count();//总数
    	$zzinfo = Db::table('zz_info')->where(array('uid'=>$uid))->order('id desc')->paginate(2,$num);
    	$page = $zzinfo->render();
    	
    	$this->assign('zzinfo',$zzinfo);
    	$this->assign('user',$user);
    	$this->assign('page',$page);
    	return $this->fetch('zr_data_money');
    }
    
    public function password(){ //资金&登录 密码修改
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	if($_POST){
    		$type = $_POST['formtype'];
    		if($type=='login'){
    			$oldpass = trim($_POST['oldpass']);
    			$userinfo = Db::table('k_user')->where(array('uid'=>$user['uid'],'password'=>md5($oldpass)))->find();
    			if(!$userinfo){
    				message("原始登录密码不正确！");
    			}
    			$newpass = trim($_POST['newpass']);
    			$newpass2 = trim($_POST['newpass2']);
    			if($newpass!=$newpass2){
    				message("两次密码不一致！");
    			}
    			$users = Db::table('k_user')->where(array('uid'=>$user['uid'],'password'=>md5($newpass)))->find();
    			if($users){
    				message("新密码不能与近期密码相同！");
    			}
    			$data['password'] = md5($newpass);
    			$res = Db::table('k_user')->where(array('uid'=>$user['uid']))->update($data);
    			if(!$res){
    				message("登录密码修改失败！");
    			}else {
    				unset($_SESSION);
    				session_destroy();
    				message("登录密码修改成功");
    			}
    		}else{
    			$oldmoneypass = trim($_POST['oldmoneypass']);
    			$userinfo = Db::table('k_user')->where(array('uid'=>$user['uid'],'qk_pwd'=>md5($oldmoneypass)))->find();
    			if(!$userinfo){
    				message("原始资金密码不正确！");
    			}
    			$newmoneypass = trim($_POST['newmoneypass']);
    			$newmoneypass2 = trim($_POST['newmoneypass2']);
    			if($newmoneypass!=$newmoneypass2){
    				message("两次资金密码不一致！");
    			}
    			$users = Db::table('k_user')->where(array('uid'=>$user['uid'],'qk_pwd'=>md5($newmoneypass)))->find();
    			if($users){
    				message("新资金密码不能与近期支付密码相同！");
    			}
    			$data['qk_pwd'] = md5($newmoneypass);
    			$res = Db::table('k_user')->where(array('uid'=>$user['uid']))->update($data);
    			if(!$res){
    				message("资金密码修改失败！");
    			}else {
    				message("资金密码修改成功");
    			}	
    		}
    	}
    	$this->assign('user',$user);
    	return $this->fetch('password');
    }
    
    public function record_ds(){  //游戏记录 体育单式
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	$list = Db::table('k_bet')->where(array('uid'=>$user['uid'],'status'=>'0'))->order('bet_time desc')->paginate(15);
    	$this->assign('list',$list);
    	$this->assign('ky',0);
    	$this->assign('bet_money',0);
    	$this->assign('bgcolor','');
    	$this->assign('user',$user);
    	$this->assign('score',NULL);
    	return $this->fetch('record_ds');
    }
    
    public function record_cg(){ //游戏记录  体育串式
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	//$betcg = Db::table('k_bet_cg')->where(array('uid'=>$user['uid'],'status'=>0))->order('bet_time desc')->select();
    	$betcg = Db::table('cglist') -> where('uid','=',$user['uid']) -> where('status','in',[0,2])->select();
    	$this->assign('betcg',$betcg);
    	$this->assign('ky',0);
    	$this->assign('bet_money',0);
    	$this->assign('bgcolor','');
    	$this->assign('current','');
    	$this->assign('canwin','');
    	$this->assign('user',$user);
    	$this->assign('line_count','0');
    	return $this->fetch('record_cg');
    }
    
    public function record_cp(){ //游戏记录  彩票游戏
        date_default_timezone_set('PRC');
        $begin = date('Y-m-d 00:00:00');
        $end = date('Y-m-d 23:59:59');
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	$cbet = Db::table('c_bet')->where(array('username'=>$user['username'],'js'=>0,'addtime'=>['between',[$begin,$end]]))->order('addtime desc')->paginate(15);
    	$this->assign('cbet',$cbet);
    	$this->assign('user',$user);
    	$this->assign('wjs',0);
    	$this->assign('ky',0);
    	$this->assign('tz',0);
    	return $this->fetch('record_cp');
    }
    
    public function tzhistory(){ //国家彩票游戏
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	$type = isset($_GET['type']) ? $_GET['type'] : 'cqssc';
    	$d = isset($_GET['d']) ? $_GET['d'] : date("Y-m-d",time()-7*3600*24);
    	$ed = isset($_GET['ed']) ? $_GET['ed'] : date("Y-m-d");
    	$ed = isset($_GET['ed']) ? $_GET['ed'] : date("Y-m-d");
    	$n = isset($_GET['n']) ? $_GET['n'] : 'all';
    	$p = isset($_GET['p']) ? $_GET['p'] : 1;
    	$arr = array(
    		'type'=>$type,
    		'd'=>$d,
    		'ed'=>$ed,
    		'n'=>$n,
    		'p'=>$p
    	);
     	if($n != 'all' && $n){
     		$where = ' uid = '.$user['uid'].' and addtime >= '."'$d'".' and addtime <= '."'$ed'".' and type =' .$n;
    	}else {
    		$where = ' uid = '.$user['uid'].' and addtime >= '."'$d'".' and addtime <= '."'$ed'";
    	} 
    	$data = Db::table('c_bet_lt')->where($where)->order('addtime desc')->select();
    	
    	//$this->assign('user',$user);
    	$this->assign('arr',$arr);
    	$this->assign('data',$data);
    	return $this->fetch('tzhistory');
    }
    
    public function report(){ //历史记录
        date_default_timezone_set('Asia/Shanghai');
        $uid	=	session("uid");
        
        $day = input('day/d',7);//显示7天
        $day = $day - 1;
        if($day<0)$day = 0;

        $etime	=	date("Y-m-d H:i:s");//'2017-08-20';//
        $stime	=	date("Y-m-d",strtotime("$etime -$day day"));
        
        $result = [];
        for($i=0;$i<=$day;$i++){
            $time	=	date("Y-m-d",strtotime("$etime -$i day"));
            $result[$time] = ['ds'=>0,'ds_tz'=>0,'cg'=>0,'cg_tz'=>0,'cp'=>0,'cp_tz'=>0,];
            $result[$time]['name'] = getWeek(date("w",time()-$i*86400));
            if(($i%2)==0) $result[$time]['bgcolor']="#FFFFFF";
            else $result[$time]['bgcolor']="#F5F5F5";
        }

        //SELECT uid,DATE(bet_time) AS bet_time2,SUM(win-bet_money+fs) AS Y FROM `k_bet` WHERE `status` IN (1,4) AND `bet_time` BETWEEN '2017-08-01' AND '2017-08-17 13:21:52' GROUP BY uid,bet_time2 ORDER BY uid ,bet_time2 DESC   
     /*
        $data = db('k_bet')
        ->where('status','IN',[1,4])->where('bet_time','BETWEEN',[$stime,$etime])
        ->group('bet_time2')
        ->field('date(bet_time) as bet_time2,sum(win-bet_money+fs) as y')
        ->order('bet_time2 desc')
        ->select();        
        
        foreach($data as $row){
            $result[$row['bet_time2']]['dsy'] = $row['y'];
        }
        
        $data = db('k_bet')    
        ->where('status','IN',[2,5])->where('bet_time','BETWEEN',[$stime,$etime])
        ->group('bet_time2')
        ->field('date(bet_time) as bet_time2,sum(win-bet_money+fs) as y')
        ->order('bet_time2 desc')
        ->select();  

        foreach($data as $row){
            $result[$row['bet_time2']]['dss'] = $row['y'];            
        }
    */
        //反水 commissioned,commission
        $data = db('k_bet')
        //->where('uid',$uid)
        ->where('status','IN',[1,2,4,5])//1,4赢,2,5输
        ->where('bet_time','BETWEEN',[$stime,$etime])
        ->where('uid','eq',$uid)
        ->group('bet_time2')
        ->field('date(bet_time) as bet_time2,sum(win-bet_money+IFNULL(commission,0)) as y, sum(bet_money) as tz')
        ->order('bet_time2 desc')
        ->select();        
        //->fetchSql(true)->select();
        //dump($data);return;
//echo Db::getLastSql();exit;        
        foreach($data as $row){
            $result[$row['bet_time2']]['ds'] = $row['y'];
            $result[$row['bet_time2']]['ds_tz'] = $row['tz'];
        }
        //dump($result);return;
        
        //反水isfs,fs
        $data = db('k_bet_cg_group')
        //->where('uid',$uid)
        ->where('status',1)//已结束
        ->where('bet_time','BETWEEN',[$stime,$etime])
        ->where('uid','eq',$uid)
        ->group('bet_time2')
        ->field('date(bet_time) as bet_time2,sum(win-bet_money+IFNULL(fs,0)) as y, sum(bet_money) as tz')
        ->order('bet_time2 desc')
        //->fetchSql(true)->select();
        ->select();
        //dump($data);return;
        
        foreach($data as $row){
            $result[$row['bet_time2']]['cg'] = $row['y'];
            $result[$row['bet_time2']]['cg_tz'] = $row['tz'];
        }
                
        //反水 commissioned,commission
        $data = db('c_bet')
        //->where('uid',$uid)
        ->where('js',1)//已结束
        ->where('addtime','BETWEEN',[$stime,$etime])
        ->where('uid','eq',$uid)
        ->group('bet_time2')
        ->field('date(addtime) as bet_time2,sum(win-money+IFNULL(commission,0)) as y, sum(money) as tz')
        ->order('bet_time2 desc')
        ->select();        
        foreach($data as $row){
            $result[$row['bet_time2']]['cp'] = $row['y'];
            $result[$row['bet_time2']]['cp_tz'] = $row['tz'];
        }
        //dump($result);return;
//echo Db::getLastSql();exit;          
        //ag ,mg,og, ss,sb 游戏平台没有加入统计;
        
        //平台N天内的总输赢
        $sum = [];
        
        //每天的总输赢 $result[$key]['sum']
        
        foreach($result as $key => $value){
            @ $result[$key]['sum'] = $result[$key]['ds'] + $result[$key]['cg'] + $result[$key]['cp'];            
            @ $sum['ds'] += $result[$key]['ds'];
            @ $sum['ds_tz'] += $result[$key]['ds_tz'];
            @ $sum['cg'] += $result[$key]['cg'];
            @ $sum['cg_tz'] += $result[$key]['cg_tz'];
            @ $sum['cp'] += $result[$key]['cp'];
            @ $sum['cp_tz'] += $result[$key]['cp_tz'];
            @ $sum['sum'] += $result[$key]['sum'];
        }
        
        $this->assign('result',$result);
        $this->assign('sum',$sum);
    	return $this->fetch();
    }
    
    public function report_ds(){
        date_default_timezone_set('Asia/Shanghai');
        $uid	=	session("uid");
        $riqi = input('riqi');
        
        
        $data = ['riqi'=>$riqi,];
        $rules = ['riqi'=>'dateFormat:Y-m-d',];
        $msg = ['riqi.dateFormat'=>'日期参数格式错误',];
        $validate = new \Think\Validate($rules,$msg);
        if(! $validate->check($data))
        {
            $error = $validate->getError();
            $this->error($error);
        }
        //$riqi = $data;

        $list = db('k_bet')
        ->where('uid',$uid)
        ->where('status','IN',[1,2,4,5])//1,4赢,2,5输
        ->where('bet_time','BETWEEN',[$riqi,$riqi." 23:59:59"])
        //->fetchSql()->select();
        ->order('bet_time desc')->paginate();
        //echo $list;
        $data = $list->all();
        foreach($data as $key=>$value){
            $data[$key]['jine'] = $value['win']+$value['commission']-$value['bet_money'];
        }
        //dump($data);return;        
        $this->assign('data',$data);
        $this->assign('list',$list);

        $count = db('k_bet')
        //->where('uid',$uid)
        ->where('status','IN',[1,2,4,5])//1,4赢,2,5输
        ->where('bet_time','BETWEEN',[$riqi,$riqi." 23:59:59"])
        ->count();
        
        $sum = db('k_bet')
        //->where('uid',$uid)
        ->where('status','IN',[1,2,4,5])//1,4赢,2,5输
        ->where('bet_time','BETWEEN',[$riqi,$riqi." 23:59:59"])
        ->sum('win+commission-bet_money');
  
        $this->assign('count',$count);
        $this->assign('sum',$sum);
        
        return $this->fetch();
    }
    
    public function report_cg(){
        date_default_timezone_set('Asia/Shanghai');
        $uid	=	session("uid");
        $riqi = input('riqi');
        
        $data = ['riqi'=>$riqi,];
        $rules = ['riqi'=>'dateFormat:Y-m-d',];
        $msg = ['riqi.dateFormat'=>'日期参数格式错误',];
        $validate = new \Think\Validate($rules,$msg);
        if(! $validate->check($data))
        {
            $error = $validate->getError();
            $this->error($error);
        }
	
        $field =
        '`k_bet_cg_group`.`gid`       AS `gid`,
        `k_bet_cg_group`.`bet_time`  AS `gbet_time`,
        `k_bet_cg_group`.`bet_money` AS `bet_money`,
        `k_bet_cg_group`.`cg_count`  AS `cg_count`,
        `k_bet_cg_group`.`bet_win`   AS `bet_win`,
        `k_bet_cg_group`.`win`       AS `win`,
        `k_bet_cg`.`bid`             AS `bid`,
        `k_bet_cg`.`bet_time`        AS `bet_time`,
        `k_bet_cg`.`bet_info`        AS `bet_info`,
        `k_bet_cg`.`match_name`      AS `match_name`,
        `k_bet_cg`.`master_guest`    AS `master_guest`,
        `k_bet_cg`.`MB_Inball`       AS `MB_Inball`,
        `k_bet_cg`.`TG_Inball`       AS `TG_Inball`,
        `k_bet_cg_group`.`uid`       AS `uid`,
        `k_bet_cg_group`.`fs`        AS `fs`,
        `k_bet_cg`.`match_dxgg`      AS `match_dxgg`,
        `k_bet_cg`.`match_rgg`       AS `match_rgg`,
        `k_bet_cg`.`match_showtype`  AS `match_showtype`,
        `k_bet_cg`.`point_column`    AS `point_column`,
        `k_bet_cg`.`ball_sort`       AS `ball_sort`,
        `k_bet_cg`.`bet_point`       AS `bet_point`,
        `k_bet_cg`.`master`          AS `master`,
        `k_bet_cg`.`guest`           AS `guest`,
        `k_bet_cg_group`.`status`    AS `status`,
        `k_bet_cg`.`status`          AS `match_status`';
            
        $betcg = db('k_bet_cg_group')
        ->join('k_bet_cg','k_bet_cg.gid = k_bet_cg_group.gid')
        ->where('k_bet_cg_group.uid',$uid)
        ->where('k_bet_cg_group.status',1)//已结束
        ->where('k_bet_cg_group.bet_time','BETWEEN',[$riqi,$riqi." 23:59:59"])
        ->field($field)
        //->fetchSql()->select();
        ->order('bet_time desc')->select();
        //dump($betcg);return;
        foreach($betcg as $key=>$value){
            $betcg[$key]['jine'] = $value['win']+$value['fs']-$value['bet_money'];
        }
        
        $this->assign('betcg',$betcg);
        $this->assign('ky',0);
        $this->assign('bet_money',0);
        $this->assign('bgcolor','');
        $this->assign('current','');
  
        $this->assign('line_count','0');
        return $this->fetch();        
    }
    
    public function report_cp(){
        date_default_timezone_set('Asia/Shanghai');
        $uid	=	session("uid");
        $user   =   db('k_user')->where('uid',$uid)->find();
        $riqi = input('riqi');
        
        
        $data = ['riqi'=>$riqi,];
        $rules = ['riqi'=>'dateFormat:Y-m-d',];
        $msg = ['riqi.dateFormat'=>'日期参数格式错误',];
        $validate = new \Think\Validate($rules,$msg);
        if(! $validate->check($data))
        {
            $error = $validate->getError();
            $this->error($error);
        }
	
        $start = date('Y-m-d 00:00:00',strtotime($riqi));
        $end = date('Y-m-d 23:59:59',strtotime($riqi));
        $cbet = db('c_bet')
        ->where('username',$user['username'])
        ->where('js',1)//已结束
        ->where('addtime','BETWEEN',[$start ,$end])
        //->fetchSql()->select();
        ->order('addtime desc')->select();
        //dump($cbet);return;
        foreach($cbet as $key=>$value){
            $cbet[$key]['jine'] = $value['win']+$value['commission']-$value['money'];
        }
      
        $this->assign('cbet',$cbet);
        
        $count = db('c_bet')
        ->where('username',$user['username'])
        ->where('js',1)//已结束
        ->where('addtime','BETWEEN',[$riqi,$riqi." 23:59:59"])
        ->count();
        
        $sum = db('c_bet')
        ->where('username',$user['username'])
        ->where('js',1)//已结束
        ->where('addtime','BETWEEN',[$riqi,$riqi." 23:59:59"])
        ->sum('win+commission-money');
      
        $this->assign('count',$count);
        $this->assign('sum',$sum);
        
        return $this->fetch();
    }
    
    public function sms(){//站内公告
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	$usermsg = Db::table('k_user_msg')->where(array('uid'=>$user['uid']))->order('msg_time desc')->select();
    	
    	$num = Db::table('k_user_msg')->where(array('uid'=>$user['uid']))->count();//总数
    	$usermsg = Db::table('k_user_msg')->where(array('uid'=>$user['uid']))->order('msg_time desc')->paginate(15,$num);
    	$page = $usermsg->render();
    	
    	$this->assign('usermsg',$usermsg);
    	$this->assign('user',$user);
    	$this->assign('page',$page);
    	return $this->fetch('sms');
    }
    
    public function smsshow($id=0){
        $uid = Session('uid');
        $where = array(
            'uid' =>['eq',$uid],
            'msg_id' => ['eq',$id]
        );
        $data = ['islook'=>1];
        Db::table('k_user_msg')->where($where)->update($data);
        $info = Db::table('k_user_msg')->where($where)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }
    
    public function smsdel($id=0){
        $uid = Session('uid');
        $where = array(
            'uid'       => ['eq',$uid],
            'msg_id'    => ['eq',$id],
        );
        $info = Db::table('k_user_msg') ->where($where)->delete();
        if($info){
            $this->success('删除成功!',url('user/sms'));
        }else{
            $this->error('删除失败!',url('user/sms'));
        }
    }
    
    public function reg_agent(){ //申请代理
        date_default_timezone_set('PRC');
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	if($_POST){
            if(request()->isMobile()){
                if(!captcha_check($_POST['tf_yzm'], "mobile_reg_agent")){
                message('验证码错误。');
                }
            }
    		$where = "uid='".Session::get('uid')."' and add_time>='".date("Y-m-d")." 00:00:00' and add_time<='".date("Y-m-d")." 23:59:59'";
    		$userdaili = Db::table('k_user_daili')->where($where)->find();
    		if($userdaili){
    			message('代理每天只能申请一次，您今天已经提交申请了，请等待客服人员联系和确认。','/user/reg_agent');
    		}
    		Db::startTrans();//开启事务
    		try {
    			$data['uid'] =	Session::get('uid');
    			$data['r_name'] =	$_POST["r_name"];
    			$data['mobile'] =	$_POST["mobile"];
    			$data['email'] =	$_POST["email"];
    			$data['about'] =	$_POST["about"];
    			$daili = Db::table('k_user_daili')->insert($data);
    			
    			Db::commit();  //事务成功
    			message("提款申请已经提交，等待财务人员给您转账。\\n您可以到历史报表中查询您的取款状态！","/user/agent");
    		}catch(\Exception $e){
    			Db::rollback();  //数据回滚
    			message("由于网络堵塞，本次申请提款失败。\\n请您稍候再试，或联系在线客服。");
    		}
    	}
    	$this->assign('user',$user);
    	return $this->fetch('reg_agent');
    }
    
    public function agent(){ //推广网址
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	$url = \request()->scheme . '://' . $_SERVER['HTTP_HOST'].'/?f='.$user['username'];
    	$userdaili = Db::table('k_user_daili')->where(array('uid'=>$uid,'status'=>1))->find();
    	if(!$userdaili){
    		message('你还未申请代理!','/user/reg_agent');
    	}
    	$this->assign('url',$url);
    	return $this->fetch('agent');
    }
    
    public function ag_user(){ //下级列表
        date_default_timezone_set('PRC');
    	$request = \think\Request::instance();
    	$username = $request->param('username') ? $request->param('username') : '';
    	$data_k = $request->param('data_k') ? date('Y-m-d 00:00:00', strtotime($request->param('data_k'))) : date('Y-m-d 00:00:00');
    	$data_o = $request->param('data_o') ? date('Y-m-d 23:59:59', strtotime($request->param('data_o'))) : date('Y-m-d 23:59:59');
    	$month = date("Y-m");
    	$where['topuser'] = ['eq',session('username')]; 
    	if($username){
    	    $where['username'] = ['=',$username];
    	}
    	$info  = Db::table('g_user_login')->where($where)->select();
    	$list = [];
    	foreach ($info as $k =>$v){
    	    $res = Db::query("call getAgentUserLlist('{$data_k}','{$data_o}',{$v['uid']})" );
    	    if(!empty($res[0])){
                $list[$v['uid']] = $res[0];
            }
    	}
    	$this->assign('list',$list);
    	$this->assign('info',$info);
    	return $this->fetch('ag_user');
    }
    
    public function ag_data(){ //报表统计
    	return $this->fetch('ag_data');
    }

    public function profile(){
        if(!request()->isMobile()){
            $this->error('页面不存在!');
        }
        $uid = Session::get('uid');
        $user = Db::table('k_user')->where(array('uid'=>$uid))->find();
        if($_POST){
            if(!captcha_check($_POST['zcyzm'], "mobile_profile")) {
                message("验证码不正确！");
            }   
            if($user['answer'] != $_POST['mmda']){
                message("密码答案不正确！");
            }
            
            if( $_POST["zcpwd0"] && $_POST["zcpwd1"] ){
                $oldpass = trim($_POST['zcpwd0']);
                $userinfo = Db::table('k_user')->where(array('uid'=>$user['uid'],'password'=>md5($oldpass)))->find();
                if(!$userinfo){
                    message("原始登录密码不正确！");
                }
                $newpass = trim($_POST['zcpwd1']);
                $newpass2 = trim($_POST['zcpwd2']);
                if($newpass!=$newpass2){
                    message("两次密码不一致！");
                }
                $users = Db::table('k_user')->where(array('uid'=>$user['uid'],'password'=>md5($newpass)))->find();
                if($users){
                    message("新密码不能与近期密码相同！");
                }
                $data['password'] = md5($newpass);                
            }

            if( $_POST["qkpwd0"] && $_POST["qkpwd1"] ){
                $oldmoneypass = trim($_POST['qkpwd0']);
                $userinfo = Db::table('k_user')->where(array('uid'=>$user['uid'],'qk_pwd'=>md5($oldmoneypass)))->find();
                if(!$userinfo){
                    message("原始资金密码不正确！");
                }
                $newmoneypass = trim($_POST['qkpwd1']);
                $newmoneypass2 = trim($_POST['qkpwd2']);
                if($newmoneypass!=$newmoneypass2){
                    message("两次资金密码不一致！");
                }
                $users = Db::table('k_user')->where(array('uid'=>$user['uid'],'qk_pwd'=>md5($newmoneypass)))->find();
                if($users){
                    message("新资金密码不能与近期支付密码相同！");
                }
                $data['qk_pwd'] = md5($newmoneypass);
            }

            if(empty($data)){
                message("请输入修改资料！");
            }

            $res = Db::table('k_user')->where(array('uid'=>$user['uid']))->update($data);
            if(!$res){
                message("会员资料修改失败！");
            }else {
                unset($_SESSION);
                session_destroy();
                message("会员资料修改成功");
            }
        }
        $this->assign('user',$user);
        return $this->fetch();
    }

    public function logout(){
        session(null);
        $this->redirect('/');
        
    }    
}

?>

