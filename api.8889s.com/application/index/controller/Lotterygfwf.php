<?php
namespace app\index\controller;
use app\index\Base;
use think\Session;
use think\Db;
use think\Request;
use app\logic\betN;
use app\logic\betC;

class Lotterygfwf extends Base{
    private $uid = '';
    private $username = '';

    public function _initialize(){        
        $key = $this->request->domain().'|'.$this->request->ip().'|'.$this->request->action();
        $interval = config('bet_interval')??5;
        if(cache($key)){   
            return ['status'=>'0','msg'=>'您投注过于频繁!',];       
        }
        cache($key,1,$interval);

        parent::_initialize();
        $this->uid = Session("uid");
        $this->username = Session("username");
       
        $action = request()->action();
        $logins = ['index','postAll','getOrdered'];
        if( (!$this->uid) && in_array($action,$logins) ){
            //return ['status'=>'0','msg'=>'请登录后再进行投注!',];
            $this->error('请登录后再进行投注!','/');            
        }
    }

    public function index($type = null, $groupId = null, $played = null){
        $types = model('type')->allTypes();
        $this->view->types = $types;

        $type = input('type');
        if(!$type){
            $this->error('请选择彩种!');
        }
        if(!is_numeric($type)){
            $lottery = db('gfwf_lottery')->where('name',$type)->find();
            if(!$lottery){
                $this->error('彩种名不存在!');
            }
            $type = $lottery['id'];
        }

        $lottery = $types[$type]??null;
        if(!$lottery){
            $this->error('彩种不存在!');
        }
        $this->view->type = $type; 
        $this->view->lottery = $lottery;
        $this->view->groups = $types[$type]['groups'];

        //全部玩法组判定玩法是否存在
        $groupId = input('groupId/d');
        $group = $types[$type]['groups'][$groupId]??null;

        if(!$group){
            //$groupId = current($types[$type]['groups']); 
            $groupIds = array_keys($types[$type]['groups']);
            $groupId = $groupIds[0]; 
            $group = $types[$type]['groups'][$groupId];
        }

        $this->view->groupId = $groupId;
        $this->view->group = $group;
        $this->view->playeds = $types[$type]['groups'][$groupId]['playeds']??null;

        $playedId = input('playedId/d');
      
        $played = $types[$type]['groups'][$groupId]['playeds'][$playedId]??null;
        if(!$played){ 
            $playedIds = array_keys($types[$type]['groups'][$groupId]['playeds']);
            $playedId = $playedIds[0]; 
            $played = $types[$type]['groups'][$groupId]['playeds'][$playedId];
            $playedName = $types[$type]['groups'][$groupId]['playeds'][$playedId]['name'];
        }
   
        $this->view->playedId = $playedId;
        $this->view->played = $played;
         $this->view->playedName = $playedName;
        $this->view->tpl = 'game/game-played/'.$this->view->played['playedTpl'];

        //上期期号 和 开奖结果;
        //开奖历史

        //当期期号 开奖倒计时,封盘倒计时;


        $maxPl = db('gfwf_played')->where('id' , $playedId)->field('bonusProp,bonusPropBase')->find();
        $this->view->maxPl = $maxPl;

        
        $gid = $lottery['name'];

        $odds = new \app\logic\odds();
        $info = $odds->$gid();
        $info = json_decode($info,true);
        //['number' => $qishu,'endtime' => $fengpan,'opentime' => $kaijiang,]
        $this->view->actionNo = $info['number'];
        $this->view->fengpan = $info['endtime'];
        $this->view->diffTime = $info['opentime'];
        //$this->view->diffTime = $info['endtime'];
       // $this->view->kjDiffTime = $info['opentime'];

        $auto = new \app\logic\auto();
        $info = $auto->$gid();
        $info = json_decode($info,true);
        //['number' => $qishu,'hm' => '最近一期开奖结果','hms' => '最近一期开奖结果的描述','hmlist'=>'往期列表']
        $this->view->lastNo = $info['numbers'];
        $this->view->kjHao = $info['hm'];
        
         $this->view->mobilelist = $info['mobilelist'];

        //$this->assign('actionNo', $actionNo) ;
        //$this->assign('lastNo', $lastNo) ;
        //$this->assign('kjHao', $kjHao) ;
        //$this->assign('kjdTime', $kjdTime) ;
        //$this->assign('diffTime', $diffTime) ;
        //$this->assign('kjDiffTime', $kjDiffTime) ;            
        //$this->assign('actionNo', $actionNo) ;
        //$this->assign('lastNo', $lastNo) ;

        $this->view->order_list = db('c_bet')->where('uid',$this->uid)
        ->where('type',$lottery['title'])->where('qishu','<',$this->view->actionNo)
        ->order('id desc')->limit(10)->select();

        $this->view->order_future = db('c_bet')->where('uid',$this->uid)
        ->where('type',$lottery['title'])->where('qishu','>',$this->view->actionNo)
        ->order('id desc')->limit(10)->select();

        $this->view->time = time();


        //充值排行 和 中奖排行, 不需要;


        //  /lotterygfwf/index/type/1请求,偶尔 index/view/game/game模板找不到
        if($this->request->isMobile()){
            $view_path = APP_PATH.$this->request->module().DS.'mview'.DS;
        }else{
            $view_path = APP_PATH.$this->request->module().DS.'newview'.DS;    
        }  

        $this->view->config('view_path',$view_path);               
        return $this->fetch('game/game') ;            
    }

