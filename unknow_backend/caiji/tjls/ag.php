<?php
$begin = time();
$base = __DIR__;
include $base.'/../db/mysqli.php';
$sql = "select * from ag_gameresult where istj = 0 limit 1000";
$query_ag = $mysqli->query($sql);

$live = array('BAC','CBAC','LINK','DT','SHB','ROU','FT','LBAC','ULPK','SBAC','NN','BJ');
$dz = array('SL1','SL2','SL3','PK_J','SL4','PKBJ','FRU','HUNTER','SLM1','SLM2','SLM3','SC01','TGLW','SLM4','TGCW','SB01','SB02','SB03','SB04','SB05','SB06','SB07','SB08','SB09','SB10','SB11','SB12','SB13','SB14','SB15','SB16','SB17','SB18','SB25','SB26','SB27','SB28','SB29','SB19','SB20','SB21','SB22','SB23','SB24','AV01','XG01','XG02','XG03','XG04','XG05','XG06','XG07','XG08','XG09','SB30','SB31','PKBD','PKBB','SB32','SB33','SB34','FRU2','TG01','TG02','TG03','SB35','SB36','SB37','SB38','SB39','SB40','TA01','TA02','TA03','TA04','TA05','TA06','TA07','TA08','TA09','TA0A','TA0B','TA0C','TA0F','TA0G','TA0Z','TA10','TA11','TA12','TA13','TA14','TA15','TA17','TA18','TA19','TA20','TA1C','TA1D','TA1E','TA1F','TA0U','TA0V','TA0W','TA0X','TA0Y','XG10','XG11','XG12','XG13','XG14','XG16','TA0P','TA0S','TA0L','TA0M','TA0N','TA0O','TA0Q','TA0R','TA0T','TA1N','TA1O ','TA1P','TA1K ','TA1L','TA1M','SV41');
while($v = $query_ag->fetch_array()){
    $query = $mysqli->query("select * from k_user where username = '{$v['username']}'");
    $userinfo = $query->fetch_array();
    if(!$userinfo){
        continue;
    }
    $date = date('Y-m-d',strtotime($v['betTime']) + 12*3600);
    $type = '';
    if(in_array($v['gameType'],$dz)){
        $type = 'dianzi';
    }elseif (in_array($v['gameType'],$live)){
        $type = 'live';
    }
    var_dump($v['gameType']) ;
    if(!$type){
        file_put_contents($base.'/aglog.txt', '有异常注单,类型为'.$v['gameType']."\r\n",FILE_APPEND);
        continue;
    }
    $query = $mysqli->query("select * from web_report where uid = {$userinfo['uid']} and platform='ag' and gametype='{$type}' and date='$date'");
    if($query && $query->num_rows){
        $sql = "update web_report set bet = bet + {$v['validBetAmount']},payout = payout + {$v['netAmount']}";
        $sql .= " where uid = {$userinfo['uid']} and platform ='ag' and gametype='{$type}' and `date` = '{$date}'";
    }else{
        $sql = "insert into web_report (uid,platform,gametype,bet,payout,`date`) values (";
        $sql .= "{$userinfo['uid']},'ag','{$type}',{$v['validBetAmount']},{$v['netAmount']},'$date')";
    }
    //echo $sql,"\r\n";
    $mysqli->query($sql);
    $sql = "update k_user set liushui = liushui + {$v['validBetAmount']} where uid = {$userinfo['uid']}";
    //echo $sql,"\r\n";
    $mysqli->query($sql);
    $sql = "update ag_gameresult set istj  = 1 where id= {$v['id']} and istj = 0";
    //echo $sql,"\r\n";
    $mysqli->query($sql);
}
$end = time();
echo $end - $begin ,"\r\n";
