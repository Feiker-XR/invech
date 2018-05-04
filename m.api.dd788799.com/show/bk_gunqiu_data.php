<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");  
header('Content-type: text/json; charset=utf-8');
include_once("../../member/cache/lqgq.php");
include_once("../include/pd_user_json.php");
if(time()-$lasttime > 3){
	if($count == 0){ //没数据
		$json["dh"]	=	0;
		$json["fy"]["p_page"] = "0";
		echo $callback."(".json_encode($json).");";
		exit;
	}else{ //有数据重新采集一次，看是否有数据
		include_once("../../member/include/function_cj1.php");
		if(lqgq_cj()){
			include("../../member/cache/lqgq.php"); //重新载入
		}else{
			$json["dh"]	=	0;
			$json["fy"]["p_page"] = "0";
			echo $callback."(".json_encode($json).");";
			exit;
		}
	}
}
$bk			=	40; //每页显示记录总个数
$this_page	=	0; //当前页
if(intval($_GET["CurrPage"])>0) $this_page	=	$_GET["CurrPage"];
$this_page++;
$start		=	($this_page-1)*$bk; //本页记录开始位置，数组从0开始
$end		=	$this_page*$bk-1; //本页记录结束位置，数组从0开始，所以要减1

$match_names=	array();
$info_array	=	array();

if(isset($lqgq) && !empty($lqgq)){
	$zqcount = count($lqgq);
	for($i=0; $i<$zqcount; $i++){
		$rows[] = $lqgq[$i];      ////保留所有的数据
		$match_names[] = $lqgq[$i]['Match_Name'];    ////只保留联赛名
	}
}

$match_name_array = array_values(array_unique($match_names));
if(@$_GET["leaguename"]<>""){
	$leaguename = explode("$",urldecode($_GET["leaguename"]));
	$nums_arr = count($rows);
	for($i=0; $i<$nums_arr; $i++){
		if(in_array($rows[$i]["Match_Name"],$leaguename)){
			$info1[] = $rows[$i];
		}
	}
	$rows = $info1;
}


