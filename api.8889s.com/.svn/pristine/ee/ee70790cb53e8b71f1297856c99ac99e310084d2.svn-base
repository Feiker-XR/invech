<?php

use think\migration\Seeder;

class WangzhiManage extends Seeder
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
        $table = $this->table('wangzhi_manage');
        //$table->truncate();
        $this->execute('delete from wangzhi_manage');

        $data = ['wangzhi'=>'http://www.hg494.com','zhanghao'=>'leon2020','mima'=>'leon2020'];
        $table->insert($data)->save();
        //$this->insert('wangzhi_manage', $data);
    }
}