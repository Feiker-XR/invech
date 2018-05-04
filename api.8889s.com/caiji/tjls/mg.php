<?php
$begin = time();
$base = __DIR__;
include $base.'/../db/mysqli.php';
$sql = "select * from mg_record where istj = 0 limit 1000";
$query_ag = $mysqli->query($sql);
while($v = $query_ag->fetch_array()){
    $query = $mysqli->query("select * from k_user where username = '{$v['username']}'");
    $userinfo = $query->fetch_array();
    if(!$userinfo){
        continue;
    }
    $date = date('Y-m-d',strtotime($v['created']) + 12*3600);
    $type = 'dianzi';
    //var_dump($v['GameType']) ;
    $query = $mysqli->query("select * from web_report where uid = {$userinfo['uid']} and platform='mg' and gametype='{$type}' and date='$date'");
    if($query && $query->num_rows){
        $sql = "update web_report set bet = bet + {$v['wager']},payout = payout + {$v['payout']}";
        $sql .= " where uid = {$userinfo['uid']} and platform ='mg' and gametype='{$type}' and `date` = '{$date}'";
    }else{
        $sql = "insert into web_report (uid,platform,gametype,bet,payout,`date`) values (";
        $sql .= "{$userinfo['uid']},'mg','{$type}',{$v['wager']},{$v['payout']},'$date')";
    }
    //echo $sql,"\r\n";
    $mysqli->query($sql);
    $sql = "update k_user set liushui = liushui + {$v['wager']} where uid = {$userinfo['uid']}";
    //echo $sql,"\r\n";
    $mysqli->query($sql);
    $sql = "update mg_record set istj  = 1 where id= {$v['id']} and istj = 0";
    //echo $sql,"\r\n";
    $mysqli->query($sql);
}
$end = time();
echo $end - $begin ,"\r\n";
