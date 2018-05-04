<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\Base;

/**
 * 后台配置控制器
 * @author root
 */

class Menu extends Base {

    /**
     * 后台菜单首页
     * @return none
     */
    public function index()
    {
        $pid  = (!empty(request()->param('pid'))) ? request()->param('pid') : 0 ;
		if($pid){
			$data = model('menu')->where('id',$pid)->field(true)->find();
			$this->assign('data',$data);
		}
        $title    = trim(request()->param('get.title'));
        $type     = config('CONFIG_GROUP_LIST');
        $all_menu = model('Menu')->getField('id,title');
        $map  =  array(
            'pid'=>$pid
        );
        if ($title) {
            $map['title'] = array('like',"%{$title}%");
        }
        $list = model("Menu")->where($map)->field(true)->order('sort asc')->select();
        int_to_string($list,array('hide'=>array(1=>'是',0=>'否'),'is_dev'=>array(1=>'是',0=>'否')));
        if($list) {
            foreach($list as &$key){
                $key['up_title'] = $all_menu[$key['pid']];
            }
            $this->assign('list',$list);
        }
        $this->meta_title = '菜单列表';
       return $this->fetch();
    }

    /**
     * 新增菜单
     * @author yangweijie <yangweijiester@gmail.com>
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $Menu = model('Menu');
            $data = $Menu->create();
            if($data){
            	$id = $Menu->add();
                if($id){
                    // S('DB_CONFIG_DATA',null);
                	//记录行为
                	action_log('update_menu', 'Menu', $id, UID);
                    $this->success('新增成功', Url('index?pid='.request()->param('pid')));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Menu->getError());
            }
        } else {
            $this->assign('info',array('pid'=>request()->param('pid')));
            $menus = model('Menu')->field(true)->select();
            $menus = model('Common/Tree')->toFormatTree($menus);
            $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
            $this->assign('Menus', $menus);
            $this->meta_title = '新增菜单';
            $this->fetch('edit');
        }
    }

    /**
     * 编辑配置
     * @author yangweijie <yangweijiester@gmail.com>
     */
    public function edit($id = 0)
    {
        if ($this->request->isPost()) {
            $Menu = model('menu');
            $data = $Menu->create();
            if($data){
                if($Menu->save()!== false){
                    // S('DB_CONFIG_DATA',null);
                	//记录行为
                	action_log('update_menu', 'Menu', $data['id'], UID);
                    $this->success('更新成功', Url('index?pid='.$data['pid']));
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($Menu->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info  = model('Menu')->field(true)->find($id);
            $menus = model('Menu')->field(true)->select();
            $menus = model('Common/Tree')->toFormatTree($menus);

            $menus = array_merge(array(0=>array('id'=>0,'title_show'=>'顶级菜单')), $menus);
            $this->assign('Menus', $menus);
            if(false === $info){
                $this->error('获取后台菜单信息错误');
            }
            $this->assign('info', $info);
            $this->meta_title = '编辑后台菜单';
            return $this->fetch();
        }
    }

    /**
     * 删除后台菜单
     * @author yangweijie <yangweijiester@gmail.com>
     */
    public function del()
    {
        $id = array_unique((array)request()->param('id'));
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(model('menu')->where($map)->delete()){
            // S('DB_CONFIG_DATA',null);
        	//记录行为
        	action_log('update_menu', 'Menu', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    public function toogleHide($id,$value = 1)
    {
        $this->editRow('Menu', array('hide'=>$value), array('id'=>$id));
    }

    public function toogleDev($id,$value = 1)
    {
        $this->editRow('Menu', array('is_dev'=>$value), array('id'=>$id));
    }

    public function importFile($tree = null, $pid=0)
    {
        if($tree == null){
            $file = APP_PATH."Admin/Conf/Menu.php";
            $tree = require_once($file);
        }
        $menuModel = model('menu');
        foreach ($tree as $value) {
            $add_pid = $menuModel->save(
                array(
                    'title'=>$value['title'],
                    'url'=>$value['url'],
                    'pid'=>$pid,
                    'hide'=>isset($value['hide'])? (int)$value['hide'] : 0,
                    'tip'=>isset($value['tip'])? $value['tip'] : '',
                    'group'=>$value['group'],
                )
            );
            if($value['operator']){
                $this->import($value['operator'], $add_pid);
            }
        }
    }

    public function import()
    {
        if($this->request->isPost()){
            $tree = input('post.tree');
            $lists = explode(PHP_EOL, $tree);
            $menuModel = model('Menu');
            if($lists == array()){
                $this->error('请按格式填写批量导入的菜单，至少一个菜单');
            }else{
                $pid = input('post.pid');
                foreach ($lists as $key => $value) {
                    $record = explode('|', $value);
                    if(count($record) == 2){
                        $menuModel->save(array(
                            'title'=>$record[0],
                            'url'=>$record[1],
                            'pid'=>$pid,
                            'sort'=>0,
                            'hide'=>0,
                            'tip'=>'',
                            'is_dev'=>0,
                            'group'=>'',
                        ));
                    }
                }
                $this->success('导入成功',Url('index?pid='.$pid));
            }
        } else {
            $this->meta_title = '批量导入后台菜单';
            $pid = (int)request()->param('pid');
            $this->assign('pid', $pid);
            $data = model('menu')->where("id={$pid}")->field(true)->find();
            $this->assign('data', $data);
            return $this->fetch();
        }
    }
}
