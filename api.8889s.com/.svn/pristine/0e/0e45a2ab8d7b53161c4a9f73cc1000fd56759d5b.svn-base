<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Db;
class chuanjs extends Login{
    
    public function index(){
      
        $query = Db::table('k_bet_cg_group')->alias('kg')
        ->join('k_user u','kg.uid=u.uid');

        $status = input('status','-1') ?? '';
        if(-1 == $status){
            //nothing
        }elseif(0 == $status){
            $query->where('status','in',[0,2]);
        }elseif(1 == $status){
            $query->where('status',1)->where('win','>',0);
        }elseif(2 == $status){
            $query->where('status',1)->where('win',0);
        }elseif(3 == $status){
            $query->where('status',3);
        }else{
            $query->where('status','in',$status);
        }

        $username = input('username') ?? '';
        if($username){
            $query->where('u.username',$username);
        }

        $tf_id = input('tf_id') ?? '';
        if($tf_id){
            $query->where('kg.gid',$tf_id);
        }

        $s_time = input('s_time') ?? '';
        $e_time = input('e_time') ?? '';
        if($s_time&&$e_time){
            //$query->whereTime('bet_time', 'between', [$s_time,$e_time]);
            $query->where("date('bet_time') between '$s_time' and '$e_time'");
        }elseif($s_time){
            //$query->whereTime('bet_time', '>=', $s_time);
            $query->where("date('bet_time') >= '$s_time'");
        }elseif($e_time){
            //$query->whereTime('bet_time', '<=', $e_time);
            $query->where("date('bet_time') <= '$e_time'");
        }

        //$bet_money = $query->sum('kg.bet_money');
        //$win = $query->sum('kg.win');  
        //$bet_money = $win = 0;
        
        $options = $query->getOptions();
        $list = $query->field('kg.*,u.username')->order('kg.gid desc')->paginate(20);

        $bet_money = $query->options($options)->sum('kg.bet_money');
        $win = $query->options($options)->sum('kg.win');  
        
        $param = request()->param();
        foreach ($param as $key => $value) {
            $list->appends($key,$value);
        }

        $gids = [];$yjs = [];
        foreach ($list as $value) {
            $gids[] = $value['gid'];
            $yjs[$value['gid']]  = 0 ;
        }
        $gids = implode(",",$gids);
        
        $sql    =   "select gid,count(*) as num from k_bet_cg where status not in(0,3) ";
        if($gids){
            $sql .= "and gid in ($gids) ";
        }
        $sql .= " group by gid";
        $result = Db::query($sql);
        foreach ($result as $rows) {
            $yjs[$rows['gid']]  =   $rows['num']; //统计已结算的个数
        }

        $this->assign('yjs', $yjs);
        $this->assign('list', $list);
        $this->assign('bet_money', $bet_money);
        $this->assign('win', $win);

        return $this->fetch();                        
    }

    
    
    public function qxbet(){
        $param = $this->request->param();
        $bid = $param['bid'] ?? '';
        $status = $param['status'] ?? '';
        $msg = \app\logic\bet::qx_bet($bid,$status) ? '操作成功' : '操作失败';
        $this->fetch('qxbet');
    }
}