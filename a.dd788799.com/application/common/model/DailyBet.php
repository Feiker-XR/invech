<?php
namespace app\common\model;
use think\Model;

use app\common\model\report\DailyTrait;
use app\common\model\report\MonthTrait;

class DailyBet extends Base{

	use DailyTrait,MonthTrait;

    protected $table = 'gygy_daily_bet';
    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';

    public static function getMonthReportOutterBuild($where=[],$paginate=true){

        $fields = [
            'sum(bet_amount) as bet_amount',
            'sum(bonus_amount) as bonus_amount',  
            'sum(win_amount) as win_amount',
            'sum(bet_num) as bet_num',
            'sum(zj_num) as zj_num',
            'sum(backwater_amount) as backwater_amount',            
            ];        

        $query = self::getMonthReportBuild($fields,$where,$paginate);

        return $query;
    }

}
