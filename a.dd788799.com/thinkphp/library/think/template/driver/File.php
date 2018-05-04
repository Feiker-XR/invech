<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace think\template\driver;

use think\Exception;

class File
{
    /**
     * 写入编译缓存
     * @param string $cacheFile 缓存的文件名
     * @param string $content 缓存的内容
     * @return void|array
     */
    public function write($cacheFile, $content)
    {
        // 检测模板目录
        $dir = dirname($cacheFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        // 生成模板缓存文件
        if (false === file_put_contents($cacheFile, $content)) {
            throw new Exception('cache write error:' . $cacheFile, 11602);
        }
    }

    /**
     * 读取编译编译
     * @param string  $cacheFile 缓存的文件名
     * @param array   $vars 变量数组
     * @return void
     */
    public function read($cacheFile, $vars = [])
    {
        if (!empty($vars) && is_array($vars)) {
            // 模板阵列变量分解成为独立变量
            extract($vars, EXTR_OVERWRITE);
        }
        //载入模版缓存文件
        include $cacheFile;
    }

    /**
     * 检查编译缓存是否有效
     * @param string  $cacheFile 缓存的文件名
     * @param int     $cacheTime 缓存时间
     * @return boolean
     */
    public function check($cacheFile, $cacheTime)
    {
        // 缓存文件不存在, 直接返回false
        if (!file_exists($cacheFile)) {
            return false;
        }
        if (0 != $cacheTime && $_SERVER['REQUEST_TIME'] > filemtime($cacheFile) + $cacheTime) {
            // 缓存是否在有效期
            return false;
        }
        return true;
    }
    
    public function iff($b,$str1,$str2=''){
        if($b)
            return $str1;
            else
                return $str2;
    }
    
    public static final function ifs(){
        $args=func_get_args();
        for($i=0; $i<count($args); $i++){
            if($args[$i]==='0' || $args[$i]) return $args[$i];
        }
    }
    
    public static function CsubStr($str,$start,$len,$suffix='...'){
        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $str, $info);
        $len*=2;
        $i=0;
        $tmpstr = '';
        while($i < $len && array_key_exists($start,$info[0])) {
            if (strlen($info[0][$start]) > 1) {
                $i+=2;
                if ($i <= $len)  $tmpstr .= $info[0][$start];
            }else {
                if (++$i <= $len)  $tmpstr .= $info[0][$start];
            }
            $start++;
        }
        return array_key_exists($start,$info[0]) ? $tmpstr.=$suffix : $tmpstr;
    }
    
    public final function shortUrl($url){
        $key = '2270845191';
        $r = file_get_contents('http://api.t.sina.com.cn/short_url/shorten.json?source=' .$key. '&url_long='.$url);
        if($r) {
            $items = json_decode($r);
            foreach($items as $item) {
                return $item->url_short;
            }
        }
    }
}
