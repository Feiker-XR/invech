<?php

use think\migration\Migrator;
use think\migration\db\Column;

class UpdateKbetcg extends Migrator
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
        //a:3:{i:0;s:6:"master";i:1;s:5:"guest";i:2;s:8:"saltCode";}
        $table = $this->table('k_bet_cg');
        $table->addColumn('master', 'string', ['null' => true, 'limit' => 32,])
            ->addColumn('guest', 'string', ['null' => true, 'limit' => 32,])
            ->addColumn('saltCode', 'string', ['null' => true, 'limit' => 32,])
            ->update();         
    }
}
