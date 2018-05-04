<?php
include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';

$base = dirname(__FILE__);
//error_reporting(E_ERROR);
include_once $base.'/include.php';
include_once($db_path."mysqlis.php");
//include_once("../../Member/cache/conf.php");
$langx	=	'zh-tw';
$scend	=	3;
//$msg	=	$_GET['msg'] ? $_GET['msg']*1 : 0;
//$t_page	=	$_GET['t_page'] ? $_GET['t_page']*1 : 1;
//$pages	=	$_GET['pages'] ? $_GET['pages']*1 : 0;
$msg	=	$_GET['msg'] ?? 0;
$t_page	=	$_GET['t_page'] ?? 1;
$pages	=	$_GET['pages'] ?? 0;

$show_pages	=	$pages+1;
$show_msg	=	$msg;
$msg_num=0;
if($pages==0){
	$data=theif_data2($webdb["datesite"],$webdb["cookie"],'msg','r',$langx,$pages);
	$login_out_reg =  '/^(\w)+logout_warn(\w)+$/';
	//if()	
	//var_dump( $data);;
	preg_match_all("/<td class=\"m_lef\">(.+?)<\/td>/is",$data,$new_msg);
	//print_r($new_msg);
	if($new_msg[1]){
		foreach($new_msg[1] as $msgg){
				$n_msg=preg_replace("/(hg)(.*)(\.com)/iU", $conf_www, trim($msgg));
				$n_msg=preg_replace("/\+6[0-9]{10,20}/is", "", $n_msg);
				$n_msg=preg_replace("/客服中心(.*?)查詢/s", "客服中心", $n_msg);
				$n_msg=preg_replace("/本公司並沒有招收任何直線或現金會員的業務/s", "爲了您的資金利益安全，請不要隨便相信其他網址", $n_msg);
				$n_msg=preg_replace("/诈骗(.*?)查询./s", "", $n_msg);
				$n_msg=trim($n_msg);
				$like_msg=mb_substr($n_msg,0,80,'utf-8');
				$sql="select nid from k_notice where msg like '".$like_msg."%'";
				$abc=$mysqli->query($sql);
				if(mysqli_num_rows($abc)<1){
					//echo $sql."=======";
					$add_time=date("Y-m-d H:i:s");
					$end_time=date("Y-m-d H:i:s",(time()+3600*24*7));
					$sql="insert into k_notice(msg,is_show,end_time,add_time,sort) values('".$n_msg."','1','".$end_time."','".$add_time."','1')";
					//echo $sql."<br>";
					msg_log($sql,'sql');
					$mysqli->query($sql);
					$msg_num++;
				}
			
		}
	}
	$msg_num_msg=$msg_num.'条公告';
	//exit;
}