    public final function group($type, $groupId)
    {
        $types = model('type')->allTypes();

        $type = input('type/d');
        if(!$type){
            $this->error('请选择彩种!');
        }
        $lottery = $types[$type]??null;
        if(!$lottery){
            $this->error('彩种不存在!');
        }
        $this->view->type = $type;
        $this->view->groups = $types[$type]['groups'];
        
        $group = $types[$type]['groups'][$groupId]??null;        
        if(!$group){
            //$groupId = current($types[$type]['groups']); 
            $groupIds = array_keys($types[$type]['groups']);
            $groupId = $groupIds[0];
            $group = $types[$type]['groups'][$groupId];
        }
        $this->view->groupId = $groupId;
        $this->view->group = $group;
        $this->view->playeds = $group['playeds']??null;
        $playedIds = array_keys($this->view->playeds);
        $playedId = $playedIds[0];
        $this->view->playedName = $group['playeds'][$playedId]['name'];
        $this->view->playedId = $playedId;
        $this->view->played = $this->view->playeds[$playedId];

        $maxPl = db('gfwf_played')->where('id' , $playedId)->field('bonusProp,bonusPropBase')->find();
        $this->view->maxPl = $maxPl;
        
        $this->view->tpl = 'game/game-played/'.$this->view->played['playedTpl'];

        if($this->request->isMobile()){
            $view_path = APP_PATH.$this->request->module().DS.'mview'.DS;
        }else{
            $view_path = APP_PATH.$this->request->module().DS.'newview'.DS;    
        }

        $this->view->config('view_path',$view_path);  

        $html = $this->fetch('game/inc_game_played');
        
        echo $html; exit();
    }

