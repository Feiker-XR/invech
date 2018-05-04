<?php
namespace app\v1\behavior;
use \think\Session;

class SaveResponse 
{
	public function run(&$response)
	{
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
	}
}
