<?php
/**
 * 向分发服务器发送采集转账记录
 * @var unknown
 */
include '../config.php';
$start = time() - 6 * 3600;
$end = time();
$data['begin'] = date("Y-m-d H:i:s", $start);
$data['end'] = date("Y-m-d H:i:s", $end);
$data['action'] = 'transfer';
$data['uid'] = $config['uid'];
$data['suffix'] = $config['suffix'];
$query = http_build_query($data);
$url = $config['url'] . '?' . $query; // ."&begin=".date("Y-m-d H:i:s",$start).'&end='.date("Y-m-d H:i:s",$end);
$info = json_decode(file_get_contents($url));
if ($info instanceof stdClass) {
    if ($info->error) {
        echo $info->data;
    } else {
        $sql = "insert into og_transfer_history (
        `VendorId`,
        `UserName`,
        `OrderNumber`,
        `TradeAmount`,
        `Balance`,
        `TradeType`,
        `From`,
        `To`,
        `AddTime`
        ) values ";
        $tmp = "";
        foreach ($info->data as $v) {
            //$tmp .= "('{$v->VendorId}','{$v->UserName}','$v->OrderNumber','$v->TradeAmount'";
            //$tmp .= ",'$v->Balance','$v->TradeType','$v->From','$v->To','$v->AddTime'),";
            $tmp .= "(";
            $tmp2 = '';
            foreach ($v as $val){
                $tmp2 .= '\''.$val.'\',';
            }
            $tmp .= trim($tmp2,',').'),';
        }
        $tmp = trim($tmp,',');
        $sql = $sql . $tmp;
        $mysqli->beginTransaction();
        if ($mysqli->exec($sql)) {
            $mysqli->commit();
        } else {
            $error = $mysqli->errorInfo();
            echo '采集错误！', $error[2], "<br/>";
            $mysqli->rollback();
        }
    }
} else {
    echo '数据结构出错，请检测！';
}