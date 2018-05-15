<?php
namespace app\common\model\member;
use app\common\model\Bonus;

trait BonusTrait
{
    public function get_bonus_init_data(){
        $id = input('id/i');
        $bonus = Bonus::get($id);
        if(!$bonus){
            $this->error = '红利不存在!';
            return false;            
        }
        return $bonus->configs;
    }

    public function do_turntable(){
        try{
            list($prize) = event('user.turntable',[$this,]);
            return $prize;    
        }catch(\Exception $e){
            $this->error = $e->getMessage();
            return false;
        }
    }

}