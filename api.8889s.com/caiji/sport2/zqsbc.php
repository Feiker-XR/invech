<?php
//足球上半场,60秒采集一次
include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';

include_once("include.php");
include_once($db_path."/mysqlis.php");

$langx	=	'zh-tw';
$t_page	=	1;
$pages	=	0;
$total = 0;
$total_ok = 0;
do{
//for($pages=0;$pages<$t_page;$pages++){
	$data=theif_data2($webdb["datesite"],$webdb["cookie"],'FT','hr',$langx,$pages);
	
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

		for($i=0;$i<$cou;$i++){
			$messages		=	$matches[0][$i];
			$messages		=	str_replace("g(","",$messages);
			$messages		=	str_replace(");","",$messages);
			$messages		=	str_replace("cha(9)","",$messages);
			$messages		=	str_replace("'","\"",$messages);
			$datainfo= json_decode($messages,true);
			if($datainfo[0]+0!=0){
				$datainfo[8]	=	str_replace(' ','',$datainfo[8]);
				$datainfo[11]	=	str_replace(' ','',$datainfo[11]);
				
				$datainfo[11]	=	substr($datainfo[11],1,strlen($datainfo[11])-1); //去UO
				
				if( !$datainfo[9])	$datainfo[9]	 =	0;
				if( !$datainfo[10])	$datainfo[10]	 =	0;
				if( !$datainfo[13])	$datainfo[13]	 =	0;
				if( !$datainfo[14])	$datainfo[14]	 =	0;
				if( !$datainfo[15])	$datainfo[15]	 =	0;
				if( !$datainfo[16])	$datainfo[16]	 =	0;
				if( !$datainfo[17])	$datainfo[17]	 =	0;
				
				$dx	=	array();
				$dx	=	get_HK_ior($datainfo[9],$datainfo[10]);
				$datainfo[9]	=	$dx[0];
				$datainfo[10]	=	$dx[1];
				$dx	=	get_HK_ior($datainfo[13],$datainfo[14]);
				$datainfo[13]	=	$dx[0];
				$datainfo[14]	=	$dx[1];
				$now = date("Y-m-d H:i:s");
				$sql	=	"Update bet_match set Match_Hr_ShowType='$datainfo[23]',Match_BRpk='$datainfo[8]',Match_BHo=$datainfo[9],Match_BAo=$datainfo[10],Match_Bdxpk='$datainfo[11]',Match_Bxpl=$datainfo[13],Match_Bdpl=$datainfo[14],Match_Bmdy=$datainfo[15],Match_Bgdy=$datainfo[16],Match_Bhdy=$datainfo[17],Match_LstTime='$now' WHERE Match_HalfId='$datainfo[0]' AND Match_StopUpdateb=0";
				
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
}while ($pages<$t_page);
msg_log('采集了' . $pages .'页，共' . $total . '条赛事数据，其中' . $total_ok . '条成功更新进数据库！','info');