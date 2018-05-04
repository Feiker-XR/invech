<?php
namespace app\common\model;
use think\Model;

use app\common\model\report\DailyTrait;
use app\common\model\report\MonthTrait;

class DailyWithdraw extends Base{

	use DailyTrait,MonthTrait;
	
    protected $table = 'gygy_daily_withdraw';
    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';

    public static function getMonthReportOutterBuild($where=[],$paginate=true){

        $fields = [
            'sum(amount) as amount',
            'sum(real_amount) as real_amount',
            'sum(debit_amount) as debit_amount',       
            ];        

        $query = self::getMonthReportBuild($fields,$where,$paginate);

        return $query;
    }
}
