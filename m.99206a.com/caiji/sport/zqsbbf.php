<?php
// 
//                                  _oo8oo_
//                                 o8888888o
//                                 88" . "88
//                                 (| -_- |)
//                                 0\  =  /0
//                               ___/'==='\___
//                             .' \\|     |// '.
//                            / \\|||  :  |||// \
//                           / _||||| -:- |||||_ \
//                          |   | \\\  -  /// |   |
//                          | \_|  ''\---/''  |_/ |
//                          \  .-\__  '-'  __/-.  /
//                        ___'. .'  /--.--\  '. .'___
//                     ."" '<  '.___\_<|>_/___.'  >' "".
//                    | | :  `- \`.:`\ _ /`:.`/ -`  : | |
//                    \  \ `-.   \_ __\ /__ _/   .-` /  /
//                =====`-.____`.___ \_____/ ___.`____.-`=====
//                                  `=---=`
// 
// 
//               ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//
//                          佛祖保佑         永不宕机/永无bug
// +----------------------------------------------------------------------
// | FileName: zqsbbf.php
// +----------------------------------------------------------------------
// | CreateDate: 2018年3月28日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
ini_set("display_errors","yes");
set_time_limit(0);
$base = dirname(__FILE__);
include_once $base.'/include.php';
include_once($db_path."/mysqlis.php");
$list_date=date('Y-m-d',time()-2*60*60);
$bdate=date('m-d',time()-2*60*60);

$rs = file_get_contents('http://119.28.61.218:8102/live/oddlives_get?Mstate=live&app_id=108&plates=1&user_token=ceaa0d1e22652646e249bb915f01cb87&version=110&xg_token=07c4c1dc01115624c015f487b618c5cf');
$info = json_decode($rs,true);
$result= $info['result']['data'];
foreach($result as $v){
    if($v['statetxt'] > 45 || $v['statetxt'] == '中'){
        $hbf_H = $v["hbf_H"];
        $cbf_H = $v['cbf_H'];
        if($hbf_H === '' || $cbf_H === ''){
            continue;
        }
        $matchtypename = $v['matchtypename'];
        $hteamName = $v['hteamName'];
        $cteamName = $v['cteamName'];
        $match_date = date('m-d',$v['starttime']);
        $sql = "update bet_match set tg_inball_hr='$cbf_H',mb_inball_hr='$hbf_H'  WHERE `Match_Name` = '$matchtypename' AND `Match_Master` = '$hteamName' AND `Match_Guest` = '$cteamName' and Match_Date = '$match_date' ";
        file_put_contents(dirname(__FILE__).'/sbsql.log', date('Y-m-d H:i:s')."\t".$sql."\r\n",FILE_APPEND);
        $mysqlis->query($sql);
    }
}