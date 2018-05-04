<?php
namespace app\admin\controller;
use app\admin\Login;
class live extends Login{
    
    
    public function transfer(){
        $param = input('param.');
        $platform = $param['platform'] ?? '';
        $transType = $param['transType'] ?? '';
        $transType = trim($transType);
        $username = $param['username'] ?? '';
        $s_time = $param['s_time'] ?? '';
        $e_time = $param['e_time'] ?? '';
        $conf = [];
        $where = [];
        $where2 = [];
        $types = [
            'AG'    => ['IN'=>12,'OUT'=>22],
            'BB'    => ['IN'=>111,'OUT' => 222],
            'MG'    => ['IN'=>13,'OUT'=>23],
            'PT'    => ['IN'=>77,'OUT'=>87],
        ];
        $allin = [];
        $allout = [];
        foreach ($types as $v){
            $allin[] = $v['IN'];
            $allout[] = $v['OUT'];
        }
        if($platform){
            //$where['platform'] = ['eq',$platform];
            $where['type'] = ['in',array_values($types[$platform])];
            $conf['platform'] = $platform;
        }
        if($transType){
            //$where['transType'] = ['eq',$transType];
            if($platform){
                $where['type'] = ['in',$types[$platform][$transType]]; 
            }else{
                if($transType == 'IN'){
                    $where['type'] = ['in',$allin];
                }else{
                    $where['type'] = ['in',$allout];
                }
            }
            $conf['transType'] = $transType;
        }
        if($username){
            $where['username'] = ['eq',$username];
            $conf['username'] = $username;
        }
        if($s_time){
            $where['actionTime'] = ['gt',strtotime($s_time.' 00:00:00')];
            $conf['s_time'] = $s_time;
        }
        if($e_time){
            $where2['actionTime'] = ['lt',strtotime($e_time .' 23:59:59')];
            $conf['e_time'] = $e_time ;
        }
        $live = new \app\model\livezz();
        if($where){
            $live->where($where);
        }
        if($where2){
            $live ->where($where2);
        }
        config('paginate.query',$conf);
        $list = $live->order('actionTime desc')->paginate(20);
        //$call = $live ->sum('amount');
        $zhuanru_all = $live->where('type','in',$allin)->sum('amount');
        $zhuanchu_all = $live->where('type','in',$allout)->sum('amount');
        //$this->assign('call',$call);
        $this->assign('zhuanru_all', $zhuanru_all ?? 0);
        $this->assign('zhuanchu_all',$zhuanchu_all ?? 0);
        $this->assign('username',$username);
        $this->assign('platform',$platform);
        $this->assign('transType',$transType);
        $this->assign('s_time',$s_time);
        $this->assign('e_time',$e_time);
        $this->assign('list',$list);
        return $this->fetch();
    }
    
