<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateVcSetConfig extends Migrator
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
        $table = $this->table('vc_set_config');             
        $table->addColumn('set_id', 'integer', ['null' => true, ])
            ->addColumn('name', 'string', ['null' => true, 'limit' => 255,])
            ->addColumn('code', 'string', ['null' => true, 'limit' => 255,])
            ->addColumn('img', 'text', ['null' => true, ])
            ->addColumn('add_time', 'integer', ['null' => true, ])
            ->addColumn('update_time', 'integer', ['null' => true, ])
            ->create();
    }
}
