<?php

use think\migration\Seeder;

class WapThirdCode extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
/*
手机站支付,只支持 微信十号线,支付宝十号线;
其他线路 2-9 因为没有接入新版本，暂时关闭 
*/
        /*
        $key_array = ['id', 'setid', 'set_configid', 'thirdid', 'code', 'min', 'max', 'add_time', 'update_time', 'status', 'warntime', 'money_decimal', 'cashier',];
        $data_array = [
            ['108','8','24','10','ALIPAY','50','5000','1502035200','1502035200','0',NULL,'0','1'],
            ['109','8','25','10','WEIXIN','50','5000','1502035200','1502035200','0',NULL,'0','1']
        ];
        $data = [];
        foreach ($data_array as $value) {
            foreach ($key_array as $index => $key) {
                $row[$key] = $value[$index];
                $data[] = $row;
            }
            
        }
        $this->insert('vc_thirdcode', $data);
        */
        $filename = __DIR__ . DS . 'wap_thirdcode.sql';
        $content = file_get_contents($filename);
        $rows = explode(PHP_EOL,$content);
        foreach($rows as $row){
            $ret1 = preg_match('/^[insert|update]/', $row);
            if($ret1>0){
                $ret = db()->execute($row);
            }
        }

    }
}