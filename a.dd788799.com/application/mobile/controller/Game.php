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
use think\Db;

/**
 * 游戏模块
 */
class Game extends Base{

    /**
     *  游戏功能
     * @param null $type
     * @param null $groupId
     * @param null $played
     * @return mixed
     */
	public function game($type=null, $groupId=null, $played=null)
    {
		$played = request()->param('played') ;
		$type   = request()->param('type') ;

		if($type) $this->type = $type ;
		if (request()->param('groupId')) {
			$this->groupId = request()->param('groupId') ;
		} else {
			$this->groupId = 1 ; // 默认进入三星玩法
		}
		$lastNo = $this->getGameLastNo($this->type) ;

		//$this->getValue("select data from {$this->prename}data where type={$this->type} and number='{$lastNo['actionNo']}'");
		$return = model('data')->where(array('type'=>$this->type,'number'=>$lastNo['actionNo']))->field('data')->find() ;
		$kjHao  = $return['data'] ;
        if($kjHao) $kjHao = explode(',', $kjHao) ;

		$actionNo   = $this->getGameNo($this->type) ;
		$types      = $this->getTypes() ;
		$kjdTime    = $types[$this->type]['data_ftime'] ;
		$diffTime   = strtotime($actionNo['actionTime'])-$this->time-$kjdTime ;
		$kjDiffTime = strtotime($lastNo['actionTime'])-$this->time ;

		$this->assign('type',$this->type) ;
		$this->assign('groupId',$this->groupId) ;
		$this->assign('types',$types) ;
		$this->assign('actionNo',$actionNo) ;
		$this->assign('lastNo',$lastNo) ;
		$this->assign('kjHao',$kjHao) ;
		$this->assign('kjdTime',$kjdTime) ;
		$this->assign('diffTime',$diffTime) ;
		$this->assign('kjDiffTime',$kjDiffTime) ;

		//$sql="select time, number, data from {$this->prename}data where type={$this->type} order by number desc,time desc limit 4";
		$history = model('data')->where(array('type'=>$this->type))->order('number desc')->limit(4)->field('time, number, data')->select() ;
        $this->assign('_list',$history) ;

		$groups = $this->getGroups() ;
		$this->assign('groups',$groups) ;
		
		$this->getSystemSettings() ;
		$this->assign('settings',$this->settings) ;
		
		$playeds=$this->getPlayeds() ;
		$this->assign('playeds',$playeds) ;

		if(!$played) {
			$playeds2 = array();
			$i=0;	
			foreach ($playeds as $play) {
				if ($play['groupId']==$this->groupId && $play['enable']==1) {
					$playeds2[$i] = $play;
					$i++;
				}
			}
			$played = $playeds2[0]['id'];
		}
		if ($played) { $this->played = $played ; }

        $this->assign('played',$played) ;
		$this->assign('playedId',$this->played) ;

		$maxPl = $this->getPl($this->type,$played) ;
		$this->assign('maxPl',$maxPl) ;

		//$sql="select * from {$this->prename}bets where uid={$_SESSION['user']['uid']} order by id desc limit 7";
		$order_list = model ('bets')->where(array('uid'=>$this->user['uid']))->limit(7)->order('id desc')->select() ;
		$this->assign('order_list',$order_list) ;
		$this->assign('time',$this->time) ;

		return $this->fetch();
	}

	public final function group($type, $groupId)
    {
		$this->playeds = $this->getPlayeds();
		$this->type = $type;
		$this->groupId = $groupId;
        $playedId = '' ;
		
		$playeds2 = array() ;
		$i = 0 ;
		foreach ($this->playeds as $play) {
			if ($play['groupId']==$groupId && $play['enable']==1) {
				$playeds2[$i] = $play;
				break;
				$i++;
			}
		}

		$playedId = $playeds2[0]['id'] ;
		$maxPl    = $this->getPl($type,$playedId) ;
		$this->assign('maxPl',$maxPl) ;
		$this->assign('playedId',$playedId) ;

		$this->assign('playeds',$this->playeds) ;
		$this->assign('type',$this->type) ;
		$this->assign('groupId',$this->groupId) ;

		$data =  $this->fetch('game/load_tab_group');
        echo $data ; exit ();
	}
	
