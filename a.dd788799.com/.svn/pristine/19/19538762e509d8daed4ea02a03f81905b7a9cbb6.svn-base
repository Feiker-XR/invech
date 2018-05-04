<?php
namespace app\common\model\report;

use bong\foundation\QueryWrapper;

use app\common\model\DailyBet;
use app\common\model\DailyDeposit;
use app\common\model\DailyWithdraw;
use app\common\model\DailyBonus;

use app\common\model\ManualMoney;

trait DailyTrait
{
    //daily模型使用:DailyBet,DailyBonus,DailyDeposit,DailyWithdraw
    //普通日报表 直接查对应日报表记录;
    //综合日报表 连表查所有日报表记录;
    private static function checkDailyDate(){
        $validate = validate('DateFormat');

        $validate->scene('daily');       
        $params = request()->param();

        if(!$validate->check($params)) {
            throw new \Exception($validate->getError());
        }
    }

    private static function attachToDaily(&$query,$field_date='date'){

        self::checkDailyDate();

        //日报表, 2018-04 2018-05;
        $params = request()->param();
        $date = date('Y-m');
        $startdate = $params['startTime']??'';
        $enddate = $params['endTime']??'';
        $sdate = empty($startdate)?$date:$startdate;
        $edate = empty($enddate)?$date:$enddate;
        $date_f = date("Y-m-01 00:00:00",strtotime($sdate));
        $date_t = date("Y-m-t 23:59:59", strtotime($edate)); 
        $query->where($field_date,'between',[$date_f,$date_t]);
    }

    //普通日报表
    public static function getDailyReportBuild(){
    	$query = (new static)->db(true,false);
    	self::attachToDaily($query);
    	return $query->order('date desc');
    }

    //日综合报表
    //正常情况下,即便每日的存款为0,存款日报表都会生成一条存款为0的统计记录;
    //只需要做内连接即可; 目前的测试数据不完整,这里实现为外连接;
    public static function getDailyAllReport(){

        $fields = [
            /*
            'CASE
            WHEN b.date=NULL THEN b.date
            ELSE b.date
            END',
            */
            'b.date as date',  //DailyBet作为左连接的起点,date必然不为空;
            'ifnull(win_amount,0.00) as win_amount',
            'ifnull(d.suc_amount,0.00) as deposit_amount',
            'ifnull(md.manual_deposit_amount,0.00) as manual_deposit_amount',
            'ifnull(mw.manual_withdraw_amount ,0.00) as manual_withdraw_amount',           
            'ifnull(w.amount,0.00) as withdraw_amount',
            'ifnull(w.real_amount,0.00) as withdraw_real_amount',
            'ifnull(w.debit_amount,0.00) as withdraw_debit_amount',
            'ifnull(bo.bonus_total_amount,0.00) as bonus_amount',

        ];

        $query = (new DailyBet)->db(true,true)->alias('b');
        $query->join((new DailyDeposit)->getTable().' d','b.date=d.date','LEFT');
        $query->join((new DailyWithdraw)->getTable().' w','b.date=w.date','LEFT');
        //$query->join((new DailyBonus)->getTable().' bo','b.date=bo.date','LEFT');
        //红利用分组子查询;
        $bonus_fields = [
            'date',
            'sum(bonus_amount) as bonus_total_amount',
        ];
        $sub_query = DailyBonus::field($bonus_fields)->group('date')->select(false);
        $query->join('('.$sub_query.') bo','b.date=bo.date','LEFT');
        //join子查询,子查询的sql必须用()符号

        
        $manual_deposit_fields = ['sum(amount) as manual_deposit_amount',];
        $manual_deposit_where = ['bonus_id'=>0];
        $sub_query = ManualMoney::getReportBuild($manual_deposit_fields,
            $manual_deposit_where,false,'day')->select(false);
        $query->join('('.$sub_query.') md','b.date=md.day','LEFT');

        $manual_withdraw_fields = ['sum(amount) as manual_withdraw_amount',];
        $manual_withdraw_where = ['bonus_id'=>-1];
        $sub_query = ManualMoney::getReportBuild($manual_withdraw_fields,
            $manual_withdraw_where,false,'day')->select(false);
        
        $query->join('('.$sub_query.') mw','b.date=mw.day','LEFT');

        $query->field($fields)->order('b.date');

        self::attachToDaily($query,'b.date');

        return $query->paginate();
    }    


}
