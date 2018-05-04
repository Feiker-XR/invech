<?php
$begin = time();
$base = __DIR__;
include $base.'/../db/mysqli.php';
$sql = "select * from ag_gameresult where istj = 0 limit 1000";
$query_ag = $mysqli->query($sql);

$live = array('BAC','CBAC','LINK','DT','SHB','ROU','FT','LBAC','ULPK','SBAC','NN','BJ');
$dz = array('YPLA','YFD','YBEN','YHR','YGS','YFR','YDZ','YBIR','YFP','YMFD','YMFR','YMBN','YGFS','YJFS','YMBI','YMBA','YMBZ','YMAC','SB50','DTA8','DTAB','DTAF','DTAG','DTAQ','DTAT','SB49','SB45','DTAR','DTB1','DTAM','DTAZ','SC03','SX02','DTA0','TA1L','TA1O','XG10','XG11','XG12','XG13','XG16','TA0L','TA0M','TA0N','TA0O','TA0P','TA0Q','TA0S','TA0T','TA0U','TA0V','TA0W','TA0X','TA0Y','TA01','TA02','TA05','TA07','TA0C','SB38','TA0Z','TA12','TA17','TA18','TA1C','TA1F','TG02','SB37','SB36','SB35','SB34','SB32','FRU2','SB33','PKBB','PKBD','SB31','XG09','XG01','XG02','XG03','XG04','XG05','XG06','XG07','XG08','SB30','AV01','SB20','SB22','SB23','SB19','SB21','SB24','SB25','SB26','SB27','SB28','SB29','TGLW','SB13','SB14','SB15','SB16','SB17','SB18','SB07','SB08','SB09','SB10','SB11','SB12','SB01','SB02','SB03','SB04','SB05','SB06','SLM3','SLM1','SLM2','PKBJ','FRU');
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
