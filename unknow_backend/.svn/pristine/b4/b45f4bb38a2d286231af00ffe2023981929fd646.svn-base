<?php
namespace app\logic;
use think\Db;
use think\Config;
class bet_cg {
    
    static function js($gid){
        $cg_count = Db::name('k_bet_cg')->where('gid','=',$gid)->count();
        $sql		=	"select g.gid from k_bet_cg_group g where $cg_count=(select count(b.gid) from k_bet_cg b where `status` in(1,2,3,4,5,8) and b.gid=g.gid) and $cg_count>(select count(b.gid) from k_bet_cg b where `status` in(3,8) and b.gid=g.gid) and g.gid=$gid";
        $rows = count(Db::query($sql));
        if($rows > 0 ){
            $sql	=	"update k_user,k_bet_cg_group set k_user.money=k_user.money+k_bet_cg_group.win,k_bet_cg_group.status=1,k_bet_cg_group.update_time=now() where k_user.uid=k_bet_cg_group.uid and k_bet_cg_group.gid=$gid and k_bet_cg_group.status!=1";
        }else{
            $sql	=	"select g.bet_money from k_bet_cg_group g where $cg_count=(select count(b.gid) from k_bet_cg b where b.status in(3,8) and b.gid=g.gid) and g.gid=$gid";
            $rows = count(Db::query($sql));
            if($rows > 0){
                $sql=	"update k_user,k_bet_cg_group set k_user.money=k_user.money+k_bet_cg_group.bet_money,k_bet_cg_group.status=3,k_bet_cg_group.win=k_bet_cg_group.bet_money,k_bet_cg_group.update_time=now() where k_user.uid=k_bet_cg_group.uid and k_bet_cg_group.gid=$gid and k_bet_cg_group.status!=3";
            }
        }
        
        Db::startTrans();
        try{
            $q1 = Db::execute($sql);
            if($q1 == 1){
                Db::commit();
                return true;
            }else{
                Db::rollback();
                return false;
            }
        }catch(Exception $e){
            Db::rollback();
            return false;
        }
        
    }
    
    
    
}