<?php
function theif_uid($langx = "zh-tw"){
	global $mysqli,$cookie_path,$webdb;
	$base = __DIR__ . '/../caiji/sport';
	//include_once($base.'/include.php');
	//$sql = "select * from wangzhi_manage where id=1";
	$sql = "select * from wangzhi_manage order by id desc limit 1";
	$query = $mysqli->query($sql);
	$temprow = $query->fetch_assoc();
	$webdb['datesite']		=	$temprow['wangzhi']; //读取为新表wangzhi30
	$webdb['user']			=	$temprow['zhanghao']; //读取为新表zhanghao
	$webdb['pawd']			=	$temprow['mima']; //读取为新表mima
	
	$curl = new Curl_HTTP_Client();
	$curl->store_cookies($cookie_path); 
	$curl->set_user_agent("Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");

	$v1 = $webdb['datesite']; //对应到新表的wangzhi
	$v2 = $webdb['datesite']; //对应到新表的wangzhi
	$v = 'v'.rand(1,2);
	$v = $$v;
	$login=array();
	$login['username']=$webdb["user"];
	$login['password']=$webdb["pawd"];
	$login['langx'] = $langx;
	$curl->set_referrer("".$v."");
	//$html_date=$curl->fetch_url("".$v."/app/member/","",5);
	$html_date=$curl->send_post_data("".$v."/app/member/login.php",$login,"",5);
	//<script>alert('登录失败!!\n请检查用户名与密码!!');top.location.href='http://www.hg494.com';</script>
	if(preg_match('/登录失败/',$html_date)){
		msg_log('登录失败!','error');
		global $global_error;
		$global_error = '登录失败!';
		exit();
	}
	preg_match("/(uid=[\w]+)&/",$html_date,$uid);
	$uid = str_replace(array("uid=","&"),array("",""),$uid[0]);
	if(strlen($uid)>20  ){
		$cache	= "<?php\r\n";
		$cache .= "\$webdb['cookie']		=	'".$uid."';\r\n";
		$cache .= "\$webdb['datesite']		=	'".$v."';\r\n";
		$cache .= "\$webdb['user']			=	'".$webdb['user']."';\r\n";
		$cache .= "\$webdb['pawd']			=	'".$webdb['pawd']."';\r\n";
		$cache .= "\$webdb['uid']			=	'1';\r\n?>";
		if(!write_file($base."/db.php",$cache)){ //写入缓存失败
			$meg	=	"缓存文件写入失败！请先设db.php文件权限为：0777";
		}
		$webdb['cookie'] = $uid;
		return $uid;
	}else{
		return 0;
	}
}

function theif_check_logout($msg){
	$login_out_reg =  '/logout_warn/';
	return preg_match($login_out_reg,$msg)===1;
}

function theif_data2($site,$uid,$gtype,$rtype,$langx,$page_no = 0){
	$msg = theif_data1($site,$uid,$gtype,$rtype,$langx,$page_no);
	if(!$msg || theif_check_logout($msg)){
		
		msg_log('采集失败,重新登录!','error');
		
		$uid = theif_uid();
		if(!$uid){
			msg_log('登录失败,退出!','error');
			exit;		
		}

		msg_log('登录成功,uid=' . $uid, 'info');

		$msg = theif_data1($site,$uid,$gtype,$rtype,$langx,$page_no);
		if(!$msg || theif_check_logout($msg)){
			msg_log('重新登录后采集失败,退出!','error');
			exit();
		}
	}
	return $msg;
}

