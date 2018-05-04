<?php
namespace app\v2\controller;
use app\v2\Base;
use think\Db;
use think\Session;
use think\cache\driver\Memcache;
class Promotions extends Base
{
	public function index()
	{
		$uid = Session::get('uid'); 
		$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
		/*
		$memcache = new Memcache;
		$hot = $memcache->has('syshot');
		if($hot==false){
			$end = date("Y-m-d H:i:s");
			$where = " overdate >= '$end' and ok = 1";
			$webhot = Db::table('web_hot')->where($where)->order('sort desc')->select();
			$memcache->set('syshot',$webhot);
			$result = $webhot;
		}else {
			$result = $memcache->get('syshot');
		}
		*/
			$end = date("Y-m-d H:i:s");
			$where = " overdate >= '$end' and ok = 1";
			$webhot = Db::table('web_hot')->where($where)->order('sort desc')->select();
			$result = $webhot;		
		$this->assign('result',$result);
		$this->assign('user',$user);
		return $this->fetch('index');
	}
}