    public function aglist(){
        include_once (COMM_PATH.'live/agConfig/ag.function.php');
        $plateform = include_once (COMM_PATH."live/agConfig/plateformname.php");
        $gamename = include_once(COMM_PATH.'live/agConfig/gamename.php');
        $slottype = include_once COMM_PATH.'live/agConfig/slottype.php';
        $flag = include_once COMM_PATH.'live/agConfig/flag.php';
        $playtype = include_once COMM_PATH.'live/agConfig/playtype.php';
        $ag = new \app\model\ag();
        $param = $this->request->param();
        $username = $param['username'] ?? '';
        $billNo = $param['billNo'] ?? '';
        $s = $param['s'] ?? '';
        $end = $param['e'] ?? '';
        $where = [];
        $where2 = [];
        $conf = [];
        if($username){
            $where['username'] = ['eq',$username];
            $conf['username'] = $username;
        }
        if($billNo){
            $where['billNo|gameCode'] = ['eq',$billNo];
            $conf['billNo'] = $billNo;
        }
        if($s){
            $where['betTime'] = ['gt',$s.' 00:00:00'];
            $conf['s'] = $s;
        }
        if($end){
            $where2['betTime'] = ['lt',$end.' 23:59:59'];
            $conf['e'] = $end;
        }
        if($where){
            $ag->where($where);
        }
        if($where2){
            $ag->where($where2);
        }
        $list = $ag->order('id desc')->paginate(20);
        $extral = [];
        foreach($list as $k => $rows){
            $extral[$k]['playtypename'] = $playtype[convertType($rows['gameType'])][$rows['playType']] ?? '未知的'.$rows['gameType'];
            $extral[$k]['gamename'] = $gamename[$rows['gameType']] ?? '未知的'.$rows['gameType'];
            $extral[$k]['moneycolor'] = $rows['netAmount'] >= 0 ? 'black' : 'red';
            switch ($extral[$k]['playtypename']){
                case '庄':
                case '庄对':
                case '庄保險':
                case '庄免佣':
                case '庄龙宝':
                case '大':
                    $typecolor ="red";
                    break;
                case '闲':
                case '闲对':
                case '闲保險':
                case '闲龙宝':
                case '小':
                    $typecolor = "blue";
                    break;
                case '和':
                    $typecolor = "green";
                    break;
                default:
                    $typecolor = 'black';
                    break;
            }
            $extral[$k]['typecolor'] = $typecolor;
        }
        if($where){
            $ag->where($where);
        }
        if($where2){
            $ag->where($where2);
        }
        $result_sum = $ag->field(['sum(betAmount) as bet1','sum(validBetAmount) as bet','sum(netAmount) as win'])->find();
        $this->assign('list',$list);
        $this->assign('result_sum',$result_sum);
        $this->assign('billNo',$billNo);
        $this->assign('s',$s);
        $this->assign('e',$end);
        $this->assign('username',$username);
        $this->assign('moneycolor','');
        $this->assign('typecolor','');
        $this->assign('playtypename','');
        $this->assign('gamename',$gamename);
        $this->assign('plateform',$plateform);
        $this->assign('slottype',$slottype);
        $this->assign('flag',$flag);
        $this->assign('extral',$extral);
        $this->assign('result_xj',['xjbet1'=>0,'xjbet'=>0,'xjwin'=>0]);
        $this->assign('playtype',$playtype);
        return $this->fetch('ag');
    }
    
    public function aghunter(){
        $aght = new \app\model\aghunter();
        $param = $this->request->param();
        $username = $param['username'] ?? '';
        $billNo = $param['billNo'] ?? '';
        $s = $param['s'] ?? '';
        $end = $param['e'] ?? '';
        $where = [];
        $where2 = [];
        $conf = [];
        if($username){
            $where['username'] = ['eq',$username];
            $conf['username'] = $username;
        }
        if($billNo){
            $where['billNo|gameCode'] = ['eq',$billNo];
            $conf['billNo'] = $billNo;
        }
        if($s){
            $where['betTime'] = ['gt',$s.' 00:00:00'];
            $conf['s'] = $s;
        }
        if($end){
            $where2['betTime'] = ['lt',$end.' 23:59:59'];
            $conf['e'] = $end;
        }
        if($where){
            $aght->where($where);
        }
        if($where2){
            $aght->where($where2);
        }
        $list = $aght->order('id desc')->paginate(20);
        if($where){
            $aght ->where($where);
        }
        if($where2){
            $aght->where($where2);
        }
        $result_sum = $aght->field(['sum(Cost) as bet1','sum(Cost) as bet','sum(Earn) as win'])->find();
        $typename = array(
            '1'=>'場景捕魚',
            '2' => '抽獎',
            '3'	=> '轉帳',
            '7'	=> '捕魚王獎勵',
        );
        $flag  = array('0'=>'成功');
        $this->assign('typename',$typename);
        $this->assign('flag',$flag);
        $this->assign('list',$list);
        $this->assign('result_sum',$result_sum);
        $this->assign('result_xj',['xjbet1'=>0,'xjbet'=>0,'xjwin'=>0]);
        $this->assign('billNo',$billNo);
        $this->assign('s',$s);
        $this->assign('e',$end);
        $this->assign('username',$username);
        return $this->fetch();
    }
    
