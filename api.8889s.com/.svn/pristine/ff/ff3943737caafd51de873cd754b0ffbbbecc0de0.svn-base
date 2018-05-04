<?php
namespace app\v1\behavior;
use \think\Session;

class SetSessionId 
{
	public function run(&$response)
	{		
		Session::boot();
		$session_id = session_id();
		cookie('PHPSESSID',$session_id,['prefix'=>'']);

		$uid = session('uid');
		$dir = ROOT_PATH.request()->module(). DS; 	
		file_put_contents($dir.'log/api.log','session_uid='.var_export($uid,true)."\r\n",FILE_APPEND);
		file_put_contents($dir.'log/api.log','session='.var_export($_SESSION,true)."\r\n",FILE_APPEND);		
	}
}
