<?php
namespace app\v1\controller;
use app\v1\Base;
use think\Session;
use think\Db;
use think\Request;
use app\logic\betN;
use app\logic\betC;

class Lotterygfwf extends Base{
    private $uid = '';
    private $username = '';

    public function _initialize(){        
        parent::_initialize();
        $this->uid = Session("uid");
        $this->username = Session("username");
       
        $action = request()->action();
        $logins = ['index','postAll','getOrdered'];
        if( (!$this->uid) && in_array($action,$logins) ){
            return ['status'=>'1','msg'=>'请登录后再进行投注!',];          
        }
    }

    public function types(){
        $types = model('type')->allTypes();        
        return $this->api_success($types);
    }

    //前端提交的注单列表,可以是官方玩法和快钱玩法;
    //只支持追号,不支持飞盘和合买;整个前后端都没有实现合买和飞盘
    //追号,实现为 快钱和官方玩法一起追号,同时翻倍
    public function postAll(){
        //config('default_return_type','json');
        try{

            $ret['status'] = 0 ;
            $ret['info'] = '投注失败,请重试...' ;

            $codes   = input('code/a');
            $para    = input('para/a');
            
            $type = $para['type']??null;
            if(!$type){
                throw new \Exception("请输入彩种ID!");
            }
            $types = model('type')->allTypes();
            $lottery = $types[$type]??null;
            if(!$lottery){
                throw new \Exception("彩种不存在!");  
            }
            $groups = model('type')->allTypes($type);
            
            $lottery_name = $lottery['name'];
            $qishu = \app\logic\qishu::$lottery_name();
            if($qishu==-1){
                throw new \Exception('已经封盘，禁止下注！');
            }

            if (count($codes) == 0)
                throw new \Exception('请先选择号码再提交投注');

            //追号时才有多期
            $actionNos = explode('|', $para['actionNo']);
            foreach ($actionNos as &$action_no) {           
                $action_no = str_replace('-', '', $action_no);                     
                if ( intval($qishu) > intval($action_no) )
                    throw new \Exception('投注失败：该期投注时间已过'.$action_no.'----'.$qishu);
                //formatActionNo 处理 新疆时时彩的bug? 需要多补一个0?
                //$para['actionNo'] = $this->formatActionNo($para['actionNo'],$para['type']) ;                
            }

            $zhuihao = input('zhuiHao');
            if($zhuihao){
                $beishus = explode('|', $para['beishu']);
                if(count($actionNos)!=count($beishus)){
                    throw new \Exception('投注失败：追号期数个数和倍数个数不一致!');
                }
            }else{
                $beishus = [1];               
            }
            
            // 查检每个注单的数据完整性
            $amount = 0;
            $betinfo = [];//注单,追号,一个投注内容,对应多个期数,则对应多个注单;
            foreach ($codes as $code) {
                
                $groupId = $code['playedGroup']??null;//input('playedGroup/d');
                $group = $groups[$groupId]??null;
                if(!$group){
                    throw new \Exception("玩法组不存在!");
                }
                $playedId = $code['playedId']??null;//input('playedId/d');
                $played = $group['playeds'][$playedId]??null;
                if(!$played){
                    throw new \Exception("玩法不存在!");
                }
                if (! $played['enable']){
                    throw new \Exception('玩法已停!');
                }

                if ($para['type']!=$code['type']){
                    throw new \Exception('彩种id有误!');
                }                

                $actionData = $code['actionData']??'';
                if(is_null($actionData)){
                    throw new \Exception("投注内容不能为空!");
                }    

                if (floatval($code['mode']) <= 0)
                    throw new \Exception('倍数模式必须大于0!');

                // 检查赔率
                if ($code['bonusProp'] != $played['bonusPropBase'])
                    throw new \Exception('赔率出错，请重新投注');

                // 检查返点 $code['fanDian'] = 0;

                // 检查倍数
                if (intval($code['beiShu']) < 1)
                throw new \Exception('倍数只能为大于1正整数');  

                // 检查模式
                $mode = floatval($code['mode']);
                if(!in_array($mode,[2,0.2,0.02,0.002])){     
                    throw new \Exception('模式不合法');       
                }

                /*
                $orderId = $code['orderId']??null;
                if(!$orderId){
                    throw new \Exception("订单id不能为空!");
                }
                */

                // 检查注数
                $betCountFun = $played['betCountFun'];
                if($betCountFun){
                  
                    $betCount = betN::$betCountFun($code['actionData']);
                    if($code['actionNum'] != $betCount){
                        throw new \Exception('提交数据出错，请重新投注，有效注数' . $betCount);
                    }                
                }

                if($played['rx_mode']!='wym'){
                    $code['weiShu'] = 0;
                }                
                //内容检查,包括内容,以及通配符和位掩码;
                //官方玩法也没有 内容检查,
                //或者通过玩法名分支做了简易检查, strpos($played['name'], "任选")
                //可以玩法添加内容检查函数betCheckFun;
                $betCheckFun = $played['betCheckFun'];
                if($betCheckFun){
                    $betCheck = betC::$betCheckFun($code['actionData'],$code['weiShu']);
                    if(!$betCheck){
                        throw new \Exception('投注内容有误，请重新投注!');
                    }                
                }
                
                //追号倍数,1个元素时表示普通投注
                foreach($actionNos as $key=>$actionNo){
 
                    $code['beiShu'] = $code['beiShu'] * $beishus[$key];
                    $money = $code['actionNum']*$code['beiShu']*$code['mode'];
                    $odds = $code['bonusProp'];//$played['bonusPropBase'];
                    //结算前无法确定可赢金额,
                    $qiuhao = $code['playedName'];
                    $wanfa = $code['actionData'];
                    $actionNum = $code['actionNum']; 

                    $data = [
                        'uid'       => $this->uid,
                        'username'  => $this->username,
                        'gfwf'      => 1,//默认0
                        'playedId'  => $code['playedId'],
                        //添加官方玩法字段区分注单,
                        //快钱玩法win字段在结算后被修改,不能作为划分标志
                        //可赢金额与倍数和模式 以及投注数 有关
                        'type'      => $lottery['title'],
                        'qishu'     => $actionNo,//$qishu,
                        'mingxi_1'  => $qiuhao,
                        'mingxi_2'  => $wanfa,
                        'odds'      => $odds,
                        'money'     => $money,//money是投注额,派奖的金额与此无关
                        'win'       => 0,   //
                        'actionNum' => $actionNum,      //默认1
                        'beiShu'    => $code['beiShu'], //默认1
                        'mode'      => $code['mode'],   //默认2
                        'weiShu'    => $code['weiShu'], //默认0
                        ];
                    $betinfo[] = $data;
                    //$amount += $money;
                }
            }    
         
           
            if($lottery['is_ffc']){
                $return = $this->add_bet_ffc($betinfo);
            }else{
               
                $return = $this->add_bet($betinfo);
               
            }
           
            if(!$return['status']){
                throw new \Exception($return['msg']);
            }

            $ret['status'] = 1  ;
            $ret['info'] = '投注成功';
        }catch (\Exception $e) {
            db()->rollback();
            $ret['info'] = $e->getMessage() ;
        }        
        return $ret;
    }

