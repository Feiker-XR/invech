<?php
namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

use app\common\model\Member;

//php think commission
//结算 指定日期或当前日期 的 上个月的佣金
class Commission extends Command
{
    protected function configure()
    {
        $this->setName('commission')->setDescription('月结佣金')
        ->addArgument('date')
        ->addOption('day');
    }

    protected function execute(Input $input, Output $output)
    {    	
        $args = $input->getArguments();

        $date = $args['date']?:date('Y-m-d');

        //遍历所有代理;一个一个月结
        $last_month_time = strtotime($date . '-1 month' );
        $first_day_last_month = date("Y-m-1", $last_month_time);

        //每个代理的佣金发放作为一个事务;已发放的直接返回;
        try{
            $perPage = 100;
            Member::AgentScope()->chunk($perPage, function($agents) use ($first_day_last_month){
                foreach ($agents as $agent) {
                    event('user.bet.commission',[$agent,$first_day_last_month]);
                }                
            });                    
        }catch(\Exception $e){
            $output->writeln($e->getMessage()); 
        }       

        $output->writeln('commission ok!');
    }
}