	public final function played($type,$playedId)
    {
		$this->playeds=$this->getPlayeds();
		$data = $this->playeds[$playedId];
		$this->type = $type;

		$maxPl = $this->getPl($type,$playedId) ;
		$this->assign('maxPl',$maxPl) ;
			
		$this->groupId = $data['groupId'] ;
		$this->played  = $playedId ;
		
		$this->assign('type',$type);
		$this->assign('played',$data);
		$this->assign('groupId',$this->groupId);
		$this->assign('playedId',$playedId);
		$this->assign('simpleInfo',$data['simpleInfo']);
		$this->assign('tpl',$data['playedTpl']);
		echo  $this->fetch("game/inc_game_played"); exit();
	}
	
	private function getPl($type=null, $played=null)
    {
		$data = model('played')->where(array('id'=>$played))->field('bonusProp, bonusPropBase')->find();
		return $data;
	}

    /**
     * 验证是否开启投注
     */
	public final function checkBuy()
    {
		$actionNo = "" ;
		$this->settings = $this->getSystemSettings();
		if($this->settings['switchBuy']==0){
			$actionNo['flag']=1;
		}
		echo json_encode($actionNo) ;exit();
	}
	
	public final function getNo($type)
    {
		$actionNo=$this->getGameNo($type);
		
		if($type==1 && $actionNo['actionTime']=='00:00'){
			$actionNo['actionTime']=strtotime($actionNo['actionTime'])+24*3600;
		}else{
			$actionNo['actionTime']=strtotime($actionNo['actionTime']);
		}
		echo json_encode($actionNo);exit;
//		$this->ajaxReturn($actionNo,'JSON');
	}

