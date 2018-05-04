<?php

use think\migration\Migrator;
use think\migration\db\Column;

class UpdateWebHot extends Migrator
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
        //a:1:{i:0;s:8:"ismobile";}
        $table = $this->table('web_hot');
        $table->addColumn('ismobile', 'integer', ['default'=>0,'limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,])
            ->update();            
    }
}
