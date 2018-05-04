<?php
include_once("db.php");
$headers	=	array();
$headers	=	get_headers($webdb["datesite"]); //获取请求头信息
$cookie		=	substr($headers[2],0,strpos($headers[2],'path=/;'));
$str		=	"<?php\r\n";
$str		.=	"unset(\$cookie_new);\r\n";
if($cookie){
	$cookie		=	str_replace('Set-Cookie:','',$cookie);
	$cookie		=	str_replace(';','',$cookie);
	$cookie		=	str_replace(' ','',$cookie);
	$str		.=	"\$cookie_new	=	'".$cookie."';\r\n";
}else{
	$str		.=	"\$cookie_new	=	'';\r\n";
}
write_file("cookie.php",$str."?>");
?>