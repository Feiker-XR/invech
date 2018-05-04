<?php
//采集篮球滚球信息入缓存,每5秒采集一次

include __DIR__ . '/global.php';
include __DIR__ . '/../../common/caiji/log_init.php';

$base = __DIR__;

defined('SDB_HOST') ? '' : define('SDB_HOST','rm-j6cv7jpe2h45e34d7o.mysql.rds.aliyuncs.com'); //数据库ip地址
defined('SDB_USER') ? '' : define('SDB_USER','xhg_db_user');     //数据库用户 
defined('SDB_PWD') ? '' : define('SDB_PWD','VCwyWClc5HrxRsSb');    //数据库密码
defined('SDB_KSB') ? '' : define('SDB_KSB','xhg_188ksb1_db');

defined('DDB_HOST') ? '' : define('DDB_HOST','rm-j6cv7jpe2h45e34d7o.mysql.rds.aliyuncs.com'); //数据库ip地址
defined('DDB_USER') ? '' : define('DDB_USER','hg99206');     //数据库用户 
defined('DDB_PWD') ? '' : define('DDB_PWD','7758521a#');    //数据库密码
defined('DDB_KSB') ? '' : define('DDB_KSB','hg_188ksb1_db');


$smysqli =   new MySQLi(SDB_HOST,SDB_USER,SDB_PWD,SDB_KSB);
$smysqli->query("set names utf8");

$dmysqli =   new MySQLi(DDB_HOST,DDB_USER,DDB_PWD,DDB_KSB);
$dmysqli->query("set names utf8");

//sunbet_history_bets

$result = $smysqli->query("select SQL_NO_CACHE * from k_user");
while($v = $result->fetch_array()){
    @$v['liushui'] = @$v['liushui'] ?: 0;

    $sql = "update k_user set liushui  = {$v['liushui']} where uid= {$v['uid']}";
    $ret = $dmysqli->query($sql);
    if(!$ret){
        msg_log('更新流水失败,sql='.$sql,'error');
    }
}

//ag_gameresult 134541260        istj
//bbin_gameresult 93065537       istj
//mg_record 1027175              istj
//og_live_history 36865175       istj
//cbet  4550566                  istongji
//kbet  395815                   istongji

$sql_agtj = "update ag_gameresult set istj = 1 where id <= 134541260";
$ret = $dmysqli->query($sql_agtj);
if(!$ret){
    msg_log('更新ag统计失败,ret='.$ret.',sql='.$sql_agtj,'error');
}

$sql_bbtj = "update bbin_gameresult set istj = 1 where id <= 93065537";
$ret = $dmysqli->query($sql_bbtj);
if(!$ret){
    msg_log('更新bb统计失败,ret='.$ret.',sql='.$sql_bbtj,'error');
}

$sql_mgtj = "update mg_record set istj = 1 where id <= 1027175";
$ret = $dmysqli->query($sql_mgtj);
if(!$ret){
    msg_log('更新mg统计失败,ret='.$ret.',sql='.$sql_mgtj,'error');
}

$sql_ogtj = "update og_live_history set istj = 1 where id <= 36865175";
$ret = $dmysqli->query($sql_ogtj);
if(!$ret){
    msg_log('更新ag统计失败,ret='.$ret.',sql='.$sql_ogtj,'error');
}

$sql_kbet_tj = "update k_bet set istongji = 1 where bid <= 395815";
$ret = $dmysqli->query($sql_kbet_tj);
if(!$ret){
    msg_log('更新kbet统计失败,ret='.$ret.',sql='.$sql_kbet_tj,'error');
}

$sql_cbet_tj = "update c_bet set istongji = 1 where id <= 4550566";
$ret = $dmysqli->query($sql_cbet_tj);
if(!$ret){
    msg_log('更新cbet统计失败,ret='.$ret.',sql='.$sql_cbet_tj,'error');
}
