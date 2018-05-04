<?php
namespace app\common\model;
use think\Model;

use app\common\model\report\DailyTrait;
use app\common\model\report\MonthTrait;

class DailyBonus extends Base{

	use DailyTrait,MonthTrait;
	
    protected $table = 'gygy_daily_bonus';
    protected $createTime = 'created_at';
    protected $updateTime = '';
    protected $autoWriteTimestamp = 'datetime';

    public function bonus()
    {
        return $this->belongsTo('Bonus','bonus_id');
    }    

    public static function getMonthReportOutterBuild($where=[],$paginate=true){

        $fields = [
            'sum(bonus_amount) as bonus_amount',            
            ];        

        $query = self::getMonthReportBuild($fields,$where,$paginate);

        return $query;
    }   

    /*
    public static function getMonthReportWhere(&$query,$where){
        if($bonus_id = input('bonus_id')??0){
            $query->where('bonus_id',$bonus_id);
        }
    }
    */
}
