<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateVcOrder extends Migrator
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
        $table = $this->table('vc_order');             
        $table->addColumn('order_id', 'string', ['limit' => 255,])
            ->addColumn('user_name', 'string', ['limit' => 255,])
            ->addColumn('order_money', 'decimal', ['precision'=>10,'scale'=>2,'default'=>0.00,])
            ->addColumn('order_time', 'integer')

            ->addColumn('sys_time', 'integer',['null' => true, ])
            ->addColumn('order_state', 'integer',['null' => true, ])
            ->addColumn('state', 'integer')
            ->addColumn('order_desc', 'string', ['null' => true, 'limit' => 255,])
        
            ->addColumn('pay_type', 'string', ['limit' => 255,])
            ->addColumn('pay_order', 'string', ['null' => true, 'limit' => 255,])
            ->addColumn('pay_api', 'string', ['null' => true, 'limit' => 255,])
            ->addColumn('lock_id', 'string', ['null' => true, 'limit' => 255,])            
            ->addColumn('order_msg', 'text', ['null' => true, 'limit' => 255,'comment' => '手动修改订单状态备注',])
            ->addColumn('uid', 'integer')

            ->create();
    }
}
