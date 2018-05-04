<?php

use think\migration\Migrator;
use think\migration\db\Column;

class UpdateKbet extends Migrator
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
        //a:8:{i:0;s:6:"master";i:1;s:5:"guest";i:2;s:8:"saltCode";i:3;s:10:"commission";i:4;s:12:"commissioned";i:5;s:8:"istongji";i:6;s:6:"device";i:7;s:2:"ip";}         
        $table = $this->table('k_bet');
        $table->addColumn('master', 'string', ['null' => true, 'limit' => 32,])
            ->addColumn('guest', 'string', ['null' => true, 'limit' => 32,])
            ->addColumn('saltCode', 'string', ['null' => true, 'limit' => 32,])
            ->addColumn('commission', 'decimal', ['null' => true, 'precision'=>4,'scale'=>3,'default'=>0.000,'comment'=>'当前注单反水金额',])
            ->addColumn('commissioned', 'integer', ['null' => true, 'default'=>0,'limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,'comment'=>'是否已反水',])
            ->addColumn('istongji', 'integer', ['null' => true, 'default'=>0,'limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,])
            ->addColumn('device', 'string', ['null' => true, 'limit' => 8,])
            ->addColumn('ip', 'string', ['null' => true, 'limit' => 16,])
            ->update();        
    }
}
