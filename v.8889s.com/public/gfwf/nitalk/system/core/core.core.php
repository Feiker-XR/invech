<?php
error_reporting(E_ALL);
header('Content-Type: text/html;charset=utf-8');
mb_internal_encoding('UTF-8');
date_default_timezone_set('PRC');
set_error_handler(array('core', 'error_handler'));
ob_start(array('core', 'ob_output'));
session_start();

class core {
	
	//初始化
	public static function init() {
		$uri = array_key_exists('REQUEST_URI', $_SERVER) ? $_SERVER['REQUEST_URI'] : '/';
		$uri_info = parse_url($uri);
		if (!is_array($uri_info) || !array_key_exists('path', $uri_info)) self::__403();
		$mod_name = substr($uri_info['path'], 8);
		if (empty($mod_name)) $mod_name = 'init';
		$act_name = '_init';
		if (!preg_match('/^[a-z0-9_\-]+$/', $mod_name) || !preg_match('/^[a-z0-9_\-]+$/', $act_name)) self::__403();
		$mod_file = SYSTEM.'/mod/'.$mod_name.'.mod.php';
		if (!is_file($mod_file)) self::__403();
		require(SYSTEM.'/core/mod.core.php');
		require($mod_file);
		$mod_classname = 'mod_'.$mod_name;
		$model = new $mod_classname;
		$methods = get_class_methods($model);
		if (!in_array($act_name, $methods)) self::__403();
		call_user_func_array(array($model, $act_name), array());
	}
	
	public static function ob_output($html) {
		// 一些用户喜欢使用windows笔记本编辑文件，因此在输出时需要检查是否包含BOM头
		if (ord(substr($html, 0, 1)) === 239 && ord(substr($html, 1, 2)) === 187 && ord(substr($html, 2, 1)) === 191) $html = substr($html, 3);
		// gzip输出
		if(
			!headers_sent() && // 如果页面头部信息还没有输出
			extension_loaded("zlib") && // 而且zlib扩展已经加载到PHP中
			array_key_exists('HTTP_ACCEPT_ENCODING', $_SERVER) &&
			stripos($_SERVER["HTTP_ACCEPT_ENCODING"], "gzip") !== false // 而且浏览器说它可以接受GZIP的页面 
		) {
			$html = gzencode($html, 3);
			header('Content-Encoding: gzip'); 
			header('Vary: Accept-Encoding');
		}
		header('Content-Length: '.strlen($html));
		return $html;
	}

	// 非法请求简写模式
	public static function __403() {
		self::error('非法请求');
	}

	/**
	 * @name 错误输出
	 * @param string message 错误信息
	 */
	public static function error($message) {
		echo $message;
		exit;
	}

	/**
	 * @name 类库调用
	 * @param string name 类库名称
	 * @return object
	 */
	public static function lib($name) {
		static $libs = array();
		if (!array_key_exists($name, $libs)) {
			require(SYSTEM.'/lib/'.$name.'.lib.php');
			$classname = 'lib_'.$name;
			$libs[$name] = new $classname;
		}
		return $libs[$name];
	}
	
	/**
	 * @name 日志记录
	 * @param array data 日志数据
	 */
	public static function logger($data) {
		$text = '';
		$data['TIME'] = date('Y-m-d H:i:s');
		$data['URI'] = $_SERVER['REQUEST_URI'];
		foreach ($data as $k => $v) $text .= '['.$k.']: '.$v."\r\n";
		$text .= "\r\n";
		file_put_contents(SYSTEM.'/log/'.date('Y.m.d').'.txt', $text, FILE_APPEND);
	}
	
	/**
	 * @name 错误捕获
	 * @param int type 错误类型
	 * @param string message 错误信息
	 * @param string file 错误文件
	 * @param string line 错误行号
	 */
	public static function error_handler($type, $message, $file, $line) {
		$data = array(
			'MSG'  => $message,
			'FILE' => $file,
			'LINE' => $line,
		);
		self::logger($data);
		if ($type !== E_WARNING && $type !== E_NOTICE && $type !== E_STRICT) self::error($message);
	}

}