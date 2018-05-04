<?php

use think\migration\Seeder;

class VcSetConfig extends Seeder
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
        $key_array = ['id','set_id','name','code','img','add_time','update_time',];
        $data_array = [
            [1,1,'支付宝扫码','ALIPAY','/uploads/1496645596674.png',1496645564,1496645597,],
            [2,2,'微信扫码','WECHAT','/uploads/1496645682684.png',1496645684,NULL],
            [3,3,'财付通扫码','TENPAY','/uploads/1496645730873.png',1496645731,NULL],
            [4,4,'工商银行','GSBANK','/uploads/1496645766606.jpg',1496645773,NULL],
            [5,4,'建设银行','JSBANK','/uploads/1496645792340.jpg',1496645793,NULL],
            [6,4,'中信银行','ZXBANK','/uploads/1496645805214.jpg',1496645825,NULL],
            [7,4,'农业银行','NYBANK','/uploads/1496645846787.jpg',1496645863,NULL],
            [8,4,'招商银行','ZSBANK','/uploads/1496645892712.jpg',1496645905,NULL],
            [9,4,'交通银行','JTBANK','/uploads/1496645927453.jpg',1496645938,NULL],
            [10,5,'QQ扫码','QQPAY','/uploads/1496645969916.png',1496645970,NULL],
            [11,6,'10元充值卡','DK10','/uploads/1496645992699.png',1496645993,NULL],
            [12,6,'20元充值卡','DK20','/uploads/1496646001626.png',1496646012,NULL],
            [13,6,'30元充值卡','DK30','/uploads/1496646028382.png',1496646029,NULL],
            [14,6,'50元充值卡','DK50','/uploads/1496646036401.png',1496646042,NULL],
            [15,6,'100元充值卡','DK100','/uploads/1496646051131.png',1496646058,NULL],
            [16,6,'200元充值卡','DK200','/uploads/1496646065433.png',1496646074,NULL],
            [17,6,'500元充值卡','DK500','/uploads/1496646093323.png',1496646100,NULL],
            [18,6,'1000元充值卡','DK1000','/uploads/1496646109326.png',1496646121,NULL],
            [19,6,'2000元充值卡','DK2000','/uploads/1496646128855.png',1496646141,NULL],
            [20,6,'3000元充值卡','DK3000','/uploads/1496646149667.png',1496646157,NULL],
            [21,6,'5000元充值卡','DK5000','/uploads/1496646166923.png',1496646174,NULL],
            [22,6,'10000元充值卡','DK10000','/uploads/1496646189102.png',1496646190,1496646467],
            [23,7,'京东扫码','JDPAY','/uploads/1496646402860.png',1496646403,NULL],
            [24,8,'支付宝wap','ALIPAYWAP','/uploads/1496817386765.png',1496817387,NULL],
            [25,8,'微信wap','WAP','/uploads/1496817414624.png',1496817416,NULL],
            [26,8,'QQwap','QQPAYWAP','/uploads/1496817449424.png',1496817450,1496817547],
            [27,8,'财付通wap','TENPAYWAP','/uploads/1496817523949.png',1496817524,1501571030],
            [28,4,'中国银行','ZGBANK','/uploads/1496833903341.jpg',1496833904,NULL],
            [29,4,'民生银行','MSBANK','/uploads/1496834032356.jpg',1496834034,NULL],
            [30,9,'百度扫码','BAIPAY','/uploads/1497006881975.png',1497006882,NULL],
        ];
        $data = [];
        foreach ($data_array as $value) {
            foreach ($key_array as $index => $key) {
                $row[$key] = $value[$index];
                $data[] = $row;
            }
            
        }
        $this->insert('vc_set_config', $data); 
    }
    */
    public function run()
    {
        $filename = __DIR__ . DS . 'vc_setconfig.sql';
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