    public final function played($type, $playedId)
    {
        $types = model('type')->allTypes();

        $type = input('type/d');
        if(!$type){
            return ['status'=>-1,'msg'=>'请选择彩种!!',];
        }
        $lottery = $types[$type]??null;
        if(!$lottery){
            return ['status'=>-1,'msg'=>'彩种不存在!',];
        }
        $this->view->type = $type;
        
        foreach($types[$type]['groups'] as $groupId => $group){
            if($group['playeds'][$playedId]??null){
                
                $this->view->groupId = $groupId;
                $this->view->playedId = $playedId;

                $this->view->playedName = $group['playeds'][$playedId]['name'];
                $this->view->played = $group['playeds'][$playedId];
              
                $this->view->tpl = 'game/game-played/'.$this->view->played['playedTpl'];
                break;
            }
        }

        if(!isset($this->view->playedId)){
            return ['status'=>-1,'msg'=>'玩法不存在!',];
        }

        $maxPl = db('gfwf_played')->where('id' , $playedId)->field('bonusProp,bonusPropBase')->find();
        $this->view->maxPl = $maxPl;

        if($this->request->isMobile()){
            $view_path = APP_PATH.$this->request->module().DS.'mview'.DS;
        }else{
            $view_path = APP_PATH.$this->request->module().DS.'newview'.DS;    
        }
        $this->view->config('view_path',$view_path);  

        $html = $this->fetch('game/inc_game_content');
        echo $html; exit();        
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
            return json_encode($ret)  ;  
        }catch (\Exception $e) {
            db()->rollback();
            $ret['info'] = $e->getMessage() ;
            return json_encode($ret) ;
        }        
        //return $ret; //返回数组,被自动转为json字符串{"status":1,"info":"投注成功"}
        //问题是前端使用eval函数解析, var data = eval('('+res+')') ;
        //必须使用这种格式:  "{\"status\":1,\"info\":\"\\u6295\\u6ce8\\u6210\\u529f\"}"
    }

    public final function getNo($type)
    {
        $types = model('type')->allTypes();

        //$type = input('type');
        if(!$type){
            //$this->error('请选择彩种!');
            echo json_encode([]);
        }
        if(!is_numeric($type)){
            $lottery = db('gfwf_lottery')->where('name',$type)->find();
            if(!$lottery){
                //$this->error('彩种名不存在!');
                echo json_encode([]);
            }
            $type = $lottery['id'];
        }

        $lottery = $types[$type]??null;
        if(!$lottery){
            //$this->error('彩种不存在!');
            echo json_encode([]);
        }

        $gid = $lottery['name'];

        $odds = new \app\logic\odds();
        $info = $odds->$gid();
        
        $info = json_decode($info,true);
        //['number' => $qishu,'endtime' => $fengpan,'opentime' => $kaijiang,]
        //opentime开奖时间倒计时
        //{"actionNo":"20180120-050","actionTime":1516429200}
        //actionTime当前开奖时间戳
        $actionNo = [];
        $actionNo['actionNo'] = $info['number'];
        $actionNo['actionTime'] = $info['opentime'] + time(); 
        $actionNo['endtime'] = $info['endtime'];
        $actionNo['opentime'] = $info['opentime'];
        $auto = new \app\logic\auto();
        $info = $auto->$gid();
        $info = json_decode($info,true);
        //['number' => $qishu,'hm' => '最近一期开奖结果','hms' => '最近一期开奖结果的描述','hmlist'=>'往期列表']
         $actionNo['mobilelist'] = $info['mobilelist'];
        echo json_encode($actionNo);
    }

    public function getLastKjData()
    {
        $types = model('type')->allTypes();

        $type = input('type');
        if(!$type){
            //$this->error('请选择彩种!');
            echo json_encode([]);
        }
        if(!is_numeric($type)){
            $lottery = db('gfwf_lottery')->where('name',$type)->find();
            if(!$lottery){
                //$this->error('彩种名不存在!');
                echo json_encode([]);
            }
            $type = $lottery['id'];
        }

        $lottery = $types[$type]??null;
        if(!$lottery){
            //$this->error('彩种不存在!');
            echo json_encode([]);
        }

        $gid = $lottery['name'];
        $odds = new \app\logic\odds();
        $info = $odds->$gid();
        $info = json_decode($info,true);

        $lastNo = [];
        $lastNo['actionName'] = $lottery['title'];
        $lastNo['thisNo']     = $info['number'];
        $lastNo['diffTime']   = $info['opentime'];

        $auto = new \app\logic\auto();
        $info = $auto->$gid();
        $info = json_decode($info,true);
        $lastNo['data'] = implode(',',$info['hm']);

        echo json_encode($lastNo);exit();
    }

    public function getQiHao($type){

        $types = model('type')->allTypes();

        if(!$type){
            echo json_encode([]);
        }
        if(!is_numeric($type)){
            $lottery = db('gfwf_lottery')->where('name',$type)->find();
            if(!$lottery){
                echo json_encode([]);
            }
            $type = $lottery['id'];
        }

        $lottery = $types[$type]??null;
        if(!$lottery){
            echo json_encode([]);
        }

        $gid = $lottery['name'];

        $odds = new \app\logic\odds();
        $info = $odds->$gid();
        $info = json_decode($info,true);        
        $thisNo = ['actionNo' => $info['number'],];
        
        $kjdTime = $info['opentime'] - $info['endtime'];//提前封盘时间
        $diffTime = $info['opentime']; 
    
        $auto = new \app\logic\auto();
        $info = $auto->$gid();
        $info = json_decode($info,true);
        $lastNo = ['actionNo' => $info['numbers'],];

        $data = ['lastNo'=>$lastNo,'thisNo'=>$thisNo,
                'diffTime'=>$diffTime,'kjdTime'=>$kjdTime,];

        echo json_encode($data);
    }

    public function getOrdered(){
        $this->view->order_list = db('c_bet')->where('uid',$this->uid)->order('id desc')->limit(10)->select();
        $this->view->time = time();

        echo  $this->fetch('game/inc_game_order');
        exit();
    }

    public function odds(){
        $odds = cache('gfwf_odds');
        if(empty($odds)){
            $ssc  = db('gfwf_group')->where('type',1)->where('type',1)
            ->field('id,groupName')->order('sort')->select();
            foreach ($ssc as &$group) {
                $group['playeds'] = db('gfwf_played')->where('enable',1)->where('groupId',$group['id'])
                ->field('id,name,bonusPropBase,playedTpl')->order('sort')->select();
            }
            $pk10 = db('gfwf_group')->where('type',6)->field('id,groupName')->order('sort')->select();
            foreach ($pk10 as &$group) {
                $group['playeds'] = db('gfwf_played')->where('enable',1)->where('groupId',$group['id'])
                ->field('id,name,bonusPropBase,playedTpl')->order('sort')->select();
            }
            $odds = ['ssc'=>$ssc,'pk10'=>$pk10,];
            cache('gfwf_odds',$odds,3600);
        }
        //\think\Response::create($odds, 'json');
        config('default_return_type','json');
        return $odds;
        
    }

    //旧版
    public function bet($type){
        if(!in_array($type,['cqssc','xjssc','pk10'])){
            return ['status'=>'0','msg'=>"彩种不支持官方玩法！",];
        }
        $types = ['cqssc'=>'重庆时时彩',
            'xjssc'=>'新疆时时彩',
            'pk10'=>'北京PK拾',
        ];
        $type_name = $types[$type];

        $qishu = \app\logic\qishu::$type();
        if($qishu==-1){
            return ['status'=>'0','msg'=>"已经封盘，禁止下注！",];
        }
        
        $betinfo = [];

        $code = $_POST['code']??[];

        $keys = array_keys($code);
        $avail_keys = ['playedId','playedName','actionData','weiShu','actionNum','beiShu','bonusProp','mode','actionNo'];
        $diff = array_diff($avail_keys,$keys);
        if(!empty($diff)){
            return ['status'=>'0','msg'=>"缺少参数！",];
        }

        //{playedId:2,playedName:"五星复式",actionData:"1,2,3,4,5",weiShu:0,actionNum:1,beiShu:1,bonusProp:"1788.00",mode:2,'actionNo':20171218089};

        if( intval($qishu) > intval($code['actionNo']) ){
            return ['status'=>'0','msg'=>'投注失败：该期投注时间已过',];         
        }

        //$played = db('gfwf_played')->where('id',$code['playedId'])->find();
        $this->getPlayeds();
        $played = $this->playeds[$code['playedId']];
        
        // 检查玩法
        if(!$played){
            return ['status'=>'0','msg'=>'玩法不存在!',];
        }
        if($played['name'] != $code['playedName']){
            return ['status'=>'0','msg'=>'玩法名错误!',];
        }

        // 检查开启
        if (! $played['enable']){
            return ['status'=>'0','msg'=>'游戏玩法已停,请刷新再投',];            
        }
        
        // 检查赔率
        if ($code['bonusProp'] != $played['bonusPropBase']){
            return ['status'=>'0','msg'=>'赔率有误!',];           
        }

        // 检查倍数
        if (intval($code['beiShu']) < 1){
            return ['status'=>'0','msg'=>'倍数只能为大于1正整数',];            
        }

        // 检查模式
        $mode = floatval($code['mode']);
        if(!in_array($mode,[2,0.2,0.02,0.002])){
            return ['status'=>'0','msg'=>'模式不合法',];            
        }

        // 检查注数
        if ($betCountFun = $played['betCountFun']) {
           if ($played['betCountFun'] == 'descar') {
                if ($code['actionNum'] > gfwf::$betCountFun($code['actionData'])){
                    return ['status'=>'0','msg'=>'提交数据出错，请重新投注',];
                }            
            } else if ($played['betCountFun'] == 'descar2') {
                if ($code['actionNum'] < 1){
                    return ['status'=>'0','msg'=>'提交数据出错，请重新投注',];
                }
            } else {
                if ($code['actionNum'] != gfwf::$betCountFun($code['actionData'])){
                    return ['status'=>'0','msg'=>'提交数据出错，请重新投注',];        
                }
            }
        } // /end

        //检查任选
        if (strpos($played['name'], "任选") > - 1 && $played['type'] == 1) {
            // 检查任选的万千百十个位数是否作弊
            if ($code['weiShu'] != 0 && $code['weiShu'] != 3 && $code['weiShu'] != 5 && $code['weiShu'] != 6 && $code['weiShu'] != 7 && $code['weiShu'] != 9 && $code['weiShu'] != 10 && $code['weiShu'] != 11 && $code['weiShu'] != 19 && $code['weiShu'] != 14 && $code['weiShu'] != 22 && $code['weiShu'] != 28 && $code['weiShu'] != 12 && $code['weiShu'] != 13 && $code['weiShu'] != 17 && $code['weiShu'] != 18 && $code['weiShu'] != 20 && $code['weiShu'] != 21 && $code['weiShu'] != 25 && $code['weiShu'] != 26 && $code['weiShu'] != 15 && $code['weiShu'] != 23 && $code['weiShu'] != 30 && $code['weiShu'] != 29 && $code['weiShu'] != 27){
                return ['status'=>'0','msg'=>'提交数据出错，请重新投注',]; 
            }

            // 任选四复式
            if ($played['id'] == 8) {
                str_replace("-", "#", $code['actionData'], $num);
                if ($num > 1){
                    return ['status'=>'0','msg'=>'提交数据出错，请重新投注',]; 
                }
            }
            // 任选三复式
            if ($played['id'] == 14) {
                str_replace("-", "#", $code['actionData'], $num);
                if ($num > 2){
                    return ['status'=>'0','msg'=>'提交数据出错，请重新投注',]; 
                }
            }
            // 任选二复式
            if ($played['id'] == 29) {
                str_replace("-", "#", $code['actionData'], $num);
                if ($num > 3){
                    return ['status'=>'0','msg'=>'提交数据出错，请重新投注',];
                }
            }
            // 任选二大小单双
            if ($played['id'] == 44) {
                str_replace("-", "#", $code['actionData'], $num);
                if ($num > 3){
                    return ['status'=>'0','msg'=>'提交数据出错，请重新投注',];        
                }
            }

            if ($played['id'] == 9) {
                if ($code['weiShu'] != 15 && $code['weiShu'] != 23 && $code['weiShu'] != 27 && $code['weiShu'] != 29 && $code['weiShu'] != 30){
                    return ['status'=>'0','msg'=>'提交数据出错，请重新投注',]; 
                }
            }

            if ($played['id'] == 15 || $played['id'] == 22 || $played['id'] == 23 || $played['id'] == 24 || $played['id'] == 41) {
                       if ($code['weiShu'] != 7 && $code['weiShu'] != 11 && $code['weiShu'] != 13 && $code['weiShu'] != 14 && $code['weiShu'] != 19 && $code['weiShu'] != 21 && $code['weiShu'] != 22 && $code['weiShu'] != 25 && $code['weiShu'] != 26 && $code['weiShu'] != 28){
                            return ['status'=>'0','msg'=>'提交数据出错，请重新投注',];
                        }
            }

            if ($played['id'] == 30 || $played['id'] == 35 || $played['id'] == 36) {
                if ($code['weiShu'] != 3 && $code['weiShu'] != 5 && $code['weiShu'] != 6 && $code['weiShu'] != 9 && $code['weiShu'] != 10 && $code['weiShu'] != 12 && $code['weiShu'] != 17 && $code['weiShu'] != 18 && $code['weiShu'] != 20 && $code['weiShu'] != 24){
                    return ['status'=>'0','msg'=>'提交数据出错，请重新投注',];
                }
            }

            // 11x5 bug
            if (strpos($played['name'], "任选") > - 1 && $played['type'] == 2) {
                if (! strstr($code['actionData'], ' ')){
                    return ['status'=>'0','msg'=>'提交数据出错，请重新投注',];
                }
                   
                // 检查任选的投注号码是否重复的作弊
                foreach (explode(' ', $code['actionData']) as $d) {
                    str_replace($d, "#", $code['actionData'], $num);
                    if ($num > 1){
                        return ['status'=>'0','msg'=>'提交数据出错，请重新投注',];
                    }
                }
            }
            // 11x5 bug
            if (strpos($played['name'], "组选") > - 1 && $played['type'] == 2) { // $this->error("222");
                if (!strstr($code['actionData'], ' ')){
                    return ['status'=>'0','msg'=>'提交数据出错，请重新投注',];
                }
                // 检查任选的投注号码是否重复的作弊
                foreach (explode(' ', $code['actionData']) as $d) {
                    str_replace($d, "#", $code['actionData'], $num);
                    if ($num > 1){
                        return ['status'=>'0','msg'=>'提交数据出错，请重新投注',];
                    }
                }
            }
        }

        $odds = $code['bonusProp'];//$played['bonusPropBase'];
        //取最小赔率,因为返点机制不一样;
        $money = $code['actionNum']*$code['beiShu']*$code['mode'];
        //结算前无法确定可赢金额,
        $qiuhao = $code['playedName'];
        $wanfa = $code['actionData'];
        $actionNum = $code['actionNum']; 

        $betinfo[] = array(
            'uid'       => $this->uid,
            'username'  => $this->username,
            'gfwf'      => 1,             //默认0
            'playedId'  => $code['playedId'],
            //添加官方玩法字段区分注单,
            //快钱玩法win字段在结算后被修改,不能作为划分标志
            //可赢金额与倍数和模式 以及投注数 有关
            'type'      => $type_name,
            'qishu'     => $qishu,
            'mingxi_1'  => $qiuhao,
            'mingxi_2'  => $wanfa,
            'odds'      => $odds,
            'money'     => $money,
            'win'       => 0,   //
            'actionNum' => $actionNum,      //默认1
            'beiShu'    => $code['beiShu'], //默认1
            'mode'      => $code['mode'],   //默认2
            'weiShu'    => $code['weiShu'], //默认0
        );
 
        $return = $this->add_bet($betinfo);
        if(!$return['status']){
            return ['status'=>'0','msg'=>$return['msg'],];
        }
        /*
        $this->assign('betinfo',$betinfo);
        $this->assign('ballname',$ball_name['name']);
        return $this->fetch('result');
        $html = $this->fetch('result');
        if(request()->isAjax()){
            return ['status'=>1,'text'=>$html];//手机站
        }else{
            return $html;
        }
        */       
        return ['status'=>1,'data'=>$betinfo,];
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

   // 弹出追号层HTML
    public  function zhuiHaoModal(){
        echo $this->fetch('game/zuihao') ;    
        exit;       
    }

  // 追号层加载期号
  // $type : 彩票种类
  // $count ： 显示多少期数
  // $actionNum : 当前期数
  // $time
    public  function zhuiHaoQs($type,$price,$beishu,$actionNum,$count){
       
        date_default_timezone_set('PRC');
        $type = input('type');
        $price = input('price');
        $beishu =  input('beishu');
         $actionNum =  input('actionNum');
        $count = input('count');
        $list = [];
        if(!$count){
             $count = 0;
        }
         $betQ = new \app\logic\betQ();
        //重庆时时彩未来期号
        //
        if($type == '3'){
            $list = $betQ::pk10($type,$actionNum,$price,$beishu,$count);
        }else{
            $list = $betQ::ssc($type,$actionNum,$price,$beishu,$count);
        }
       
         
    
        $this->assign('list', $list);
        echo $this->fetch('game/zuihao_qs') ;    
       // echo $this->fetch('game/zuihao_qs') ;    
        exit;  
    }
    //playid ： 玩法ID
   public  function  getgfwfrandom($playid){
         $playid = input('playid');
         if(!$playid){
            $playid = 2;    
         }
        $playinfo =  Db::table('gfwf_played')->field('selectNum,weishu,randomSscFun')->where('id','eq',$playid)->find();
        $randomSscFun =  $playinfo['randomSscFun'];
        $random = new \app\logic\random();
        $info = $random::$randomSscFun($playinfo['selectNum'],$playinfo['weishu']);
        return json_encode( $info);
   }
        
}