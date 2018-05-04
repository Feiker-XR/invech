<?php 
namespace app\v1\controller;
use app\v1\Base;
use app\v1\Login;

use app\live\agGame;
use app\live\mgGame;
use app\live\bbingame;
use app\live\ptGame;
use app\live\sunbet;
use app\live\ptGamePlayer;
use app\live\oggame;

class Platform extends Login {

    static protected $types = ['ag','bb','mg','og','sb','pt'];
    static protected $suffix = 'test';
    
    protected function is_fengpan($type){
        $fengpan = db('k_fengpan')->where('name',$type.'zr')->where('weihu',1)->select();
        return $fengpan;
    }
    

    public function balance($type){

        if(!in_array($type,self::$types)){
            return ['status'=>1,'msg'=>'平台类型不合法','data'=>''];
        }
        if($this->is_fengpan($type)){
            return ['status'=>1,'msg'=>'当前平台已封盘','data'=>''];
        }

        $userinfo = $this->user;
        
        //用户名
        $username  = $userinfo['username'];
        $password = substr(md5(md5($username)),3,12);
        
        if (mb_substr($username,-3,3,'utf-8') != self::$suffix) {
            $temp_username = $username . self::$suffix;
        } else {
            $temp_username = $username;
        }
        $mg_username = $username.'@'.self::$suffix;
        
        $zrtype = $type;
        switch ($zrtype){
            case 'bb':
                bbingame::CreateMember($temp_username,$password);
                $bbRet = bbingame::CheckUsrBalance($temp_username);
                //dump($bbRet);return $bbRet;
                if($bbRet === false){
                    return ['status' => 1,"msg"=>'未知，请联系管理员！'];
                }else{
                    $bb_balance = $bbRet;
                    return ['status' => 0, 'data'=>sprintf("%.2f",$bb_balance)];
                }                
            case 'og':
                oggame::CheckAndCreateAccount($temp_username, 'oga123456');
                //查询OG金额
                if ($temp_username != '') {
                    $og_balance = oggame::GetBalance($temp_username,'oga123456'); //og::getUserInfo($user['og_username']);
                } else {
                    $og_balance ='0.00';
                }
                return ['status'=>0, 'data'=>sprintf("%.2f", $og_balance),];
            case 'ag':
                $result = agGame::regUser($temp_username);
                //查询ag金额
                $ag_balance =agGame::inquireBalance($temp_username);
                //dump($ag_balance);return $ag_balance;                                
                return ['status' => 0,'data'=>sprintf("%.2f", $ag_balance)];
            case 'na'://维护中
                return ['status' => 0,'data'=>sprintf("%.2f", '0.00')];
            case 'mg':
                $auth = mgGame::authenticate();
                $auth = $auth['body']['access_token'];
                //$account_ext_ref = 'lisi5787@hga';
                $account_ext_ref = $mg_username;
                mgGame::createMember($auth,$mg_username,$password,$account_ext_ref);
                $mgRet = mgGame::getBalance($auth,$account_ext_ref);
                if($mgRet['success'] == false){
                    $msg = $mgRet['body']['code'] . $mgRet['body']['message'];
                    return ['status' => 1,'msg' => $msg];
                }else{
                    $mg_balance = $mgRet['body'][0]['credit_balance'];
                }
                return ['status' => 0 ,'data'=> sprintf("%.2f",$mg_balance)];
            case 'sb':
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
                return ['status'=>0, 'data'=> sprintf("%.2f",$sb_balance)];
            case 'pt':
                $ret = ptGamePlayer::create($temp_username);
                $ret = ptGamePlayer::balance($temp_username);
                if(@$ret['error']){
                    return ['status' => 1,"msg"=>$ret["errorcode"].$ret["error"],"data"=>0,];
                }else{
                    $pt_balance = $ret['result']['balance'];
                    return ['status' => 0, 'data'=>sprintf("%.2f",$pt_balance)];
                }
        }
    }

