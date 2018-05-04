<?php
//-----------------全局常亮,变量,公共
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('IS_CLI') or define('IS_CLI', PHP_SAPI == 'cli' ? true : false);

//-----------------日志文件全局变量
$global_log_dir = __DIR__ . DS . 'logs';

//---------------html缓存全局变量
$global_cache_dir = __DIR__ . DS . 'html' . DS;
$global_cache_html = true;
$global_cache_time = $argv[1]??'2017-09-03 13:00:00';//html缓存截止时间

//--------------数据文件缓存全局变量
$global_cache_type = 'memcache';//'file';
$global_file_cache_dir = __DIR__ . DS . '..' . DS . '..' . DS . 'runtime' .  DS . 'cache';