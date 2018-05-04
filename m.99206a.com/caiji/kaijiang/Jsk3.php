<?php

ignore_user_abort(TRUE);
set_time_limit(50);
$base = dirname(__FILE__);
file_put_contents($base.'/record_xyft.txt', date("Y-m-d H:i:s")."\r\n",FILE_APPEND);
if(file_exists($base."/../db/mysqli.php")){
    include ($base."/../db/mysqli.php");
}else{
    file_put_contents($base.'/record_xyft.txt', date("Y-m-d H:i:s")."\t数据库连接文件不存在!\r\n",FILE_APPEND);
    exit('数据库连接文件不存在!');
}
if($base."/auto_class.php"){
    include ($base."/auto_class.php");
}else{
    file_put_contents($base.'/record_xyft.txt', date("Y-m-d H:i:s")."\t算法文件不存在!\r\n",FILE_APPEND);
    exit('算法文件不存在!');
}
include $base.'/jsk3_suanfa.php';
$wjs = getWeiJieSuan('江苏快3', $mysqli);
$qistr = $wjs['qistr'];
$ids = $wjs['ids'];
$qishu = explode(',', $qistr);
var_dump($qishu);
// 获取开奖号码
foreach ($qishu as $qi) {
    echo "开始结算第{$qi}期\r\n";
    if(empty($qi)){
        echo "结算期号为空,结束!\r\n";
        continue;
    }
    $sql = "select * from c_auto_6 where qishu=" . $qi . " order by id desc limit 1";
    $query = $mysqli->query($sql);
    $rs = $query->fetch_array();
    if(!$rs){
        echo "尚未找到开奖结果\r\n";
        continue;
        
    }
    // 根据期数读取未结算的注单
    $sql = "select * from c_bet where type='江苏快3' and js=0 and qishu=" . $qi . " order by addtime asc";
    $query = $mysqli->query($sql);
    $sum = $mysqli->affected_rows;
    while ($rows = $query->fetch_array()) {
        if(jsk3_js($rs, $rows)){
            $msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
            $mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
            $affect = $mysqli->affected_rows;
            if($affect){
                $msql = "select money from k_user where uid = '".$rows['uid']."'";
                $q = $mysqli->query($msql);
                $balance = $q->fetch_array();
                $m_value = $rows['win'];
                $m_order = 'JS3FPJ'.$rows['id'];
                $uid = $rows['uid'];
                $q_qian = $balance['money'];
                $h_qian = $balance['money'] + $rows['win'];
                $status = 1;
                $m_make_time = date('Y-m-d H:i:s');
                $about = '江苏快三派奖,订单号:'.$rows['did'].',金额:'.$rows['win'];
                $type  = 400;
                $sql = "insert into k_money (m_order,uid,m_value,q_qian,h_qian,status,m_make_time,about,type) values";
                $sql .= "('{$m_order}','$uid','$m_value','$q_qian','$h_qian','$status','$m_make_time','$about','$type')";
                $mysqli->query($sql);
                $msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
                $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
            }
        }else{
            $msql="update c_bet set win=0,js=1 where id=".$rows['id']." and js = 0";
            $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
        }
    }
    $msql = "update c_auto_6 set ok=1 where qishu=" . $qi . "";
    $mysqli->query($msql) or die("期数修改失败!!!");
    $delsql = "delete from weijiesuan where qishu = '$qi' and `type` = '江苏快3';";
    $mysqli->query($delsql);
    echo "结算结束!\r\n";
}


?>
<style type="text/css">
body, td, th {
	font-size: 12px;
}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><?=$qi?>期 结算完毕！</td>
	</tr>
</table>


