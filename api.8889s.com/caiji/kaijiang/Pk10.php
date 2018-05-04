<?php
file_put_contents(dirname(__FILE__).'/pk10.log', "开始执行结算脚本\r\n");
$base = dirname(__FILE__);
if(file_exists($base."/../db/mysqli.php")){
    include ($base."/../db/mysqli.php");
}else{
    exit('数据库连接文件不存在!');
}
if($base."/auto_class.php"){
    include ($base."/auto_class.php");
}else{
    exit('算法文件不存在!');
}
include $base.'/pk10_suanfa.php';
if(function_exists('getWeiJieSuan')){
    $wjs = getWeiJieSuan('北京PK拾',$mysqli);
}else{
    exit('未结算期数获取方法不存在!');
}
sleep(8);//byxx
$ids = $wjs['ids'];
$qistr = $wjs['qistr'];
$qiarr = explode(',', $qistr);
foreach ($qiarr as $qi) {
    if (empty($qi)){
        file_put_contents(dirname(__FILE__).'/pk10.error.log', $qi." 期号不能为空\r\n");
        continue;
        // 获取开奖号码
    }
    $sql = "select * from c_auto_3 where qishu=" . $qi . " order by id desc limit 1";
    $query = $mysqli->query($sql);
    $rs = $query->fetch_array();
    if(!$rs){
        continue;
    }
    
    // 根据期数读取未结算的注单
    $sql = "select * from c_bet where type='北京PK拾' and js=0 and qishu=" . $qi . " order by addtime asc";
    $query = $mysqli->query($sql);
    $sum = $mysqli->affected_rows;
    
    while ($rows = $query->fetch_array()) {
        if(pk10_js($rs, $rows)){
            $msql="update c_bet set js=1 where id='".$rows['id']."' and js = 0";
            $mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
            $affect = $mysqli->affected_rows;
            if($affect){
                $msql = "select money from k_user where uid = '".$rows['uid']."'";
                $q = $mysqli->query($msql);
                $balance = $q->fetch_array();
                $m_value = $rows['win'];
                $m_order = 'PKSPJ'.$rows['id'];
                $uid = $rows['uid'];
                $q_qian = $balance['money'];
                $h_qian = $balance['money'] + $rows['win'];
                $status = 1;
                $m_make_time = date('Y-m-d H:i:s');
                $about = '北京PK拾派奖,订单号:'.$rows['did'].',金额:'.$rows['win'];
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
    $msql = "update c_auto_3 set ok=1 where qishu=" . $qi . "";
    $mysqli->query($msql) or die("期数修改失败!!!");
    $delsql = "delete from weijiesuan where qishu = '$qi' and `type` = '北京PK拾';";
    $mysqli->query($delsql);
}




