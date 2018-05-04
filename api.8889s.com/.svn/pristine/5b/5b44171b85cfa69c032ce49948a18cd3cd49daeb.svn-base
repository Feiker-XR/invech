<?php
/**
 * 向分发服务器采集投注信息
 */
 date_default_timezone_set("PRC");
$base = dirname(__FILE__);
include $base.'/../config.php';
$start = time() - 72*3600;
$end = time();
$data['begin'] = date("Y-m-d H:i:s",$start);
$data['end']   = date("Y-m-d H:i:s",$end);
$data['action'] = 'bethistory';
$data['uid'] = $config['uid'];
$data['suffix'] = $config['suffix'];
$query = http_build_query($data);
$url = $config['url'].'pt/query.php?'.$query;
echo $url,"\n\n\n";
try{
    $info = json_decode(file_get_contents($url),true);
}catch(Exception $e){
    echo $e->getMessage();
}
if($info){
    if($info['error']){
        echo $info['data'];
    }else{
        foreach ($info['data'] as $v) {
			unset ($v['id']);
			$keys = '';
			$vals = '';
			$update = '';
			foreach($v as $k=>$value){
				$keys .= "`$k`,";
				$vals .= "'$value',";
				$update .= "`$k` = '$value',";
			}
			$keys = trim($keys,',');
			$vals = trim($vals,',');
			$update = trim($update,',');
			$sql = "insert into pt_record ($keys) values ($vals) on duplicate key update $update";
			$mysqli->exec($sql);
		}
    }
}else{
    echo '数据结构出错，请检查!';
}