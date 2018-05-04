<?php
//足球滚球采集入库
include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';

$base = dirname(__FILE__);
include_once($base.'/include.php');
include_once($db_path."/mysqlis.php");
//header("Content-type: text/html; charset=utf-8");
$langx	=	'zh-tw';
$msg	=	0;

$data=theif_data2($webdb["datesite"],$webdb["cookie"],'FT','re',$langx,0);
$show_pages =   1;
msg_log('采集第' . $show_pages .'页html成功!','info');
if (sizeof(explode("gamount",$data))>1){
	//preg_match_all("/g\((.+?)\);/is",$data,$matches);
	preg_match_all("/(Array\(.+\);)/i",$data,$matches);
	$cou	=	sizeof($matches[0]);
    msg_log('第' . $show_pages .'页html有'.$cou.'条赛事数据！','info');
    $page_ok = 0;	
	for($i=1;$i<$cou;$i++){
		$messages		=	$matches[0][$i];
		$messages		=	str_replace("Array(","",$messages);
		$messages		=	str_replace(");","",$messages);
		$messages		=	str_replace("cha(9)","",$messages);
		$messages		=	str_replace("'","",$messages);
		$datainfo= explode(",",$messages);
		
		$datainfo[8]	=	str_replace(' ','',$datainfo[8]);  //客队
		$datainfo[11]	=	str_replace(' ','',$datainfo[11]);
		$datainfo[22]	=	str_replace(' ','',$datainfo[22]);
		$datainfo[25]	=	str_replace(' ','',$datainfo[25]);
		
		$datainfo[11]	=	substr($datainfo[11],1,strlen($datainfo[11])-1); //去UO
		$datainfo[25]	=	substr($datainfo[25],1,strlen($datainfo[25])-1); //去UO
		
		if(  $datainfo[9])	$datainfo[9]	+=	0.01;
		else $datainfo[9]					 =	0;
		if(  $datainfo[10])	$datainfo[10]	+=	0.01;
		else $datainfo[10]					 =	0;
		if(  $datainfo[13])	$datainfo[13]	+=	0.01;
		else $datainfo[13]					 =	0;
		if(  $datainfo[14])	$datainfo[14]	+=	0.01;
		else $datainfo[14]					 =	0;
		if(  $datainfo[23])	$datainfo[23]	+=	0.01;
		else $datainfo[23]					 =	0;
		if(  $datainfo[24])	$datainfo[24]	+=	0.01;
		else $datainfo[24]					 =	0;
		if(  $datainfo[27])	$datainfo[27]	+=	0.01;
		else $datainfo[27]					 =	0;
		if(  $datainfo[28])	$datainfo[28]	+=	0.01;
		else $datainfo[28]					 =	0;
		if( !$datainfo[33])	$datainfo[33]	 =	0;
		if( !$datainfo[34])	$datainfo[34]	 =	0;
		if( !$datainfo[35])	$datainfo[35]	 =	0;
		if( !$datainfo[36])	$datainfo[36]	 =	0;
		if( !$datainfo[37])	$datainfo[37]	 =	0;
		if( !$datainfo[38])	$datainfo[38]	 =	0;
		if(strpos($datainfo[1],'</font>')) $datainfo[1] = '45.5';
		$js				=	0;
		if(is_numeric($datainfo[1]) && $datainfo[1]*1 > 88) $js	=	-1;
		
		$match_matchtime	=	date("m-d").' '.datetoap(date("H:i"));
		
		$sql	=	"select id from `bet_match` where Match_ID='".$datainfo[0]."'";
		$mysqlis->query($sql);
		if($mysqlis->affected_rows){ //有数据，更新
			$sql	=	"update bet_match set Match_MasterID='$datainfo[3]',Match_HalfId='$datainfo[20]',Match_GuestID='$datainfo[4]',Match_Time='$datainfo[1]',Match_Type='2',Match_ShowType='$datainfo[7]',Match_Ho=$datainfo[9],Match_Ao=$datainfo[10],Match_RGG='$datainfo[8]',Match_BzM=$datainfo[33],Match_BzG=$datainfo[34],Match_BzH=$datainfo[35],Match_DxGG='$datainfo[11]',Match_DxDpl=$datainfo[14],Match_DxXpl=$datainfo[13],Match_Hr_ShowType='$datainfo[21]',Match_BRpk='$datainfo[22]',Match_BHo=$datainfo[23],Match_BAo=$datainfo[24],Match_Bdpl=$datainfo[28],Match_Bxpl=$datainfo[27],Match_BDxpk='$datainfo[25]',Match_Bmdy=$datainfo[36],Match_Bgdy=$datainfo[37],Match_Bhdy=$datainfo[38],Match_NowScore='$datainfo[18]:$datainfo[19]',Match_OverScore='$datainfo[18]:$datainfo[19]',Match_HRedCard='$datainfo[29]',Match_GRedCard='$datainfo[30]',Match_JS=$js,Match_LstTime=now(),iPage=1,iSn=".($i+1)." WHERE Match_ID='$datainfo[0]' AND Match_StopUpdateg=0";
		}else{ //没数据，插入
		$datainfo[5] = strip_tags($datainfo[5]);
					$datainfo[6] = strip_tags($datainfo[6]);
			$sql	=	"insert into bet_match(Match_ID,Match_Date,Match_Time,Match_Name,Match_Master,Match_Guest,Match_Type,Match_ShowType,Match_Ho,Match_Ao,Match_RGG,Match_DxGG,Match_DxDpl,Match_DxXpl,Match_Hr_ShowType,Match_BRpk,Match_BHo,Match_BAo,Match_Bdpl,Match_Bxpl,Match_BDxpk,Match_NowScore,Match_CoverDate,Match_MatchTime,Match_HRedCard,Match_GRedCard,Match_BzM,Match_BzG,Match_BzH,Match_Bmdy,Match_Bgdy,Match_Bhdy,Match_HalfId,Match_MasterID,Match_GuestID,Match_JS,Match_LstTime,iPage,iSn) values('$datainfo[0]','".date("m-d")."','$datainfo[1]','$datainfo[2]','$datainfo[5]','$datainfo[6]','2','$datainfo[7]',$datainfo[9],$datainfo[10],'$datainfo[8]','$datainfo[11]',$datainfo[14],$datainfo[13],'$datainfo[21]','$datainfo[22]',$datainfo[23],$datainfo[24],$datainfo[28],$datainfo[27],'$datainfo[25]','$datainfo[18]:$datainfo[19]',now(),'$match_matchtime','$datainfo[29]','$datainfo[30]',$datainfo[33],$datainfo[34],$datainfo[35],$datainfo[36],$datainfo[37],$datainfo[38],'$datainfo[20]','$datainfo[3]','$datainfo[4]',$js,now(),1,".($i+1).")";	
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


