<?php
namespace app\behavior;


use app\common\model\Bonus as BonusModel;
use app\common\model\BonusFlow as BonusFlowModel;
use app\common\model\Money as MoneyModel;
use app\common\model\Member as UserModel;
use app\common\model\Bet as BetModel;
use app\common\model\Config as ConfigModel;
use app\common\model\BackWater as BackWaterModel;

use think\Hook;//Hook::add和Hook::listen可以封装在帮助函数tag和hook中;

class BonusEventSubscriber 
{
	//tp的事件处理实现为hook的形式;
	//红利事件放在bonus表中;
	//其它事件的事件名和事件处理函数 建议 不要放在bonus表,也不要放在此订阅者中;
	//app_begin	$dispatch
	public function run(&$dispatch)
	{		
        $bonusEvents = BonusModel::getCachedEvents();

        $classname = get_class($this);

        foreach ($bonusEvents as $event => $businesses) {
            foreach ($businesses as $business) {
            	/*
            	$handle 支持 [$classname, $method]
            	$handle 可以是$obj,那么方法名就是标签名;
            	$handle 可以是::fun 全局函数
                $handle = [$classname , 'do' . ucfirst($business) ];
                Hook::add($event,$handle);  
                */
                $handle = $classname . '@do' . ucfirst($business);
                container('events')->listen($event,$handle);               
            }
        }
	}

    private function getBusiness(){
        $bt =debug_backtrace();
        $parent_function = $bt[2]['function'];//doXxx
        return lcfirst(substr($parent_function,2)); 
    }

    private function getBonus(){
        $business = $this->getBusiness();
        $bonus = BonusModel::getBonusByBusiness($business);
        if(!$bonus){ 
            throw new \Exception('bonus not configed.');
        }
        return $bonus;  
    }

    //外层事务调内层事务;内层事务失败回滚,同时需要抛出异常给上层去回滚

    //Hook::listen('user.register',$user,[$tid])
    //事件的数据负载使用 $extra = [$tid,$abc];    
    public function doRegister_hook(UserModel $user,$extra){//hook格式
        list($tid) = $extra;
        //...
    }

    //$payload = [$user,$tid,$a,$b,];
    //event('user.register', $payload);
    public function doRegister(UserModel $user,UserModel $tuser=null,...$extra){
        //list($a,$b) = $extra;
        
        $bonus = $this->getBonus();
        $amount = $bonus->getAmount();

        if($amount<=0)return;
	       
        transaction(function() use ($user,$bonus,$amount){
            $flow_data = [
                'uid'   =>  $user->uid,
                'bonus_id' => $bonus->id,               
                'amount'   => $amount,
                'remark'   => $bonus->desc
            ];

            $flow = BonusFlowModel::create($flow_data);

            $user->incBalance($amount,'bonus',$flow->id,$bonus->desc);
            //当前红利需要打码量
            if($bonus->is_audit){
                $betFlowRate = empty($bonus->betFlowRate)?ConfigModel::getByName('betFlowRate'):$bonus->betFlowRate;
                $audit = $betFlowRate * $amount;
                $user->incAuditFlow($audit);
            }

        });
	    
    }

    public function doRecommend(UserModel $user,UserModel $tuser=null,...$extra){

            if(!$tuser) return;

            $bonus = $this->getBonus();
            $amount = $bonus->getAmount();
        
            if($amount<=0)return;

            transaction(function() use ($user,$tuser,$bonus,$amount){

                $flow_data = [
                    'uid'   =>  $tuser->uid,
                    'bonus_id' => $bonus->id,               
                    'amount'   => $amount,
                    'remark'   => $bonus->desc.':'.$tuser->username.'推荐了'.$user->username,
                ];

                $flow = BonusFlowModel::create($flow_data);
                $tuser->incBalance($amount,'bonus',$flow->id,$bonus->desc);

                //当前红利需要打码量
                if($bonus->is_audit){
                    $betFlowRate = empty($bonus->betFlowRate)?ConfigModel::getByName('betFlowRate'):$bonus->betFlowRate;
                    $audit = $betFlowRate * $amout;
                    $user->incAuditFlow($audit);
                }

            });

    }   



