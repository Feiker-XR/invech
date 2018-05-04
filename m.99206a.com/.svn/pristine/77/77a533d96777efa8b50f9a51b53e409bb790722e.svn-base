<?php
$bool	=	false;
$arr	=	explode('|',urldecode($_GET['lsm']));

if($_GET['lsm'] == 'zqzcds'){ //足球早餐单式
	include_once("../include/mysqlis.php");
	$bool	=	true;
	$sql	=	"select match_name from bet_match WHERE Match_Type=0 AND Match_CoverDate>'".date('Y-m-d H:i:s')."' group by match_name";
	$query	=	$mysqlis->query($sql);
}elseif($_GET['lsm'] == 'zqzcsbc'){ //足球早餐上半场
	include_once("../include/mysqlis.php");
	$bool	=	true;
	$sql	=	"select match_name from bet_match where Match_CoverDate>'".date('Y-m-d H:i:s')."' and match_date!='".date("m-d")."' and (Match_BHo+Match_BAo<>0 or Match_Bdpl+Match_Bxpl<>0) and Match_IsShowb=1 group by match_name";
	$query	=	$mysqlis->query($sql);
}elseif($_GET['lsm'] == 'zqds'){ //足球单式
	include_once("../include/mysqlis.php");
	$bool	=	true;
	$sql	=	"select match_name from bet_match WHERE Match_Type=1 AND Match_CoverDate>'".date('Y-m-d H:i:s')."' AND Match_Date='".date("m-d")."' and Match_HalfId is not null group by match_name";
	$query	=	$mysqlis->query($sql);
}elseif($_GET['lsm'] == 'lqds'){ //篮球单式
	include_once("../include/mysqlis.php");
	$bool	=	true;
	$sql	=	"select match_name from lq_match WHERE Match_CoverDate>'".date('Y-m-d H:i:s')."' AND Match_Date='".date("m-d")."' group by match_name";
	$query	=	$mysqlis->query($sql);
}elseif($_GET['lsm'] == 'zqsbc'){ //足球上半场
	include_once("../include/mysqlis.php");
	$bool	=	true;
	$sql	=	"select match_name from bet_match where Match_Type=1 and match_date='".date("m-d")."' AND Match_CoverDate>'".date('Y-m-d H:i:s')."' and (Match_BHo+Match_BAo<>0 or Match_Bdpl+Match_Bxpl<>0) and Match_IsShowb=1 group by match_name";
	$query	=	$mysqlis->query($sql);
}elseif($_GET['lsm'] == 'gj'){ //冠军
	include_once("../include/mysqlis.php");
	$bool	=	true;
	$sql	=	"select x_title as match_name from t_guanjun where match_type=1 and match_coverdate>'".date('Y-m-d H:i:s')."' and x_result is null group by x_title";
	$query	=	$mysqlis->query($sql);
}

$html = '';
$htmls = '';
$html .= "<table width='660' border='0' cellpadding='0' cellspacing='0'>
			<tr>
				<td height='5' align='left' valign='middle' bgcolor='FFFFFF'></td>
			</tr>
			<tr>
				<td align='left' valign='middle' bgcolor='FFFFFF'>";
if($bool){
	while($rows = $query->fetch_array()){ 

	$htmls .="<div class='cb_div'><input type='checkbox' name='liangsai' id='liangsa' value='".$rows['match_name']."' />".$rows['match_name']."</div>";
	}
}else{
	foreach($arr as $k=>$v){
		$htmls .="<div class='cb_div'><input type='checkbox' name='liangsai' id='liangsai' value='".$v."' />".$v."></div>";
	}
}
$html .=$htmls;
$html .="</td></tr></table>";
echo $html;
?>

