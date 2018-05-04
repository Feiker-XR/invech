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
class RechargeController extends Base {

	public final function index()
    {
		$banks    = model('member_bank')->where(array('admin'=>1, 'enable'=>1))->select();
		$bankList = model('bank_list')->where(array('isDelete'=>0))->select();
		$banks2   = array();

		$i = 0;
		foreach($banks as $bank)
		{
			foreach($bankList as $b)
			{
				if($bank['bankId'] == $b['id'])
				{
					$banks2[$i] = array_merge($bank,$b);
					$i++;
				}
			}
		}
		
		
		$set=$this->getSystemSettings();
		$this->assign('set',$set);
		$this->assign('banks',$banks2);
		$this->assign('coinPassword',$this->user['coinPassword']);
		$this->display();
	}
	
	/* 进入充值，生产充值订单 */
	public final function recharge(){
		
		if(I('amount')<=0)
			$this->error('充值金额必须大于0');
		
		$user = M('members')->find($this->user['uid']);
		if($user['coinPassword']!=think_ucenter_md5(I('coinpwd'), UC_AUTH_KEY)){
			$this->error('资金密码不正确');
		}else{
			// 插入提现请求表
			unset($para['coinpwd']);
			$para['rechargeId']=$this->getRechId();
			$para['actionTime']=$this->time;
			$para['uid']=$this->user['uid'];
			$para['username']=$this->user['username'];
			$para['actionIP']=$this->ip(true);
			$para['mBankId']=I('mBankId');
			$para['info']='用户充值';
			$para['amount']=intval(I('amount'));
			
			if(M('member_recharge')->add($para)){
				
				$bank = M('member_bank')->where(array('admin'=>1, 'enable'=>1,'bankId'=>I('mBankId')))->find();
				$bankList = M('bank_list')->where(array('isDelete'=>0))->select();

				foreach($bankList as $b)
				{
					if($bank['bankId'] == $b['id'])
					{
						$bank = array_merge($bank,$b);
					}
				}
			
				$this->assign('para',$para);
				$this->assign('memberBank',$bank);
				$this->display('Recharge/recharge');
			}else{
				$this->error('充值订单生产请求出错');
			}
		}
		
	}
	
	private final function getRechId(){
		$rechargeId=mt_rand(100000,999999);
		if(M('member_recharge')->where(array('rechargeId'=>$rechargeId))->find()){
			getRechId();
		}else{
			return $rechargeId;
		}
	}
	
	//充值详单
	public final function info(){
		$rechargeInfo = M('member_recharge')->where(array('id'=>I('id')))->find();		
		$bankInfo = M('member_bank')->where(array('uid'=>$rechargeInfo['uid']))->find();
		$list = M('bank_list')->order('id')->select();
		
		$bankList = array();
		if($list) foreach($list as $var){
			$bankList[$var['id']]=$var;
		}
		
		$this->assign('rechargeInfo',$rechargeInfo);
		$this->assign('bankInfo',$bankInfo);
		$this->assign('bankList',$bankList);
		
		$this->display('Recharge/recharge-info');
	}
}
