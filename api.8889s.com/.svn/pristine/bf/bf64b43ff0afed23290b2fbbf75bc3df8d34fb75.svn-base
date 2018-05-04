<?php
/**
 * 采集投注信息表
 * @var unknown
 */
include '../config.php';
$start = time() - 6*3600;
$end = time();
$data['begin'] = date("Y-m-d H:i:s",$start);
$data['end']   = date("Y-m-d H:i:s",$end);
$data['action'] = 'transfer';
$data['uid'] = $config['uid'];
$data['suffix'] = $config['suffix'];
$query = http_build_query($data);
$url = $config['url'].'?'.$query;//."&begin=".date("Y-m-d H:i:s",$start).'&end='.date("Y-m-d H:i:s",$end);
$info = json_decode(file_get_contents($url));
echo gettype($info);
if($info instanceof stdClass ){
   if($info->error){
       echo $info->data;
   }else{
       foreach($info->data as $v){
           $keys = 'txid,timestamp,userid,username,amt,postbal,cur,playertype';
           $vals = "'{$v->txid}','{$v->timestamp}','$v->userid','$v->username',$v->amt,'$v->postbal','$v->cur',$v->playertype";
           $sql = "insert into sunbet_bet_history ($keys) values ($vals);";
           $mysqli->query($sql);
       }
   }
}else{
    echo '数据结构出错，请检测！';
}