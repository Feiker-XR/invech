<?php
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");
$sql="SELECT * FROM `c_odds_0` order by id";
$query		= $mysqli->query($sql);
$list 		= array();
$j=1;
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<77; $i++){
		$list['ball'][$j][$i] = $odds['h'.$i];
	}
	$j++;
}
$arr = array(   
	'oddslist' => $list,    
);  
$json_string = json_encode($arr);
echo $json_string;