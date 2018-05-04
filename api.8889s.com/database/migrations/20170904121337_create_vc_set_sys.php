<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateVcSetSys extends Migrator
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
        $table = $this->table('vc_sys');             
        $table->addColumn('sys_user', 'string', ['null' => true, 'limit' => 20,])
            ->addColumn('nick_name', 'string', ['null' => true, 'limit' => 100,])
            ->addColumn('sys_password', 'string', ['null' => true, 'limit' => 100,])
            ->addColumn('sys_level', 'integer', ['null' => true, ])
            ->addColumn('last_login', 'datetime', ['null' => true, ])
            ->addColumn('last_ip', 'string', ['null' => true, 'limit' => 30,])
            ->addColumn('privilege', 'string', ['null' => true, 'limit' => 255,])
            ->create();
    }
}
