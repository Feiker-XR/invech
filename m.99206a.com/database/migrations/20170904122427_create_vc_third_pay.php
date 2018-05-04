<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateVcThirdPay extends Migrator
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
        $table = $this->table('vc_thirdpay');             
        $table->addColumn('name', 'string', ['null' => true, 'limit' => 255,])
            ->addColumn('type', 'string', ['null' => true, 'limit' => 255,])            
            ->addColumn('pid', 'string', ['null' => true, 'limit' => 255,])
            ->addColumn('pkey', 'text', ['null' => true, ])
            ->addColumn('seckey', 'string', ['null' => true, 'limit' => 255,])
            ->addColumn('pubkey', 'string', ['null' => true, 'limit' => 255,])
            ->addColumn('prikey', 'string', ['null' => true, 'limit' => 255,])
            ->addColumn('purl', 'text', ['null' => true, ])
            ->addColumn('hrefbackurl', 'text', ['null' => true, ])
            ->addColumn('callbackurl', 'text', ['null' => true, ])
            ->addColumn('queryurl', 'text', ['null' => true, ])
            ->addColumn('add_time', 'integer', ['null' => true, ])
            ->addColumn('update_time', 'integer', ['null' => true, ])
            ->addColumn('warntime', 'integer', ['null' => true, ])
            ->create();
    }
}
