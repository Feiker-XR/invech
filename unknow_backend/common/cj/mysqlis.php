<?php
include($_SERVER['DOCUMENT_ROOT'].'/Include/db.php');
unset($mysqlis);
$mysqlis = new MySQLi(DB_HOST,DB_USER,DB_PWD,"js1_188sport1_db");
$mysqlis->query("set names utf8");
?>