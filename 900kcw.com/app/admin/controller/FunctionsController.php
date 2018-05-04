<?php
namespace app\admin\controller;
use app\admin\controller\AdminController;
/**
 * 应用管理
 */

class FunctionsController extends AdminController {

    /**
     * 当前模块参数
     */
    protected function _infoModule(){
        return array(
            'info'  => array(
                'name' => '应用管理',
                'description' => '管理网站基本功能',
                ),
            'menu' => array(
                    array(
                        'name' => '应用列表',
                        'url' => url('admin/Functions/index'),
                        'icon' => 'exclamation-circle',
                    ),
                )
            );            
    }
    /**
     * 应用列表
     */
    public function index(){
        $breadCrumb = array('应用管理'=>url());
        $this->assign('breadCrumb',$breadCrumb);
        $this->assign('list',target('Functions')->loadList());
        $this->adminDisplay();
    }

    /**
     * 状态更改
     */
    public function state(){
        $data = request('post.data');
        $app = request('get.app');
        //更新配置
        $config = array();
        $config['APP_STATE'] = $data;
        $file = $app.'/config';
        $info = load_config($file);
        if($info['APP_SYSTEM'] || !$info['APP_INSTALL']){
            $this->error('该应用无法更改状态！');
        }
        if(save_config($file, $config)){
            $this->success('应用状态更新成功！');
        }else{
            $this->error('应用状态更新失败！');
        }
    }

    /**
     * 安装
     */
    public function install(){
        $app = request('post.data');
        //读取配置
        $info = target('Functions')->getInfo($app);
        if(empty($info) || $info['APP_SYSTEM'] || $info['APP_INSTALL'] ){
            $this->error('该模块无法进行安装操作！');
        }
        //更改模块状态
        $config = array();
        $config['APP_INSTALL'] = 1;
        $config['APP_STATE'] = 1;
        $file = $app.'/config';
        if(!save_config($file, $config)){
            $this->error('应用配置失败，请确保应用写入权限！');
        }
        $sql_info = load_config($app.'/install');
        //执行SQL语句
        if($sql_info['INSTALL_SQL']){
            $sql = explode('<@>',$sql_info['INSTALL_SQL']);
            foreach ($sql as $key => $vo) {
                target('Functions')->execute($vo);
            }
        }
        $this->success('应用安装成功！');
    }

    /**
     * 卸载
     */
    public function uninstall(){
        $app = request('post.data');
        //读取配置
        $info = target('Functions')->getInfo($app);
        if(empty($info) || $info['APP_SYSTEM'] || !$info['APP_INSTALL'] ){
            $this->error('该模块无法进行卸载操作！');
        }
        $sql_info = load_config($app.'/install');
        //执行扩展卸载方法
        // if($info['APP_INST_MODEL']){
        //     if(!target($app.'/'.$info['APP_INST_MODEL'])->uninstall()){
        //         $this->error(target($app.'/'.$info['APP_INST_MODEL'])->getError());
        //     }
        // }
        //执行卸载SQL语句
        if($sql_info['UNSTALL_SQL']){
            $sql = explode('<@>',$sql_info['UNSTALL_SQL']);
            foreach ($sql as $key => $vo) {
                target('Functions')->execute($vo);
            }
        }
        //更改模块状态
        $config = array();
        $config['APP_INSTALL'] = 0;
        $config['APP_STATE'] = 0;
        $file = $app .'/config';
        if(!save_config($file, $config)){
            $this->error('应用配置失败，请确保应用写入权限！');
        }
        $this->success('应用卸载成功！');
    }
}

