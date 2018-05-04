<?php
namespace app\v1\behavior;
use \think\Session;
use \think\Cache;
use think\Response;

class SecurityCheck 
{
/*
key:JdsX93ciJYvDD9rpL8jM0MhbKEsW7Rrx
发送头部信息header组成部分
version:接口版本号
clienttime:请求时间戳
deviceid:设备序列号
sign:MD5(clienttime=请求时间戳&deviceid=设备序列号&version=版本号&key=密钥)  小写
*/

	public function run(&$request)
	{
		
		$controller = request()->controller();
		$controller = ucfirst($controller);
		$controller_except = ['Rule','Test'];
		$action = request()->action();
		$action_except = ['help','test'];

		$b_except = in_array($action,$action_except) || in_array($controller,$controller_except);
		$debug = config('app_debug');
		if(!$debug && !$b_except){
			$api_md5_key = config('api_md5_key')??'JdsX93ciJYvDD9rpL8jM0MhbKEsW7Rrx';
			$header = $request->header();
			$sign_str = 'clienttime='.$header['clienttime'].'&deviceid='.$header['deviceid'].'&version='.$header['version'].'&key='.$api_md5_key;
			$sign = md5($sign_str);
			if($sign != $header['sign']){
				$data = ['status'=>1,'msg'=>'您无权访问!',];
				$response = Response::create($data, 'json');
				abort($response);
			}
		}
	}
}
