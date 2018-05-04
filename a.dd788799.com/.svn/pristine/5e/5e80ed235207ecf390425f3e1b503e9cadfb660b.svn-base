<?php
namespace app\common\model\report;

use app\common\model\Bet;
use app\common\model\Order;
use app\common\model\Withdraw;
use app\common\model\ManualMoney;
use app\common\model\BonusFlow;

use bong\foundation\QueryWrapper;

trait CommonForFlowTrait
{
    private static function attachToFieldAndWhere($query,$fields=[],$where=[]){
        if(!empty($where)){
            $query->where($where);
        }
        $query->field($fields);
    }

    public static function makeWrapperForPaginate($query,$mode='uid'){
        $sub_query = $query->buildSql();
        
        //$query_new = db()->table($sub_query.' s')->order($mode.' desc');
        $query_new = (new static)->db(false,true);
        $query_new->table($sub_query.' s')->order($mode.' desc');

        return $query_new; 
    }

    public static function makeWrapperForSum($query,$fields=[]){
        $sub_query = $query->buildSql();
        
        //$query_new = db()->table($sub_query.' s');
        $query_new = (new static)->db(false,true);
        $query_new->table($sub_query.' s');

        $query_new->field($fields);

        return $query_new; 

        //return new QueryWrapper($query_new);
    }      

    public static function makeWrapperForPaginateAndSum($query,$fields=[],$mode='uid'){

        $sub_query = $query->buildSql();//options已清空

        $query_page = (new static)->db(false,true);
        $query_page->table($sub_query.' s');
        $query_page->order($mode.' desc');

 
        $query_sum = (new static)->db(false,true);
        $query_sum->table($sub_query.' s');
        $query_sum->field($fields);

        return [$query_page,$query_sum];
    }       
}
