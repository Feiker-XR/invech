<?php
namespace app\common\model;
use think\Model;

use app\common\traits\model\UserFlow;
//use app\common\model\attach\MoneyRecordTrait;
use app\common\model\report\DailyMakerTrait;

use app\common\model\report\CommonForFlowTrait;
use app\common\model\report\DailyAndMonthForFlowTrait;
//use app\common\model\report\GlobalUserFromFlowTrait;
//use app\common\model\report\GlobalAgentFromFlowTrait;
use app\common\model\report\GlobalFromFlowTrait;

class ManualMoney extends Base{

    protected $table = 'gygy_manual_money';
    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';

    use UserFlow;
    use DailyMakerTrait;
    use CommonForFlowTrait,DailyAndMonthForFlowTrait;
    use /*GlobalUserFromFlowTrait,GlobalAgentFromFlowTrait,*/GlobalFromFlowTrait;

    public function admin()
    {
        return $this->belongsTo('Admin','opt_uid','id');
    }

    public function bonus()
    {
        return $this->belongsTo('Bonus','bonus_id','id');
    }

    public function bonusFlow()
    {
        return $this->belongsTo('BonusFlow','bonus_flow_id','id');
    }

    public function getAmountTypeAttr($value)
    {
        if($this->data['bonus_id'] == -1){
            return '动手扣款';
        }
        if($this->data['bonus_id'] == 0){
            return '动手存款';
        }
        //return $this->bonus->name;
        return $this->bonus->getData('name');
    }


    public function scopeDeposit($query){
        return $query->where('bonus_id',0);
    }
    public function scopeWithdraw($query){
        return $query->where('bonus_id',-1);
    }        

    //后台
    public static function attachToSelfRequest(&$query,$params=[]){

        $params = request()->param();

        $bonus_id = $params['bonus_id']??'';
        if(is_numeric($bonus_id)){
           $query->where('x.bonus_id', $bonus_id);
        }
        
    } 

}
