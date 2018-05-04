<?php
/**
 * 向分发服务器采集投注信息
 */
include '../config.php';
$start = time() - 6*3600;
$end = time();
$start = strtotime("2017-02-24 00:00:01");
$end = strtotime("2017-02-24 23:59:59");
$data['begin'] = date("Y-m-d H:i:s",$start);
$data['end']   = date("Y-m-d H:i:s",$end);
$data['action'] = 'bethistory';
$data['uid'] = $config['uid'];
$data['suffix'] = $config['suffix'];
$query = http_build_query($data);
$url = $config['url'].'mg/query.php?'.$query;
try{
    $info = json_decode(file_get_contents($url));
}catch(Exception $e){
    echo $e->getMessage();
}
if($info instanceof stdClass ){
    if($info->error){
        echo $info->data;
    }else{
        
        $sql = "insert INTO mg_gameresult(transaction_id,account_id,mg_name,application_id,currency,
		transaction_time,amount,balance,created,ip,category,type,
		browser_type,platform,server_id,game_id,item_id,ext_item_id)  ";
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
}else{
    echo '数据结构出错，请检查!';
}