    public function bbin(){
        include_once (COMM_PATH."live/bbConfig/function.bbin.php");
        $gamename = include_once(COMM_PATH.'live/bbConfig/gamename.php');
        $playtype = include_once COMM_PATH.'live/bbConfig/playtype.php';
        $resultType = include_once COMM_PATH.'live/bbConfig/resultType.php';
        $bbin = new \app\model\bbin();
        $param = $this->request->param();
        $username = $param['username'] ?? '';
        $billNo = $param['billNo'] ?? '';
        $s = $param['s'] ?? '';
        $end = $param['e'] ?? '';
        $where = [];
        $where2 = [];
        $conf = [];
        if($username){
            $where['username'] = ['eq',$username];
            $conf['username'] = $username;
        }
        if($s){
            $where['WagersDate'] = ['gt',$s.' 00:00:00'];
            $conf['s'] = $s;
        }
        if($end){
            $where2['WagersDate'] = ['lt',$end.' 23:59:59'];
            $conf['e'] = $end;
        }
        if($where){
            $bbin->where($where);
        }
        if($where2){
            $bbin->where($where2);
        }
        $list = $bbin->order('WagersDate desc')->paginate(20);
        $extral = [];
        foreach ($list as $k => $rows){
            $tmp = explode("*",$rows['WagerDetail']);
            //1,1:0.95,10.00,9.50*3,1:8,10.00,-10.00
            $info = '';
            foreach ($tmp as $v){
                $detail = explode(',', $v);
                $info .= @$playtype[$rows['GameType']][$detail[0]];
                $info .= ',';
            }
            $extral[$k]['info'] = trim($info,',');
            if(!empty($rows['Card']) && $rows['GameType'] == '3001'){
                $tmp = explode(",",$rows['Result']);
                $tmpz = $tmp[0];
                $tmpx = $tmp[1];
                $tmp = explode('*',$rows['Card']);
                $images = '';
                $tmpimg = array();
                foreach ($tmp as $v){
                    $imgs = explode(",",$v);
                    foreach($imgs as $i){
                        $images .= "<img src='./images/{$i}.gif' />";
                    }
                    $tmpimg[] = $images;
                    $images = '';
                }
                $extral[$k]['zxinfo'] = ['tmpz'=>$tmpz,'tmpx'=>$tmpx,'tmpimg'=>$tmpimg];
            }else{
                //var_dump(getGameType($rows['GameType']));
                $extral[$k]['resultType'] = @$resultType[getGameType($rows['GameType'])][$rows['Result']];
            }
        }
        if($where){
            $bbin ->where($where);
        }
        if($where2){
            $bbin->where($where2);
        }
        $result_sum = $bbin->field(['sum(BetAmount) as bet1','sum(Commissionable) as bet','sum(Payoff) as win'])->find();
        $this->assign('list',$list);
        $this->assign('gamename',$gamename);
        $this->assign('extral',$extral);
        $this->assign('result_sum',$result_sum);
        $this->assign('result_xj',['xjbet1'=>0,'xjbet'=>0,'xjwin'=>0]);
        $this->assign('s',$s);
        $this->assign('e',$end);
        $this->assign('username',$username);
        return $this->fetch();
        
    }
    
    public function oglist(){
        $gamename = include_once(COMM_PATH.'live/ogConfig/gamename.php');
        $GameBettingKind = include_once COMM_PATH.'live/ogConfig/GameBettingKind.php';
        $GameResult = include_once COMM_PATH.'live/ogConfig/GameResult.php';
        $ResultType = include_once COMM_PATH.'live/ogConfig/ResultType.php';
        $og = new \app\model\og();
        $param = $this->request->param();
        $username = $param['username'] ?? '';
        $billNo = $param['billNo'] ?? '';
        $s = $param['s'] ?? '';
        $end = $param['e'] ?? '';
        $where = [];
        $where2 = [];
        $conf = [];
        if($username){
            $where['username'] = ['eq',$username];
            $conf['username'] = $username;
        }
        if($billNo){
            $where['OrderNumber|GameRecordID'] = ['eq',$billNo];
            $conf['billNo'] = $billNo;
        }
        if($s){
            $where['AddTime'] = ['gt',$s.' 00:00:00'];
            $conf['s'] = $s;
        }
        if($end){
            $where2['AddTime'] = ['lt',$end.' 23:59:59'];
            $conf['e'] = $end;
        }
        if($where){
            $og->where($where);
        }
        if($where2){
            $og->where($where2);
        }
        $list = $og->order('AddTime desc')->paginate(20);
        if($where){
            $og ->where($where);
        }
        if($where2){
            $og->where($where2);
        }
        $result_sum = $og ->field(['sum(BettingAmount) as bet1','sum(ValidAmount) as bet','sum(WinLoseAmount) as win'])->find();
        $this->assign('GameBettingKind',$GameBettingKind);
        $this->assign('GameResult',$GameResult);
        $this->assign('ResultType',$ResultType);
        $this->assign('list',$list);
        $this->assign('gamename',$gamename);
        $this->assign('result_sum',$result_sum);
        $this->assign('result_xj',['xjbet1'=>0,'xjbet'=>0,'xjwin'=>0]);
        $this->assign('s',$s);
        $this->assign('e',$end);
        $this->assign('billNo',$billNo);
        $this->assign('username',$username);
        return $this->fetch();
    }
    
