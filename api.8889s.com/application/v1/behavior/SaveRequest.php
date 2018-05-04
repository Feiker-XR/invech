<?php
namespace app\v1\behavior;
use \think\Session;

class SaveRequest 
{
	public function run(&$request)
	{		
		$dir = ROOT_PATH.request()->module(). DS;
		
		//$request = request();
		//$str = var_export($request,true);
		$uri = $request->server('request_uri');
		$header = $request->header();
		$param = $request->param();
		//$return = $response->getData();
		$now     = date('Y-m-d H:i:s');
		
file_put_contents($dir.'log/api.log',"---------------".$uri."---------------"."\r\n",FILE_APPEND);		
file_put_contents($dir.'log/api.log','time='.$now."\r\n",FILE_APPEND);
file_put_contents($dir.'log/api.log','uri='.$uri."\r\n",FILE_APPEND);
file_put_contents($dir.'log/api.log','header='.var_export($header,true)."\r\n",FILE_APPEND);
file_put_contents($dir.'log/api.log','param='.var_export($param,true)."\r\n",FILE_APPEND);
//file_put_contents('api.log','return='.var_export($return,true)."\r\n\r\n",FILE_APPEND);	    
	    
	}
}
