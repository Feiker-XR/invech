<?php

use think\migration\Seeder;

class VcThirdPay extends Seeder
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
        $filename = __DIR__ . DS . 'vc_thirdpay.sql';
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