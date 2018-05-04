<?php
namespace app\api\middlewares;
use Closure;
use \think\Session;

class Log 
{
	public function handle($request, Closure $next)
	{		
		//------------------SaveRequest-----------------------
		$dir = ROOT_PATH.$request->module(). DS;
		
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



		$response = $next($request);

		//------------------SaveResponse-------------------
		$dir = ROOT_PATH.request()->module(). DS; 
		
		$code = $response->getCode();		
		file_put_contents($dir.'log/api.log','response_code='.$code."\r\n",FILE_APPEND);
	
		//$return = $response->getData();
		$return = $response->getContent();
			
		//application/json text/html;
		$content_type = $response->getHeader('Content-Type');
		if(strpos($content_type,'text/html') === false){
			file_put_contents($dir.'log/api.log','response_content='.var_export($return,true)."\r\n",FILE_APPEND);			
		}else{
			$action = request()->action();
			file_put_contents($dir.'log/'.$action.'.html',$return,FILE_APPEND);			
		}

		file_put_contents($dir.'log/api.log',"\r\n\r\n",FILE_APPEND);
	 	
	 	return $response;   
	}
}