    private function add_bet($data){
        
        Db::startTrans();
        $is_mobile = $this->request->isMobile();
        $ip = $this->request->ip();

        try{
           
            foreach ($data as $v){

                $v['q_qian'] = Db::table('k_user')->where('uid','=',$this->uid)->column('money')[0];
            
                if($v['q_qian'] < $v['money']){
                    Db::rollback();
                    return array('status'=>false,'msg' => '金额不足!');
                }
                $v['h_qian'] = $v['q_qian'] - $v['money'];

                Db::table('k_user')->where('uid',$this->uid)->update(['money' =>$v['h_qian']]);
              
                $v['did'] = ($is_mobile ?'WAP' : 'PC').date('YmdHis').rand(10000,99999);
                $v['addtime'] = date('Y-m-d H:i:s');
                $v['adddate'] = date('Y-m-d');
                $v['tms']     = time();
                $v['device'] = $is_mobile ? 'MOBILE' : 'PC';
                $v['ip']    = $ip;
                $v['www'] = $this->request->host();
                $signStr = $v['did'].$v['uid'].$v['username'].$v['addtime'];
                $signStr .= $v['type'].$v['qishu'].$v['mingxi_1'].$v['mingxi_2'];
                $signStr .= $v['odds'].sprintf('%.2f',$v['money']).sprintf('%.2f',$v['q_qian']);
                $v['saltCode'] = md5($signStr);
                $insertid = Db::table('c_bet')->insertGetId($v); 
                $log = [];              
                $log['m_order']   = 'CBET'.$insertid;
                $log['uid']     = Session('uid');
                $log['m_value'] = $v['money'];
                $log['q_qian']  = $v['q_qian'];
                $log['h_qian']  = $v['h_qian'];
                $log['status']  = '1';
                $log['m_make_time'] = date('Y-m-d H:i:s');
                $log['about'] = $v['type'].'投注,订单号:'.$insertid.',金额:'.$v['money'];
                $log['type'] = '300';
               
                Db::table('k_money') -> insert($log);

            }

            Db::commit();
        }catch (\Exception $e){
           
            echo $e->getMessage();  

            Db::rollback();
            return array('status'=>false,'msg'=>$e->getMessage());
        }
       
        return array('status' => true);
    }

