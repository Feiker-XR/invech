<?php
namespace app\common\model\member;

use app\common\model\Money;
use app\common\model\Order;
use app\common\model\Bet;
use app\common\model\Withdraw;
use app\common\model\BackWater;

trait RecordTrait
{
    private function attachToMySelf(&$query){
        $query->where('x.uid',$this->uid);
    }
 

    public function money_record_build(){
        $query = (new Money)->getListBuild();
        $this->attachToMySelf($query);
        return $query;
    }

    public function money_record(){        
        $query = $this->money_record_build();
        return $query->paginate();
    }

    public function recharge_record_build(){
        $query = (new Order)->getListBuild();        
        $this->attachToMySelf($query);
        $query->where('x.status',1);
        $query->with('way,user');
        $query->field('id,orderno,amount,created_at,status,local_code');
        return $query;
    }

    public function recharge_record(){
        $data   =   [];
        $data['list'] = $this->recharge_record_build()->paginate();
        $data['CountAmount'] = $this->recharge_record_build()->sum('amount');
        $PageAmount = 0;
        foreach ($data['list'] as $v){
            $PageAmount = bcadd($PageAmount,$v->amount,2);
        }
        $data['PageAmount']     =  $PageAmount;
        return $data;
    } 

    public function bet_record_build(){
        $query = (new Bet)->getListBuild();        
        $this->attachToMySelf($query);
        $query->with('types,played,user');
        return $query;
    }

    //投注记录
    public function bet_record(){        

        $data['list']   =   $this->bet_record_build()->paginate();
        /*     
        $data['tz']     =   $this->bet_record_build()->sum('actionNum*mode*beiShu');
        $data['bonus']  =   $this->bet_record_build()->sum('bonus');
        $data['cha']    =   $this->bet_record_build()->sum('bonus-actionNum*mode*beiShu');
        */
        $query = $this->bet_record_build();
        $sum_fields = [
            'ifnull(sum(mode*beiShu*actionNum),0.00) as bet_amount',
            'ifnull(sum(bonus),0.00) as zj_amount',
            //'ifnull(sum(case when lotteryNo !="" then actionNum*mode*beiShu-bonus else 0 end),0.00) as win_amount',
            'ifnull(sum(case when lotteryNo !="" then bonus-actionNum*mode*beiShu else 0 end),0.00) as win_amount',
            ];
        $stat = $query->field($sum_fields)->find();
        $data['tz'] = $stat['bet_amount'];
        $data['bonus'] = $stat['zj_amount'];
        $data['cha'] = 0 - $stat['win_amount'];

        $Pagetz = $Pagecha = $Pagebonus = 0;
        foreach ($data['list'] as $key => $item){
            //$Pagetz     +=  $item->actionNum * $item->mode * $item->beiShu;
            $Pagetz     +=  $item->bet_money;
            $Pagebonus  +=  $item->bonus;
            $data['list'][$key]['cha'] = $item->win_money; 
            $Pagecha += $item->win_money;
        }
      
        $data['Pagetz']     =  round($Pagetz,2);
        $data['Pagebonus']  =  round($Pagebonus,2);
        $data['Pagecha']    =  round($Pagecha,2);
        return $data;
    }

    //提现记录
    public function withdraw_record_build(){
        $query = (new Withdraw)->getListBuild();        
        $this->attachToMySelf($query);
        return $query;
    }

    public function withdraw_record(){
        $data   =   [];
        $data['list'] = $this->withdraw_record_build()->paginate();
        $data['CountAmount'] = $this->withdraw_record_build()->sum('amount');
        $PageAmount = 0;
        foreach ($data['list'] as $v){
            $PageAmount = bcadd($PageAmount,$v->amount,2);
        }
        $data['PageAmount']     =  $PageAmount;
        return $data;
    }

    //返水记录
    public function backwater_record_build(){
        $query = (new BackWater)->getListBuild();        
        $this->attachToMySelf($query);
        return $query;
    }

    public function backwater_record(){
        $data   =   [];
        $data['list'] = $this->backwater_record_build()->paginate();
        $data['CountAmount'] = $this->backwater_record_build()->sum('amount');
        $PageAmount = 0;
        foreach ($data['list'] as $v){
            $PageAmount = bcadd($PageAmount,$v->amount,2);
        }
        $data['PageAmount']     =  $PageAmount;
        return $data;
    }
}