<?php
error_reporting(E_ERROR);
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0
$base = dirname(__FILE__);
include 'include.php';
include_once($db_path."mysqlis.php");
include_once($db_path."mysqlio.php");
include_once($base."/../../runtime/cache/gp_db.php");
include_once($base."/../../runtime/cache/zqgq_un.php");
include_once ($base . "/get_point.php");
include_once ($base . "/bet.php");

$langx='zh-tw';
$data=theif_data($webdb["datesite"],$webdb["cookie"],'FT','re',$langx,0);
$list_date=date('Y-m-d',time()-2*60*60);
$bdate=date('m-d',time()-2*60*60);
$date=date('Y-m-d',time()-2*60*60);
$mDate=date('m-d',time()-2*60*60);
$a = array(
    "<font style=background-color=red>",
    "</font>"
);
$b = array(
    "",
    ""
);
preg_match_all("/new Array\((.+?)\);/is",$data,$matches);
$cou1=sizeof($matches[0]);
for($i=0;$i<$cou1;$i++){
    $messages=$matches[0][$i];
    $messages=str_replace("new Array(","",$messages);
    $messages = str_replace($a,$b,$messages);
    $messages=str_replace(");","",$messages);
    $messages=str_replace("'","",$messages);
    $datainfo=explode(",",$messages);
    $mb_mid=trim($datainfo[3]);
    $tg_mid=trim($datainfo[4]);
    $mb_inball_hr=trim(strip_tags($datainfo[18]));
    $tg_inball_hr=trim(strip_tags($datainfo[19]));
    $t0=(is_numeric($tg_inball_hr))?$tg_inball_hr:"-1";
    $m0=(is_numeric($mb_inball_hr))?$mb_inball_hr:"-1";
    if(($datainfo[1]=='中场' || $datainfo[1] == '半场') && strlen($t0)<5 && strlen($m0)<5){
        //$sql="update bet_match set tg_inball_hr='$t0',mb_inball_hr='$m0' where match_masterid=$mb_mid and match_guestid=$tg_mid and  match_master not like '%(上半)%' and Match_Date='$bdate'";
        //echo $sql."-".$datainfo[5]."<br>";
        //$mysqlis->query($sql);

        //$sql="update bet_match set mb_inball='$m0',tg_inball='$t0',tg_inball_hr='$t0',mb_inball_hr='$m0' where match_masterid=$mb_mid and match_guestid=$tg_mid and match_master like '%(上半)%'  and Match_Date='$bdate'";
        //echo $sql."-".$datainfo[5]."<br>";
        //$mysqlis->query($sql);
    }

}
/********************************结算开始*****************************/
$sql="select MB_Inball_HR,TG_Inball_HR,Match_Master,match_name,Match_Guest,Match_ID from bet_match where `Match_Date` ='$mDate' and (MB_Inball_HR>=0 or (MB_Inball_HR='-1' and TG_Inball_HR='-1')) and match_js!='1' order by ID";
echo  $sql,"\r\n";
$query			=	$mysqlis->query($sql);

while($rows	=	$query->fetch_array()){
    //print_r($rows);
    $mids[$rows['Match_ID']]=$rows['Match_ID'];
    $MB_Inball_HR=$rows['MB_Inball_HR'];
    $TG_Inball_HR=$rows['TG_Inball_HR'];
    $MB_Inball=$rows['MB_Inball'];
    $TG_Inball=$rows['TG_Inball'];
    //保存所有上半场单式注单比分
    $sql="update k_bet set MB_Inball='$MB_Inball_HR',TG_Inball='$TG_Inball_HR' where lose_ok=1 and (ball_sort like('%上半场%') or bet_info like('%上半场%')) and status=0 and match_id='".$rows['Match_ID']."'";
    $mysqli->query($sql);
    //保存所上半场有串关注单比分
    $sql="update k_bet_cg set mb_inball='$MB_Inball_HR',tg_inball='$TG_Inball_HR' where status=0 and match_id='".$rows['Match_ID']."' and (ball_sort like('%上半场%') or bet_info like('%上半场%'))";
    $mysqli->query($sql);
}

$mid=@implode(",",$mids);
//自动结算开始

$m=	count($mids);
$bool	=	true;
if(count($mids)>0){
    $sql		=	"select k_bet.*,k_user.username from k_bet left join k_user on k_bet.uid=k_user.uid where k_bet.lose_ok=1 and (ball_sort like('%上半场%') or bet_info like('%上半场%')) and status=0 and match_id in($mid) and k_bet.check=0 order by  k_bet.bid  desc ";
    //单式
    $result		=	$mysqli->query($sql);
    while ($rows = $result->fetch_array()) {
        @$all_bet_money+=$rows["bet_money"];
        $column=$rows["point_column"];
        $bid=intval($rows['bid']);
        $mb_inball=$rows['MB_Inball'];
        $tg_inball=$rows['TG_Inball'];
        if($mb_inball ==='' || $tg_inball === '' || $mb_inball === null || $tg_inball === null )
            continue;
        $t=make_point(strtolower($column),"","",$rows["MB_Inball"],$rows["TG_Inball"],$rows["match_type"],$rows["match_showtype"],$rows["match_rgg"],$rows["match_dxgg"],$rows["match_nowscore"]);
        $str ="{$rows['bid']} make_point(strtolower($column), '', '', {$rows["MB_Inball"]}, {$rows["TG_Inball"]}, {$rows["match_type"]}, {$rows["match_showtype"]}, {$rows["match_rgg"]}, {$rows["match_dxgg"]}, {$rows["match_nowscore"]});";
        file_put_contents(dirname(__FILE__).'/zqsbauto.log', $str."\r\n",FILE_APPEND);
        
        $status=intval($t['status']);
        $bool	=	bet::set($bid,$status,$mb_inball,$tg_inball);
        if(!$bool) break;
        $bids[$rows['bid']]=$rows['bid'];
    }

    $sql		=	"select k_bet_cg.*,k_user.username from k_bet_cg left join k_user on k_bet_cg.uid=k_user.uid where status=0 and match_id in($mid) and(ball_sort like('%上半场%') or bet_info like('%上半场%')) and k_bet_cg.check=0 order by k_bet_cg.bid desc";
    $result_cg	=	$mysqli->query($sql); //串关
    while ($rows = $result_cg->fetch_array()) {
        $all_bet_money+=$rows["bet_money"];
        $column=$rows["point_column"];
        $t=make_point(strtolower($column),"","",$rows["MB_Inball"],$rows["TG_Inball"],$rows["match_type"],$rows["match_showtype"],$rows["match_rgg"],$rows["match_dxgg"],$rows["match_nowscore"]);
        $bid=intval($rows['bid']);
        $status=intval($t['status']);
        $mb_inball=$rows['MB_Inball'];
        $tg_inball=$rows['TG_Inball'];
        $bool	=	bet::set_cg($bid,$status,$mb_inball,$tg_inball);
        if(!$bool) break;
        $cg_bids[$rows['bid']]=$rows['bid'];
    }

    if(count($bids)>0){
        $mysqli->query("update k_bet set `check`=1 where bid in(".implode(",",$bids).")");
    }
    if(count($cg_bids)>0){
        $mysqli->query("update k_bet_cg set `check`=1 where bid in(".implode(",",$cg_bids).")");
    }
    if($bool){
        $mysqlis->query("update bet_match set match_sbjs='1' where match_id in($mid)");
        //include_once("../../class/admin.php");
        //admin::insert_log($_SESSION["adminid"],"批量审核了足球赛事".$mid."注单");
        $m=count($mids);
    }else{
    }
}
echo $m ,"条足球比分\r\n";
