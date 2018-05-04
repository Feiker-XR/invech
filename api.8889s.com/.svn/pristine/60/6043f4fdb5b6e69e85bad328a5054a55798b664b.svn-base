<?php
include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';
/*
$str = "Array('2874058','09-02<br>05:00a','日本J2联赛','60392','60391','山形蒙迪奥','冈山雉鸡','H','4.4','16','31','5.9','4.5','6','31','16','4.55','Y');";
eval("\$str = $str");
*/
$base = dirname(__FILE__);
include_once($base.'/include.php');
include_once($db_path."/mysqlis.php");
//header("Content-type: text/html; charset=utf-8");
$langx	=	'zh-tw';
//$scend	=	3;
//$msg	=	0;
$t_page	=	1;
$pages	=	0;
//$show_pages	=	$pages+1;
//$show_msg	=	$msg;
$total = 0;
$total_ok = 0;
do{
//for($pages=0;$pages<$t_page;$pages++){
	$data=theif_data2($webdb["datesite"],$webdb["cookie"],'FT','f',$langx,$pages);
	
	$show_pages	=	$pages+1;
	msg_log('采集第' . $show_pages .'页html成功!','info');
	
	$pb=explode('t_page=',$data);
	$pb=explode(';',$pb[1]);
	$t_page=$pb[0]*1;
	
	if (sizeof(explode("gamount",$data))>1){
		preg_match_all("/(Array\(.+\);)/i",$data,$matches);
		$cou=sizeof($matches[0]);

		msg_log('第' . $show_pages .'页html有'.$cou.'条赛事数据！','info');
		$total += $cou;
		$page_ok = 0;
		
		for($i=0;$i<$cou;$i++){
			$messages		=	$matches[0][$i];
			$messages		=	str_replace("Array(","",$messages);
			$messages		=	str_replace(");","",$messages);
			$messages		=	str_replace("cha(9)","",$messages);
			$messages		=	str_replace("'","",$messages);
			$datainfo= explode(",",$messages);

			if($datainfo[0]+0!=0){
				$sql	=	"update bet_match set Match_BqMM=$datainfo[8],Match_BqMH=$datainfo[9],Match_BqMG=$datainfo[10],Match_BqHM='$datainfo[11]',Match_BqHH=$datainfo[12],Match_BqHG=$datainfo[13],Match_BqGM=$datainfo[14],Match_BqGH='$datainfo[15]',Match_BqGG='$datainfo[16]',Match_LstTime=now() WHERE Match_ID='$datainfo[0]' AND Match_StopUpdatebq=0";
				msg_log($sql,'sql');
				if(FALSE === $mysqlis->query($sql)){
					msg_log('更新赛事失败：'.$sql,'error');
				}else{
					$page_ok++;
					$total_ok++;
				}				
			}
		}
		msg_log('第' . $show_pages .'页成功更新'.$page_ok.'条赛事数据！','info');
	}else{
    	msg_log('第' . $show_pages .'页html没有赛事数据！','info');
	}
	$pages++;
}while($pages<$t_page);
msg_log('采集了' . $pages .'页，共' . $total . '条赛事数据，其中' . $total_ok . '条成功更新进数据库！','info');
