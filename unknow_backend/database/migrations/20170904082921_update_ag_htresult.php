<?php

use think\migration\Migrator;
use think\migration\db\Column;

class UpdateAgHtresult extends Migrator
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
        $table = $this->table('ag_htresult');
        $table->addColumn('commission', 'decimal', ['null' => true, 'precision'=>4,'scale'=>3,'default'=>0.000,'comment'=>'当前注单反水金额',])
              ->addColumn('commissioned', 'integer', ['null' => true, 'default'=>0,'limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,'comment'=>'是否已反水',])
              //->addColumn('istj', 'integer', ['limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,])
              ->update();
    }
}
