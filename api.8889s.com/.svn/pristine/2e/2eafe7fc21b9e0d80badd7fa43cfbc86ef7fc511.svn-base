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
	//error_reporting(E_ALL);
	//ini_set('display_errors',1);
	$leaguename	 =	explode("$",urldecode($_GET["leaguename"]));
	//var_dump($leaguename);
	$v			 =	(count($leaguename)>1 ? 'and (' : 'and' );
	$sqlwhere	.=	" $v match_name='".replace_mysql_input($leaguename[0])."'";
	//echo __LINE__;
	for($is=1; $is<count($leaguename)-1; $is++){
		$sqlwhere.=	" or match_name='".replace_mysql_input($leaguename[$is])."'";
		//echo __LINE__;
	}
	//echo __LINE__;
	$sqlwhere	.=	(count($leaguename)>1 ? ')' : '' );
}

$sql		=	"select id from bet_match WHERE Match_Type=1 AND Match_CoverDate>'".date('Y-m-d H:i:s')."' AND Match_Date='".date("m-d")."' and Match_HalfId is not null ".$sqlwhere.' order by Match_CoverDate,iPage,match_name,Match_Master,Match_ID,iSn';
//echo $sql;
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
	
	$sql	=	"select match_name from bet_match WHERE Match_Type=1 AND Match_CoverDate>'".date('Y-m-d H:i:s')."' AND Match_Date='".date("m-d")."' and Match_HalfId is not null group by match_name";
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
	$sql	=	"SELECT Match_ID, Match_HalfId, Match_Date, Match_Time, Match_Master, Match_Guest, Match_RGG, Match_Name, Match_IsLose, Match_BzM, Match_BzG, Match_BzH, Match_DxDpl, Match_DxXpl, Match_DxGG, Match_Ho, Match_Ao, Match_MasterID, Match_GuestID, Match_ShowType, Match_Type, Match_DsDpl, Match_DsSpl,Match_Bmdy,Match_BHo,Match_Bdpl,Match_Bgdy,Match_BAo,Match_Bxpl,Match_Bhdy,Match_BRpk,Match_Bdxpk,Match_Hr_ShowType FROM Bet_Match where id in($id) order by Match_CoverDate,iPage,match_name,Match_Master,Match_ID,iSn";
	$query	=	$mysqlis->query($sql);
	$i		=	0;
	while($rows = $query->fetch_array()){ 
		$json["db"][$i]["Match_ID"]			=	$rows["Match_ID"];  
		$json["db"][$i]["Match_Master"]		=	strip_tags($rows["Match_Master"]);  
		$json["db"][$i]["Match_Guest"]		=	strip_tags($rows["Match_Guest"]);   
		$json["db"][$i]["Match_Name"]		=	$rows["Match_Name"];   
		$Match_Time=substr($rows["Match_Time"],0,5);
		//exit(substr($rows["Match_Time"],-1));
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
		$rows["Match_BzM"]<>""?$a=$rows["Match_BzM"]:$a=0;
		$json["db"][$i]["Match_BzM"]		=	$a;  
		double_format($rows["Match_Ho"])<>""?$b=double_format($rows["Match_Ho"]):$b=0;
		$json["db"][$i]["Match_Ho"]			=	$b;    
		$rows["Match_DxDpl"]<>""?$c=$rows["Match_DxDpl"]:$c=0;
		$json["db"][$i]["Match_DxDpl"]		=	$c;   
		$rows["Match_DsDpl"]<>""?$d=$rows["Match_DsDpl"]:$d=0;
		$json["db"][$i]["Match_DsDpl"]		=	$d;    
		$rows["Match_BzG"]<>""?$e=$rows["Match_BzG"]:$e=0;
		$json["db"][$i]["Match_BzG"]		=	$e;   
		$rows["Match_Ao"]<>""?$f=$rows["Match_Ao"]:$f=0;
		$json["db"][$i]["Match_Ao"]			=	$f;   
		$rows["Match_DxXpl"]<>""?$g=$rows["Match_DxXpl"]:$g=0;
		$json["db"][$i]["Match_DxXpl"]		=	$g;   
		$rows["Match_DsSpl"]<>""?$h=$rows["Match_DsSpl"]:$h=0;
		$json["db"][$i]["Match_DsSpl"]		=	$h;    
		$rows["Match_BzH"]<>""?$k=$rows["Match_BzH"]:$k=0;
		$json["db"][$i]["Match_BzH"]		=	$k;     
		$rows["Match_RGG"]<>""?$j=$rows["Match_RGG"]:$j=0;
		$json["db"][$i]["Match_RGG"]		=	$j;   
		$rows["Match_DxGG"]<>""?$m="大".$rows["Match_DxGG"]:$m=0;
		$json["db"][$i]["Match_DxGG1"]		=	$m;    
		$json["db"][$i]["Match_ShowType"]	=	$rows["Match_ShowType"];
		$rows["Match_DxGG"]<>""?$n="小".$rows["Match_DxGG"]:$n=0;
		$json["db"][$i]["Match_DxGG2"]		=	$n;   
		$json["db"][$i]["Match_Bmdy"]		=	$rows["Match_Bmdy"]<>"" ? $rows["Match_Bmdy"] : 0;
		$json["db"][$i]["Match_BHo"]		=	$rows["Match_BHo"]<>"" ? $rows["Match_BHo"] : 0;
		$json["db"][$i]["Match_Bdpl"]		=	$rows["Match_Bdpl"]<>"" ? $rows["Match_Bdpl"] : 0;
		$json["db"][$i]["Match_Bgdy1"]		=	$rows["Match_Bgdy"]<>"" ? $rows["Match_Bgdy"] : 0;
		$json["db"][$i]["Match_Bgdy2"]		=	$rows["Match_Bgdy"]<>"" ? $rows["Match_Bgdy"] : 0;
		$json["db"][$i]["Match_BAo"]		=	$rows["Match_BAo"]<>"" ? $rows["Match_BAo"] : 0;
		$json["db"][$i]["Match_Bxpl"]		=	$rows["Match_Bxpl"]<>"" ? $rows["Match_Bxpl"] : 0;
		$json["db"][$i]["Match_Bhdy1"]		=	$rows["Match_Bhdy"]<>"" ? $rows["Match_Bhdy"] : 0;
		$json["db"][$i]["Match_Bhdy2"]		=	$rows["Match_Bhdy"]<>"" ? $rows["Match_Bhdy"] : 0;
		$json["db"][$i]["Match_BRpk"]		=	$rows["Match_BRpk"]<>"" ? $rows["Match_BRpk"] : 0;
		$json["db"][$i]["Match_Bdxpk1"]		=	$rows["Match_Bdxpk"]<>"" ? '大'.$rows["Match_Bdxpk"] : '';
		$json["db"][$i]["Match_Hr_ShowType"]		=	$rows["Match_Hr_ShowType"]<>"" ? $rows["Match_Hr_ShowType"] : '';
		$json["db"][$i]["Match_Bdxpk2"]		=	$rows["Match_Bdxpk"]<>"" ? '小'.$rows["Match_Bdxpk"] : '';
		$i++;
	}
}
echo $callback."(".json_encode($json).")";
?>