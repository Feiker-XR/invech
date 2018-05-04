<?php
namespace app\common\model;
use think\Model;

use app\common\model\report\DailyTrait;
use app\common\model\report\MonthTrait;

class DailyReport extends Base {

	use DailyTrait,MonthTrait;
		
    protected $table = 'gygy_daily_report';
    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';

}
