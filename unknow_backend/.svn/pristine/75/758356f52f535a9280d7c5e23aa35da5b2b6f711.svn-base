<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateVcThirdCode extends Migrator
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
        $table = $this->table('vc_thirdcode');             
        $table->addColumn('setid', 'integer',['null' => true, ])
            ->addColumn('set_configid', 'integer', ['null' => true, ])
            ->addColumn('thirdid', 'integer', ['null' => true, ])
            ->addColumn('code', 'string', ['null' => true, 'limit' => 255,])
            ->addColumn('min', 'string', ['null' => true, 'limit' => 255,])            
            ->addColumn('max', 'string', ['null' => true, 'limit' => 255,])
            ->addColumn('add_time', 'integer', ['null' => true, ])
            ->addColumn('update_time', 'integer', ['null' => true, ])
            ->addColumn('status', 'integer', ['null' => true, ])
            ->addColumn('warntime', 'integer', ['null' => true, ])
            ->addColumn('money_decimal', 'integer', ['null' => true, 'default'=>0,'limit' => \Phinx\Db\Adapter\MysqlAdapter::INT_TINY,])
            ->create(); 
    }
}