function theif_data1($site,$uid,$gtype,$rtype,$langx,$page_no = 0){
	//$uid = 'nth7hgbsem15069906l3415075';
	switch($gtype){
	case 'FU':
		$base_url = "{$site}app/member/FT_future/index.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3";
		$filename="{$site}app/member/FT_future/body_var.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3&page_no=$page_no";

		break;
	case 'FS':
		$base_url = "{$site}app/member/browse_FS/loadgame_R.php?rtype=fs&uid=$uid&langx=$langx&mtype=3";
		$filename = "{$site}app/member/browse_FS/reloadgame_R.php?mid=1&uid=$uid&langx=$langx&choice=ALL&LegGame=ALL&pages=1&records=40&FStype=FT&area_id=&league_id=&rtype=$rtype";
		break;
	case 'OU':
		$gtype_browse=$gtype."_browse";
		$base_url = "{$site}app/member/OP_future/index.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3";
		$filename="{$site}app/member/OP_future/body_var.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3&page_no=$page_no";
		break;
	case 'BKR':
		$base_url = "{$site}app/member/BK_future/index.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3";
		$filename="{$site}app/member/BK_future/body_var.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3&page_no=$page_no";
		break;
	case 'msg':
		$base_url = "{$site}app/member/select.php?uid=$uid&langx=$langx";
		$filename="{$site}app/member/scroll_history.php?uid=$uid&langx=$langx&select_date=0";
		break;
	default:
		$gtype_browse=$gtype."_browse";
		$base_url = "{$site}app/member/".$gtype_browse."/index.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3";
		$filename="{$site}app/member/".$gtype_browse."/body_var.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3&page_no=$page_no";
		break;
	}
	//$base_url=$filename="http://g.com/a.php";
	$thisHttp = new cHTTP();
	$thisHttp->setReferer($base_url);

	$thisHttp->getPage($filename);

	$msg  = $thisHttp->getContent();
	if(!$msg){
		$msg2 = $thisHttp->get_error_msg();
		html_cache($msg2,$gtype,$rtype,$page_no);
	}else{
		html_cache($msg,$gtype,$rtype,$page_no);
	}
	/*if(in_array("$gtype",array("BS","FS"))==0){
		$msg .= gzinflate(substr($msg,10));
	}*/
	/*
	$dir = __DIR__ . '/../caiji/sport/content/';
	$filename = $gtype.'_'.$rtype.'_'.date('mdHis').'.html';
	file_put_contents($dir . $filename,$msg);
	*/
	
	$a = array(
"if(self == top)",
"<script>",
"</script>",
"parent.GameFT=new Array();",
"new Array('gid'",
"\n\n"
);
$b = array(
"",
"",
"",
"",
"",
""
);
unset($matches);
$html_data = str_replace($a,$b,$msg);
	return $html_data;
}

function theif_data($site,$uid,$gtype,$rtype,$langx,$page_no){
	//$uid = 'nth7hgbsem15069906l3415075';
	switch($gtype){
	case 'FU':
		$base_url = "{$site}app/member/FT_future/index.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3";
		$filename="{$site}app/member/FT_future/body_var.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3&page_no=$page_no";

		break;
	case 'FS':
		$base_url = "{$site}app/member/browse_FS/loadgame_R.php?rtype=fs&uid=$uid&langx=$langx&mtype=3";
		$filename = "{$site}app/member/browse_FS/reloadgame_R.php?mid=1&uid=$uid&langx=$langx&choice=ALL&LegGame=ALL&pages=1&records=40&FStype=FT&area_id=&league_id=&rtype=$rtype";
		break;
	case 'OU':
		$gtype_browse=$gtype."_browse";
		$base_url = "{$site}app/member/OP_future/index.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3";
		$filename="{$site}app/member/OP_future/body_var.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3&page_no=$page_no";
		break;
	case 'BKR':
		$base_url = "{$site}app/member/BK_future/index.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3";
		$filename="{$site}app/member/BK_future/body_var.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3&page_no=$page_no";
		break;
	case 'msg':
		$base_url = "{$site}app/member/select.php?uid=$uid&langx=$langx";
		$filename="{$site}app/member/scroll_history.php?uid=$uid&langx=$langx&select_date=0";
		break;
	default:
		$gtype_browse=$gtype."_browse";
		$base_url = "{$site}app/member/".$gtype_browse."/index.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3";
		$filename="{$site}app/member/".$gtype_browse."/body_var.php?rtype=$rtype&uid=$uid&langx=$langx&mtype=3&page_no=$page_no";
		break;
	}
	//$base_url=$filename="http://g.com/a.php";
	$thisHttp = new cHTTP();
	$thisHttp->setReferer($base_url);

	$thisHttp->getPage($filename);

	$msg  = $thisHttp->getContent();
	/*if(in_array("$gtype",array("BS","FS"))==0){
		$msg .= gzinflate(substr($msg,10));
	}*/
	$a = array(
"if(self == top)",
"<script>",
"</script>",
"parent.GameFT=new Array();",
"new Array('gid'",
"\n\n"
);
$b = array(
"",
"",
"",
"",
"",
""
);
unset($matches);
$html_data = str_replace($a,$b,$msg);
	return $html_data;
}

function write_file($filename,$data,$method="rb+",$iflock=1){
	@touch($filename);
	$handle=@fopen($filename,$method);
	if($iflock){
		@flock($handle,LOCK_EX);
	}
	@fputs($handle,$data);
	if($method=="rb+") @ftruncate($handle,strlen($data));
	@fclose($handle);
	@chmod($filename,0777);	
	if( is_writable($filename) ){
		return true;
	}else{
		return false;
	}
}
?>
