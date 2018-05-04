<?php
//错误处理在 日志模块启动完成后 有效
//defined('DS') or define('DS', DIRECTORY_SEPARATOR);



function error_handler ( $errno , $errstr , $errfile , $errline ){
	//$err_log = __DIR__ . DS . '..' . DS . '..' . DS . 'runtime' .  DS . 'log' . DS . 'err.log';
/*
		$timezone = date_default_timezone_get();		
		date_default_timezone_set('PRC');

	    file_put_contents($destination, $msg, FILE_APPEND); 	    
	    date_default_timezone_set($timezone);
*/
	    global $global_error;	    
	    //$errors = error_get_last();
		$msg = "[{$errno}]{$errstr}[{$errfile}:{$errline}]";
		msg_log($msg,'system');
		$bt = debug_backtrace();
		msg_log($bt,'system');
		//notice错误经处理函数后不退出,继续执行,需要强制退出
		$global_error .= $msg . PHP_EOL;
		$global_error .= var_export($bt, true) . PHP_EOL;
		die('遇到错误退出');
}

error_reporting(E_ALL);
set_error_handler("error_handler");

//判断是正常退出还是错误导致退出
function shutdown()
{
	global $global_error;
	$result = ' [运行结果：';
	//$errors = error_get_last();
	if(!$global_error){
		$result .= '正常退出]';
		msg_log($result, 'info');		
	}else{
		$result .= '异常退出]';		
		msg_log($result, 'error');
		$error = '错误详情：' . $global_error;		
		msg_log($error, 'error');		
	}

	$runtime    = round(microtime(true) - START_TIME, 10);
	$time_str   = ' [运行时间：' . number_format($runtime, 6) . 's]';
	//Log::write($time_str, 'info', $global_module);
	msg_log($time_str, 'info');
}

register_shutdown_function('shutdown');