    private function add_bet_ffc($data){        
        Db::startTrans();
        $is_mobile = $this->request->isMobile();
        $ip = $this->request->ip();
        try{
            foreach ($data as $v){
                $v['q_qian'] = Db::table('k_user')->where('uid','=',$this->uid)->column('money')[0];
                if($v['q_qian'] < $v['money']){
                    Db::rollback();
                    return array('status'=>false,'msg' => '金额不足!');
                }
                $v['h_qian'] = $v['q_qian'] - $v['money'];
                Db::table('k_user')->where('uid',$this->uid)->update(['money' =>$v['h_qian']]);
                $v['did'] = ($is_mobile ?'WAP' : 'PC').date('YmdHis').rand(10000,99999);
                $v['addtime'] = date('Y-m-d H:i:s');
                $v['adddate'] = date('Y-m-d');
                $v['tms']     = time();
                $v['device'] = $is_mobile ? 'MOBILE' : 'PC';
                $v['ip']    = $ip;
                $v['www'] = $this->request->host();
                $signStr = $v['did'].$v['uid'].$v['username'].$v['addtime'];
                $signStr .= $v['type'].$v['qishu'].$v['mingxi_1'].$v['mingxi_2'];
                $signStr .= $v['odds'].sprintf('%.2f',$v['money']).sprintf('%.2f',$v['q_qian']);
                $v['saltCode'] = md5($signStr);

                $insertid = Db::table('c_bet_ffc')->insertGetId($v);  
                $log = [];              
                
                //$log['m_order']   = 'CBET'.$insertid;
                $log['m_order']   = $v['did'];

                $log['uid']     = Session('uid');
                $log['m_value'] = $v['money'];
                $log['q_qian']  = $v['q_qian'];
                $log['h_qian']  = $v['h_qian'];
                $log['status']  = '1';
                $log['m_make_time'] = date('Y-m-d H:i:s');
                $log['about'] = $v['type'].'投注,订单号:'.$v['did'].',金额:'.$v['money'];
                $log['type'] = '300';
                Db::table('k_money') -> insert($log);
                                
            }
            Db::commit();
        }catch (\Exception $e){
            echo $e->getMessage();  
            Db::rollback();
            return array('status'=>false,'msg'=>$e->getMessage());
        }
        return array('status' => true);
    }
  
}