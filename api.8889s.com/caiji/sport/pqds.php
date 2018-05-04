<?php
//排球单式数据,60秒采集一次
include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';

$base = dirname(__FILE__);
include_once($base.'/include.php');
include $db_path.'mysqlis.php';
//header("Content-type: text/html; charset=utf-8");

$langx	=	'zh-tw';
$t_page	=	1;
$pages	=	0;
$total = 0;
$total_ok = 0;
do{
//for($pages=0;$pages<$t_page;$pages++){
	$data=theif_data2($webdb["datesite"],$webdb["cookie"],'VB','r',$langx,$pages);
	
	$show_pages	=	$pages+1;
	msg_log('采集第' . $show_pages .'页html成功!','info');	

	$pb=explode('t_page=',$data);
	$pb=explode(';',$pb[1]);
	$t_page=$pb[0]*1;
	
	if (sizeof(explode("gamount",$data))>1){
		preg_match_all("/g\((.+?)\);/is",$data,$matches);
		$cou=sizeof($matches[0]);

		msg_log('第' . $show_pages .'页html有'.$cou.'条赛事数据！','info');
		$total += $cou;
		$page_ok = 0;

		$sql	=	"update Volleyball_Match set Match_Type=0 WHERE match_coverdate>now()"; //默认所有赛事都关盘
		msg_log($sql,'sql');
		if(FALSE === $mysqlis->query($sql)){
			msg_log('更新赛事Match_Type失败：'.$sql,'error');
		}
		
		for($i=0;$i<$cou;$i++){
			$messages		=	$matches[0][$i];
			$messages		=	str_replace("g(","",$messages);
			$messages		=	str_replace(");","",$messages);
			$messages		=	str_replace("cha(9)","",$messages);
			$messages		=	str_replace("'","\"",$messages);
			$datainfo= json_decode($messages,true);
			
			if($datainfo[0]+0!=0){
				$datainfo[12] =	str_replace('U','',$datainfo[12]);
				$datainfo[11] =	str_replace('O','',$datainfo[11]);
				$datainfo[6] =	str_replace('<font color=gray>','',$datainfo[6]);
				$datainfo[6] =	str_replace('</font>','',$datainfo[6]);
				$datainfo[5] =	str_replace('<font color=gray>','',$datainfo[5]);
				$datainfo[5] =	str_replace('</font>','',$datainfo[5]);
				if(empty($datainfo[9])){$datainfo[9]=0;}//else{$datainfo[9]+=0.01;}
				if(empty($datainfo[10])){$datainfo[10]=0;}//else{$datainfo[10]+=0.01;}
				if(empty($datainfo[13])){$datainfo[13]=0;}//else{$datainfo[13]+=0.01;}
				if(empty($datainfo[14])){$datainfo[14]=0;}//else{$datainfo[14]+=0.01;}
				if(empty($datainfo[20])){
					$datainfo[20]	=	0;
				}else{
					$datainfo[20]	-=	0.01;
				}
				if(empty($datainfo[21])){
					$datainfo[21]	=	0;
				}else{
					$datainfo[21]	-=	0.01;
				}
				if(empty($datainfo[18])){$datainfo[18]=0;}
				if(empty($datainfo[17])){$datainfo[17]=0;}
				if(empty($datainfo[15])){$datainfo[15]=0;}
				if(empty($datainfo[16])){$datainfo[16]=0;}
				$time =	explode('<br>',strtolower($datainfo[1]));
				$isLose = isset($time[2]) ? '1' : '0';
				$CoverDate = date("Y").'-'.$time[0].' '.cdate($time[1]);
				$HgDate = $time[0].' '.$time[1];
				$sql = "select id from `Volleyball_Match` where Match_ID='".$datainfo[0]."'";
				$mysqlis->query($sql);
				if($mysqlis->affected_rows){ //有数据，更新
					$sql	=	"update Volleyball_Match set Match_Date='$time[0]',Match_Time='$time[1]',Match_Name='$datainfo[2]',Match_Master='$datainfo[5]',Match_Guest='$datainfo[6]',Match_Masterid='$datainfo[3]',Match_Guestid='$datainfo[4]',Match_IsLose='$isLose',Match_Type=1,Match_Ho='$datainfo[9]',Match_Ao='$datainfo[10]',Match_RGG='$datainfo[8]',Match_BzM='$datainfo[15]',Match_BzG='$datainfo[16]',Match_DxGG='$datainfo[11]',Match_DxDpl='$datainfo[14]',Match_DxXpl='$datainfo[13]',Match_DsDpl='$datainfo[20]',Match_DsSpl='$datainfo[21]',Match_ShowType='$datainfo[7]',Match_CoverDate='$CoverDate' WHERE Match_ID='$datainfo[0]' AND Match_StopUpdateds=0;";
				}else{ //没数据，插入
				    $datainfo[5] = strip_tags($datainfo[5]);
					$datainfo[6] = strip_tags($datainfo[6]);
					$sql	=	"insert into Volleyball_Match(Match_ID,Match_Date,Match_Time,Match_Name,Match_Master,Match_Guest,Match_Masterid,Match_Guestid,Match_IsLose,Match_Type,Match_Ho,Match_Ao,Match_RGG,Match_BzM,Match_BzG,Match_DxGG,Match_DxDpl,Match_DxXpl,Match_DsDpl,Match_DsSpl,Match_ShowType,Match_CoverDate,Match_MatchTime)values('$datainfo[0]','$time[0]','$time[1]','$datainfo[2]','$datainfo[5]','$datainfo[6]','$datainfo[3]','$datainfo[4]','$isLose',1,'$datainfo[9]','$datainfo[10]','$datainfo[8]','$datainfo[15]','$datainfo[16]','$datainfo[11]','$datainfo[14]','$datainfo[13]','$datainfo[20]','$datainfo[21]','$datainfo[7]','$CoverDate','$HgDate');";
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
