<?php
namespace app\admin\model;
use app\base\model\BaseModel;
/**
 * 应用操作
 */
class FunctionsModel extends BaseModel{

    /**
     * 获取列表
     * @return array 列表
     */
    public function loadList(){
        $list = glob(APP_PATH.'*/conf/config.php');
        $configArray = array();
        foreach ($list as $file) {
            //解析模块名
            $file = str_replace('\\', '/', $file);
            $fileName = explode('/', $file);
            $fileName = array_slice($fileName,-3,1);
            $fileName = $fileName[0];
            $configArray[$fileName] = $this->getInfo($fileName);
        }
        $configArray = array_order($configArray,'APP_SYSTEM');
        return $configArray;

    }

    /**
     * 添加APP信息
     * @param string $app 应用名
     */
    public function getInfo($app){
        $info = load_config($app.'/config');
        if(empty($info)){
            return ;
        }
        $info['APP'] = $app;
        $info['APP_DIR'] =  $app;
        if($info['APP_SYSTEM']){
            $info['APP_STATE'] = 1;
            $info['APP_INSTALL'] = 1;
        }
        return $info;
    }
    /**
     * 添加APP数据库
     * @param string $sql sql语句
     */    
    public function execute($sql,$params = Array())
    {
        return $this->query($sql,$params);
    }

}
