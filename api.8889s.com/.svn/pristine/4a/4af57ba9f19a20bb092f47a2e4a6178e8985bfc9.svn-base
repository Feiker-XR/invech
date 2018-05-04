<?php
include '../config.php';
$start = time() - 6*3600;
$end = time();
$start = strtotime("2017-02-14 00:00:01");
$end = strtotime("2017-02-15 23:59:59");
$data['begin'] = date("Y-m-d H:i:s",$start);
$data['end']   = date("Y-m-d H:i:s",$end);
$data['action'] = 'bethistory';
$data['uid'] = $config['uid'];
$data['suffix'] = $config['suffix'];
$query = http_build_query($data);
$url = $config['url'].'sunbet/query.php?'.$query;//."&begin=".date("Y-m-d H:i:s",$start).'&end='.date("Y-m-d H:i:s",$end);
try{
    $info = json_decode(file_get_contents($url));
}catch(Exception $e){
    echo $e->getMessage();
}
if($info instanceof stdClass ){
    if($info->error){
        echo $info->data;
    }else{
		if(count($info->data) == 0){
			exit('no data');
		}
        foreach($info->data as $v){
            $keys = 'ugsbetid,txid,betid,beton,betclosedon,betupdatedon,timestamp,roundid,roundstatus,userid,username,
    riskamt,winamt,winloss,beforebal,postbal,cur,gameprovider,gameprovidercode,gamename,gameid,platformtype,
    ipaddress,bettype,playtype,playertype,gamedata';
            $vals = "'{$v->ugsbetid}','{$v->txid}','{$v->betid}','{$v->beton}','$v->betclosedon','$v->betupdatedon','$v->timestamp',$v->roundid";
            $vals .= ",'{$v->roundstatus}','$v->userid','$v->username',$v->riskamt,$v->winamt,$v->beforebal,$v->postbal,'$v->cur'";
            
            $vals .= ",'{$v->gameprovider}','{$v->gameprovidercode}','{$v->gamename}','{$v->gamename}','{$v->gameid}','{$v->platformtype}'";
            $vals .= ",'{$v->ipaddress}','{$v->bettype}','{$v->playtype}','{$v->playertype}','{$v->gamedata}'";
            $sql = "insert into sunbet_history_bets ($keys) values ($vals);";
			$mysqli->query($sql);
        }
    }
}else{
    echo '数据结构出错，请检查!';
}