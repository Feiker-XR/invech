<?php
namespace app\common\model;
use think\Model;

use app\common\model\report\DailyTrait;
use app\common\model\report\MonthTrait;

class DailyDeposit extends Base{

	use DailyTrait,MonthTrait;
	
    protected $table = 'gygy_daily_deposit';
    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';

    public static function getMonthReportOutterBuild($where=[],$paginate=true){

        $fields = [
            'sum(pre_amount) as pre_amount',
            'sum(suc_amount) as suc_amount',            
            ];        

		$query = self::getMonthReportBuild($fields,$where,$paginate);

        return $query;
    }    
}
