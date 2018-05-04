<?php
/**
 * 向分发服务器采集投注信息
 */
include dirname(__FILE__).'/../config.php';
$start = time() - 2*3600;
$end = time();
//$start = strtotime("2017-02-24 00:00:01");
//$end = strtotime("2017-02-24 23:59:59");
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
        foreach ($info->data as $v) {
            $sql = "insert INTO mg_record   ";
			$tmp = "";
			$tmp2 = '';
			$tmp3 = '';
            foreach ($v as $key => $val){
				if($key != 'id'){
					$tmp .= "`$key`,";
					$tmp2 .= '\''.$val.'\',';
					$tmp3 .= "`$key` = '$val',";
				}
                
            }
            $tmp = trim($tmp,',');
			$tmp2 = trim($tmp2,',');
			$tmp3 = trim($tmp3,',');
			$sql .= " ($tmp) values ($tmp2) ON DUPLICATE KEY UPDATE $tmp3 ;";
			$mysqli->exec($sql);
        }
    }
}else{
    echo '数据结构出错，请检查!';
}