<?php
$base = dirname(__FILE__);
include $base.'/config.php';
include $base.'/../db/mysqli.php';
$is_cli = preg_match("/cli/i", php_sapi_name()) ? true : false;
if($is_cli){
    $type = $argv[1];
    $url = isset($argv[2]) ? $argv[2] : 'url';
}else{
    $type = $_REQUEST['type'];
    $url = isset($_REQUEST['url']) ? $_REQUEST['url'] : 'url';
}
$keys = array_keys($config);
if(!in_array($type,$keys)){
    exit('类型不存在!');
}
$conf = $config[$type];
$html_data = file_get_contents($conf[$url]);
$data = json_decode($html_data,true);
$all = array();
foreach ($data['data'] as $k => $v) {
    $qishu = $v['expect'];
    $time = $v['opentime'];
    if(empty($v['opentime'])) continue;
    $tmp = explode(',',$v['opencode']);if($tmp[0]=='**')$tmp[0]='01';
    $one = array($qishu,$time,$tmp);
    $all[] = $one;
}
$qishu = $all[0][0];
$time = $all[0][1];
$tmp_ball = '';

for($i = 0 ; $i< $conf['ball'];$i++){
    $b = '`ball_'.($i+1).'`';
    $$b = $all[0][2][$i];
    $tmp_ball .= $b.',';
    
}
$tmp_ball = trim($tmp_ball,',');
$jiesuan = '';
$lottery_type = $conf['name'];
foreach ($all as $k => $v){
    if($type == 'jsk3'){
        $v[0] = substr($v[0], 2);
    }
    $sql = "select id from {$conf['table']} where qishu = '{$v[0]}'";
    $tquery = $mysqli->query($sql);
    $tcou = $mysqli->affected_rows;
    echo $tcou,"\r\n";
    $tmp_val ='';
    for($i = 0; $i<$conf['ball'];$i++){
        $tmp_val .= "'{$v[2][$i]}',";
    }
    $tmp_val = trim($tmp_val,',');
    if($tcou == 0){
        if($jiesuan){
            $jiesuan .= ','.$v[0];
        }else{
            $jiesuan=$v[0];
        }
        if(!preg_match('/[a-zA-Z]+/',$v[0])){
            $addsql = "insert into weijiesuan (`type`,`qishu`) values ";
            $addsql .= " ('$lottery_type','{$v[0]}');";
            $mysqli -> query($addsql);
        }
        
        $sql	=	"insert into {$conf['table']} (`qishu`,`datetime`,$tmp_ball) values ('".$v[0]."','".$v[1]."',{$tmp_val})";
        echo $sql; 
        $mysqli->query($sql);
    }
}