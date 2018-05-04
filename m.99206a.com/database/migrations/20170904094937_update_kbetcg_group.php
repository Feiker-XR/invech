<?php

use think\migration\Migrator;
use think\migration\db\Column;

class UpdateKbetcgGroup extends Migrator
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
        //a:5:{i:0;s:8:"saltCode";i:1;s:8:"istongji";i:2;s:4:"isfs";i:3;s:2:"ip";i:4;s:6:"device";}
        $table = $this->table('k_bet_cg_group');
        $table->addColumn('saltCode', 'string', ['null' => true, 'limit' => 32,])
            ->addColumn('isfs', 'integer', ['null' => true, 'default'=>0,'limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,'comment'=>'是否已反水',])
            ->addColumn('istongji', 'integer', ['null' => true, 'default'=>0,'limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,])
            ->addColumn('device', 'string', ['null' => true, 'limit' => 8,])
            ->addColumn('ip', 'string', ['null' => true, 'limit' => 32,])
            ->update();         
    }
}
