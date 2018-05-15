<?php
//
//                                  _oo8oo_
//                                 o8888888o
//                                 88" . "88
//                                 (| -_- |)
//                                 0\  =  /0
//                               ___/'==='\___
//                             .' \\|     |// '.
//                            / \\|||  :  |||// \
//                           / _||||| -:- |||||_ \
//                          |   | \\\  -  /// |   |
//                          | \_|  ''\---/''  |_/ |
//                          \  .-\__  '-'  __/-.  /
//                        ___'. .'  /--.--\  '. .'___
//                     ."" '<  '.___\_<|>_/___.'  >' "".
//                    | | :  `- \`.:`\ _ /`:.`/ -`  : | |
//                    \  \ `-.   \_ __\ /__ _/   .-` /  /
//                =====`-.____`.___ \_____/ ___.`____.-`=====
//                                  `=---=`
//
//
//               ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//
//                          佛祖保佑         永不宕机/永无bug
// +----------------------------------------------------------------------
// | FileName: Fs.php
// +----------------------------------------------------------------------
// | CreateDate: 2018年4月17日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\admin\controller;
use app\admin\Login;
use think\Db;
class fs extends Login{
    
    //第一步统计并计算
    //第二步选择会员进行反水
    //第三步
    
    public function index(){
        return $this->fetch();
    }
    
    
    public function js($platform,$gametype,$starttime = '',$endtime = ''){
        //获取指定类型游戏的反水设置,
        //获取所有会员此类游戏的总投注
        $starttime = date('Y-m-d 00:00:00',strtotime($starttime));
        $endtime = date('Y-m-d 23:59:59',strtotime($endtime));
        $gameplatinfo = db('v_gameplatform')->where('platform_id','eq',$platform)->where('gametype','eq',$gametype)->find();
        $platform = $gameplatinfo['plateform'];
        $plateformname = $gameplatinfo['plateformname'];
        $gametypename = $gameplatinfo['gametypename'];
        $fsbili = db('fs_group')->where([
            'plateformname'=>['eq',$plateformname],
            'gametype' => ['eq',$gametype]
        ])->select(); //
        $fsbili = $this->formatFsRate($fsbili);
        if(in_array($plateformname, ['MG','PT','BBIN','OG','AG'])){
            $where = [
                'platform' => ['eq',$platform],
                'gametype' => ['eq',$gametype],
                'isFs' => ['eq',0]
            ];
            $list = db('live_data')->whereTime('betTime', 'between',[$starttime,$endtime])
            ->where($where)
            ->group('username')->field(['sum(validBetAmount) as totalBetAmount','username','betDate'])->select();
        }else{
            $where = [
                'isFs' => ['eq',0],
                'status' => ['in',[1,2,4,5]],
            ];
            $list = db('bet_user')->where($where) -> whereTime('bet_time','between',[$starttime,$endtime])
            ->field(['sum(validBetAmount) as totalBetAmount','username','betDate','uid'])->group('username')->select();
            //echo $list ;exit;
        }
        $users = [];
        foreach($list as $k => $v){
            $users[] = $v['username'];
        }
        //unset($k);
        //unset($v);
        $user_gids = db('k_user')->where('username','in',$users)->field(['username','gid'])->select();
        $user_gid = [];
        foreach($user_gids as $k=>$v){
            $user_gid[strtolower($v['username'])] = $v['gid'];
        }
        //unset($k);
        //unset($v);
        $group_infos = db('k_group')->field(['id','name'])->select();
        $group_info = [];
        foreach($group_infos as $v){
            $group_info[$v['id']] = $v['name'];
        }
        foreach($list as $k => $v){
            $fsrate = $this->getRate($fsbili, $v['totalBetAmount'], $user_gid[strval(strtolower($v['username']))]);
            $list[$k]['fsRate'] = $fsrate;
            $list[$k]['gid'] = $user_gid[strtolower($v['username'])];
            if(in_array($plateformname, ['MG','PT','BBIN','OG','AG'])){
                db('live_data')->where('betTime', 'between',[$starttime,$endtime])
                ->where($where)->where('username','eq',$v['username'])->update(['fsRate'=>$fsrate,'fsMoney'=>['exp','fsRate*validBetAmount']]);
            }else{
                db('k_bet')->where('bet_time', 'between',[$starttime,$endtime])
                ->where($where)->where('uid','eq',$v['uid'])->update(['fsRate'=>$fsrate,'fsMoney'=>['exp','fsRate*validBetAmount']]);
            }
            
        }
        $this->assign('platform',$platform);
        $this->assign('gametype',$gametype);
        $this->assign('plateformname',$plateformname);
        $this->assign('gametypename',$gametypename);
        $this->assign('group_info',$group_info);
        $this->assign('list',$list);
        $this->assign('starttime',$starttime);
        $this->assign('endtime',$endtime);
        return $this->fetch();
        // $this->getRate($fsbili, $totalBetAmount, $gid);
        
        
    }
    