$count_num = count($rows);
if($count_num == "0"){
	$json["dh"]	=	0;
	$json["fy"]["p_page"]	=	0;
}else{		
	$json["fy"]["p_page"]	=	ceil($count_num/$bk); //总页数
	$json["fy"]["page"] 	=	$this_page-1;
	//联赛名字
	$i	=	0;
	$lsm=	'';
	foreach($match_name_array as $t){
		$lsm	.=	urlencode($t).'|';
		$i++;
	}
	$json["lsm"]=	rtrim($lsm,'|');
	$json["dh"]	=	ceil($i/3)*30; //窗口高度 px 值
	if($end > $count_num-1) $end = $count_num-1;
	$i	=	0;
	for($b=$start; $b<=$end; $b++){
		$json["db"][$i]["Match_ID"]			=	$rows[$b]["Match_ID"];
		$json["db"][$i]["Match_Master"]		=	$rows[$b]["Match_Master"];
		$json["db"][$i]["Match_Guest"]		=	$rows[$b]["Match_Guest"];
		$json["db"][$i]["Match_Name"]		=	$rows[$b]["Match_Name"];
		$json["db"][$i]["Match_Time"]		=	$rows[$b]["Match_Time"];
		$json["db"][$i]["Match_Ho"]			=	$rows[$b]["Match_Ho"];
		$json["db"][$i]["Match_DxDpl"]		=	$rows[$b]["Match_DxDpl"];
		$json["db"][$i]["Match_DsDpl"]		=	$rows[$b]["Match_DsDpl"];
		$json["db"][$i]["Match_Ao"]			=	$rows[$b]["Match_Ao"];
		$json["db"][$i]["Match_DxXpl"]		=	$rows[$b]["Match_DxXpl"]<>"" ? $rows[$b]["Match_DxXpl"] : 0;
		$json["db"][$i]["Match_DsSpl"]		=	$rows[$b]["Match_DsSpl"]<>"" ? $rows[$b]["Match_DsSpl"] : 0;
		$json["db"][$i]["Match_RGG"]		=	$rows[$b]["Match_RGG"];
		$json["db"][$i]["Match_DxGG1"]		=	$rows[$b]["Match_DxGG"] ? "大".$rows[$b]["Match_DxGG"] : '';
		$json["db"][$i]["Match_ShowType"]	=	$rows[$b]["Match_ShowType"];
		$json["db"][$i]["Match_DxGG2"]		=	$rows[$b]["Match_DxGG"] ? "小".$rows[$b]["Match_DxGG"]: '';
		
		/*$json["db"][$i]["Match_BzM"]		=	$rows[$b]["Match_BzM"]<>"" ? $rows[$b]["Match_BzM"] : 0;
		$json["db"][$i]["Match_BzG"]		=	$rows[$b]["Match_BzG"]<>"" ? $rows[$b]["Match_BzG"] : 0;
		$json["db"][$i]["Match_DFzDX1"]		=	$rows[$b]["Match_DFzDX1"]<>"" ? '大'.$rows[$b]["Match_DFzDX1"] : '';
		$json["db"][$i]["Match_DFzDpl"]		=	$rows[$b]["Match_DFzDpl"]<>"" ? $rows[$b]["Match_DFzDpl"] : 0;
		$json["db"][$i]["Match_DFzDX2"]		=	$rows[$b]["Match_DFzDX2"]<>"" ? '小'.$rows[$b]["Match_DFzDX2"] : '';
		$json["db"][$i]["Match_DFzXpl"]		=	$rows[$b]["Match_DFzXpl"]<>"" ? $rows[$b]["Match_DFzXpl"] : 0;
		$json["db"][$i]["Match_DFkDX1"]		=	$rows[$b]["Match_DFkDX1"]<>"" ? '大'.$rows[$b]["Match_DFkDX1"] : '';
		$json["db"][$i]["Match_DFkDpl"]		=	$rows[$b]["Match_DFkDpl"]<>"" ? $rows[$b]["Match_DFkDpl"] : 0;
		$json["db"][$i]["Match_DFkDX2"]		=	$rows[$b]["Match_DFkDX2"]<>"" ? '小'.$rows[$b]["Match_DFkDX2"] : '';
		$json["db"][$i]["Match_DFkXpl"]		=	$rows[$b]["Match_DFkXpl"]<>"" ? $rows[$b]["Match_DFkXpl"] : 0;*/
		
		/*$json["db"][$i]["Match_NowScore"]		=	$rows[$b]["Match_NowScore"]<>"" ? $rows[$b]["Match_NowScore"] : 0;
		$json["db"][$i]["Match_lqNowScore"]		=	$rows[$b]["Match_lqNowScore"]<>"" ? $rows[$b]["Match_lqNowScore"] : 0;
		$json["db"][$i]["Match_IsMaster"]		=	$rows[$b]["Match_IsMaster"]<>"" ? $rows[$b]["Match_IsMaster"] : 0;
		$json["db"][$i]["Match_NowSession"]		=	 $rows[$b]["Match_NowSession"];
		$json["db"][$i]["Match_ScoreH"]		=	$rows[$b]["Match_ScoreH"]<>"" ? $rows[$b]["Match_ScoreH"] : 0;
		$json["db"][$i]["Match_ScoreC"]		=	$rows[$b]["Match_ScoreC"]<>"" ? $rows[$b]["Match_ScoreC"] : 0;
		$json["db"][$i]["Match_LastGoal"]		=	$rows[$b]["Match_LastGoal"]<>"" ? $rows[$b]["Match_LastGoal"] : 0;
		$json["db"][$i]["Match_LastTime"]		=	$rows[$b]["Match_LastTime"]<>"" ? $rows[$b]["Match_LastTime"] : 0;
		/*
		"Match_NowScore": "83:35",
            "Match_lqNowScore": "83:35",
            "Match_IsMaster": "Y",
            "Match_NowSession": "Q4",
            "Match_ScoreH": "83",
            "Match_ScoreC": "35",
            "Match_LastGoal": "A",
            "Match_LastTime": "360"
		*/
		$i++;
	}
}
//print_r($json);
echo $callback."(".json_encode($json).");";
?>