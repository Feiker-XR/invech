<?php
/**
 * 向分发服务器采集投注信息
 */
$base = dirname(__FILE__);
include $base.'/../config.php';
$start = time() - 76*3600;
$end = time();
//$start = strtotime("2017-03-01 00:00:01");
//$end = strtotime("2017-03-01 23:59:59");
$data['begin'] = date("Y-m-d H:i:s",$start);
$data['end']   = date("Y-m-d H:i:s",$end);
$data['action'] = 'bethistory';
$data['uid'] = $config['uid'];
$data['suffix'] = $config['suffix'];
$query = http_build_query($data);
$url = $config['url'].'oggame/query.php?'.$query;//."&begin=".date("Y-m-d H:i:s",$start).'&end='.date("Y-m-d H:i:s",$end);
echo $url;

try{
    $info = json_decode(file_get_contents($url));
}catch(Exception $e){
    echo $e->getMessage();
}
var_dump($info);
if($info instanceof stdClass ){
    if($info->error){
        echo $info->data;
    }else{
		//var_dump($info->data);
        if(count($info->data) == 0){
			//exit('no data');
		}
        $tmp = "";
		$data = $info->data;
		//var_dump($data);
        foreach ($data as $k => $v) {
			//var_dump($v);
			//echo $k,"\r\n";
			$tmp = '';
            $sql = "insert into og_live_history (
            `ProductID` ,
            `UserName`  ,
            `GameRecordID`,
            `OrderNumber`,
            `TableID`  ,
            `Stage`,
            `Inning` ,
            `GameNameID` ,
            `GameBettingKind`,
            `GameBettingContent`,
            `ResultType`,
            `BettingAmount`,
            `CompensateRate`,
            `WinLoseAmount` ,
            `Balance` ,
            `AddTime` ,
            `PlatformID`,
            `VendorId`,
            `ValidAmount`,
            `GameResult`
            ) values ";
            //$tmp .= "('{$v->VendorId}','{$v->UserName}','$v->OrderNumber','$v->TradeAmount'";
            //$tmp .= ",'$v->Balance','$v->TradeType','$v->From','$v->To','$v->AddTime'),";
            $tmp2 = '(';
            foreach ($v as $val){
                $tmp2 .= '"'.$val.'",';
            }
            $sql .= trim($tmp2,',').')';
            $sql .= "  ON DUPLICATE KEY UPDATE ";
            $sql .= "ResultType='{$v->ResultType}',WinLoseAmount='{$v->WinLoseAmount}',ValidAmount='{$v->ValidAmount}'";
			echo $sql;
            $mysqli->exec($sql) ;//or die($mysqli->errorInfo()[2]);
        }
		//echo $tmp;
		/*
		if($tmp){
			$sql = $sql . $tmp;
			$mysqli->beginTransaction();
			if ($mysqli->exec($sql)) {
				$mysqli->commit();
			} else {
				$error = $mysqli->errorInfo();
				echo '采集错误！', $error[2], "<br/>";
				$mysqli->rollback();
			}
		}else{
			echo 'no data';
		}*/
        
    }
}else{
    echo '数据结构出错，请检查!';
}