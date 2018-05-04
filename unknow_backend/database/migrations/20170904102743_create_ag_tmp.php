<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateAgTmp extends Migrator
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
        $table = $this->table('ag_tmp');
        $table->addColumn('username', 'string', ['null' => true, 'limit' => 50,])
            ->addColumn('ag', 'decimal', ['null' => true, 'precision'=>15,'scale'=>2,])
            ->addColumn('agwin', 'decimal', ['null' => true, 'precision'=>15,'scale'=>2,])
            ->create();
    }
}
