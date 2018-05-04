<?php
namespace app\agent\controller;
use app\agent\Login;
use think\Cache;
class Agent extends Login{
    
    public function index(){

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
        ->field('sum(bet_money) as bet,sum(win) as win')->find();

        $tycg = db('k_bet_cg_group')
        ->where('uid','IN',$uids)
        ->where('bet_time','>=',$firstday . ' 00:00:00')
        ->where('bet_time','<=',$lastday . ' 23:59:59')
        ->where('status',1)
        ->field('sum(bet_money) as bet,sum(win) as win')->find();


        $agzr = db('k_user')->alias('u')
        ->join('ag_gameresult ag', 'u.username = ag.username')
        ->where('uid','IN',$uids)
        ->where('betTime','>=',$firstday . ' 00:00:00')
        ->where('betTime','<=',$lastday . ' 23:59:59')
        ->field('SUM(validBetAmount) as bet,SUM(netAmount) as win')->find();

        $cp = db('c_bet')
        ->where('uid','IN',$uids)
        ->where('addtime','>=',$firstday . ' 00:00:00')
        ->where('addtime','<=',$lastday . ' 23:59:59')
        ->where('js',1)
        ->field('sum(money) as bet,sum(win) as win')->find();

        // 开始统计有效会员
        $ty_uids = db('k_bet')
        ->where('uid','IN',$uids)
        ->where('bet_time','>=',$firstday . ' 00:00:00')
        ->where('bet_time','<=',$lastday . ' 23:59:59')
        ->where('status','in',[1,2,4,5])
        ->column('distinct uid');

        $tycg_uids = db('k_bet_cg_group')
        ->where('uid','IN',$uids)
        ->where('bet_time','>=',$firstday . ' 00:00:00')
        ->where('bet_time','<=',$lastday . ' 23:59:59')
        ->where('status',1)
        ->column('distinct uid');

        $agzr_uids = db('k_user')->alias('u')
        ->join('ag_gameresult ag', 'u.username = ag.username')
        ->where('uid','IN',$uids)
        ->where('betTime','>=',$firstday . ' 00:00:00')
        ->where('betTime','<=',$lastday . ' 23:59:59')
        ->column('distinct u.uid as uid');

        $cp_uids = db('c_bet')
        ->where('uid','IN',$uids)
        ->where('addtime','>=',$firstday . ' 00:00:00')
        ->where('addtime','<=',$lastday . ' 23:59:59')
        ->where('js',1)
        ->column('distinct uid');

        $avail_uids = array_merge(array_keys($ty_uids),array_keys($tycg_uids),array_keys($agzr_uids),array_keys($cp_uids));
        $avail_uids = array_unique($avail_uids);
        $yxhy = count($avail_uids);

        $syzj = ($ty['win'] - $ty['bet']) + ($tycg['win'] - $tycg['bet']) + ($agzr['win'] - $agzr['bet']) + ($cp['win'] - $cp['bet']);

        $this->view->yongjin = $this->yongjin($yxhy,$syzj);
        $this->view->page_header = '首页';
        return $this->fetch();
    }

    private function yongjin($yxhy, $syzj){//算法有问题

        $tmp = db('k_user_daili_bili')->order('px')->select();
        $win = $ren = $ty = $cp = $zr = array();
        foreach ($tmp as $row_bl){
            $win[$row_bl['px']] = $row_bl['win'];
            $ren[$row_bl['px']] = $row_bl['ren'];
            $ty[$row_bl['px']] = $row_bl['ty'];
            $cp[$row_bl['px']] = $row_bl['cp'];
            $zr[$row_bl['px']] = $row_bl['zr'];
        }
        
        if ($yxhy < $ren['1']) {
            return 0;
        }

        $s = $o = $z = 1;
        for ($i = 2; $i <= count($ren); $i ++) {
            $ii = $i - 1;
            if ($i == count($ren)) {
                if ($yxhy >= $ren['' . $i . '']) {
                    $s = $i;
                }
                if ($syzj > $win['' . $i . '']) {
                    $o = $i;
                }
            } else {
                if ($yxhy >= $ren['' . $ii . ''] && $yxhy <= $ren['' . $i . '']) {
                    $s = $ii;
                }
                if ($syzj > $win['' . $ii . ''] && $syzj < $win['' . $i . '']) {
                    $o = $ii;
                }
            }
        }
        if ($s > $o) {
            $z = $o;
        }
        if ($s < $o) {
            $z = $s;
        }
        if ($s == $o) {
            $z = $s;
        }       

        if ($syzj < 0) {
            $yongjin = abs($syzj * $ty['' . $z . ''] / 100);
            return $yongjin;
            //$yongjin = ($tysy * $ty['' . $z . ''] / 100) + ($zrsy * $zr['' . $z . ''] / 100) + ($cptz * $cp['' . $z . ''] / 100);            
        } else {
            return 0;
        }        
    }


    public function logout(){
        session(null);
        cookie(null,config('cookie.prefix'));
       	$this->redirect('/index/login');
    }    
}