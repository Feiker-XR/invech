<?php
namespace app\common\model;
use think\Model;

use app\common\traits\model\UserFlow;

class Commission extends Base{

    protected $table = 'gygy_commission';
    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';

    use UserFlow;
        
    public function money()
    {
        return $this->morphMany('Money',['type','item_id'],'commission');
    }

}
