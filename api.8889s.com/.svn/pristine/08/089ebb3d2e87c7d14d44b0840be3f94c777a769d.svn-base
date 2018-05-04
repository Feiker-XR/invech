<?php
namespace app\v1\behavior;
use \think\Session;
use \think\Cache;
use think\Response;

class ThrottleRequests 
{
	public function run(&$request)
	{
		$times = config('throttle_times');
		$minutes = config('throttle_minutes');

		$key = $request->domain().'|'.$request->ip();
		$timer = $key.':timer';

		
		$msg = 'key=' . cache($key) . '&timer=' . cache($timer);
	    $now = date('Y-m-d H:i:s');
	    $msg = "[{$now}]" . $msg;
	    $dir = ROOT_PATH.request()->module(). DS;
	    file_put_contents($dir.'log/throttle.log',$msg."\r\n",FILE_APPEND);

		//Cache::get($timer,null);
		if(!cache('?'.$timer)){
			$ret = cache($timer,$times,$minutes*60);
			$ret = cache($key,1,$minutes*60);
		}else{
			$attempts = cache($key);
			if($attempts<=$times){
				//cache()->inc($key);//inc设置key为永久有效;
				$cache = Cache::init();
				$cache->inc($key);
			}else{
				//不能删除key 和 计时器;
				//throw \Exception('访问频繁!');
				//throw new HttpException(500, '访问频繁!');
				$data = ['status'=>1,'msg'=>'访问频繁!',];
				$response = Response::create($data, 'json');
				abort($response);
			}

		}
	    
	}
}
