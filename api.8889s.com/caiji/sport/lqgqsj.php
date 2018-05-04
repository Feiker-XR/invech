<?php
//采集篮球滚球信息入缓存,每10秒采集一次
include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';

$base = dirname(__FILE__);
include($base.'/include.php');
include $db_path.'mysqlis.php';
$langx	=	'zh-cn';
$t_page	=	1;
$msg	=	0;

$data=theif_data2($webdb["datesite"],$webdb["cookie"],'BK','re',$langx,0);
$show_pages =   1;
msg_log('采集第' . $show_pages .'页html成功!','info');
if (sizeof(explode("gamount",$data))>1){
	//echo "52355";exit;
	    preg_match_all("/(Array\(.+\);)/i",$data,$matches);
		$cou=sizeof($matches[0]);
	    msg_log('第' . $show_pages .'页html有'.$cou.'条赛事数据！','info');
	    $page_ok = 0;			
		for($i=0;$i<$cou;$i++){
			$messages		=	$matches[0][$i];
			$messages		=	str_replace("Array(","",$messages);
			$messages		=	str_replace(");","",$messages);
			$messages		=	str_replace("cha(9)","",$messages);
			$messages		=	str_replace("'","",$messages);
			$datainfo= explode(",",$messages);
		
		//echo $messages."<br>";
		//$datainfo= json_decode($messages,true);
		//print_r($datainfo);exit;
		//$datainfo		=	eval("return $messages;");
		
		$datainfo[5]	=	preg_replace("/<[^>]*>/","",$datainfo[5]);
		$datainfo[6]	=	preg_replace("/<[^>]*>/","",$datainfo[6]);
		$datainfo[8]	=	str_replace(' ','',$datainfo[8]);
		$datainfo[11]	=	str_replace(' ','',$datainfo[11]);
		$datainfo[11]	=	substr($datainfo[11],1,strlen($datainfo[11])-1);
		$datainfo[32]	=	substr($datainfo[32],0,5);
		
		if( !$datainfo[9])	$datainfo[9]	 =	0;
		if( !$datainfo[10])	$datainfo[10]	 =	0;
		if( !$datainfo[13])	$datainfo[13]	 =	0;
		if( !$datainfo[14])	$datainfo[14]	 =	0;
		if( !$datainfo[18])	$datainfo[18]	 =	0;
		if( !$datainfo[19])	$datainfo[19]	 =	0;
		
		$CoverDate		=	date("Y-m-d").' '.cdate($datainfo[1]);
		$HgDate			=	date("m-d").' '.$datainfo[1];
		//$tmpids .= $datainfo[0] .',';
		$sql			=	"select id from `lq_match` where Match_ID='$datainfo[0]'";
		$mysqlis->query($sql);
		if($mysqlis->affected_rows){ //有数据，更新
			$sql		=	"update lq_match set Match_Time='$datainfo[1]',Match_Type=2,Match_ShowType='$datainfo[7]',Match_Ho='$datainfo[9]',Match_Ao='$datainfo[10]',Match_RGG='$datainfo[8]',Match_DxGG='$datainfo[11]',Match_DxDpl='$datainfo[14]',Match_DxXpl='$datainfo[13]',Match_MasterID='$datainfo[3]',Match_GuestID='$datainfo[4]',Match_LstTime=now() WHERE Match_ID='$datainfo[0]' AND Match_StopUpdateg=0";
		}else{ //没数据，插入
		    $datainfo[5] = strip_tags($datainfo[5]);
					$datainfo[6] = strip_tags($datainfo[6]);
			$sql		=	"insert into lq_match(Match_ID,Match_Time,Match_Date,Match_Name,Match_Master,Match_Guest,Match_Type,Match_ShowType,Match_Ho,Match_Ao,Match_RGG,Match_DxGG,Match_DxDpl,Match_DxXpl,Match_CoverDate,Match_MatchTime,Match_MasterID,Match_GuestID,Match_LstTime,iPage,iSn) values ('$datainfo[0]','$datainfo[1]','".date("m-d")."','$datainfo[2]','$datainfo[5]','$datainfo[6]',2,'$datainfo[7]','$datainfo[9]','$datainfo[10]','$datainfo[8]','$datainfo[11]','$datainfo[14]','$datainfo[13]','$CoverDate','$HgDate','$datainfo[3]','$datainfo[4]',now(),1,".($i+1).")";
		}
		msg_log($sql,'sql');
		if(FALSE === $mysqlis->query($sql)){
			msg_log('更新赛事失败：'.$sql,'error');
		}else{
			$page_ok++;
		}
	}
	msg_log('第' . $show_pages .'页成功更新'.$page_ok.'条赛事数据！','info');
}else{
	msg_log('第' . $show_pages .'页html没有赛事数据！','info');	
}
