<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Db;

class gunqiudan extends Login{
    
    public function index(){

        $list = Db::table('k_bet')->alias('b')
        ->join('k_user u','b.uid = u.uid','LEFT')
        ->where('b.lose_ok',0)
        ->order(['b.bid'=>'desc',])
        ->field('b.*,u.username ')->select();

        $this->assign('list',$list);

        return $this->fetch();        
    }
    
    public function set_lose(){
        $bid                =   input('get.bid/d',0);
        $isok               =   input('get.lose_ok/d',0);
        $status             =   input('get.status/d',0);
        $num                =   0;

        if($bid<1){
            Alert('操作失败！',url('index'));
        }

        if($isok==1){ //注单有效,滚球通过确认
            $sql            =   "update k_bet set lose_ok=1,update_time=now() where bid=$bid and lose_ok=0";
            $msg            =   "滚球注单有效";
            $num            =   1;
        }

        if($isok==0){ //注单无效
            $sql            =   "select bet_info,master_guest from k_bet where bid=$bid limit 1";
            $result         =   Db::query($sql);
            $t              =   $result[0];
            $match_info     =   $t["bet_info"]; 
            $msg_title      =   $t["master_guest"]."_注单已取消";
            $why            =   '';

            if($status==7){
                $why        =   '红卡无效';
                $msg        =   "滚球注单红卡无效";
                $msg_info   =   $t["master_guest"].'<br/>'.$t["bet_info"].'<br /><font style="color:#F00"/>因红卡无效，该注单取消，已返还本金。</font>';
            }
            
            if($status==6){
                $why        =   '进球无效';
                $msg        =   "滚球注单进球无效";
                $msg_info   =   $t["master_guest"].'<br/>'.$t["bet_info"].'<br /><font style="color:#F00"/>因进球无效，该注单取消，已返还本金。</font>';
            }
            
            if($status==3){
                $why        =   '手工无效';
                $msg        =   "注单无效";
                $msg_info   =   $t["master_guest"].'<br/>'.$t["bet_info"].'<br /><font style="color:#F00"/>该注单取消，已返还本金。</font>';
            }
            
            $sql            =   "update k_bet,k_user set k_bet.lose_ok=1,k_bet.status=$status,k_user.money=k_user.money+k_bet.bet_money,k_bet.win=k_bet.bet_money,k_bet.update_time=now(),k_bet.sys_about='$why' where k_user.uid=k_bet.uid and k_bet.bid=$bid";
            $num            =   2;
        }


        Db::startTrans(); //事务开始
        try{
            $q1 = Db::execute($sql);
          
            if($q1 == $num){
                Db::commit(); //事务提交

                if($isok    == 0){
                    $uid             =   input('get.uid/d',0);
                    msg_add($uid,'结算中心',$msg_title,$msg_info);
                }
                sys_log(session("adminid"),"审核了编号为".$bid."的".$msg);
                
                Alert('操作成功！',url('index'));
            }else{
                Db::rollback(); //数据回滚
                Alert('操作失败！',url('index'));
            }
        }catch(Exception $e){
            Db::rollback(); //数据回滚
            Alert('操作失败！',url('index'));
        }
    }

}
