<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use app\admin\Base;

/**
 * 提醒控制器
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class Notice extends Base {



    /**
     * 后台首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
		/* 查询条件初始化 */
    	$map = array();
		
		$list = model('content')
            ->order('id desc')
            ->paginate();

//		$this->recordList($list);
        $this->assign('_list', $list);
        $this->assign('_page', $list->render());

        $this->meta_title = '系统公告';
        return $this->fetch();
    }

    /**
     *  新增系统公告
     */
	public function add(){

		if($this->request->isPost()){
			$data['title'] = request()->param('title') ;
			$data['content'] = request()->param('content');
			$data['addTime'] = time();

			if (model('content')->save($data)) {
                $this->success('新增成功',Url('notice/index'));
            } else {
                $this->error('新增失败');
            }

		} else {
		    $content[''] =
			$this->meta_title = '新增公告';
			return $this->fetch();
		}
	}

	/**
     * 编辑配置
     * @author
     */
    public function update(){
        if($this->request->isPost()){
			$data['id']      =  request()->param('id') ;
            $data['title']   =  request()->param('title');
			$data['content'] =  request()->param('content');
			$data['enable']  =  !empty(request()->param('enable')) ? request()->param('enable') : 1;
			$data['addTime'] = time();

			if (model('content')->save($data)) {
                $this->success('更新成功',Url('notice/index'));
            } else {
                $this->error('更新失败');
            }

        } else {
            $id      = request()->param('id') ;
            $content = model('content')->find($id);
            $this->assign('content', $content);
            $this->meta_title = '编辑公告';
            return $this->fetch('notice/add');
        }

    }

    /**
     * 删除数据
     */
	public final function del($id='')
    {
		if (model('content')->where('id',$id)->delete()) {
            $this->success('删除成功',Url('notice/index'));
        }else {
            $this->error('删除失败');
        }
	}

}
