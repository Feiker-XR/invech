<?php


class FILE_Cache{


    protected static $config = [
        //'expire'        => 0,
        'cache_subdir'  => true,
        'prefix'        => '',
        //'path'          => CACHE_PATH,//默认不可改;或者从全局变量取;
        //'data_compress' => false,//不支持压缩
    ];

	protected static function get_filename($name)
	{
		global $global_file_cache_dir;
		if(!$global_file_cache_dir){
			msg_log('文件缓存目录没有配置','error');
			return;
		}		
        $cache_root = $global_file_cache_dir;
        if (substr($cache_root, -1) != DS) {
            $cache_root .= DS;
        }		

        $name = md5($name);
        if (self::$config['cache_subdir']) {
            $name = substr($name, 0, 2) . DS . substr($name, 2);
        }
        if (self::$config['prefix']) {
            $name = self::$options['prefix'] . DS . $name;
        }

        $filename = $cache_root . $name . '.php'; 

        return $filename;      
	}

	public static function set($name, $value, $expire = 0)
	{

		$filename = self::get_filename($name);
		if(!$filename){
			return false;
		}

        $dir      = dirname($filename);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

	    $data = serialize($value);
	    $data   = "<?php\n//" . sprintf('%012d', $expire) . $data . "\n?>";
	    $result = file_put_contents($filename, $data);
		//chmod($filename, 0755); 
		//chown($filename, 'www'); 
		//这两函数disabled,
	    if ($result) {
	    	return true;
	    }else{
	    	return false;
	    }
	}

	public static function get($name, $default = false)
	{
		$filename = self::get_filename($name);
		if (!is_file($filename)) {
			return $default;
		}

        $content = file_get_contents($filename);
        if (false !== $content) {
            $expire = (int) substr($content, 8, 12);
            if (0 != $expire && $_SERVER['REQUEST_TIME'] > filemtime($filename) + $expire) {
                unlink($filename);
                return $default;
            }
            $content = substr($content, 20, -3);
            $content = unserialize($content);
            return $content;
        }else{
        	return $default;
        }
	}

}

class Memcache_Cache{

    protected static $instance = null;//单例  
    protected static $config = [
        'host'       => '127.0.0.1',
        'port'       => 11211,
        'timeout'    => 0, // 超时时间（单位：毫秒）
        'prefix'     => '',
        'flag'		 => '0',//使用MEMCACHE_COMPRESSED指定对值进行压缩(使用zlib)。
    ];

    //返回实例 还是 true/false
	public static function init()
	{
		//默认情况下，Memcached实例在请求结束后会被销毁。但可以在创建时通过persistent_id为每个实例指定唯一的ID， 在请求间共享实例。所有通过相同的persistent_id值创建的实例共享同一个连接。		
		if(is_null(self::$instance)){
			self::$instance = new Memcache();

            if(self::$config['timeout'] > 0){
				$ret = self::$instance->connect ( self::$config['host'] , self::$config['port'] , self::$config['timeout']);            
            }else{
				$ret = self::$instance->connect ( self::$config['host'] , self::$config['port']);             	
            }

			if(!$ret){
				msm_log('memcache连接失败！','error');
				//exit;//返回无连接的对象 没意义
				return false;
			}
		}
		
		//return self::$instance; 
		return true;
	}

	//返回true/false
	public static function set($name, $value, $expire = 0)
	{		
		if(!self::init()){
			return false;
		}
		$name = self::$config['prefix'] . $name;
		return self::$instance->set($name, $value, self::$config['flag'], $expire);
	}

	public static function get($name, $default = false)
	{
		if(!self::init()){
			return false;
		}
		$name = self::$config['prefix'] . $name;
		
        $result = self::$instance->get($name, self::$config['flag']);
        return false !== $result ? $result : $default;		
	}	
}