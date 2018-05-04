<?php
include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';

$base = __DIR__;
include $base.'/../db/mysqli.php';
$sql = "select * from og_live_history where istj = 0 limit 1000";
$query_og = $mysqli->query($sql);
while($v = $query_og->fetch_array()){
    $query = $mysqli->query("select * from k_user where username = '{$v['UserName']}'");
    $userinfo = $query->fetch_array();
    if(!$userinfo){
        continue;
    }

    $date = date('Y-m-d',strtotime($v['AddTime'])/* + 12*3600*/);
    $type = 'dianzi';

    $query = $mysqli->query("select * from web_report where platform = 'og' and gametype ='{$type}' and uid = {$userinfo['uid']} and `date` = '{$date}'");
    if($query && $query->num_rows){
        $sql = "update web_report set bet = bet + {$v['ValidAmount']},payout = payout + {$v['WinLoseAmount']}";
        $sql .= " where uid = {$v['uid']} and platform ='og' and gametype='sport' and `date` = '{$date}'";
    }else{
        $sql = "insert into web_report (uid,platform,gametype,bet,payout,`date`) values (";
        $sql .= "{$userinfo['uid']},'og','{$type}',{$v['ValidAmount']},{$v['WinLoseAmount']},'$date')";
    }
    //echo $sql,"\r\n";
    $mysqli->query($sql);
    $sql = "update k_user set liushui = liushui + {$v['ValidAmount']} where uid = {$userinfo['uid']}";
    //echo $sql,"\r\n";
    $mysqli->query($sql);
    $sql = "update og_live_history set istj  = 1 where id= {$v['id']} and istj = 0";
    //echo $sql,"\r\n";
    $mysqli->query($sql);
}

