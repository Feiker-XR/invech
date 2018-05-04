<?php
/**
 * 向分发服务器采集投注信息
 */
date_default_timezone_set('Etc/GMT+4');
include dirname(__FILE__).'/../config.php';
$start = time() -18*3600;
$end = time() - 12*3600;

//$start = strtotime("2017-07-19 00:00:01");
//$end = strtotime("2017-07-19 23:59:59");
$data['begin'] = date("Y-m-d H:i:s",$start);
$data['end']   = date("Y-m-d H:i:s",$end);
$data['action'] = 'bethistory';
$data['uid'] = $config['uid'];
$data['suffix'] = $config['suffix'];
$query = http_build_query($data);
$url = $config['url'].'/bbin/query.php?'.$query;
try{
    $info = json_decode(file_get_contents($url));
}catch(Exception $e){
    echo $e->getMessage();
}
if($info instanceof stdClass ){
    if($info->error){
        echo $info->data;
    }else{
		
		foreach ($info->data as $v) {
            $tmp = "";
            $sql = "insert into bbin_gameresult (
			username,WagersID,WagersDate,WagerDetail,
			SerialID,RoundNo,GameType,GameCode,
			Result,ResultType,Card,BetAmount,Payoff,
			Currency,Commissionable,Origin
        ) values ";
            
            //$tmp .= "('{$v->VendorId}','{$v->UserName}','$v->OrderNumber','$v->TradeAmount'";
            //$tmp .= ",'$v->Balance','$v->TradeType','$v->From','$v->To','$v->AddTime'),";
            $tmp .= "(";
            $tmp2 = '';
            foreach ($v as $val){
                $tmp2 .= '\''.$val.'\',';
            }
            $tmp .= trim($tmp2,',').')';
            $sql .= $tmp;
            $sql .= " ON DUPLICATE KEY UPDATE Result='{$v->Result}',ResultType='{$v->ResultType}',Card='{$v->Card}'";
			$sql .= ",BetAmount='{$v->BetAmount}',Payoff='{$v->Payoff}',Commissionable = '{$v->Commissionable}'";
			$sql .= ",WagerDetail='{$v->WagerDetail}'";
			echo '<br/>',$sql,'<br/>';
			if(!$mysqli->query($sql)){
				//file_put_contents(dirname(__FILE__).'/error2.log',"error",FILE_APPEND);
			}
        }
        
		/*
        $sql = "insert into bbin_gameresult (
        username,WagersID,WagersDate,WagerDetail,
		SerialID,RoundNo,GameType,GameCode,
		Result,ResultType,Card,BetAmount,Payoff,
		Currency,Commissionable,Origin
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
		*/
    }
}else{
    echo '数据结构出错，请检查!';
}
