<?php

//define('LOG_DEBUG', true);
//define('DS', DIRECTORY_SEPARATOR);
//define('IS_CLI', PHP_SAPI == 'cli' ? true : false);
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('IS_CLI') or define('IS_CLI', PHP_SAPI == 'cli' ? true : false);

class Log{
	/*
	system:由错误处理程序记录

	*/
    protected static $config = [
        //'dir'	=>      'logs',//使用全局变量配置
		'debug'	=>	true,
        'level'	=>	['crontab','info','error','sql','system'],
        'file_size' => '10485760',//单位字节,10M
    ];

	public static function write($msg, $type = 'log', $sub = '')
	{
		global $global_log_dir;
		if(!$global_log_dir){
			exit('日志目录没有配置');
		}	

        $path = $global_log_dir;
        if (substr($path, -1) != DS) {
            $path .= DS;
        }	

		if(true !== self::$config['debug']){
			return;
		}
		if(!in_array($type, self::$config['level'])){
			return;
		}

		$timezone = date_default_timezone_get();
		date_default_timezone_set('PRC');

		$cli         = IS_CLI ? '_cli' : '';

		//$path = __DIR__ . DS . self::$config['dir'] . DS;

		if($sub){
			$path .= $sub . DS;
			//!is_dir($dir) && mkdir($dir, 0755, true);
		}
	    $destination = $path . date('Ym') . DS . date('d') . $cli . '.log';

        if (is_file($destination) && floor(self::$config['file_size']) <= filesize($destination)) {
            rename($destination, dirname($destination) . DS . time() . '-' . basename($destination));
		}

	    //错误处理函数的日志单独存放
	    if('system' == $type){
	    	$destination = __DIR__ . DS . '..' . DS . '..' . DS . 'runtime' .  DS . 'log' . DS . 'system.log';
	    }

	    $dir = dirname($destination);
	    !is_dir($dir) && mkdir($dir, 0755, true);

	    if (!is_string($msg)) {
	        $msg = var_export($msg, true);
	    }
	    $msg = '[ ' . $type . ' ] ' . $msg . "\r\n";
	    $now     = date('Y-m-d H:i:s');
	    $msg = "[{$now}]" . $msg;

	    file_put_contents($destination, $msg, FILE_APPEND); 
	    //error_log($msg, 3, $destination);

	    date_default_timezone_set($timezone);	    
	}
}