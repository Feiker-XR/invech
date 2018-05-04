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
use app\admin\model\Activity;
use think\Db;

/**
 * 消费佣金控制器
 * @author root
 */
class Score extends Base {

    static protected $allow = array( 'verify');

    /**
     * 首页
     * @author root
     */
    public final function index(){
        $para = request()->param();
//
//		//dump($para);
//		// 用户限制
//		if($para['username']){
//			$userWhere=" and m.username like '%{$para['username']}%'";
//		}
//
//		// 时间限制
//		if($para['fromTime'] && $para['toTime']){
//			$fromTime=strtotime($para['fromTime']);
//			$toTime=strtotime($para['toTime'])+24*3600;
//			$timeWhere=" and s.swapTime between $fromTime and $toTime";
//		}elseif($para['fromTime']){
//			$fromTime=strtotime($para['fromTime']);
//			$timeWhere=" and s.swapTime>=$fromTime";
//		}elseif($para['toTime']){
//			$toTime=strtotime($para['toTime'])+24*3600;
//			$timeWhere=" and s.swapTime<$toTime";
//		}else{
//			$timeWhere=' and s.swapTime>'.strtotime('00:00');
//		}
//

		$list = Db::table('gygy_score_swap s')
            ->join('gygy_members m','s.uid=m.uid')
            ->join('gygy_score_goods g','s.goodId=g.id')
//            ->where('s.uid=m.uid and s.goodId=g.id '.$userWhere.$timeWhere)
            ->order('s.id desc')
            ->field('s.*, g.title goodsTitle, g.price goodsPrice, m.username userName'
            )->paginate();
		//dump($Model->getLastSql());
		
//		$this->recordList($list);
        $this->assign('_list', $list);
        $this->assign('_page', $list->render());
		
		$this->meta_title = '兑换记录';
		return $this->fetch();
    }

    /**
     * 兌換管理
     * @return mixed
     * @throws \think\exception\DbException
     */
	public final function goodslist()
    {
        $list = model('score_goods')
            ->where(array())
            ->order('id desc')
            ->paginate();
		//dump($Model->getLastSql());
		
//		$this->recordList($list);
        $this->assign('_list', $list);
        $this->assign('_page', $list->render());

		$this->meta_title = '兑换管理';
		return $this->fetch();
    }

    /**
     * 兌換管理，状态开启或关闭处理
     */
	public final function onScore(){
	    $type   = request()->param('type') ;
	    $id     = request()->param('id') ;
	    $enable = ($type==1) ? 0 : 1 ;

		if(model('score_goods')->find($id)->save(array('enable'=>$enable))) {
            $this->success('修改成功',Url('score/goodslist'));
        } else {
            $this->error('修改失败');
        }

	}

    /**
     * 删除
     */
	public final function del()
    {
        $id = request()->param('id') ;
		if (model('score_goods')->where('id',$id)->delete()) {
            $this->success('删除成功',Url('score/goodslist'));
        } else {
            $this->error('删除失败');
        }
	}

	public final function modal()
    {
		return $this->fetch('score/goods-modal');
	}
	
	public final function updateGoods()
    {
        $id = request()->param('id');
		if ($id) {
			$Config = model('score_goods');
            $data = $Config->create();
            if($data){
                if($Config->save($data)){
                    $this->success('更新商品成功', Url('score/goodslist'));
                } else {
                    $this->error('更新商品失败');
                }
            } else {
                $this->error($Config->getError());
            }
		} else {
			$Config = model('score_goods');
            $data   = $Config->create();
            if($data){
                if($Config->save($data)){
                    $this->success('新增商品成功', Url('score/goodslist'));
                } else {
                    $this->error('新增商品失败');
                }
            } else {
                $this->error($Config->getError());
            }
		}
	}

    /**
     *  消费活动管理
     * @return mixed
     * @throws \think\exception\DbException
     */
	public final function activity()
    {
        $list = model('activity')
            ->order('id')
            ->paginate() ;

//		$this->recordList($list);
        $this->assign('_list', $list);
        $this->assign('_page', $list->render());
		
		$this->meta_title = '消费活动';
		return $this->fetch();
    }

	public final function activitymodal()
    {
		$this->fetch('score/addactivity');
	}

    /**
     *  新增消费活动
     */
	public final function addactivity()
    {
		if($this->request->isPost()){

			$data['all']   = request()->param('all');
			$data['amount']= request()->param('amount');
				
			if(model('activity')->save($data)){
				$this->success('新增成功', Url('score/activity'));
			} else {
				$this->error('新增失败');
			}

		} else {
			$this->meta_title = '新增消费活动';
			return $this->fetch();
		}
    }

    /**
     *  修改消费活动
     */
	public final function editactivity()
    {
        if ($this->request->isPost()) {
            $params         = request()->param() ;
            $id             = $params['id'];
            $model          = model('activity')->find($id) ;
            $data['all']    = $params['all'] ;
            $data['amount'] = $params['amount'] ;

            if ($model->save($data)) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败或没有改动');
            }
        }
    }

    /**
     * 删除消费活动
     */
	public final function delactivity($id)
    {
		if(model('activity')->find($id)->delete()) {
            $this->success('删除成功',Url('score/activity'));
        } else {
            $this->error('删除失败');
        }
	}

}
