<?php
namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class Report extends Command
{
   
    //无用
    protected function configure(){

        $this->setName('report')->setDescription('采集-报表');
    }

    protected function execute(Input $input, Output $output){
        date_default_timezone_set('PRC') ;
        $star_time = strtotime(date("Y-m-d",time()));
        $end_time = strtotime(date("Y-m-d",strtotime("+1 day")));
        $where = [];
        $where['actionTime'] = ['>=', $star_time];
        $where['actionTime'] = ['<=',$end_time];
        $expect = db('bets')->field('sum(actionNum*mode) as bet_amount,sum(actionNum) as bet_count,sum(zjCount) as zj_count,sum(zjCount*bonus) as zj_amount')->where($where)->select();

        if(!$expect){
            $win = floatval($expect['bet_amount'])-floatval($expect['zj_amount']);
            $gygy_daily_report = ['bet_amount'=>$expect['bet_amount'],
                                'bet_count'=>$expect['bet_count'],
                                'zj_amount'=>$expect['zj_amount'],
                                'zj_count'=>$expect['zj_count'],
                                'win'=>$win,
                                'created_at'=>time(),
                         ];
            }
            $ret = db('daily_report')->insert($gygy_daily_report);
         }


}
