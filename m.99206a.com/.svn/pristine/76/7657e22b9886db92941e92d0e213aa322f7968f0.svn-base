<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateFengpan extends Migrator
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
        $table = $this->table('k_fengpan');
        $table->addColumn('name', 'string', ['limit' => 255,])
            ->addColumn('weihu', 'integer', ['limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,'default'=>0,])        
            ->addColumn('reason', 'string', ['limit' => 1024,])
            ->addColumn('name1', 'string', ['limit' => 255,])
            ->create();
    }
}
