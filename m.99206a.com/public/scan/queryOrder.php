<?php
use think\Db;
error_reporting(E_ERROR);
$m_order = $_REQUEST['OrderId'];

$mysqli =  new  mysqli("rm-j6cv7jpe2h45e34d7o.mysql.rds.aliyuncs.com","hg99206","dgpzYjRba1KksP5kzL","hg_188ksb1_db" );
$sql = "select status from k_money where m_order = '{$m_order}' and status = 1";
$q1			=	$mysqli->query($sql);
$q1 = $q1->fetch_array();
print_r($q1);
$ql = $q1['status'];
if($q1){
    $return = array('status' =>'1');
}else{
    $return = array('status' =>'0');
}
echo json_encode($return);
?>