<?php
namespace app\common\model\report;

use bong\foundation\QueryWrapper;

use app\common\model\DailyBet;
use app\common\model\DailyDeposit;
use app\common\model\DailyWithdraw;
use app\common\model\DailyBonus;

trait MonthTrait
{
    //无需建月报表,一年一个日报表也就300多记录;
    //daily模型使用:DailyBet,DailyBonus,DailyDeposit,DailyWithdraw

    //日报表模型的getMonthReportOutterBuild定义fields,并调用这里的getMonthReportBuild
    private static function attachToFieldAndWhere($query,$fields=[],$where=[]){
        if(!empty($where)){
            $query->where($where);
        }
        $query->field($fields);
    }
    
    private static function attachToGroup($query){
        $field = "DATE_FORMAT(`date`,'%Y-%m') as month";        
        $query->field($field)->group('month');
    }

    private static function checkMonthDate(){
        $validate = validate('DateFormat');

        $validate->scene('month');       
        $params = request()->param();

        if(!$validate->check($params)) {
            throw new \Exception($validate->getError());
        }
    }

    private static function attachToMonth(&$query,$field_date='date'){

        self::checkMonthDate();

        $params = request()->param();
        $year = date('Y');
        $startdate = $params['startTime']??'';
        $enddate = $params['endTime']??'';
        $sdate = empty($startdate)?$year:$startdate;
        $edate = empty($enddate)?$year:$enddate;

        //date('Y-m-d H:i:s',strtotime('2017'));//2018-04-18 20:17:00
        //$date_f = date("Y-01-01 00:00:00",strtotime($sdate));
        //$date_t = date("Y-12-31 23:59:59", strtotime($edate)); 
        $date_f_time = mktime(0, 0, 0, 1, 1, $sdate);
        $date_t_time = mktime(23, 59, 59, 12, 31, $edate);
        $date_f = date("Y-m-d H:i:s",$date_f_time);
        $date_t = date("Y-m-d H:i:s",$date_t_time);

        $query->where($field_date,'between',[$date_f,$date_t]);
    }

    private static function makeWrapperForPaginate($query){
        $sub_query = $query->buildSql();
        
        //$query_new = db($sub_query.' s')->order('day');//error
        $query_new = db()->table($sub_query.' s')->order('month');

        return $query_new; 
    }

    public static function getMonthReportBuild($fields=[],$where=[],$paginate=true){

        $model = (new static);

        $query = $model->db(true,true);

        self::attachToMonth($query);
        self::attachToGroup($query);
        self::attachToFieldAndWhere($query,$fields,$where);

        if($paginate){
            return self::makeWrapperForPaginate($query);
        }else{
            return $query;
        }

    }

    //月综合报表
    public static function getMonthAllReport(){

        $query_month_bet = DailyBet::getMonthReportOutterBuild([],false);
        $query_month_deposit = DailyDeposit::getMonthReportOutterBuild([],false);
        $query_month_withdraw = DailyWithdraw::getMonthReportOutterBuild([],false);
        $query_month_bonus = DailyBonus::getMonthReportOutterBuild([],false);

        $sub_query_month_bet = $query_month_bet->select(false);
        $sub_query_month_deposit = $query_month_deposit->select(false);
        $sub_query_month_withdraw = $query_month_withdraw->select(false);
        $sub_query_month_bonus = $query_month_bonus->select(false);

        $query = db()->table('('.$sub_query_month_bet.') b');
        $query->join('('.$sub_query_month_deposit.') d','b.month=d.month','LEFT');
        $query->join('('.$sub_query_month_withdraw.') w','b.month=w.month','LEFT');
        $query->join('('.$sub_query_month_bonus.') bo','b.month=bo.month','LEFT');

        $fields = [
            'b.month as month',
            'ifnull(bet_amount,0.00) as bet_amount',
            'ifnull(b.bonus_amount,0.00) as zj_amount',
            'ifnull(win_amount,0.00) as win_amount',
            'ifnull(bet_num,0) as bet_num',
            'ifnull(zj_num,0) as zj_num',
            'ifnull(backwater_amount,0.00) as backwater_amount',

            'ifnull(d.pre_amount,0.00) as deposit_pre_amount',
            'ifnull(d.suc_amount,0.00) as deposit_amount',

            'ifnull(w.amount,0.00) as withdraw_amount',
            'ifnull(w.real_amount,0.00) as withdraw_real_amount',
            'ifnull(w.debit_amount,0.00) as withdraw_debit_amount',

            'ifnull(bo.bonus_amount,0.00) as bonus_amount',
        ];        

        $query->field($fields)->order('b.month');

        return $query->paginate();
    }    
}