do{
	$data=theif_data2($webdb["datesite"],$webdb["cookie"],'FT','r',$langx,$pages);
//$data = file_get_contents('zqds.txt');
//file_put_contents('./zq.txt', $data);
	$pb=explode('t_page=',$data);
	$pb=explode(';',$pb[1]);
	$t_page=$pb[0]*1;
	preg_match_all("/parent.msg=\'(.+?)\';/is",$data,$new_msg);
	/*获取并过滤公告 开始*/
	$n_msg=preg_replace("/(hg)(.*)(\.com)/iU", $conf_www, trim($new_msg[1][0]));
	$n_msg=preg_replace("/\+6[0-9]{10,20}/is", "", $n_msg);
	$n_msg=preg_replace("/客服中心(.*?)查詢/s", "客服中心", $n_msg);
	$n_msg=preg_replace("/本公司並沒有招收任何直線或現金會員的業務/s", "爲了您的資金利益安全，請不要隨便相信其他網址", $n_msg);
	$n_msg=preg_replace("/诈骗(.*?)查询./s", "", $n_msg);
	$n_msg=trim($n_msg);
	/*获取并过滤公告 开始*/
	if($n_msg){
		$sql="select nid from k_notice where msg='".trim($n_msg)."'";
		$abc=$mysqli->query($sql);
		if(mysqli_num_rows($abc)<1){
			$add_time=date("Y-m-d H:i:s");
			$end_time=date("Y-m-d H:i:s",(time()+3600*24*7));
			$sql="insert into k_notice(msg,is_show,end_time,add_time,sort) values('".$n_msg."','1','".$end_time."','".$add_time."','1')";
			//echo $sql;exit;
			msg_log($sql,'sql');
			$mysqli->query($sql);
		}
	}
//echo "sadfads\r\n";	exit;
	if(sizeof(explode("gamount",$data))>1){
		$k=0;
		preg_match_all("/(Array\(.+\);)/i",$data,$matches);
		$cou=sizeof($matches[0]);
		for($i=0;$i<$cou;$i++){				
			$messages		=	$matches[0][$i];
			$messages		=	str_replace("Array(","",$messages);
			$messages		=	str_replace(");","",$messages);
			$messages		=	str_replace("cha(9)","",$messages);
			$messages		=	str_replace("'","",$messages);
			//var_dump($messages);exit;
			//$datainfo= json_decode($messages,true);
			$datainfo= explode(",",$messages);
			if($datainfo[0]+0!=0){				
				$datainfo[8]	=	str_replace(' ','',$datainfo[8]);
				$datainfo[11]	=	str_replace(' ','',$datainfo[11]);
				$datainfo[24]	=	str_replace(' ','',$datainfo[24]);
				$datainfo[27]	=	str_replace(' ','',$datainfo[27]);
				
				$datainfo[11]	=	substr($datainfo[11],1,strlen($datainfo[11])-1); //去UO
				$datainfo[27]	=	substr($datainfo[27],1,strlen($datainfo[27])-1); //去UO
				
				if( !$datainfo[9])	$datainfo[9]	 =	0;
				if( !$datainfo[10])	$datainfo[10]	 =	0;
				if( !$datainfo[13])	$datainfo[13]	 =	0;
				if( !$datainfo[14])	$datainfo[14]	 =	0;
				if( !$datainfo[20])	$datainfo[20]	 =	0;
				else $datainfo[20]	 -=	0.01;
				if( !$datainfo[21])	$datainfo[21]	 =	0;
				else $datainfo[21]	 -=	0.01;
				if( !$datainfo[25])	$datainfo[25]	 =	0;
				if( !$datainfo[26])	$datainfo[26]	 =	0;
				if( !$datainfo[29])	$datainfo[29]	 =	0;
				if( !$datainfo[30])	$datainfo[30]	 =	0;
				if( !$datainfo[34])	$datainfo[34]	 =	0;
				if( !$datainfo[15])	$datainfo[15]	 =	0;
				if( !$datainfo[16])	$datainfo[16]	 =	0;
				if( !$datainfo[17])	$datainfo[17]	 =	0;
				if( !$datainfo[31])	$datainfo[31]	 =	0;
				if( !$datainfo[32])	$datainfo[32]	 =	0;
				if( !$datainfo[33])	$datainfo[33]	 =	0;
				
				$dx	=	array();
				$dx	=	get_HK_ior($datainfo[9],$datainfo[10]);
				$datainfo[9]	=	$dx[0];
				$datainfo[10]	=	$dx[1];
				$dx	=	get_HK_ior($datainfo[13],$datainfo[14]);
				$datainfo[13]	=	$dx[0];
				$datainfo[14]	=	$dx[1];
				
				$time			=	explode('<br>',strtolower($datainfo[1]));
				$isLose			=	isset($time[2]) ? '1' : '0';
				$CoverDate		=	date("Y").'-'.$time[0].' '.cdate($time[1]);
				
				$sql	=	"select id from `bet_match` where Match_ID='".$datainfo[0]."'";
				$a = $mysqlis->query($sql);			
				//if($mysqlis->affected_rows){ //有数据，更新
				if(mysqli_num_rows($a)>0){
					$sql	=	"update bet_match set Match_HalfId='$datainfo[22]',Match_MasterID='$datainfo[3]',Match_GuestID='$datainfo[4]',Match_Date='$time[0]',Match_Time='$time[1]',Match_IsLose='$isLose',Match_Type=1,Match_ShowType='$datainfo[7]',Match_Ho=$datainfo[9],Match_Ao=$datainfo[10],Match_RGG='$datainfo[8]',Match_BzM=$datainfo[15],Match_BzG=$datainfo[16],Match_BzH=$datainfo[17],Match_DxGG='$datainfo[11]',Match_DxDpl=$datainfo[14],Match_DxXpl=$datainfo[13],Match_DsDpl=$datainfo[20],Match_DsSpl=$datainfo[21],Match_Hr_ShowType='$datainfo[23]',Match_BRpk='$datainfo[24]',Match_BHo=$datainfo[25],Match_BAo=$datainfo[26],Match_Bdpl=$datainfo[30],Match_Bxpl=$datainfo[29],Match_BDxpk='$datainfo[27]',Match_Bmdy=$datainfo[31],Match_Bgdy=$datainfo[32],Match_Bhdy=$datainfo[33],Match_TypePlay=$datainfo[34],Match_CoverDate='$CoverDate',Match_LstTime=now(),iPage=".($pages+1).",iSn=".($i+1)." WHERE Match_ID='$datainfo[0]' AND Match_StopUpdateds=0";
				}else{ //没数据，插入
				$datainfo[5] = strip_tags($datainfo[5]);
					$datainfo[6] = strip_tags($datainfo[6]);
					$sql	=	"insert into `bet_match` (Match_ID,Match_HalfId,Match_Date,Match_Time,Match_Name,Match_Master,Match_Guest,Match_IsLose,Match_Type,Match_ShowType,Match_Ho,Match_Ao,Match_RGG,Match_BzM,Match_BzG,Match_BzH,Match_DxGG,Match_DxDpl,Match_DxXpl,Match_DsDpl,Match_DsSpl,Match_Hr_ShowType,Match_BRpk,Match_BHo,Match_BAo,Match_Bdpl,Match_Bxpl,Match_BDxpk,Match_CoverDate,Match_MasterID,Match_GuestID,Match_Bmdy,Match_Bgdy,Match_Bhdy,Match_TypePlay,Match_MatchTime,Match_LstTime,iPage,iSn) values ('$datainfo[0]','$datainfo[22]','$time[0]','$time[1]','$datainfo[2]','$datainfo[5]','$datainfo[6]','$isLose',1,'$datainfo[7]',$datainfo[9],$datainfo[10],'$datainfo[8]',$datainfo[15],$datainfo[16],$datainfo[17],'$datainfo[11]',$datainfo[14],$datainfo[13],$datainfo[20],$datainfo[21],'$datainfo[23]','$datainfo[24]',$datainfo[25],$datainfo[26],$datainfo[30],$datainfo[29],'$datainfo[27]','$CoverDate','$datainfo[3]','$datainfo[4]',$datainfo[31],$datainfo[32],$datainfo[33],$datainfo[34],'".$time[0].' '.$time[1]."',now(),".($pages+1).",".($i+1).")";					
				}
				msg_log($sql,'sql');
				$mysqlis->query($sql);
				$msg++;
			}
		}
	}
	msg_log('处理了' . $msg . '条记录','info');
	$show_msg	=	$msg;
	$pages++;
	sleep(3);
}while ($pages<$t_page);
