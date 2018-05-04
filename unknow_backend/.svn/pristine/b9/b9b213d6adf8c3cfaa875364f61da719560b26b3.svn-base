<?php
include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';

$base = __DIR__;
include $base.'/../db/mysqli.php';
$sql = "select * from sunbet_history_bets where istj = 0 limit 1000";
$query_og = $mysqli->query($sql);
while($v = $query_og->fetch_array()){
    $query = $mysqli->query("select * from k_user where username = '{$v['username']}'");
    $userinfo = $query->fetch_array();
    if(!$userinfo){
        continue;
    }

    $date = date('Y-m-d',strtotime($v['timestamp'])/* + 12*3600*/);
    $type = 'dianzi';

    $query = $mysqli->query("select * from web_report where platform = 'sb' and gametype ='{$type}' and uid = {$userinfo['uid']} and `date` = '{$date}'");
    if($query && $query->num_rows){
        $sql = "update web_report set bet = bet + {$v['riskamt']},payout = payout + {$v['winamt']}";
        $sql .= " where uid = {$v['uid']} and platform ='sb' and gametype='{$type}' and `date` = '{$date}'";
    }else{
        $sql = "insert into web_report (uid,platform,gametype,bet,payout,`date`) values (";
        $sql .= "{$userinfo['uid']},'sb','{$type}',{$v['riskamt']},{$v['winamt']},'$date')";
    }
    //echo $sql,"\r\n";
    $mysqli->query($sql);
    $sql = "update k_user set liushui = liushui + {$v['riskamt']} where uid = {$userinfo['uid']}";
    //echo $sql,"\r\n";
    $mysqli->query($sql);
    $sql = "update sunbet_history_bets set istj  = 1 where id= {$v['id']} and istj = 0";
    //echo $sql,"\r\n";
    $mysqli->query($sql);
}

