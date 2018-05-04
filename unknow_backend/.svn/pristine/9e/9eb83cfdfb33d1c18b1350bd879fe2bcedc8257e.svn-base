<?php

use think\migration\Migrator;
use think\migration\db\Column;

class UpdateKuserFanshuiBili extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        //a:13:{i:0;s:3:"gid";i:1;s:2:"ag";i:2;s:2:"mg";i:3;s:2:"bb";i:4;s:2:"og";i:5;s:2:"sb";i:6;s:5:"tz_ag";i:7;s:5:"tz_ty";i:8;s:5:"tz_cp";i:9;s:5:"tz_mg";i:10;s:5:"tz_bb";i:11;s:5:"tz_og";i:12;s:5:"tz_sb";}
        $count = $this->execute('DELETE FROM k_user_fanshui_bili');


        $table = $this->table('k_user_fanshui_bili');
        $table->addColumn('gid', 'integer', ['null' => true, 'limit' => 11,])
            ->addColumn('ag', 'float')
            ->addColumn('mg', 'float')
            ->addColumn('bb', 'float')
            ->addColumn('og', 'float')
            ->addColumn('sb', 'float')
            ->addColumn('tz_ag', 'float', ['precision'=>8,'scale'=>0,])
            ->addColumn('tz_ty', 'float', ['precision'=>8,'scale'=>0,])
            ->addColumn('tz_cp', 'float', ['precision'=>8,'scale'=>0,])
            ->addColumn('tz_mg', 'float', ['precision'=>8,'scale'=>0,])
            ->addColumn('tz_bb', 'float', ['precision'=>8,'scale'=>0,])
            ->addColumn('tz_og', 'float', ['precision'=>8,'scale'=>0,])
            ->addColumn('tz_sb', 'float', ['precision'=>8,'scale'=>0,])
            ->update();
    }
}
