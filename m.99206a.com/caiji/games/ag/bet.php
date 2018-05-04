<?php
/**
 * 向分发服务器采集投注信息
 */
include dirname(__FILE__).'/../config.php';
$start = time() - 20 * 3600;
$end = time();
// $start = strtotime("2017-02-24 00:00:01");
// $end = strtotime("2017-03-14 23:59:59");
$data['begin'] = date("Y-m-d H:i:s", $start);
$data['end'] = date("Y-m-d H:i:s", $end);
$data['action'] = 'bethistory';
$data['uid'] = $config['uid'];
$data['suffix'] = $config['suffix'];
$query = http_build_query($data);
$url = $config['url'] . 'aggame/query.php?' . $query;
echo $url;
try {
    $info = json_decode(file_get_contents($url));
} catch (Exception $e) {
    echo $e->getMessage();
}
if ($info instanceof stdClass) {
    if ($info->error) {
        echo $info->message;
    } else {
        foreach ($info->data as $v) {
			$sql = "INSERT INTO ag_gameresult (billNo,netAmount,agentCode,gameCode,betTime,";
			$sql .= "gameType,betAmount,validBetAmount,flag,playType,currency,tableCode,loginIP,recalcuTime,";
			$sql .= "platformType,round,result,beforeCredit,username,suffix )  VALUES ";
			$sql .= "('{$v->billNo}','{$v->netAmount}','{$v->agentCode}','{$v->gameCode}','{$v->betTime}',";
			$sql .= "'{$v->gameType}','{$v->betAmount}','{$v->validBetAmount}','{$v->flag}','{$v->playType}',";
			$sql .= "'{$v->currency}','{$v->tableCode}','{$v->loginIP}','{$v->recalcuTime}','{$v->platformType}',";
			$sql .= "'{$v->round}','{$v->result}','{$v->beforeCredit}','{$v->username}','{$v->suffix}')";
			$sql .= ' ON DUPLICATE KEY UPDATE ';
			$sql .= 'billNo = ' . "'{$v->billNo}',netAmount='{$v->netAmount}',agentCode='{$v->agentCode}',gameCode='{$v->gameCode}',";
			$sql .= "betTime='{$v->betTime}',gameType='{$v->gameType}',betAmount='{$v->betAmount}',";
			$sql .= "validBetAmount='{$v->validBetAmount}',flag='{$v->flag}',playType='{$v->playType}',currency='{$v->currency}',";
			$sql .= "tableCode='{$v->tableCode}',loginIP='{$v->loginIP}',recalcuTime='{$v->recalcuTime}',";
			$sql .= "platformType='{$v->platformType}',round='{$v->round}',result='{$v->result}',beforeCredit='{$v->beforeCredit}',";
			$sql .= "username='{$v->username}',suffix='{$v->suffix}'";
			echo $sql,'<br/>';
			$sql = str_replace("'NOW()'", "NOW()", $sql);
			$mysqli->exec($sql);
        }
    }
} else {
    echo '数据结构出错，请检查!';
}