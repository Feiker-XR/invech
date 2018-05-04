<?php
include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';

$base = __DIR__;
include $base.'/../db/mysqli.php';
$sql = "select * from c_bet where istongji = 0 and js = 1 limit 1000";
$query_kbet = $mysqli->query($sql);
while($v = $query_kbet->fetch_array()){
    $query = $mysqli->query("select * from k_user where uid = '{$v['uid']}'");
    $userinfo = $query->fetch_array();
    if(!$userinfo){
        continue;
    }

    $date = date('Y-m-d',strtotime($v['addtime'])/* + 12*3600*/);

    $query = $mysqli->query("select * from web_report where platform = 'self' and gametype ='lottery' and uid = '{$v['uid']}' and `date` = '{$date}'");
    if($query && $query->num_rows){
        $sql = "update web_report set bet = bet + {$v['money']},payout = payout + {$v['win']}";
        $sql .= " where uid = {$v['uid']} and platform ='self' and gametype='lottery' and `date` = '{$date}'";
    }else{
        $sql = "insert into web_report (uid,platform,gametype,bet,payout,`date`) values (";
        $sql .= "{$v['uid']},'self','lottery',{$v['money']},{$v['win']},'$date')";
    }
    //echo $sql,"\r\n";
    $mysqli->query($sql);
    $sql = "update k_user set liushui = liushui + {$v['money']} where uid = {$v['uid']}";
    //echo $sql,"\r\n";
    $mysqli->query($sql);
    $sql = "update c_bet set istongji  = 1 where id= {$v['id']} and istongji = 0";
    //echo $sql,"\r\n";
    $mysqli->query($sql);
}

