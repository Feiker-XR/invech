<?php
namespace app\agent\controller;
use app\agent\Login;
use think\Cache;
class Member extends Login{
    
    public function index(){
        $agentid = session('agentid');
        $param = $this->request->param();

        $where['top_uid'] = $agentid;
        if($param['username']??''){
            $where['username'] = ['like','%'.$param['username'].'%'];
        }
        config('paginate.query',$param);
        $this->view->members = db('k_user')->where($where)->order('uid desc')->paginate(2);
        $this->view->page_header = '会员列表';

        return $this->fetch();
    }

    public function avail(){
        $agentid = session('agentid');

        $now_date = date("Y-m", time());
        $date = input('date',$now_date);
        $firstday = $date.'-01';
        $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));

        $uids = db('k_user')->where('top_uid',$agentid)->column('uid');

        //体育,串关,彩票,真人;
        $ty = db('k_bet')
        ->where('uid','IN',$uids)
        ->where('bet_time','>=',$firstday . ' 00:00:00')
        ->where('bet_time','<=',$lastday . ' 23:59:59')
        ->where('status','in',[1,2,4,5])
        ->group('uid')->field('uid,sum(bet_money) as bet,sum(win) as win')->select();
        $ty_map = [];
        foreach ($ty as $key => $value) {
            $ty_map[$value['uid']] = $value;
        }

        $tycg = db('k_bet_cg_group')
        ->where('uid','IN',$uids)
        ->where('bet_time','>=',$firstday . ' 00:00:00')
        ->where('bet_time','<=',$lastday . ' 23:59:59')
        ->where('status',1)
        ->group('uid')->field('uid,sum(bet_money) as bet,sum(win) as win')->select();
        $tycg_map = [];
        foreach ($tycg as $key => $value) {
            $tycg_map[$value['uid']] = $value;
        }

        $agzr = db('k_user')->alias('u')
        ->join('ag_gameresult ag', 'u.username = ag.username')
        ->where('uid','IN',$uids)
        ->where('betTime','>=',$firstday . ' 00:00:00')
        ->where('betTime','<=',$lastday . ' 23:59:59')
        ->group('uid')->field('uid,SUM(validBetAmount) as bet,SUM(netAmount) as win')->select();
        $agzr_map = [];
        foreach ($agzr as $key => $value) {
            $agzr_map[$value['uid']] = $value;
        }

        $cp = db('c_bet')
        ->where('uid','IN',$uids)
        ->where('addtime','>=',$firstday . ' 00:00:00')
        ->where('addtime','<=',$lastday . ' 23:59:59')
        ->where('js',1)
        ->group('uid')->field('uid,sum(money) as bet,sum(win) as win')->select();
        $cp_map = [];
        foreach ($cp as $key => $value) {
            $cp_map[$value['uid']] = $value;
        }

        $avail_uids = array_merge(array_keys($ty_map),array_keys($tycg_map),array_keys($agzr_map),array_keys($cp_map));
        $avail_uids = array_unique($avail_uids);

        $result = [];
        foreach($avail_uids as $uid){
            $username = db('k_user')->where('uid',$uid)->value('username');
            $result[$uid] = [
                'uid'=>$uid,
                'username'=>$username,
                'ty_bet'=>$ty_map[$uid]['bet']??0,
                'ty_win'=>$ty_map[$uid]['win']??0,
                'tycg_bet'=>$tycg_map[$uid]['bet']??0,
                'tycg_win'=>$tycg_map[$uid]['win']??0,
                'agzr_bet'=>$agzr_map[$uid]['bet']??0,
                'agzr_win'=>$agzr_map[$uid]['win']??0,
                'cp_bet'=>$cp_map[$uid]['bet']??0,
                'cp_win'=>$cp_map[$uid]['win']??0,
            ];
        }

        $this->view->result = $result;
        $this->view->page_header = '有效会员列表';

        return $this->fetch();
    }
  
}