<?php
namespace app\common\model\report;

use bong\foundation\QueryWrapper;

trait DailyMakerTrait
{
	//普通模型,生成 daily数据,用于DailyReport命令
    //目前支持Bet,Deposit,Withdraw,BonusFlow,扩展中
    private static function attachToDailyWithDate(&$query,$date=null){

        if(!$date){
            $date = date('Y-m-d');
        }

        $query->where('created_at','between',[$date.' 00:00:00',$date.' 23:59:59',]);
    }

    public static function getDailyBuild($date=null,$where=[]){
    	//$query = (new static)->db(true,false);
        $query = (new static)->db(true,true);
        $query->where($where);
    	self::attachToDailyWithDate($query,$date);
    	return new QueryWrapper($query);
    }

    //红利日报,分组统计,统计各类红利信息
    public static function getBonusDailyBuild($date=null){
    	$query = (new static)->db(true,false);
    	self::attachToDailyWithDate($query,$date);
    	$query->group('bonus_id');
    	return new QueryWrapper($query);
    }
}
