<?php
namespace app\common\model;

use app\common\traits\model\UserFlow;
use app\common\traits\model\Extra as ExtraTrait;
use app\common\model\report\CommonForFlowTrait;
use app\common\model\report\DailyAndMonthForFlowTrait;
use app\common\model\report\GlobalFromFlowTrait;

class CompanyMoney extends Base{

    use ExtraTrait;
    use UserFlow;
    use CommonForFlowTrait,DailyAndMonthForFlowTrait;
    use GlobalFromFlowTrait;

    protected static $extra = 'extra';

    protected $table = 'gygy_company_money';
    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';

    public function admin()
    {
        return $this->belongsTo('Admin','opt_uid','id');
    }
    
    public function scopeBankScope($query){
        return $query->where('type',CompanySet::TYPE_BANK);
    }

    public function scopeAlipayScope($query){
        return $query->where('type',CompanySet::TYPE_ALIPAY);
    }

    public function scopeWechatScope($query){
        return $query->where('type',CompanySet::TYPE_WECHAT);
    }

    public function getTypeTextAttr($value){
        $names = CompanySet::NAME_ARRAY;
        $type = $this->data['type'];
        return $names[$type]??'';
    }

    //后台
    public static function attachToSelfRequest(&$query,$params=[]){

        $params = request()->param();

        if(isset($params['type']) && is_numeric($params['type'])){
            $query->where('x.type', $params['type']);
        }

        $query->with('admin');
    }    


}
