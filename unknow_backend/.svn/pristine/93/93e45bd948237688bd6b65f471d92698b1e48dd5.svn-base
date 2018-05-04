<?php
namespace app\v2\controller;
use app\v2\Base;
use think\Db;
use think\Session;
use think\Cache;
class Game extends Base
{
	public function index($type = 'ag')
	{
		$uid = Session::get('uid'); 
		$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
		//$plateform = Db::table('dzyx')->distinct('true')->field('platform')->select();
		//$category = Db::table('dzyx')->distinct('true')->field(['gametype','platform'])->group('platform')->select();
		$this->assign('user',$user);
		$this->assign('type',$type);
		$dzGameConfigs = cache('dzGameConfigs');
		if(!$dzGameConfigs){
		    $sqlFengpan = "select * from dzyx where platform = 'ag' and (ishot = 1 or isnew = 1)  limit 40 ";
		    $query = Db::query($sqlFengpan);
		    
		    foreach ($query as $dzGameConfig){
		        $dzGameConfigs['ag'][] = $dzGameConfig;
		    }
		    $sqlFengpan = "select * from dzyx where platform = 'mg' and (ishot = 1 or isnew = 1)  limit 40 ";
		    $query = Db::query($sqlFengpan);
		    foreach ($query as $dzGameConfig){
		        $dzGameConfigs['mg'][] = $dzGameConfig;
		    }
		    $sqlFengpan = "select * from dzyx where platform = 'pt' and (ishot = 1 or isnew = 1)  limit 40 ";
		    $query = Db::query($sqlFengpan);
		    foreach ($query as $dzGameConfig){
		        $dzGameConfigs['pt'][] = $dzGameConfig;
		    }
		    $sqlFengpan = "select * from dzyx where platform = 'bb' and (ishot = 1 or isnew = 1)  limit 40 ";
		    $query = Db::query($sqlFengpan);
		    foreach ($query as $dzGameConfig){
		        $dzGameConfigs['bb'][] = $dzGameConfig;
		    }
		}
		$this->assign('dzGameConfigs',$dzGameConfigs);
		return $this->fetch('index');
	}
	
	public function ag(){
	    
	}
	
	public function bbin(){
	    
	}
	
	public function mg(){
	    
	}
	
	public function pt(){
	    
	}
	
	public function sunbet(){
	    
	}
	
	
}