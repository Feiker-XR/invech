<?php
namespace app\common\model;
use think\Model;
class BonusConfig extends Base
{
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $autoWriteTimestamp = 'datetime';

    protected $table = 'gygy_bonus_config';


    public function bonus()
    {
        return $this->belongsTo('Bonus','bonus_id');
    }

    public function getAmount($amount=0){

        if($this->amount>0||!$amount){
            return $this->amount;
        }else{
            return $this->radio * $amount / 100;
        }

    }

    public static function getList(){
        $params = request()->param();
        $query  = self::order('bonus_id')->order('sort desc');
        if($params['bonus_id']??''){
           $query->where('bonus_id', $params['bonus_id']);
        }
        if($params['bonus_name']??null){
           $query->alias('c')->join('gygy_bonus b','b.id = c.bonus_id')->where('b.name','like', '%'.trim($params['bonus_name']).'%');
        }
        return $query->paginate();
    }

}