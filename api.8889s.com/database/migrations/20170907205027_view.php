<?php

use think\migration\Migrator;
use think\migration\db\Column;

class View extends Migrator
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
        $dbname_sql = 'select database() as dbname';
        //$count = $this->execute($dbname_sql);
        //$dbname = $this->query($dbname_sql)->fetchAll();
        //$dbname = $this->fetchAll($dbname_sql);
        $result = $this->fetchRow($dbname_sql);
        $dbname = $result['dbname'];

        
        $filename = __DIR__ . DS . 'view.sql';
        $content = file_get_contents($filename);
        $rows = explode(PHP_EOL,$content);
        foreach($rows as $row){
            $ret1 = preg_match('/ALGORITHM/', $row);
            if($ret1>0){
                $row = str_replace('/*!50001', '', $row);
                $row = str_replace('*/;', '', $row);
                //$dbs = ['js1_188ksb1_db','js1_188other1','js1_188sport1_db'];
                //$nulls = ['','',''];
                //$row = str_replace($dbs, $nulls, $row);
                $ret = db()->execute($row);
            }
        }
    }
}
