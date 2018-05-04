<?php
namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

use app\common\model\Backup as BackupModel;

class Backup extends Command
{
    //每月最后一天
	//0 3 28-31 * * [ `date -d tomorrow +\%e` -eq 1 ] && (shell script)
    //脚本在每月1号结算备份上个月的数据;
	//date相对时间,默认相对今天;
	//php think flow_backup 2018-03-21 gygy_config --day

    protected function configure()
    {
        $this->setName('flow_backup')->setDescription('备份流水')
        ->addArgument('date')->addArgument('tables')
        ->addOption('day');
    }

    protected function execute(Input $input, Output $output)
    {    	
        $args = $input->getArguments();

        $date = $args['date']?:date('Y-m-d');

        $opt = $input->getOptions();        
        $mode = ($opt['day']=='day')?'day':'';
        if($mode == 'day'){
            $last_day_time = strtotime("-1 days", strtotime($date));
            $date_f = date("Y-m-d", $last_day_time);
            $date_t = date("Y-m-d",$last_day_time);
            $date_show = date("Y-m-d",$last_day_time);
        }else{
            $last_month_time = strtotime("-1 months", strtotime($date));
            $date_f = date("Y-m-01",$last_month_time);
            $date_t = date("Y-m-t", $last_month_time);            
            $date_show = date("Y-m",$last_month_time);
        }
        //$where['created_at'] = ['between' , [$date_f.' 00:00:00',$date_t.' 23:59:59'],];

        $tables = [];
        if($args['tables']){
            $tables = explode (',',$args['tables']);      
            $tables = array_unique($tables);
            $diff = array_diff($tables,array_keys(BackupModel::TABLE_ARRAY));
            if($diff){
                $output->writeln("table is not valid!");exit;
            }            
        }

        try{
            BackupModel::backup($date_show,$tables,$date_f,$date_t);
            $output->writeln('backup ok!');
        }catch(\Exception $e){
            $output->writeln($e->getMessage()); 
        }

    }
}