    public function doTurntable(UserModel $user, ...$extra){

        $bonus = $this->getBonus();
        
        $config = $bonus->getConfig();

        $amount = $bonus->getAmount();
        
        if($amount>0){
            $flow = BonusFlowModel::create([
                'uid'       =>  $user->uid,
                'bonus_id'  =>  $bonus->id,
                'amount'    =>  $amount,
                'remark'    =>  $config->desc,            
            ]);

            $user->incBalance($amount,'bonus',$flow->id,$config->desc);

            //当前红利需要打码量
            if($bonus->is_audit){
                $betFlowRate = empty($bonus->betFlowRate)?ConfigModel::getByName('betFlowRate'):$bonus->betFlowRate;
                $audit = $betFlowRate * $amout;
                $user->incAuditFlow($audit);
            }

        }

    }   

    public function doFirstDeposit(UserModel $user, $order, ...$extra){
        //订单因为做备份,用户表新建字段表示是否赠送过首存红利;
        //if(!$user->first_deposit){  送首存优惠 }
	$a = 1;
    }
    

    //单个注单的返水,如果是即时返水,开奖后发送返水事件;
    //如果是月返水,那么请遍历当月注单,为每个注单发送返水事件;
    public function doBackWater_old(BetModel $bet, ...$extra){

        $bonus = $this->getBonus();
        
        $config = $bonus->getConfig();

        $amount = $config->getAmount($bet->bet_money);

        $flow = BonusFlowModel::create([
            'uid'       =>  $bet->uid,
            'bonus_id'  =>  $bonus->id,
            'amount'    =>  $amount,
            //'config'    =>  json_encode($config),//将当时的奖项放进去?
            'remark'    =>  $config->desc,       
        ]);

        $bet->user->incBalance($amount,'bonus',$flow->id,$config->desc);

        //没有返水表;
        //返水流水和分佣流水 都是 放入红利流水
        //查询分佣流水,只需bonus_id即可;
    }

    //重新设计返水表,返水和佣金的流水比较多;
    //而且bonus_flow只合适简单的红利;
    //登录产生的红利,没必要做一个登录记录,让登录红利去关联登录记录;
    //而 返水流水 和 分佣流水 还依赖 注单流水,

    //返水的流水比较多,而且用户的返点由用户自由选择    
    //佣金不仅流水多,而且设置方式特别,根据打码量或输赢值来算,放在全局配置中;

    public function doBackWater(BetModel $bet, ...$extra){

        $amount = $bet->bet_money * $bet->fanDian;

        //$bonus = $this->getBonus();
        if($amount>0){
            $flow = BackWaterModel::create([
                'uid'       =>  $bet->uid,            
                'amount'    =>  $amount,
                'item_id'   =>  $bet->id,
                'remark'    =>  '投注即时返水',  
            ]);
            $bet->user->incBalance($amount,'backwater',$bet->id,'投注即时返水');   
        }          
    }

    //复活金
    public function doComeback(UserModel $user, ...$extra){
        return 'doComeback';
    }
    //全勤奖金,月底可领一次,要求每天登录一次; 
    //上次登录时间,本月登录次数; 登录时间间隔有一天,增加计数,月底判定计数==当月天数
    public function doDuty(UserModel $user, ...$extra){
        return 'doDuty';
    }
    //VIP生日礼金,生日的三天内,可领取一次;
    public function doBirthday(UserModel $user, ...$extra){
        return 'doBirthday';
    }    
    
    //如果根据输赢值计算佣金,那么佣金只支持月结,不支持即时
    //本注用户赢了,是无法计算其佣金; 总输赢才可以;
    
    public function doCommission(UserModel $agent, ...$extra){

        list($date) = $extra;

        return $agent->commission($date);

    }

}
