<?php
namespace app\admin\controller;

use app\admin\Login;
use think\Db;
class chuanguan extends Login
{

    public function chuan_info()
    {
        $param = $this->request->param();
        $gid = $param['gid'] ?? '';
        $uid = $param["uid"] ?? '' ;
        $match_id = $param['match_id'] ?? '';
        $match_name = $param['match_name'] ?? '';
        $sql = "select k_bet_cg.*,k_user.username from k_bet_cg left join k_user on k_bet_cg.uid=k_user.uid where 1";
        if ($gid) {
            $sql .= " and k_bet_cg.gid=" . $gid;
        }
        if ($uid) {
            $sql .= " and k_bet_cg.uid=" . $uid;
        }
        if ($match_id) {
            $sql .= " and k_bet_cg.match_id=" . $match_id;
        }
        if ($match_name) {
            $sql .= " and k_bet_cg.match_name='" . urldecode($match_name) . "'";
        }
        
        if(isset($param['status'])){
            if ($status > 0) {
                $sql .= " and k_bet_cg.status>0";
            } else if ($status == 0) {
                $sql .= " and k_bet_cg.status=0";
            }
        }
        
        $sql .= " order by  k_bet_cg.bid  desc ";
        $list = Db::query($sql);
        $this ->assign('list',$list);
        return $this -> fetch();
    }
    
    public function set_score_cg(){
        $bid			=	intval($_GET["bid"]);
        $status			=	intval($_GET["status"]);
        $sql			=	"select master_guest,match_name from k_bet_cg where bid=$bid limit 1";
        $t = Db::query($sql)[0];
        //$t				=	$query->fetch_array();
        if(strpos($t['master_guest'],'VS.')) 
            $master_guest	=	explode('VS.',$t['master_guest']);
        else 
            $master_guest	=	explode('VS',$t['master_guest']);
        $this->assign('master_guest',$master_guest);
        $this->assign('t',$t);
        $this->assign('bid',$bid);
        $this->assign('status',$status);
        return $this-> fetch();
    }
    
    public function set_cg_bet(){
        $bid		=	intval($_GET["bid"]);
        $status		=	intval($_GET["status"]);
        $mb_inball	=	$_GET['MB_Inball'];
        $tg_inball	=	$_GET['TG_Inball'];
        $bool		=	\app\logic\bet::set_cg($bid,$status,$mb_inball,$tg_inball);
        $show_msg	=	'';
        if($bool){
            $show_msg	=	'操作成功';
        }else{
            $show_msg	=	'操作失败';
        }
        $this -> assign('show_msg',$show_msg);
        $this->assign('status',$status);
        return $this -> fetch();
        
    }
    
    public function qx_cgbet(){
        $bid		=	intval($_GET["bid"]);
        $msg		=	\app\logic\bet::qx_cgbet($bid) ? '操作成功' : '操作失败';
        Alert($msg,$_SERVER["HTTP_REFERER"]);
    }
    
    public function set_cg(){
        if($_GET["ok"]	==	1){
            $gid	=	$_GET["id"];
            $msg	=	\app\logic\bet_cg::js($gid) ? '操作成功' : '操作失败';
            
            Alert($msg,$_SERVER['HTTP_REFERER']);
        }
        
        if($_GET["ok"]	==	2){
            $arr	=	$_POST["gid"];
            $sum	=	$true	=	$false	=	0;
            foreach($arr as $k=>$gid){
                $sum++;
                \app\logic\bet_cg::js($gid) ? $true++ : $false++;
            }
            Alert("共结算：$sum 条串关注单；\\n成功有：$true 条；\\n失败有：$false 条。",$_SERVER['HTTP_REFERER']);
        }
    }
    
    public function setcg_cutone(){
        $msg	=	'操作失败';
        
        if($_GET['action']==1){
            $gid	=	$_GET['gid'];
            $sql	=	"update k_bet_cg_group set cg_count=cg_count-1 where gid='$gid' and cg_count>0";
            Db::startTrans();
            try{
                $q1 = Db::execute($sql);
                if($q1>0){
                    Db::commit(); //事务提交
                    $msg	=	'操作成功';
                }else{
                    Db::rollback(); //数据回滚
                }
            }catch(Exception $e){
                Db::rollback(); //数据回滚
            }
        }else{
            $msg	=	'参数错误';
        }
        $this->assign('msg',$msg);
        $this->assign('gid',$gid);
        return $this->fetch();
    }
    
    public function setcg_qx(){
        $gid		=	intval($_GET["gid"]);
        $count		=	0;
        $sql		=	"select `status`,cg_count from k_bet_cg_group where `status` in(1,3) and gid=$gid limit 1";
        $rows 		=	Db::query($sql)[0];
        $count		=	$rows['cg_count'];
        
        if($rows["status"] == 1){
            $sql	=	"update k_user,k_bet_cg_group set k_user.money=k_user.money-k_bet_cg_group.win,k_bet_cg_group.status=0,k_bet_cg_group.win=0,k_bet_cg_group.update_time=null,k_bet_cg_group.cg_count=(select count(*) from k_bet_cg where gid=k_bet_cg_group.gid) where k_user.uid=k_bet_cg_group.uid and k_bet_cg_group.gid=$gid";
        }elseif($rows["status"]==3){
            $sql	=	"update k_user,k_bet_cg_group set k_user.money=k_user.money-k_bet_cg_group.win,k_bet_cg_group.status=0,k_bet_cg_group.win=0,k_bet_cg_group.update_time=null,k_bet_cg_group.cg_count=(select count(*) from k_bet_cg where gid=k_bet_cg_group.gid) where k_user.uid=k_bet_cg_group.uid and k_bet_cg_group.gid=$gid";
        }
        
        Db::startTrans();
        try{
            $q1		=	Db::execute($sql);
            $sql	=	"update k_bet_cg set status=0 where gid=$gid"; //输，所有该组都需要重新审核
            $q2		=	Db::execute($sql);
            if($q1>0 && $q2==$count){
                Db::commit(); //事务提交
                $msg=	"操作成功";
            }else{
                Db::rollback(); //数据回滚
                $msg=	"操作失败";
            }
        }catch(Exception $e){
            Db::rollback(); //数据回滚
            $msg	=	"操作失败";
        }
        Alert($msg,$_SERVER["HTTP_REFERER"]);
    }
}