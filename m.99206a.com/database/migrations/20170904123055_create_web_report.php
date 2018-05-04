<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateWebReport extends Migrator
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
        $table = $this->table('web_report');             
        $table->addColumn('uid', 'integer')
            ->addColumn('platform', 'string', ['limit' => 32,])
            ->addColumn('gametype', 'string', ['limit' => 32,])
            ->addColumn('bet', 'decimal', ['precision'=>12,'scale'=>2,'default'=>0.00,])
            ->addColumn('payout', 'decimal', ['precision'=>12,'scale'=>2,'default'=>0.00,'comment' => '派奖',])
            ->addColumn('date', 'date') 
            ->create();
    }
}
