<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace app\admin\Controller;
use app\admin\Base;


/**
 * 统计功能控制器
 * @author root
 */
class Count extends Base {

    static protected $allow = array( 'verify');

    /**
     * 后台首页
     * @author root
     */
    public function index()
    {

		$dataMonth = model('count')->field('left(date,7) monthName,sum(betAmount) betAmount,sum(betAmount-zjAmount) winAmount')->group('monthName')->order('monthName desc')->limit(5)->select()->toArray();
        $this->assign('dataMonth',$dataMonth); //临时测试数据

        $todayData = $this->getDateCount();
		$this->assign('todayData',$todayData); //临时测试数据
		
		$date=strtotime("00:00")-24*3600;
		$yestodayData = $this->getDateCount($date);
		$this->assign('yestodayData',$yestodayData);

		$this->getTypes();
		$this->assign('types',$this->types);
		
		$this->getPlayeds();
		$this->assign('playeds',$this->playeds);
		
		$this->meta_title = '统计概况';
        return $this->fetch();
    }

	/**
	 * 获得某天的统计信息
	 */
	private function getDateCount($date=null)
    {
		if(!$date) $date=strtotime(date("Y-m-d",time()));

		$map=array();
		$map['kjTime'] = array('between',array($date,$date+24*3600));
		$map['lotteryNo'] = array('neq','');
		$map['isDelete'] = 0;
		$all=model('bets')->where($map)->field('IFNULL(count(*),0) betCount,IFNULL(sum(beiShu*mode*actionNum*(fpEnable+1)),0) betAmount,IFNULL(sum(bonus),0) zjAmount')->find()->toArray();

		$map=array();
		$map['liqType'] = array('between',array(2,3));
		$map['actionTime'] = array('between',array($date,$date+24*3600));
		$all= array_merge($all,model('coin_log')->where($map)->field('IFNULL(sum(coin),0) fanDianAmount')->find()->toArray());
		
		$map=array();
		$map['liqType'] = array('between',array(50,51,52,53));
		$map['actionTime'] = array('between',array($date,$date+24*3600));
		$all= array_merge($all,model('coin_log')->where($map)->field('IFNULL(sum(coin),0) brokerageAmount')->find()->toArray());

		return $all;
	}
	
	public final function datelist()
    {
		$para = request()->param();

		// 时间限制
		if($para['fromTime'] && $para['toTime']){
			$fromTime=strtotime($para['fromTime']);
			$toTime=strtotime($para['toTime'])+24*3600;
			
			$timeWhere="and l.actionTime between $fromTime and $toTime";
		}elseif($para['fromTime']){
			$fromTime=strtotime($para['fromTime']);
			
			$timeWhere="and l.actionTime >= $fromTime";
		}elseif($para['toTime']){
			$toTime=strtotime($para['toTime'])+24*3600;
			
			$timeWhere="and l.actionTime < $toTime";
		}else{
			$toTime=strtotime('00:00');
			
			$timeWhere="and l.actionTime > $toTime";
		}
		
		// 用户限制
		$amountTitle='全部总结';
		if($para['parentId']=intval($para['parentId'])){
			// 用户ID限制
			$userWhere="and u.parentId={$para['parentId']}";
			$uid=$para['parentId'];
			$userWhere2="and concat(',', u.parents, ',') like '%,$uid,%'";
		}
		if($para['uid']=intval($para['uid'])){
			// 用户ID限制
			$user = M('members')->where(array('uid'=>$para['uid']))->find();
			$uParentId=$user['parentId'];
			$userWhere="and u.uid=$uParentId";
			$userWhere2="and concat(',', u.parents, ',') like '%,$uParentId,%'";
		}
		
		if($para['username']){
			// 用户名限制
			$userWhere="and u.username='{$para['username']}'";
			$user = model('members')->where(array('username'=>$para['username']))->find();
			$userWhere2="and concat(',', u.parents, ',') like '%,".$user['uid'].",%'";
		}

		$sql="select u.username, u.coin, u.uid, u.parentId, hh.fanDianAmount,hh.betAmount, hh.zjAmount,hh.cashAmount,hh.rechargeAmount,hh.brokerageAmount  
		from gygy_members u ,
		(select l.uid,
		sum(case when l.liqType in (2,3) then l.coin else 0 end) as fanDianAmount,
		0-sum(case when l.liqType in (101,102,7) then l.coin else 0 end) as betAmount,
		sum(case when l.liqType=6 then l.coin else 0 end) as zjAmount,
		0-sum(case when l.liqType=107 then l.fcoin else 0 end) as cashAmount,
		sum(case when l.liqType=1 then l.coin else 0 end) as rechargeAmount,
		sum(case when l.liqType in (50,51,52,53) then l.coin else 0 end) as brokerageAmount 
		from gygy_coin_log l where 1 $timeWhere group by l.uid) hh where hh.uid=u.uid and 1 $userWhere group by u.uid order by (hh.zjAmount-hh.betAmount+hh.fanDianAmount) desc";
		//dump($sql);
		
		$Model = new \Think\Model();
		$list=$Model->query($sql);
		
		if(!$list) {
			//$uParentId2=$this->getValue("select parentId from {$this->prename}members where uid=?",$para['parentId']);
			//$user = M('members')->where(array('uid'=>$para['parentId']))->find();
			$list=array(array(
				'parentId'=>0,
				'uid'=>$para['parentId'],
				'username'=>'没有下级了'
				));
			$noChildren=true;
			//dump($noChildren);
		}
		//dump($list);
		
		$sql2="select sum(j.fanDianAmount) as fanDianAmount2, sum(j.betAmount) as betAmount2,sum(j.zjAmount) as zjAmount2,
		sum(j.cashAmount) as cashAmount2,sum(j.rechargeAmount) as rechargeAmount2,sum(j.brokerageAmount) as brokerageAmount2,sum(coin) as coin2 from
		(select u.username, u.coin, u.uid, u.parentId, hh.fanDianAmount,hh.betAmount, hh.zjAmount,hh.cashAmount,hh.rechargeAmount,hh.brokerageAmount  
		from gygy_members u ,
		(select l.uid,
		sum(case when l.liqType in (2,3) then l.coin else 0 end) as fanDianAmount,
		0-sum(case when l.liqType in (101,102,7) then l.coin else 0 end) as betAmount,
		sum(case when l.liqType=6 then l.coin else 0 end) as zjAmount,
		0-sum(case when l.liqType=107 then l.fcoin else 0 end) as cashAmount,
		sum(case when l.liqType=1 then l.coin else 0 end) as rechargeAmount,
		sum(case when l.liqType in (50,51,52,53) then l.coin else 0 end) as brokerageAmount 
		from gygy_coin_log l where 1 $timeWhere group by l.uid) hh where hh.uid=u.uid and 1 $userWhere2 group by u.uid) j";	
		//echo $sql2;
		
		$all=$Model->query($sql2);
		$all = $all[0];
		$this->assign('all',$all);
		
		$this->recordList($list);
		$this->assign('para',$para);
		
		$this->assign('noChildren',$noChildren);
		
		$this->meta_title = '综合统计';
		return $this->fetch();
	}
}
