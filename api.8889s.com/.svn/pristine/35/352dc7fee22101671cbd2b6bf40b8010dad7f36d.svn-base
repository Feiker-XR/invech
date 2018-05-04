<?php
$base = dirname(__FILE__);
include ($base . "/../db/mysqli.php");
include ($base . "/auto_class.php");
include ($base . "/cpzj.php");
include ($base . "/../lottery/config.php");
$is_cli = preg_match("/cli/i", php_sapi_name()) ? true : false;
if ($is_cli) {
    $type = $argv[1];
} else {
    $type = $_REQUEST['type'];
}
$name = $config[$type]['name'];
$table = $config[$type]['table'];
$wjs = getWeiJieSuan($name, $mysqli);
$qistr = $wjs['qistr'];
$ids = $wjs['ids'];
$qiarr = explode(',', $qistr);
sleep(8); // byxx
foreach ($qiarr as $qi) {
    if (empty($qi))
        continue;
    // 获取开奖号码
    $sql = "select * from {$table} where qishu=" . $qi . " order by id desc limit 1";
    $query = $mysqli->query($sql);
    $rs = $query->fetch_array();
    echo $qi,"\r\n";
    if (! $rs) {
        continue;
    }
    
    // 根据期数读取未结算的注单
    $sql = "select * from c_bet where type='{$name}' and js=0 and qishu=" . $qi . " order by addtime asc";
    $query = $mysqli->query($sql);
    $sum = $mysqli->affected_rows;
    while ($rows = $query->fetch_array()) {
        // 注单是否合法
        /*if (! cpzj::checkLotterySalt($rows)) {
            // 非法注单结算为输
            echo '注单异常!';
            $msql = "update c_bet set legal = 0 where id = {$rows['id']}";
            $mysqli->query($msql);
            $msql = "update c_bet set win=0,js=1,legal = 1 where id=" . $rows['id'] . " and js = 0";
            $mysqli->query($msql) or die("会员修改失败!!!" . $rows['id']);
            continue;
        }*/
        $win = 0;
        $flag = 'insert';
        $date = date('Y-m-d',strtotime($rows['addtime'])); 
        $msql = "select * from web_report where `date` = '{$date}' and uid = {$rows['uid']}"; 
        $dquery = $mysqli->query($msql);
        
        if($dquery && $dquery->num_rows){
            $flag = 'update';
        }
        $rs = cpzj::$type ($rs, $rows); //true 中奖 false 未中奖  2 返回本金
        if ($rs === true) {
            $msql = "update c_bet set js=1,legal = 1 where id='" . $rows['id'] . "' and js = 0";
            $mysqli->query($msql) or die("注单修改失败!!!" . $rows['id']);
            $affect = $mysqli->affected_rows;
            if ($affect) {
                $msql = "select money from k_user where uid = '" . $rows['uid'] . "'";
                $q = $mysqli->query($msql);
                $balance = $q->fetch_array();
                $m_value = $rows['win'];
                $m_order = 'PJ' . $rows['id'];
                $uid = $rows['uid'];
                $q_qian = $balance['money'];
                $h_qian = $balance['money'] + $rows['win'];
                $status = 1;
                $m_make_time = date('Y-m-d H:i:s');
                $about = $name . '派奖,订单号:' . $rows['did'] . ',金额:' . $rows['win'];
                $category = 400;
                $sql = "insert into k_money (m_order,uid,m_value,q_qian,h_qian,status,m_make_time,about,type) values";
                $sql .= "('{$m_order}','$uid','$m_value','$q_qian','$h_qian','$status','$m_make_time','$about','$category')";
                $mysqli->query($sql);
                $msql = "update k_user set liushui = liushui + {$rows['money']},  money=money+" . $rows['win'] . " where uid=" . $rows['uid'] . "";
                $mysqli->query($msql) or die("会员修改失败!!!" . $rows['id']);
            }
            $win = $rows['win'];
        } elseif($rs === false) {
            $msql = "update c_bet set win=0,js=1,legal = 1 where id=" . $rows['id'] . " and js = 0";
            $mysqli->query($msql) or die("会员修改失败!!!" . $rows['id']);
            $sql = "update k_user set liushui = liushui + {$rows['money']} where uid = {$rows['uid']}";
            $mysqli ->query($sql);
        }elseif($rs === 2){
            $msql = "update c_bet set js=1,legal = 1 where id='" . $rows['id'] . "' and js = 0";
            $mysqli->query($msql) or die("注单修改失败!!!" . $rows['id']);
            $affect = $mysqli->affected_rows;
            if ($affect) {
                $msql = "select money from k_user where uid = '" . $rows['uid'] . "'";
                $q = $mysqli->query($msql);
                $balance = $q->fetch_array();
                $m_value = $rows['money'];
                $m_order = 'PJ' . $rows['id'];
                $uid = $rows['uid'];
                $q_qian = $balance['money'];
                $h_qian = $balance['money'] + $rows['money'];
                $status = 1;
                $m_make_time = date('Y-m-d H:i:s');
                $about = $name . '派奖,订单号:' . $rows['did'] . ',金额:' . $rows['money'];
                $category = 400;
                $sql = "insert into k_money (m_order,uid,m_value,q_qian,h_qian,status,m_make_time,about,type) values";
                $sql .= "('{$m_order}','$uid','$m_value','$q_qian','$h_qian','$status','$m_make_time','$about','$category')";
                $mysqli->query($sql);
            }
            $win = $rows['win'];
        }
        if($rs != 2){
            if($flag == 'insert'){
                $sql = "insert into web_report (`uid`,platform,gametype,bet,payout,`date`) values('{$rows['uid']}','self','lottery' ";
                $sql .= ",{$rows['money']},{$win},'$date') ";
                $mysqli->query($sql);
            }else{
                $sql = "update web_report set bet = bet +{$rows['money']}, payout = payout + {$win} where uid = '{$rows['uid']}' and `date` = '{$date}' and gametype ='lottery' and platform = 'self'";
                $mysqli->query($sql);
            }
        }
        
    }
    $msql = "update {$table} set ok=1 where qishu=" . $qi . "";
    $mysqli->query($msql) or die("期数修改失败!!!");
    $delsql = "delete from weijiesuan where qishu = '$qi' and `type` = '{$name}';";
    $mysqli->query($delsql);
    echo $name . '第' . $qi . '结算完毕!';
}
$mysqli->close();