    public function paifa($platform,$gametype,$starttime,$endtime){
        $usernames = $_REQUEST['username'];
        $gameplatinfo = db('v_gameplatform')->where('plateform','eq',$platform)->where('gametype','eq',$gametype)->find();
        $plateformname = $gameplatinfo['plateformname'];
        $gametypename = $gameplatinfo['gametypename'];
        $fsbili = db('fs_group')->where([
            'plateformname'=>['eq',$plateformname],
            'gametype' => ['eq',$gametype]
        ])->select();
        $fsbili = $this->formatFsRate($fsbili);
        if(in_array($plateformname, ['MG','PT','BBIN','OG','AG'])){
            $where = [
                'platform' => ['eq',$platform],
                'gametype' => ['eq',$gametype],
                'username' => ['in',$usernames],
                'isFs' => ['eq',0]
            ];
            $list = db('live_data')->whereTime('betTime', 'between',[$starttime,$endtime])
            ->where($where)
            ->group('username')->field(['sum(validBetAmount) as totalBetAmount','username','betDate'])->select();
            $users = [];
            foreach($list as $k => $v){
                $users[] = $v['username'];
            }
            unset($k);
            unset($v);
            $user_gids = db('k_user')->where('username','in',$users)->field(['username','gid','uid'])->select();
            $user_gid = [];
            foreach($user_gids as $k=>$v){
                $user_gid[strtolower($v['username'])] = $v['gid'];
                $user_uid[strtolower($v['username'])] = $v['uid'];
            }
            unset($k);
            unset($v);
            $group_infos = db('k_group')->field(['id','name'])->select();
            $group_info = [];
            foreach($group_infos as $v){
                $group_info[$v['id']] = $v['name'];
            }
            foreach($list as $k => $v){
                $fsrate = $this->getRate($fsbili, $v['totalBetAmount'], $user_gid[strval(strtolower($v['username']))]);
                $list[$k]['fsRate'] = $fsrate;
                $list[$k]['gid'] = $user_gid[strtolower($v['username'])];
                db('live_data')->where('betTime', 'between',[$starttime,$endtime])
                ->where($where)->where('username','eq',$v['username'])->update([
                    'fsRate'=>$fsrate,
                    'fsMoney'=>['exp','fsRate*validBetAmount'],
                    'fsTime' => date('Y-m-d H:i:s',time() + 12*3600),
                    'isFs' => 1
                ]);
                $fsMoney = sprintf('%0.2f',$v['totalBetAmount'] * $fsrate);
                
                
                $pre_money = db('k_user')->where('username','eq',$v['username'])->field(['money'])->find();
                db('k_user')->where('username','eq',$v['username'])->update(['money'=>['exp','money+'.$fsMoney]]);
                $insertData = [
                    'm_order' => 'FS'.strtoupper(uniqid()).rand(100,999),
                    'status' => 1,
                    'about' => $plateformname.$gametypename.$starttime.'-'.$endtime."返水{$fsMoney}元!",
                    'type' =>600,
                    'assets' => $pre_money['money'],
                    'balance' =>($pre_money['money'] + $fsMoney),
                    'm_value' => $fsMoney,
                    'uid' => $user_uid[strtolower($v['username'])]
                    ];
                db('k_money')->insert($insertData);
                msg_add($user_uid[strtolower($v['username'])], '系统消息', $insertData['about'], '尊贵的会员,您于'.$starttime.'-'.$endtime.'在'.$plateformname.$gametypename.'游戏的返水'.$fsMoney.',请您查收,祝您游戏愉快!');
            }
            echo '<script>alert("派发完成!");window.location="/fs/index/"</script>';
            exit;
        }
        
    }
    
    protected function formatFsRate($data){
        $tmp =[];
        foreach($data as $v){
            $tmp[$v['gid']][] = $v;
        }
        return $tmp;
    }
    
    protected function getRate(array $arr,float $totalBetAmount,$gid){
        if(!isset($arr[$gid])){
            return 0;
        }
        foreach ($arr[$gid] as $k => $v){
            if(($totalBetAmount >= $v['minBetAmount'] && $totalBetAmount < $v['maxBetAmount']) ||
                ($totalBetAmount > $v['minBetAmount'] && $v['maxBetAmount'] == 0))
                return $v['rate'];
        }
        return 0;
    }
    
    
}