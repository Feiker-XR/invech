<?php
include dirname(__FILE__).'/config.php';
unset($mysqli);
$mysqli	=	new MySQLi(DB_HOST,DB_USER,DB_PWD,DB_KSB);
$mysqli->query("set names utf8");