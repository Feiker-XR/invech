<?php
$begin = time();
$base = __DIR__;
include $base.'/../db/mysqli.php';
$sql = "select * from bbin_gameresult where istj = 0 limit 1000";
$query_ag = $mysqli->query($sql);
$sport = array('FT','BK','FB','IH','BS','TN','F1','SP','CB');
$live = array('3001','3002','3003','3005','3006','3007','3008','3010','3011','3012','3014','3015','3016');
$dz = array('5005','5006','5007','5008','5009','5010','5012','5013','5014','5015','5016','5017','5029','5030','5034','5035','5039','5040','5041','5043','5044','5048','5049','5054','5057','5058','5060','5061','5062','5063','5064','5065','5066','5067','5068','5069','5070','5073','5076','5077','5078','5079','5080','5083','5084','5088','5089','5090','5091','5092','5093','5094','5095','5096','5105','5106','5107','5108','5109','5115','5116','5117','5118','5131','5201','5202','5203','5204','5402','5404','5406','5407','5601','5701','5703','5704','5705','5706','5707','5801','5802','5803','5804','5805','5806','5808','5809','5810','5811','5821','5823','5824','5825','5826','5827','5828','5831','5832','5833','5835','5836','5837','5901','5902','5903','5904','5905','5907','5908','5888');
$caipiao = array('LT','BBLT','BBRB','BB3D','BJ3D','PL3D','SH3D','BBGE','LDDR','LDRS','BBLM','LKPA','BCRA','BCRB','BCRC','BCRD','BCRE','BJPK','BBPK','RDPK','GDE5','JXE5','SDE5','CQSC','XJSC','TJSC','JSQ3','AHQ3','BBQK','BBKN','CAKN','BJKN','CQSF','TJSF','GXSF','CQWC','OTHER',
);
while($v = $query_ag->fetch_array()){
    $query = $mysqli->query("select * from k_user where username = '{$v['username']}'");
    $userinfo = $query->fetch_array();
    if(!$userinfo){
        continue;
    }
    $date = date('Y-m-d',strtotime($v['WagersDate']) + 12*3600);
    $type = '';
    if(in_array($v['GameType'],$dz)){
        $type = 'dianzi';
    }elseif (in_array($v['GameType'],$live)){
        $type = 'live';
    }elseif(in_array($v['GameType'],$sport)){
        $type = 'sport';
    }elseif(in_array($v['GameType'],$caipiao)){
        $type = 'lottery';
    }
    var_dump($v['GameType']) ;
    if(!$type){
        file_put_contents($base.'/bbinlog.txt', '有异常注单,类型为'.$v['gameType']."\r\n",FILE_APPEND);
        continue;
    }
    $query = $mysqli->query("select * from web_report where uid = {$userinfo['uid']} and platform='bbin' and gametype='{$type}' and date='$date'");
    if($query && $query->num_rows){
        $sql = "update web_report set bet = bet + {$v['BetAmount']},payout = payout + {$v['Payoff']}";
        $sql .= " where uid = {$userinfo['uid']} and platform ='bbin' and gametype='{$type}' and `date` = '{$date}'";
    }else{
        $sql = "insert into web_report (uid,platform,gametype,bet,payout,`date`) values (";
        $sql .= "{$userinfo['uid']},'bbin','{$type}',{$v['BetAmount']},{$v['Payoff']},'$date')";
    }
    //echo $sql,"\r\n";
    $mysqli->query($sql);
    $sql = "update k_user set liushui = liushui + {$v['BetAmount']} where uid = {$userinfo['uid']}";
    //echo $sql,"\r\n";
    $mysqli->query($sql);
    $sql = "update bbin_gameresult set istj  = 1 where id= {$v['id']} and istj = 0";
    //echo $sql,"\r\n";
    $mysqli->query($sql);
}
$end = time();
echo $end - $begin ,"\r\n";
