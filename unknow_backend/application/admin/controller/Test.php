<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class test extends Controller{

	
	public function test(){
	    
	    $con = Db::connect();
	    $con->startTrans();
	    try{
	        $user = $con->table('k_user')->where('uid',558)->find();
	        dump($user);
	        $con->table('k_user2d')->where('uid',558)->delete();
	        //$con->exec('UPDATE `k_user2`  SET `money`=1  WHERE  `uid` = 558');
	        $sql = $con->getLastSql();
	        dump($sql);
	        //throw new \Exception();
	        $con->commit();
	        dump("commit11");return;
	    }catch (\Exception $e) {
	        $con->rollback();
	        dump("rollback");
	        return;
	    }
	}
	
	public function test2(){
	    //k_user2
	    $ret = Db::startTrans();
	    try{
	        //Db::table('k_user')->where('uid',558)->update(['money'=>'1']);
	        Db::table('k_user23')->where('uid',558)->update(['money'=>'1']);
	        Db::commit();
	        dump("commit11");return;
	    }catch (\Exception $e) {
	        Db::rollback();
	        dump("rollback"); return;
	    }
	}

}