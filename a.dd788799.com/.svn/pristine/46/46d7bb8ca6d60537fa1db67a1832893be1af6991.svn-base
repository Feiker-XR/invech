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
use think\Db;

/**
 *
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class Time extends Base {

    static protected $allow = array( 'verify');

    /**
     * 首页
     * @author root
     */
    public function index()
    {
		/* 查询条件初始化 */
    	$map = array();
		$type =  !empty(request()->param('type')) ? request()->param('type') : '';
		$this->assign('type',$type);
		
		$types = model('type')->where(array('enable'=>1))->select();
		$this->assign('types',$types);
		$list = Db::table('gygy_data_time a')
            ->join('gygy_type t ','a.type = t.id and t.id='.intval($type))
            ->field('a.*,t.title')
            ->order('actionNo')
            ->paginate();

//		$this->recordList($list);
        $this->assign('_list', $list);
        $this->assign('_page', $list->render());

        $this->meta_title = '时间管理';
       return $this->fetch();
    }
	/**
     * 编辑配置
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function update()
    {
        if ($this->request->isPost()) {
            $data = request()->param() ;
            $result['status'] = 0;
            $result['msg'] = 'error';
            if($data){
                $Config = model('data_time')->find($data['cid']);
                unset($data['cid']);
                if($Config->save($data)){
					//记录行为
//					$this->addLog(22 , $data['id'], $data['actionTime']);
                  $result['status'] = 1 ;
                  $result['msg'] = 'success';
                } else {
                    //插入失败
                    $result['status'] = 0 ;
                    $result['msg'] = 'update  faill';
                }
            } else {
                //缺少数据
                $result['status'] = 2 ;
                $result['msg'] = 'lost params';
            }
            echo  json_encode($result); die;
        } else {
            $id = request()->param('id') ;
            $info = array();
            /* 获取数据 */
            $info = model('data_time')->field(true)->find($id) ;

            if (false === $info){
                $this->error('获取配置信息错误');
            }
            $this->assign('info', $info);
            $this->meta_title = '编辑配置';
            return $this->fetch('edit');
        }
    }

}
