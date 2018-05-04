<?php
namespace app\common\model;

use app\common\traits\model\MyTable;

class LotteryTime extends Base{

    use MyTable;

    protected $table = 'gygy_lottery_time';

    protected static $id_table = 'gygy_lottery_time_id';    
    protected $prefix = 'gygy_lottery_time';
    protected $prefix_db = 'lottery_time';

    public function getActionNoAttr($value)
    {
        return $this->data['qishu'];
    }

    public function setActionNoAttr($value,$data)
    {
        return $this->data['qishu'] = $value;
    }    

    public function getActionTimeAttr($value)
    {
        return $this->data['kaipan'];
    }

    public function setActionTimeAttr($value,$data)
    {
        return $this->data['kaipan'] = $value;
    }   

}
