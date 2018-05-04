<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace app\mobile\Controller;

use app\mobile\Base;

/**
 * 空模块，主要用于显示404页面，请不要删除
 */
class Notice extends Base
{

	/**
	 * 列表页
	 */
	public final function notice()
    {
		$list = model('content')->where(array('enable'=>1))->order('id desc')->select() ;
		$id   = request()->param('id') ;
		foreach ($list as $l)
			$list2[$l['id']]=$l;
		if($id) {
            $info = $list2[$id];
        } else {
            $info = $list[0];
        }
		$this->assign('info',$info) ;
		$this->assign('data',$list) ;
		return $this->fetch('user/notice') ;
	}
	
	/**
	 * 详情页
	 */
	public final function info()
    {
		$content = model('content')->where(array('enable'=>1, 'id'=>request()->param('id')))->find() ;
		$this->assign('info',$content) ;
		return $this->fetch('user/info') ;
	}
}
