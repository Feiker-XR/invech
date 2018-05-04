<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateGametype extends Migrator
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
        $table = $this->table('gametype');
        $table->addColumn('gameplateform', 'integer')
            ->addColumn('gametype', 'string', ['limit' => 32,])
            ->addColumn('addtime', 'datetime', ['limit' => 12,])            
            ->addColumn('commissionRate', 'decimal', ['null' => true, 'precision'=>4,'scale'=>2,'default'=>0.00,'comment'=>'反水比例',])            
            ->addColumn('plateformname', 'string', ['null' => true, 'limit' => 32,])
            ->create(); 
    }
}
