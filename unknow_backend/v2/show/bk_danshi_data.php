<?php
header('Content-type: text/json; charset=utf-8');
include_once("../include/pd_user_json.php");
include_once("../include/mysqlis.php");
include_once("../common/function.php");
$this_page	=	0; //当前页
if(intval($_GET["CurrPage"])>0) $this_page	=	intval($_GET["CurrPage"]);
$this_page++;
$bk			=	40; //每页显示多少条记录
$sqlwhere	=	''; //where 条件
$id			=	''; //ID字符串
$i			=	1; //记录总个数
$start		=	($this_page-1)*$bk+1; //本页记录开始位置
$end		=	$this_page*$bk; //本页记录结束位置
//页数统计
if(@$_GET["leaguename"]<>""){
	$leaguename	 =	explode("$",urldecode($_GET["leaguename"]));
	$v			 =	(count($leaguename)>1 ? 'and (' : 'and' );
	$sqlwhere	.=	" $v match_name='".replace_mysql_input($leaguename[0])."'";
	for($is=1; $is<count($leaguename)-1; $is++){
		$sqlwhere.=	" or match_name='".replace_mysql_input($leaguename[$is])."'";
	}
	$sqlwhere	.=	(count($leaguename)>1 ? ')' : '' );
}

$sql		=	"select id from lq_match WHERE Match_CoverDate>'".date('Y-m-d H:i:s')."' AND Match_Date='".date("m-d")."' ".$sqlwhere.'  order by Match_CoverDate,iPage,iSn,Match_ID,match_name,Match_Master';
$query		=	$mysqlis->query($sql);
while($row	=	$query->fetch_array()){
	if($i  >= $start && $i <= $end){
		$id	=	$row['id'].','.$id;
	}
	$i++;
}
if($i == 1){ //未查找到记录
	$json["dh"]	=	0;
	$json["fy"]["p_page"] = 0; 
}else{
	$id			=	rtrim($id,',');
	$json["fy"]["p_page"] 	= ceil($i/$bk); //总页数
	$json["fy"]["page"] 	= $this_page-1;
	
	$sql	=	"select match_name from lq_match WHERE Match_CoverDate>'".date('Y-m-d H:i:s')."' AND Match_Date='".date("m-d")."' group by match_name";
	$query	=	$mysqlis->query($sql);
	$i		=	0;
	$lsm	=	'';
	while($row = $query->fetch_array()){
		$lsm	.=	urlencode($row['match_name']).'|';
		$i++;
	}
	$json["lsm"]=	rtrim($lsm,'|');
	$json["dh"]	=	ceil($i/3)*30; //窗口高度 px 值
	
	//赛事数据
	//$sql	=	"SELECT Match_ID, Match_Date, Match_Time, Match_Master, Match_Guest, Match_RGG, Match_Name, Match_IsLose, Match_DxDpl, Match_DxXpl, Match_DxGG, Match_Ho, Match_Ao, Match_MasterID, Match_GuestID, Match_ShowType, Match_Type, Match_DsDpl, Match_DsSpl,Match_BzM,Match_BzG,Match_DFzDX,Match_DFzDpl,Match_DFzXpl,Match_DFkDX,Match_DFkDpl,Match_DFkXpl FROM lq_match where id in($id) order by Match_CoverDate,iPage,iSn,Match_ID,match_name,Match_Master";
	
	$sql	=	"SELECT Match_ID, Match_Date, Match_Time, Match_Master, Match_Guest, Match_RGG, Match_Name, Match_IsLose, Match_DxDpl, Match_DxXpl, Match_DxGG, Match_Ho, Match_Ao, Match_MasterID, Match_GuestID, Match_ShowType, Match_Type, Match_DsDpl, Match_DsSpl FROM lq_match where id in($id) order by Match_CoverDate,iPage,iSn,Match_ID,match_name,Match_Master";
	//echo $sql;
	
	$query	=	$mysqlis->query($sql);
	$i		=	0;
	while($rows = $query->fetch_array()){ 
		if($rows["Match_Ho"]==0 && $rows["Match_DxGG1"]==0 && $rows["Match_DsDpl"]==0){
			continue;
		}else{
			$json["db"][$i]["Match_ID"] = $rows["Match_ID"];
			$json["db"][$i]["Match_Master"] = $rows["Match_Master"];
			$json["db"][$i]["Match_Guest"] = $rows["Match_Guest"];
			$json["db"][$i]["Match_Name"] = $rows["Match_Name"];
			$Match_Time=substr($rows["Match_Time"],0,5);
		if(substr($rows["Match_Time"],-1)=='p'){
			$time_arr=explode(':',$Match_Time);
			if($time_arr[0]==12) $Match_Time=$time_arr[0].':'.$time_arr[1];
			else $Match_Time=($time_arr[0]+12).':'.$time_arr[1];
		}
		$mdate	=	$rows["Match_Date"]."<br/>".$Match_Time;
			if ($rows["Match_IsLose"]==1){
				$mdate.= "<br><font color=red>滾球</font>";
			}
			$json["db"][$i]["Match_Date"]		=	$mdate;
			$json["db"][$i]["Match_Ho"]			=	$rows["Match_Ho"];
			$json["db"][$i]["Match_DxDpl"]		=	$rows["Match_DxDpl"] ? $rows["Match_DxDpl"] : 0;
			$json["db"][$i]["Match_DsDpl"]		=	$rows["Match_DsDpl"] ? $rows["Match_DsDpl"] : 0;
			$json["db"][$i]["Match_Ao"]			=	$rows["Match_Ao"];
			$json["db"][$i]["Match_DxXpl"]		=	$rows["Match_DxXpl"] ? $rows["Match_DxXpl"] : 0;
			$json["db"][$i]["Match_DsSpl"]		=	$rows["Match_DsSpl"] ? $rows["Match_DsSpl"] : 0;;
			$json["db"][$i]["Match_RGG"]		=	$rows["Match_RGG"];
			$json["db"][$i]["Match_DxGG1"]		=	$rows["Match_DxGG"]<>"" ? "大".$rows["Match_DxGG"] : '';
			$json["db"][$i]["Match_ShowType"]	=	$rows["Match_ShowType"];
			$json["db"][$i]["Match_DxGG2"]		=	$rows["Match_DxGG"]<>"" ? "小".$rows["Match_DxGG"] : '';
			
			$json["db"][$i]["Match_BzM"]		=	$rows["Match_BzM"]<>"" ? $rows["Match_BzM"] : 0;
			$json["db"][$i]["Match_BzG"]		=	$rows["Match_BzG"]<>"" ? $rows["Match_BzG"] : 0;
			$json["db"][$i]["Match_DFzDX1"]		=	$rows["Match_DFzDX"]<>0 ? '大'.$rows["Match_DFzDX"] : '';
			$json["db"][$i]["Match_DFzDpl"]		=	$rows["Match_DFzDpl"]<>"" ? $rows["Match_DFzDpl"] : 0;
			$json["db"][$i]["Match_DFzDX2"]		=	$rows["Match_DFzDX"]<>0 ? '小'.$rows["Match_DFzDX"] : '';
			$json["db"][$i]["Match_DFzXpl"]		=	$rows["Match_DFzXpl"]<>"" ? $rows["Match_DFzXpl"] : 0;
			$json["db"][$i]["Match_DFkDX1"]		=	$rows["Match_DFkDX"]<>0 ? '大'.$rows["Match_DFkDX"] : '';
			$json["db"][$i]["Match_DFkDpl"]		=	$rows["Match_DFkDpl"]<>"" ? $rows["Match_DFkDpl"] : 0;
			$json["db"][$i]["Match_DFkDX2"]		=	$rows["Match_DFkDX"]<>0 ? '小'.$rows["Match_DFkDX"] : '';
			$json["db"][$i]["Match_DFkXpl"]		=	$rows["Match_DFkXpl"]<>"" ? $rows["Match_DFkXpl"] : 0;
		}
		$i++;
	}
}
//print_r($json);exit;
echo $callback."(".json_encode($json).");";
?>