    /**
     * 投注
     */
	public final function postCode()
    {
		$urlshang = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '' ; //上一页URL
		$urldan   = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '' ; //本站域名
		$urlcheck = substr($urlshang,7,strlen($urldan));
        //if($urlcheck !== $urldan)  $this->error('郑重警告：提交数据出错，请重新投注') ;

        $codes   = $_POST['code'] ;
        $para    = $_POST['para'];
        $amount  = 0;
        $fpcount = 1;  //飞盘 默认为1

		$this->getSystemSettings() ;
		if ($this->settings['switchBuy']==0) $this->error('本平台已经停止购买！') ;
		if ($this->settings['switchDLBuy']==0 && $this->user['type'])  $this->error('代理不能买单！') ;
		if(count($codes)==0) $this->error('请先选择号码再提交投注') ;
		//检查时间 期数
		$ftime      = $this->getTypeFtime($para['type']) ;  //封单时间
		$actionTime = $this->getGameActionTime($para['type']) ;  //当期时间
		$actionNo   = $this->getGameActionNo($para['type']) ;  //当期期数
		//if($actionTime!=$para['kjTime'])  $this->error('投注失败：你投注第'.$para['actionNo'].'已过购买时间1');
		if($actionNo != $para['actionNo'])  $this->error('投注失败：你投注第'.$para['actionNo'].'已过购买时间2') ;
		if($actionTime - $ftime < $this->time) $this->error('投注失败：你投注第'.$para['actionNo'].'已过购买时间3') ;
		
		// 查检每注的赔率是否正常
		$this->getPlayeds() ;
		foreach ($codes as $code) {
			$played = $this->playeds[$code['playedId']] ;
			//检查开启
			if(!$played['enable']) $this->error('游戏玩法组已停,请刷新再投 -1') ;
			//检查赔率
			$chkBonus=($played['bonusProp']-$played['bonusPropBase'])/$this->settings['fanDianMax']*($this->user['fanDian']-$code['fanDian'])+$played['bonusPropBase'] ;
			if($code['bonusProp']>$played['bonusProp']) $this->error('提交数据出错，请重新投注 -1') ;  //dump('myfandian:'.$this->user['fanDian'].' fandian:'.$code['fandian']);
			if($code['bonusProp']<$played['bonusPropBase']) $this->error('提交数据出错，请重新投注 -2') ; //dump('chkBonus:'.intval($chkBonus).'bonusProp:'.intval($code['bonusProp']));
			if(intval($chkBonus)!=intval($code['bonusProp'])) $this->error('提交数据出错，请重新投注 -3' );
			//检查返点
			if(floatval($code['fanDian'])>floatval($this->user['fanDian']) || floatval($code['fanDian'])>floatval($this->settings['fanDianMax'])) $this->error('提交数据出错，请重新投注 -4');
			//检查倍数
			if(intval($code['beiShu'])<1) $this->error('倍数只能为大于1正整数');
			// 检查注数
			if ($betCountFun=$played['betCountFun']) {
				if($played['betCountFun']=='descar'){
					if($code['actionNum']>Bet::$betCountFun($code['actionData'])) $this->error('提交数据出错，请重新投注 -5');
				}else if($played['betCountFun']=='descar2'){
					if($code['actionNum']<1) $this->error('提交数据出错，请重新投注 -6');
				}else{
					//if($code['actionNum']!=Bet::$betCountFun($code['actionData'])) $this->error('提交数据出错，请重新投注 -7'.Bet::$betCountFun($code['actionData']));
				}
			}///end
			
			//防作弊 20150722
			if ($this->types[$code['type']]['type']!=$played['type'])
			{
				$this->error('提交数据出错，请重新投注2');
			}
			
			if(strpos($played['name'],"任选")>-1 && $played['type']==1) {
				//检查任选的万千百十个位数是否作弊
				if($code['weiShu']!=0 && $code['weiShu']!=3 && $code['weiShu']!=5 && $code['weiShu']!=6 && $code['weiShu']!=7 &&  $code['weiShu']!=9 &&
				$code['weiShu']!=10 && $code['weiShu']!=11 && $code['weiShu']!=19 && $code['weiShu']!=14 && $code['weiShu']!=22 && 
				$code['weiShu']!=28 && $code['weiShu']!=12 && $code['weiShu']!=13 && $code['weiShu']!=17&& $code['weiShu']!=18 && 
				$code['weiShu']!=20 && $code['weiShu']!=21 && $code['weiShu']!=25 && $code['weiShu']!=26 && $code['weiShu']!=15 && 
				$code['weiShu']!=23 && $code['weiShu']!=30 && $code['weiShu']!=29 && $code['weiShu']!=27)
					$this->error('提交数据出错，请重新投注2');

				//任选四复式
				if ($played['id']==8) {
					str_replace("-","#",$code['actionData'],$num);
					if($num>1)
						$this->error('提交数据出错，请重新投注4');
				}
				//任选三复式
				if ($played['id']==14) {
					str_replace("-","#",$code['actionData'],$num);
					if($num>2)
						$this->error('提交数据出错，请重新投注4');
				}
				//任选二复式
				if ($played['id']==29) {
					str_replace("-","#",$code['actionData'],$num);
					if($num>3)
						$this->error('提交数据出错，请重新投注4');
				}
				//任选二大小单双
				if ($played['id']==44) {
					str_replace("-","#",$code['actionData'],$num);
					if($num>3)
						$this->error('提交数据出错，请重新投注4');
				}
				
				if($played['id']==9) {
						if($code['weiShu']!=15 && $code['weiShu']!=23 && $code['weiShu']!=27 && $code['weiShu']!=29 && $code['weiShu']!=30)
							$this->error('提交数据出错，请重新投注2');
				}
				
				if( $played['id']==15 || $played['id']==22 || $played['id']==23 || $played['id']==24 || $played['id']==41) {
						if($code['weiShu']!=7 && $code['weiShu']!=11 && $code['weiShu']!=13 && $code['weiShu']!=14 && $code['weiShu']!=19 &&
						$code['weiShu']!=21 && $code['weiShu']!=22 && $code['weiShu']!=25 && $code['weiShu']!=26 && $code['weiShu']!=28)
							$this->error('提交数据出错，请重新投注2');
				}
				
				if($played['id']==30||$played['id']==35||$played['id']==36) {
						if($code['weiShu']!=3 && $code['weiShu']!=5 && $code['weiShu']!=6 && $code['weiShu']!=9 && $code['weiShu']!=10 &&
						$code['weiShu']!=12 && $code['weiShu']!=17 && $code['weiShu']!=18 && $code['weiShu']!=20 && $code['weiShu']!=24)
							$this->error('提交数据出错，请重新投注2');
				}
			}	
				
			//11x5 bug
			if(strpos($played['name'],"任选")>-1 && $played['type']==2) {//$this->error("222");
				if(!strstr($code['actionData'],' '))
					$this->error('提交数据出错，请重新投注3');
				//检查任选的投注号码是否重复的作弊
				foreach(explode(' ',$code['actionData']) as $d) {
					str_replace($d,"#",$code['actionData'],$num);
					if($num>1)
						$this->error('提交数据出错，请重新投注3');
				}					
			}
			//11x5 bug
			if (strpos($played['name'],"组选")>-1 && $played['type']==2) {
			    //$this->error("222");
				if(!strstr($code['actionData'],' '))
					$this->error('提交数据出错，请重新投注3');
				//检查任选的投注号码是否重复的作弊
				foreach(explode(' ',$code['actionData']) as $d) {
					str_replace($d,"#",$code['actionData'],$num);
					if($num>1)
						$this->error('提交数据出错，请重新投注3');
				}
			}

		}
		
		$ip = $this->ip(true);
		if(isset($para['fpEnable']) && $para['fpEnable'])  $fpcount=2;

		$para2=array(
			'actionTime'=>$this->time,
			'actionNo'=>$para['actionNo'],
			'kjTime'=>$actionTime,
			'actionIP'=>$ip,
			'uid'=>$this->user['uid'],
			'username'=>$this->user['username'],
			'serializeId'=>uniqid()
		);
		
		if ($zhuihao = request()->param('zhuiHao')) {
			$liqType = 102 ;
			$codes   = array() ;
			$info    = '追号投注' ;
			
			foreach(explode(';', $zhuihao) as $var){
				list($code['actionNo'], $code['beiShu'], $code['kjTime']) = explode('|', $var) ;
				$code['kjTime'] = strtotime($code['kjTime']) ;
				$actionNo=$this->getGameNo($para['type'],$code['kjTime']-1) ;

				if(strtotime($actionNo['actionTime'])-$ftime<$this->time) $this->error('投注失败：你追号投注第'.$code['actionNo'].'已过购买时间') ;
				$codes[] = $code;
				$amount += abs($code['actionNum']*$code['mode']*$code['beiShu']*$fpcount) ;
			}
		} else {
			$liqType=101;
			$info='投注';

			foreach($codes as $i=>$code){
				$codes[$i]=array_merge($code, $para2) ;
				$amount+=abs($code['actionNum']*$code['mode']*$code['beiShu']*$fpcount) ;
			}
		}

		//查询用户可用资金
		$user = db('members')->where(array('uid'=>$this->user['uid']))->field('coin')->find() ;//$this->getValue("select coin from {$this->prename}members where uid={$_SESSION['user']['uid']}");
		$userAmount = $user['coin'] ;
		if($userAmount < $amount) $this->error('您的可用资金不足，是否充值？') ;
		
		// 开始事物处理
		Db::startTrans() ;
		$isBetSuccess  = array() ;
		$isCoinSuccess = array() ;
		$i = 0;
		foreach($codes as $code) {
			// 插入投注表
			$code['wjorderId'] = $code['type'].$code['playedId'].$this->randomkeys(8-strlen($code['type'].$code['playedId'])) ;
			$code['actionNum'] = abs($code['actionNum']) ;
			$code['mode']      = abs($code['mode']) ;
			$code['beiShu']    = abs($code['beiShu']) ;
			$amount            = abs($code['actionNum']*$code['mode']*$code['beiShu']*$fpcount) ;

			$isBetSuccess[$i]  = db('bets')->data($code)->insert() ;
			//$this->insertRow($this->prename .'bets', $code);

			// 添加用户资金流动日志
			$isCoinSuccess[$i] = $this->addCoin(array(
				'uid'=>$this->user['uid'],
				'type'=> isset($code['type']) ? $code['type'] : '',
				'liqType'=>$liqType,
				'info'=>$info,
				'extfield0'=> isset($isBetSuccess[$i]) ? $isBetSuccess[$i] : '',
				'extfield1'=> isset($para['serializeId']) ? $para['serializeId'] : '',
				'coin'=>-$amount
			));
			$i++;
		}
		
		$isSuc = true;
		for(;$i>=0;$i--) {
			if( isset($isBetSuccess[$i]) && $isBetSuccess[$i]===false ||  isset($isCoinSuccess[$i]) && $isCoinSuccess[$i]===false) {
				$isSuc = false;
				break;
			}
		}
		
		if ($isSuc) {
			//将投注记录写入文件
			if (!is_dir('record/')) mkdir('record/');
			$fp = fopen("record/".$code['username'].".txt", "a+");
			$tz_content = $code['wjorderId']." 投注内容：".$code['actionData']." 玩法：".$code['playedId']." 元角分：".$code['mode']." 倍数：".$code['beiShu']." 注数：".$code['actionNum']." 时间：".date('m-d H:i:s',time())."\r\n\r\n";
			$flag = fwrite($fp,$tz_content) ;
			if (!$flag) {
				$this->error('创建投注记录文件失败');
			} 
			fclose($fp); 
			
			Db::commit() ; //成功则提交
			$this->success('投注成功');
		} else{
            Db::rollback();//不成功，则回滚
			$this->error('投注失败');
		}		

	}

