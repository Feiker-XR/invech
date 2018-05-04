<?php
//采集篮球早餐数据,60秒采集一次
include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';

$base = dirname(__FILE__);
include_once($base.'/include.php');
include_once($db_path."mysqlis.php");
//header("Content-type: text/html; charset=utf-8");

$langx	=	'zh-tw';
$t_page	=	1;
$pages	=	0;
$total = 0;
$total_ok = 0;
do{
//for($pages=0;$pages<$t_page;$pages++){
	$data=theif_data2($webdb["datesite"],$webdb["cookie"],'BKR','all',$langx,$pages);

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
				$datainfo[12] =	str_replace('U','',$datainfo[12]);
				$datainfo[11] =	str_replace('O','',$datainfo[11]);
				$datainfo[6] =	str_replace('<font color=gray>','',$datainfo[6]);
				$datainfo[6] =	str_replace('</font>','',$datainfo[6]);
				$datainfo[5] =	str_replace('<font color=gray>','',$datainfo[5]);
				$datainfo[5] =	str_replace('</font>','',$datainfo[5]);
				
				if(empty($datainfo[9])){$datainfo[9]=0;}
				if(empty($datainfo[10])){$datainfo[10]=0;}
				if(empty($datainfo[13])){$datainfo[13]=0;}
				if(empty($datainfo[14])){$datainfo[14]=0;}
				if(empty($datainfo[20])){$datainfo[20]=0;}
				if(empty($datainfo[21])){$datainfo[21]=0;}
				if(empty($datainfo[18])){
					$datainfo[18]	=	0;
				}else{
					$datainfo[18]	-=	0.01;
				}
				if(empty($datainfo[17])){
					$datainfo[17]	=	0;
				}else{
					$datainfo[17]	-=	0.01;
				}
				
				if($datainfo[9]==0.01 || $datainfo[10]==0.01){ //皇冠测试水位，不显示
					$datainfo[8]	=	'';
					$datainfo[9]	=	0;
					$datainfo[10]	=	0;
				}
				if($datainfo[13]==0.01 || $datainfo[14]==0.01){ //皇冠测试水位，不显示
					$datainfo[11]	=	'';
					$datainfo[13]	=	0;
					$datainfo[14]	=	0;
				}
				
				$time =	explode('<br>',strtolower($datainfo[1]));
				$preg1 = "/(第[0-9]節)/";
				$match_type=0;
				if(preg_match($preg1,$datainfo[5]) || strpos($datainfo[5],"(上半)")){
					$match_type=3;
				}elseif(date("m-d")==$time[0]){
					$match_type=1;
				}elseif(date("m-d")<$time[0]){
					$match_type=0;
				}
				$isLose = isset($time[2]) ? '1' : '0';
				$CoverDate	=	date("Y").'-'.$time[0].' '.cdate($time[1]);
				$HgDate = $time[0].' '.$time[1];
				
				$sql = "select id from `Lq_Match` where Match_ID='".$datainfo[0]."'";
				msg_log($sql,'sql');
				$mysqlis->query($sql);
				if($mysqlis->affected_rows){ //有数据，更新
					if($match_type==1){
						$sql	=	"update lq_match set Match_Date='$time[0]',Match_Time='$time[1]',Match_IsLose=$isLose,Match_Type=$match_type,Match_ShowType='$datainfo[7]',Match_Ho='$datainfo[9]',Match_Ao='$datainfo[10]',Match_RGG='$datainfo[8]',Match_DxGG='$datainfo[11]',Match_DxDpl='$datainfo[14]',Match_DxXpl='$datainfo[13]',Match_DsDpl='$datainfo[20]',Match_DsSpl='$datainfo[21]',Match_CoverDate='$CoverDate',Match_MasterID='$datainfo[3]',Match_GuestID='$datainfo[4]',Match_LstTime=now(),iPage=".($pages+1).",iSn=".($i+1)." WHERE Match_ID=$datainfo[0]  AND Match_StopUpdateds=0;";
					}else{
						$sql	=	"update lq_match set Match_Date='$time[0]',Match_Time='$time[1]',Match_IsLose=$isLose,Match_Type=$match_type,Match_ShowType='$datainfo[7]',Match_Ho='$datainfo[9]',Match_Ao='$datainfo[10]',Match_RGG='$datainfo[8]',Match_DxGG='$datainfo[11]',Match_DxDpl='$datainfo[14]',Match_DxXpl='$datainfo[13]',Match_DsDpl='$datainfo[20]',Match_DsSpl='$datainfo[21]',Match_CoverDate='$CoverDate',Match_MasterID='$datainfo[3]',Match_GuestID='$datainfo[4]',Match_LstTime=now(),iPage=".($pages+1).",iSn=".($i+1)." WHERE Match_ID=$datainfo[0]  AND Match_StopUpdatezc=0;";
					}
				}else{ //没数据，插入
				    $datainfo[5] = strip_tags($datainfo[5]);
					$datainfo[6] = strip_tags($datainfo[6]);
					$sql	=	"insert into lq_match(Match_ID,Match_Date,Match_Time,Match_Name,Match_Master,Match_Guest,Match_IsLose,Match_Type,Match_ShowType,Match_Ho,Match_Ao,Match_RGG,Match_DxGG,Match_DxDpl,Match_DxXpl,Match_DsDpl,Match_DsSpl,Match_CoverDate,Match_MatchTime,Match_MasterID,Match_GuestID,Match_LstTime,iPage,iSn)values('$datainfo[0]','$time[0]','$time[1]','$datainfo[2]','$datainfo[5]','$datainfo[6]','$isLose','$match_type','$datainfo[7]','$datainfo[9]','$datainfo[10]','$datainfo[8]','$datainfo[11]','$datainfo[14]','$datainfo[13]','$datainfo[20]','$datainfo[21]','$CoverDate','$HgDate','$datainfo[3]','$datainfo[4]',now(),".($pages+1).",".($i+1).")";
				}
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