    public function mglist(){
        include_once (COMM_PATH.'live/mgConfig/mg.function.php');
        $mg = new \app\model\mg();
        $param = $this->request->param();
        $username = $param['username'] ?? '';
        $billNo = $param['billNo'] ?? '';
        $s = $param['s'] ?? '';
        $end = $param['e'] ?? '';
        $where = [];
        $where2 = [];
        $conf = [];
        if($username){
            $where['username'] = ['eq',$username];
            $conf['username'] = $username;
        }
        if($billNo){
            $where['OrderNumber|GameRecordID'] = ['eq',$billNo];
            $conf['billNo'] = $billNo;
        }
        if($s){
            $where['transaction_time'] = ['gt',$s.' 00:00:00'];
            $conf['s'] = $s;
        }
        if($end){
            $where2['transaction_time'] = ['lt',$end.' 23:59:59'];
            $conf['e'] = $end;
        }
        if($where){
            $mg->where($where);
        }
        if($where2){
            $mg->where($where2);
        }
        $list = $mg->order('transaction_time desc')->paginate(20);
        if($where){
            $mg ->where($where);
        }
        if($where2){
            $mg->where($where2);
        }
        $result_sum = $mg ->field(["sum(if(category='PAYOUT',amount,0)) as win","sum(if(category = 'WAGER',amount,0)) as bet"])->find();
        $this->assign('list',$list);
        $this->assign('result_sum',$result_sum);
        $this->assign('result_xj',['bet'=>0,'win'=>0]);
        $this->assign('s',$s);
        $this->assign('e',$end);
        $this->assign('billNo',$billNo);
        $this->assign('username',$username);
        $this->assign('GameName',$GameName);
        return $this->fetch();
    }
    
    public function ptlist(){
        $game_name = include(COMM_PATH.'live/ptConfig/gamename.php');
        $pt = new \app\model\pt();
        $param = $this->request->param();
        $username = $param['username'] ?? '';
        $billNo = $param['billNo'] ?? '';
        $s = $param['s'] ?? '';
        $end = $param['e'] ?? '';
        $where = [];
        $where2 = [];
        $conf = [];
        if($username){
            $where['username'] = ['eq',$username];
            $conf['username'] = $username;
        }
        if($billNo){
            $where['GAMECODE'] = ['eq',$billNo];
            $conf['billNo'] = $billNo;
        }
        if($s){
            $where['GAMEDATE'] = ['gt',$s.' 00:00:00'];
            $conf['s'] = $s;
        }
        if($end){
            $where2['GAMEDATE'] = ['lt',$end.' 23:59:59'];
            $conf['e'] = $end;
        }
        if($where){
            $pt->where($where);
        }
        if($where2){
            $pt->where($where2);
        }
        $list = $pt->order('GAMEDATE desc')->paginate(20);
        if($where){
            $pt ->where($where);
        }
        if($where2){
            $pt->where($where2);
        }
        $result_sum = $pt ->field(["sum(WIN) as win ","sum(BET) as bet"])->find();
        $this->assign('list',$list);
        $this->assign('result_sum',$result_sum);
        $this->assign('result_xj',['bet'=>0,'win'=>0]);
        $this->assign('s',$s);
        $this->assign('e',$end);
        $this->assign('billNo',$billNo);
        $this->assign('username',$username);
        $this->assign('game_name',$game_name);
        return $this->fetch();
    }
  
    
}