    public function transfer($type){

        if(!in_array($type,self::$types)){
            return ['status'=>0,'msg'=>'平台类型不合法','data'=>''];
        }
        if($this->is_fengpan($type)){
            return ['status'=>1,'msg'=>'当前平台已封盘','data'=>''];
        }

        $direct = trim(input('direct'));
        if(!in_array($direct,['IN','OUT'])){
            return ['status'=>1,'msg'=>'direct参数不合法','data'=>''];
        }
        $amount = floatval(input('amount'));
        if( $amount < 0 ){
           return ['status'=>1,'msg'=>'amount参数不合法','data'=>'']; 
        }

        if( $amount < 1 ){
            return ['status'=>1,'msg'=>"转账金额最低为：1元，请重新输入",'data'=>''];
        }

        $zmaps = [
            'ag'    =>  'AG',
            'bb'    =>  'BB',
            'mg'    =>  'MG',
            'og'    =>  'OG',
            'sb'    =>  'sbet',
            'pt'    =>  'PT',
        ];
        $targetTmp = $zmaps[$type];

        $uid = $this->uid;
        $user = $this->user;
        $userinfo = $this->user;
        $username  = $user['username'];
        $password = substr(md5(md5($username)),3,12);
        
        if (mb_substr($username,-3,3,'utf-8') != self::$suffix) {
            $temp_username = $username . self::$suffix;
        } else {
            $temp_username = $username;
        }
        $mg_username = $username.'@'.self::$suffix;

        if( $direct == 'IN' ){

            $inStatus = 0;

            $ztypemaps = [
                'ag'    =>  12,
                'bb'    =>  111,
                'mg'    =>  13,
                'og'    =>  17,
                'sb'    =>  16,
                'pt'    =>  77,
            ]; 
            $zz_type = $ztypemaps[$type];

            $zz_money = $amount;

            if($userinfo["money"] < $amount){
                return ['status'=>1,'msg'=>'用户余额不足','data'=>'']; 
            }            

            $web_zzzzz = db('web_zzzzz')->where('name',$targetTmp)->find();
            $muqian = $web_zzzzz['muqian'];
            if ($muqian < $zz_money) {                        
                return ['status'=>1,'msg'=>"您申请转入的真人娱乐额度不足请联系客服！",'data'=>'']; 
            }
                            
            if('ag' == $type){
 
                $billno = "HGA{$this->uid}AG".time().rand(10,99);
                
                $result = agGame::regUser($temp_username);
                if(!$result['Code']){
                    $trans_result = agGame::depositToAG($temp_username,$zz_money,$billno);
                    if($trans_result == true){
                        $inStatus = 1;
                    }
                }
            }else if('og' == $type){
                $billNO = $billno ='jinpai'. rand(10,9999).date("mdHis");
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
            else if('sb' == $type){ //sbet
                $billNO = $billno =$username."-addmoney-".time();
                //if(time() - session('sunbetTokenTime') > 3600 || session('authtoken') == ""){
                if( (time() - session('sunbetTokenTime')?:0) > 3600){                            
                    $token = sunbet::getToken();
                    if($token){
                        session('sunbetTokenTime',time());
                        session('sunbetToken',$token);
                        $authtoken = sunbet::authorize(session('sunbetToken'),$temp_username);
                        session('authtoken',$authtoken);
                    }else{
                        return ['status'=>1, 'msg'=>'获取token失败',];
                    }
                }
                $trans_result = sunbet::addMoney(session('sunbetToken'), $zz_money,$temp_username);
                //{"bal":70.00,"cur":"RMB","txid":"test001jsa-addmoney-1502270331","ptxid":"a2275094-e37c-e711-80be-0050568c10c1","dup":false}"
                $trans_result = json_decode($trans_result);
                if($trans_result && !@$trans_result->err){
                    $billno = $trans_result->txid;
                    $inStatus = 1;
                }
            }else if('bb' == $type){
                $billno = $uid.time();
                bbingame::CreateMember($temp_username,$password);
                $trans_result = bbingame::Transfer($temp_username,$zz_money,$billno,$act = 'IN');        
                if($trans_result === true){
                    $inStatus = 1;
                }
            }
            else if('mg' == $type){    
                //$trans_result = $mgapi->deposit($mg_username,$zz_money,$qGuid);
                $mg_username =  $username.'@'.self::$suffix;
                $billno ='mg'. rand(10,9999).date("mdHis");//订单号杜撰
                $account_id = '';//'小罗说有固定生成规则'
                //$account_ext_ref = 'lisi5787@hga';
                $account_ext_ref = $mg_username;                        
                //$auth = 'Basic R2FtaW5nTWFzdGVyMUNOWV9hdXRoOjlGSE9SUWRHVFp3cURYRkBeaVpeS1JNZ1U=';
                $auth = mgGame::authenticate();
                if($auth['success'] == true){
                    $auth = $auth['body']['access_token'];
                    $trans_result = mgGame::createTranscation($auth,$zz_money,$billno,0,$account_ext_ref, $account_id);
                    
                    if($trans_result['success'] == true){
                        $inStatus = 1;
                    }                    
                }

            }else if('pt' == $type){
                $billno ='pt'. rand(10,9999).date("mdHis");//订单号杜撰
                $ret = ptGamePlayer::create($temp_username);
                //if(!isset($ret['error'])){
                    $ret = ptGamePlayer::deposit($temp_username,$zz_money,$billno);
                    if(isset($ret['result']) && isset($ret['result']['result']) && $ret['result']['result'] == 'Deposit OK'){
                        $inStatus = 1;
                    }else{
                        return ['status'=>1,'msg'=>$ret["errorcode"].$ret["error"],];
                    }                     
                //}
            }
                    
            db()->startTrans();

            if(1 == $inStatus){                             
                db('web_zzzzz')->where('name',$targetTmp)->setInc('xiaofei',$zz_money);
                db('web_zzzzz')->where('name',$targetTmp)->setDec('muqian',$zz_money);
                $status = 1;
                $about = "转入".$targetTmp;
                $order = date("YmdHis")."_".session('username');

                $insert_data = [
                    'uid'   =>  $uid,
                    'm_value'   =>  $zz_money,
                    'status'    =>  $status,
                    'm_order'   =>  $order,
                    'pay_card'  =>  $userinfo["pay_card"],
                    'pay_num'   =>  $userinfo["pay_num"],
                    'pay_address'   =>  $userinfo["pay_address"],
                    'pay_name'  =>  $userinfo['pay_name'],
                    'about'     =>  $about,
                    'assets'    =>  $userinfo["money"],
                    'balance'     =>  $userinfo["money"]+$zz_money,
                    'type'      =>  $zz_type,
                ];
                db('k_money')->insert($insert_data);
                
                $new_money = $user['money'] - abs($zz_money);
                $data = [
                    'uid'       =>  $uid,
                    'username'  =>  $username,
                    'old_money' =>  $user['money'],
                    'amount'    =>  $zz_money,
                    'new_money' =>  $new_money,
                    'type'      =>  $zz_type,
                    'info'      =>  '转入'.$targetTmp,
                    'actionTime'    =>  time(),
                    'result'    =>  '转账成功',
                    'billNO'    =>  $billno,
                    'status'    =>  1,
                ];
                db('zz_info')->insert($data);

                db('k_user')->where('uid',$uid)->setDec('money',$zz_money);
 
                db()->commit();
                return ['status'=>0, 'msg'=>"转账成功,转账金额为".intval($zz_money),];
            }else{
                db()->rollback();
                return ['status'=>1, 'msg'=>"转账失败，请联系客服",];
            }            
        }


        if( $direct == 'OUT'){
            $outStatus = 0;

            $ztypemaps = [
                'ag'    =>  22,
                'bb'    =>  211,
                'mg'    =>  23,
                'og'    =>  27,
                'sb'    =>  26,
                'pt'    =>  87,
            ]; 
            $zz_type = $ztypemaps[$type];

            $zz_money = $amount;

            if('ag' == $type){
                $billno = "HGA{$uid}AG".time().rand(10,99);
                $result = agGame::regUser($temp_username);
                if(!$result['Code']){
                    $trans_result = agGame::AGToWithdrawal($temp_username,$zz_money,$billno);
                    if($trans_result == '1'){
                        $outStatus = 1;
                    }
                }
            }elseif('sb' == $type){
                //if(time() - session('sunbetTokenTime') > 3600 || session('authtoken') == ""){     
                if( (time() - session('sunbetTokenTime')?:0) > 3600){
                    $token = sunbet::getToken();
                    if($token){
                        session('sunbetTokenTime',time());
                        session('sunbetToken',$token);
                        $authtoken = sunbet::authorize(session('sunbetToken'),$temp_username);
                        session('authtoken',$authtoken);
                    }else{
                        return ['status'=>1,'msg'=>'获取token失败',];
                    }
                }
                $trans_result = sunbet::reduceMoney(session('sunbetToken'), $zz_money,$temp_username);
                $trans_result = json_decode($trans_result);
                if($trans_result && !@$trans_result->err){
                    $billno = $billNO = $trans_result->txid;
                    $outStatus = 1;
                }
            }elseif ('og' == $type) {
                $billNO = $billno ='jinpai'. rand(10,9999).date("mdHis");
                if(strval(oggame::CheckAndCreateAccount($temp_username, 'oga123456'))){
                    $trans_result = oggame::TransferCredit($temp_username,"oga123456",$billno,'OUT',$zz_money);
                    if($trans_result === '1'){
                        $outStatus = 1;
                    }elseif($trans_result === '2'){
                        oggame::ConfirmTransferCredit($temp_username,"oga123456",$billno,'OUT',$zz_money);
                        $outStatus = 1;
                    }
                } 
            }elseif ('bb' == $type) {
                bbinGame::CreateMember($temp_username,$password);
                $billno = '0'.$uid.time();
                //$trans_result = $bbapi->withdrawal($temp_username,$zz_money,$billno);
                $trans_result = bbingame::Transfer($temp_username,$zz_money,$billno,$act = 'OUT');
                if($trans_result == true){
                    $outStatus = 1;
                }
            }elseif ('mg' == $type) {
                $billno ='mg'. rand(10,9999).date("mdHis");//订单号杜撰
                $account_id = '';//'小罗说有固定生成规则'
                //$account_ext_ref = 'lisi5787@hga';         
                $mg_username =  $username.'@'.self::$suffix;
                $account_ext_ref = $mg_username;  
                //$auth = 'Basic R2FtaW5nTWFzdGVyMUNOWV9hdXRoOjlGSE9SUWRHVFp3cURYRkBeaVpeS1JNZ1U=';
                $auth = mgGame::authenticate();
                $auth = $auth['body']['access_token'];
                $trans_result = mgGame::createTranscation($auth,$zz_money,$billno,1,$account_ext_ref, $account_id);
                if($trans_result['success'] == true){
                    $outStatus = 1;
                }
            }elseif ('pt' == $type) {
                $type="PT";
                $billno ='pt'. rand(10,9999).date("mdHis");//订单号杜撰
                $ret = ptGamePlayer::create($temp_username);
                $ret = ptGamePlayer::withdraw($temp_username,$zz_money,$billno);
                if(isset($ret['result']) && isset($ret['result']['result']) && $ret['result']['result'] == 'Withdraw OK'){
                    $outStatus = 1;
                }else{
                    return ['status'=>1,'msg'=>$ret["errorcode"].$ret["error"],];
                    
                }
            }

            db()->startTrans();

            if(1 == $outStatus){
                
                db('web_zzzzz')->where('name',$targetTmp)->setDec('xiaofei',$zz_money);
                db('web_zzzzz')->where('name',$targetTmp)->setInc('muqian',$zz_money);
                                        
                $status = 1;
                $about = $targetTmp."转出";
                $order = date("YmdHis")."_".$user['username'];

                $insert_data = [
                    'uid'   =>  $uid,
                    'm_value'   =>  $zz_money,
                    'status'    =>  $status,
                    'm_order'   =>  $order,
                    'pay_card'  =>  $userinfo["pay_card"],
                    'pay_num'   =>  $userinfo["pay_num"],
                    'pay_address'   =>  $userinfo["pay_address"],
                    'pay_name'  =>  $userinfo['pay_name'],
                    'about'     =>  $about,
                    'assets'    =>  $userinfo["money"],
                    'balance'     =>  $userinfo["money"]+$zz_money,
                    'type'      =>  $zz_type,
                ];
                db('k_money')->insert($insert_data);
                        
                $new_money = $user['money'] + $zz_money;
                $data = [
                    'uid'       =>  $uid,
                    'username'  =>  $username,
                    'old_money' =>  $user['money'],
                    'amount'    =>  $zz_money,
                    'new_money' =>  $new_money,
                    'type'      =>  $zz_type,
                    'info'      =>  $targetTmp.'转出',
                    'actionTime'    =>  time(),
                    'result'    =>  '转账成功',
                    'billNO'    =>  $billno,
                    'status'    =>  1,
                ];
                db('zz_info')->insert($data);
                
                db('k_user')->where('uid',$uid)->setInc('money',$zz_money);
                
                db()->commit();
                return ['status'=>0,'msg'=>"转账成功,转账金额为".intval($zz_money),];
            }else{
                db()->rollback();
                //return ['status'=>1,'msg'=>"真人点数不足，转账失败！"];
                return ['status'=>1,'msg'=>'平台转账失败！'];                
            }

        }
    }

}

