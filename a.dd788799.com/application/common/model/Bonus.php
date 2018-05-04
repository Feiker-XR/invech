<?php

namespace app\common\model;
use think\Model;

class Bonus extends Base
{
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $autoWriteTimestamp = 'datetime';
    protected $table = 'gygy_bonus';
    protected static $cachePrefix = 'bonus';
    protected static $cacheEvents = 'events';
    
//缓存,bonus.register 对应bonus对象
//缓存,bonus.events   

    private static function getEvents(){

        $events = [];

        $bonus = self::where('enable',1)->select();
        foreach ($bonus as $record) {
            $events[$record->event][] = $record->business;
        }

        cache(self::$cachePrefix . '.' .self::$cacheEvents , $events , config('LONG_CACHE_TIME')??120);

        return $events;

    }

    public static function getCachedEvents(){

        $events = cache(self::$cachePrefix . '.' .self::$cacheEvents);

        if(empty($events)){
            $events = self::getEvents();
        }

        return $events;        
    }

    public static function getBonusByBusiness($business = null){
        $bonus = null;
        if($business){
            $bonus = self::where('enable',1)->where('business',$business)->find();
        }
        return $bonus;
    }

    public function getAmount($flow=0,$code=0){
        $cf = null;
        foreach ($this->configs as $config) {
            if($config->code == $code){
                $cf = $config;
                break;
            }
        }
        if(!$cf){//没有配置
            return 0;   
        }

        if($flow < $cf->limit){//没有达到流水要求
            return 0;
        }

        $amount = 0;
        if($cf->amount){//固定奖金
            $amount = $cf->amount;
        }else{//比例奖金,但不能超过上限;
            $amount = $flow * $cf->radio;
            if($amount > $cf->max){
                $amount = $cf->max;
            }
        }
        return $amount;
    }

    //根据中奖率获取中奖项
    public function getConfig(){
        
        $sum = 0;
        foreach($this->configs as $config){
            $sum += $config->chance;
        }

        foreach($this->configs as $config){
            $rand = mt_rand(1, $sum);
            if ($rand <= $config->chance) {
                return $config;   
            } else {   
                $sum -= $config->chance;   
            }                     
        }

        //大转盘没中奖也必须设置一个config
        throw new \Exception("请检查红利配置!");        
    }

    public static function getAll(){
        $params = cache('gygy_bonus');
        if(!$params){
            $params = self::All();
            $params_map = [];
            foreach($params as $k=>$v){
                $params_map[$v['id']] = $v;
            }   
            $params = $params_map;
            cache('gygy_bonus',$params);
        }
        return $params;
    }  
    //-------------后台---------------

    public function configs()
    {
        return $this->hasMany('BonusConfig','bonus_id');
    }

    public static function getList(){
        $params = request()->param();
        $query = self::order('id desc');
        if($params['name']??''){
             $query->where('name', 'like','%'.trim($params['name']).'%');
        }

        if(isset($params['enable']) && is_numeric($params['enable'])){
            $query->where('enable', $params['enable']);
        }
        return $query->paginate();
    }
}