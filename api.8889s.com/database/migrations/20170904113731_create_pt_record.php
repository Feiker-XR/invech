<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreatePtRecord extends Migrator
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
        $table = $this->table('pt_record');
 
        $table->addColumn('PLAYERNAME', 'string', ['limit' => 32,])
            ->addColumn('WINDOWCODE', 'string', ['limit' => 16,])
            ->addColumn('GAMEID', 'string', ['limit' => 16,])
            ->addColumn('GAMECODE', 'string', ['null' => true, 'limit' => 32,])
            ->addColumn('GAMETYPE', 'string', ['null' => true, 'limit' => 64,])
            ->addColumn('GAMENAME', 'string', ['null' => true, 'limit' => 128,])
            ->addColumn('SESSIONID', 'string', ['null' => true, 'limit' => 32,])

            ->addColumn('BET', 'decimal', ['null' => true, 'precision'=>13,'scale'=>2,'default'=>0.00,])
            ->addColumn('WIN', 'decimal', ['null' => true, 'precision'=>13,'scale'=>2,'default'=>0.00,])
            ->addColumn('PROGRESSIVEBET', 'decimal', ['null' => true, 'precision'=>13,'scale'=>2,'default'=>0.00,])
            ->addColumn('PROGRESSIVEWIN', 'decimal', ['null' => true, 'precision'=>13,'scale'=>2,'default'=>0.00,])
            ->addColumn('BALANCE', 'decimal', ['null' => true, 'precision'=>13,'scale'=>2,'default'=>0.00,])
            ->addColumn('CURRENTBET', 'decimal', ['null' => true, 'precision'=>13,'scale'=>2,'default'=>0.00,])

            ->addColumn('GAMEDATE', 'datetime', ['null' => true, ])
            ->addColumn('LIVENETWORK', 'string', ['null' => true, 'limit' => 32])
            ->addColumn('suffix', 'string', ['null' => true, 'limit' => 4])
            ->addColumn('username', 'string', ['null' => true, 'limit' => 32])
            ->addColumn('code', 'string', ['null' => true, 'limit' => 32])           
            ->create();
    }
}
