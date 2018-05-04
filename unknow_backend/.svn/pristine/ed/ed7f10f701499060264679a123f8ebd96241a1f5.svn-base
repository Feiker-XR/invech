<?php

use think\migration\Migrator;
use think\migration\db\Column;

class UpdateKuser extends Migrator
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
        //  a:6:{i:0;s:9:"wechat_id";i:1;s:8:"nickname";i:2;s:6:"isbind";i:3;s:9:"firstbind";i:4;s:7:"liushui";i:5;s:11:"og_username";}
        $table = $this->table('k_user');
        $table->addColumn('wechat_id', 'string', ['null' => true, 'limit' => 64,])
            ->addColumn('nickname', 'string', ['null' => true, 'limit' => 64,])
            ->addColumn('isbind', 'integer', ['null' => true, 'default'=>0,'limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,])
            ->addColumn('firstbind', 'integer', ['null' => true, 'default'=>0,'limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,])
            ->addColumn('liushui', 'decimal', ['null' => true, 'precision'=>18,'scale'=>2,'default'=>0.00,])
            ->addColumn('og_username', 'string', ['null' => true, 'limit' => 32,])
            ->update();         
    }
}