	/**
	 *  ajax撤单
	 */
	public final function deleteCode()
    {
		Db::startTrans();
		$id = request()->param('id') ;

		//$sql="select * from {$this->prename}bets where id=".$id;
		if(!$data = model('bets')->where(array('id'=>request()->param('id')))->find()) $this->error('找不到订单。') ;
		if($data['isDelete']) $this->error('这单子已经撤单过了。');
		if($data['uid']!=$this->user['uid']) $this->error('这单子不是您的，您不能撤单。');		// 可考虑管理员能给用户撤单情况
		if($data['kjTime']<=$this->time) $this->error('已经开奖，不能撤单');
		if(!empty($data['lotteryNo'])) $this->error('已经开奖，不能撤单');
		if($data['qz_uid']) $this->error('单子已经被人抢庄，不能撤单');

		// 冻结时间后不能撤单
		$this->getTypes();
		$ftime = $this->getTypeFtime($data['type']);
//		if($data['kjTime']-$ftime<$this->time) $this->error('这期已经结冻，不能撤单');

		$amount = $data['beiShu'] * $data['mode'] * $data['actionNum'] * intval(($data['fpEnable']?'2':'1')) ;
		$amount = abs($amount) ;
		// 添加用户资金变更日志
		$isSuc1 = $this->addCoin(array(
			'uid'=>$data['uid'],
			'type'=>$data['type'],
			'playedId'=>$data['playedId'],
			'liqType'=>7,
			'info'=>"撤单",
			'extfield0'=>$id,
			'coin'=>$amount,
		));

		// 更改定单为已经删除状态
		$map['isDelete'] = 1;
//		$isSuc2 = db('bets')->where('id='.$id)->find()->save($map);
		$isSuc2 = model('bets')->where('id='.$id)->find();
		$isSuc2->save($map) ;

		if($isSuc1!==false && $isSuc2==true)
		{
			//将投注记录写入文件
			if (!is_dir('./record')) @mkdir('./record');
			$fp = fopen("record/".$data['username'].".txt", "a+");
			$tz_content=$data['wjorderId']." 撤单 ".date('m-d H:i:s',time())."\r\n\r\n";
			$flag=fwrite($fp,$tz_content);
			if(!$flag)
			{
				$this->error('创建投注记录文件失败');
			} 
			fclose($fp); 
			
			Db::commit();//成功则提交
			$this->success('撤单成功');
		} else {
			Db::rollback();//不成功，则回滚
			$this->error('撤单失败');
		}

	}
	
