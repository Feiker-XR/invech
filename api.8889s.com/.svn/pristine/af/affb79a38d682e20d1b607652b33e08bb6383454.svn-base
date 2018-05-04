<?php

use think\migration\Seeder;

class VcSet extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    /*
    public function run()
    {
        $key_array = ['id','name','type','sort','pic','setclass','add_time','update_time','status',];
        $data_array = [
            [1,'支付宝','alipay',1,'/uploads/1496665625579.png',0,1496644958,1496823784,0,],
            [2,'微信','wechat',2,'/uploads/1496665633811.png',0,1496644976,1501506184,0,],
            [3,'财付通','tenpay',3,'/uploads/1496665642289.png',0,1496644999,1496665643,0,],
            [4,'网银','bank',4,'/uploads/1496665648494.png',0,1496645022,1496823784,0,],
            [5,'QQ钱包','qqpay',5,'/uploads/1496665656963.png',0,1496645048,1496665657,0,],
            [6,'点卡充值','diankapay',6,'/uploads/1496665662244.png',0,1496645068,1496665664,0,],
            [7,'京东','jdpay',7,'/uploads/1496665669996.png',0,1496646343,1496665670,0,],
            [8,'手机APP','app',9,'/uploads/1501829760741.png',1,1496649572,1501830049,0,],
            [9,'百度钱包','baipay',8,'/uploads/1497006863150.png',0,1497006865,1501664352,1,],
        ];
        $data = [];
        foreach ($data_array as $value) {
            foreach ($key_array as $index => $key) {
                $row[$key] = $value[$index];
                $data[] = $row;
            }
            
        }
        $this->insert('vc_set', $data); 
    }
    */
    public function run()
    {
        $filename = __DIR__ . DS . 'vc_set.sql';
        $content = file_get_contents($filename);
        $rows = explode(PHP_EOL,$content);
        foreach($rows as $row){
            $ret1 = preg_match('/^insert/', $row);
            if($ret1>0){
                $ret = db()->execute($row);
            }
        }        
    }    
}