<?php

//依赖全局配置
class HTML_Cache{

	public static function write($msg, $gtype, $rtype, $page_no = 0, $sub = '')
	{
		global $global_cache_html,$global_cache_dir,$global_cache_time;

		if(!$global_cache_dir){
			msg_log('html缓存目录没有配置','error');
			exit;
		}	

		//$timezone = date_default_timezone_get();
		date_default_timezone_set('PRC'); 

		if(!$global_cache_html){
			return;
		}

		if(strtotime($global_cache_time) < time()){
			return;
		}

		$cli         = IS_CLI ? '_cli' : '';

		$path = $global_cache_dir;
        if (substr($path, -1) != DS) {
            $path .= DS;
        }		
		if($sub){
			$path .= $sub . DS;
			//!is_dir($dir) && mkdir($dir, 0755, true);
		}
	    $destination = $path . date('Ymd') . DS . $gtype . '_' . $rtype . '_' . $page_no . '_' . date('His') . $cli . '.html';

	    $dir = dirname($destination);
	    !is_dir($dir) && mkdir($dir, 0755, true);

	    if (!is_string($msg)) {
	        $msg = var_export($msg, true);
	    }

	    file_put_contents($destination, $msg, FILE_APPEND); 

	    date_default_timezone_set('Etc/GMT+4');
	}
}