	/**
	 * ajax取定单列表
	 */
	public final function getOrdered($type=null)
    {
		if(!$this->type) $this->type=$type;
		
		//$sql="select * from {$this->prename}bets where uid={$_SESSION['user']['uid']} order by id desc limit 7";
		$order_list = model('bets')->where(array('uid'=>$this->user['uid']))->limit(7)->order('id desc')->select();
		$this->assign('order_list',$order_list);
		$this->assign('time',$this->time);
		
		$types = $this->getTypes();
		$this->assign('types',$types);
		
		$playeds = $this->getPlayeds();
		$this->assign('playeds',$playeds);
		
		return $this->fetch('game/inc_game_order_history');
	}
	
	public final function getQiHao($type)
    {
		$thisNo=$this->getGameNo($type) ;
		$data = array(
			'lastNo'    => $this->getGameLastNo($type),
			'thisNo'    => $this->getGameNo($type),
			'diffTime'  => strtotime($thisNo['actionTime'])-$this->time,
			'validTime' => $thisNo['actionTime'],
			'kjdTime'   => $this->getTypeFtime($type)
		) ;
		echo json_encode($data) ;exit();
//		$this->ajaxReturn($data,'JSON');
	}

	public final function getLastKjData($type)
    {
		$ykMoney = 0 ;
		$czName = '重庆时时彩' ;
		$this->type=$type ;
		if(!$lastNo=$this->getGameLastNo($this->type)) $this->error('查找最后开奖期号出错') ;
		$data = model('data')->where(array('type'=>$this->type, 'number'=>$lastNo['actionNo']))->field('data')->find() ;
		if (!$lastNo['data'] = $data['data'])
			//$this->error('获取数据出错');
			return null;
		
		$thisNo = $this->getGameNo($this->type) ;
		$lastNo['actionName'] = $czName ;
		$lastNo['thisNo']     = $thisNo['actionNo'] ;
		$lastNo['diffTime']   = strtotime($thisNo['actionTime'])-$this->time ;
		$lastNo['kjdTime']    = $this->getTypeFtime($type) ;
		echo  json_encode($lastNo); exit();
//		$this->ajaxReturn($lastNo,'JSON');
	}

    /**
     * 历史开奖
     */
	public final function history()
    {
		$this->type = request()->param('type') ;
		$history    = model('data')->where(array('type'=>$this->type))->order('number desc,time desc')->limit(10)->field('id,number,data')->select() ;
		$this->assign('_list',$history) ;
		$this->meta_title = "历史开奖" ;
		return $this->fetch() ;
	}

	public final function gethistory()
    {
		$this->type = request()->param('type','','intval') ;
		$history    = model('data')->where(array('type'=>$this->type, 'id'=>array('lt',request()->param('last_id'))))->order('number desc,time desc')->limit(10)->field('id,number,data')->select() ;
		$this->assign('_list',$history);
		$this->meta_title = "历史开奖";
		return $this->fetch('game/gethistory');
	}

    /**
     * 随机函数
     * @param $length
     * @return string
     */
	public function randomkeys($length)
	{
		$key = "";
		$pattern='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$pattern1='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$pattern2='0123456789';
		for($i=0;$i<$length;$i++)
		{
			$key .= $pattern{mt_rand(0,35)};
		}
		return $key;
	}

}
