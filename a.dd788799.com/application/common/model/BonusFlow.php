<?php

namespace app\common\model;
use think\Model;

use app\common\traits\model\UserFlow;
use app\common\model\report\DailyMakerTrait;
//use app\common\model\attach\MoneyRecordTrait;

use app\common\model\report\CommonForFlowTrait;
use app\common\model\report\DailyAndMonthForFlowTrait;
//use app\common\model\report\GlobalUserFromFlowTrait;
//use app\common\model\report\GlobalAgentFromFlowTrait;
use app\common\model\report\GlobalFromFlowTrait;

class BonusFlow extends Base
{
    use UserFlow;
    use DailyMakerTrait;
    use CommonForFlowTrait,DailyAndMonthForFlowTrait;
    use /*GlobalUserFromFlowTrait,GlobalAgentFromFlowTrait,*/GlobalFromFlowTrait;

    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';

    protected $table = 'gygy_bonus_flow';

    public function bonus()
    {
        return $this->belongsTo('Bonus','bonus_id');
    }

    public static function attachToSelfRequest(&$query,$params=[]){

        $params = request()->param();

        if($params['bonus_id']??''){
           $query->where('x.bonus_id', $params['bonus_id']);
        }
        
    }    
}