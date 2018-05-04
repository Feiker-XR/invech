<?php
namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

use bong\service\Database;

class Backup extends Command
{
	//0 3 28-31 * * [ `date -d tomorrow +\%e` -eq 1 ] && (shell script)
	//date相对时间,默认相对今天,上个月的; 或者相对指定日期的上个月的数据;
	//php think backup  ag_gameresult,ag_htresult 2018-03-21 

    CONST TABLE_ARRAY = [
    	'ag_gameresult'	  => 'betTime',
    	'ag_htresult'	  => 'betTime',
    	'bbin_gameresult' => 'WagersDate',
    	'og_live_history' => 'AddTime',
    	'mg_record'		  => 'transaction_time',
    	'pt_record'		  => 'GAMEDATE',
    	'gygy_config'	  => 'create_at',
    	'gygy_config2'	  => 'create_at',
    ];

    protected function configure()
    {
        $this->setName('backup')->setDescription('备份注单')
        ->addArgument('tables')->addArgument('date');
    }

    protected function execute(Input $input, Output $output)
    {    	
        $args = $input->getArguments();
        $date = $args['date']?:date('Y-m-d');		
		$date_e = date("Y-m-t", strtotime("-1 months", strtotime($date)));
		$date_t = date("Ym", strtotime("-1 months", strtotime($date)));

        $tables = explode (',',$args['tables']);			
        $database = new Database(); 
        
        $tables = array_unique($tables);
        $diff = array_diff($tables,array_keys(self::TABLE_ARRAY));
        if($diff){
        	$output->writeln("table is not valid!");exit;
        }

        foreach($tables as $table){
        	$where = [];
        	$date_field = self::TABLE_ARRAY[$table];
        	$where[$date_field] = ['<=' , $date_e.' 23:59:59'];
        	$ret = $database->backup($date_t,$table,$where);	
        }
		
		$output->writeln("backup ok!");	
    }
}
