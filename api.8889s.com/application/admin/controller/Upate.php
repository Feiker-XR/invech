<?php
// +----------------------------------------------------------------------
// | FileName: Upate.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年11月20日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\admin\controller;

use think\Db;
use app\admin\Login;
use think\Model;

class Update extends Login
{
    
    public function index(){
        set_time_limit(0);
        $sql = "ALTER TABLE `ag_htresult` ADD COLUMN `betDate`  date NULL AFTER `commissioned`; ";
        $sql = "update ag_htresult set betDate = DATE_FORMAT(ag_htresult.SceneStartTime,'%Y-%m-%d');";
        $sql = "update ag_gameresult set betDate = DATE_FORMAT(ag_gameresult.betTime,'%Y-%m-%d'); ";
        
        $sql ="select sum(`validBetAmount`) as bet ,sum(`netAmount`) as win ,betDate,username from ag_gameresult group by username,betDate ";
        
        "insert into web_report (web_report.uid,bet,payout,`date`,platform,gametype) select uid, sum(`validBetAmount`) as bet ,sum(`netAmount`) as payout ,betDate ,'ag' as platform,'live' as gametype from ag_gameresult as a,k_user as b where a.username = b.username group by a.username,betDate ";
        
      
        
    }
    
}