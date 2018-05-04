<?php
//以全局变量的形式 嵌入 日志功能 和 采集数据日志;
//全局变量以$global_xx的形式命名,每个模块/目录都需要一个global.php文件,
set_time_limit(0);

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('IS_CLI') or define('IS_CLI', PHP_SAPI == 'cli' ? true : false);

define('START_TIME', microtime(true));

/*
$included_files = get_included_files();
foreach ($included_files as $filename) {
  echo "$filename\n";
}
*/


//defined('IS_WIN') or define('IS_WIN', strpos(PHP_OS, 'WIN') !== false);
//defined('CACHE_HTML') or define('CACHE_HTML', true);

/*
//只支持单层include,不稳定
$bt = debug_backtrace();
if(1 != count($bt))exit('init脚本使用错误!');
$script = $bt[0]['file'];	//C:\work\fd\caiji\sport\test2.php
$global_module = str_replace('.php','',substr($script,strrpos($script, 	DS)+1));
*/

$script = $_SERVER ['PHP_SELF'];
//$_SERVER ['PHP_SELF'],windows下返回test2.php; linux下返回/www/wwwroot/site/caiji/sport/
/*
if(strrpos($script, 	DS) === false){
	$global_module = str_replace('.php','',$script);
}else{	
	$global_module = str_replace('.php','',substr($script,strrpos($script, 	DS)+1));		
}
*/
$global_module = str_replace('.php','',basename($script));


//-----------------日志文件全局变量
//$global_log_dir = __DIR__ . DS . 'logs';
include_once(__DIR__ . DS . 'log.php');
function msg_log($msg, $type = 'log'){
	global $global_module;
	Log::write($msg, $type, $global_module);
}

//注册错误处理,单独记录日志
include_once(__DIR__ . DS . 'error.php');

//---------------html缓存全局变量
//$global_cache_dir = __DIR__ . DS . 'html' . DS;
//$global_cache_html = true;
include_once(__DIR__ . DS . 'html_cache.php');
function html_cache($msg, $gtype, $rtype, $page_no = 0){
	global $global_module;
	HTML_Cache::write($msg, $gtype, $rtype, $page_no, $global_module);
}

//--------------数据文件缓存全局变量
//$global_cache_type = 'file';//'memcache';//'file';
//$global_file_cache_dir = __DIR__ . DS . '..' . DS . '..' . DS . 'runtime' .  DS . 'cache';

include_once(__DIR__ . DS . 'cache.php');
function data_cache($name, $value = '', $expire = 0){
	global $global_cache_type;
	

	if(!in_array($global_cache_type, ['file','memcache'])){
		msg_log('文件缓存类型配置错误','error');
		return;
	}

	if('file' == $global_cache_type){
		if (is_null($name)) {
	            return false;
	    } elseif ('' === $value) {
	 		return FILE_Cache::get($name);
	    } else{
	    	return FILE_Cache::set($name, $value, $expire);
	    }		
	}
	if('memcache' == $global_cache_type){
		if (is_null($name)) {
	            return false;
	    } elseif ('' === $value) {
	 		return Memcache_Cache::get($name);
	    } else{
	        msg_log( $global_cache_type.PHP_EOL.$name,'info');
	    	return Memcache_Cache::set($name, $value);
	    }		
	}
	
}