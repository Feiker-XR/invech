<?php
/**
 * 客服ID
 * 这个用户最好不要是其他用户的下级，也不要是其他用户的上级
 * 当客服给下级群发信息时，将会向网站所有用户发送消息
 */
define('KFID', 292); // ()
// 数据库配置
define('DB_HOST', 'localhost'); // 数据库主机
define('DB_PORT', '3306'); // 数据库端口号
define('DB_NAME', 'alafeia'); // 数据库名称
define('DB_USER', 'root'); // 数据库账户
define('DB_PASS', 'root');//'ysTz7UCokFKRV*n@E*&Yarxbsd5V*cRy'); // 数据库密码