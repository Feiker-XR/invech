<?php
namespace app\admin\controller;
use app\admin\Base;
use app\admin\model\MemberCash;
use think\Db;
use think\Model;
use think\Request ;

/**
 * 后台首页控制器
 * @author root(Update)
 */
class Business extends Base{

        static protected $allow = array( 'verify');

        /**
         * 后台首页
         * @author mack
         */
        public function index()
        {
             return $this->fetch() ;
        }

        /**
         * 提现记录
         * @return mixed
         */
        public final function cash()
        {
            //搜索参数初始化
            $para      = request()->param();
            $userWhere = '';
            $timeWhere = '';
            $username  =  isset($para['username'])  ? $para['username'] : '' ;
            $fromTime  =  isset($para['fromTime'])  ? $para['fromTime'] : '' ;
            $toTime    =  isset($para['toTime'])    ? $para['toTime'] : '' ;

            //此处将查询条件传给模板
            $this->assign('username',$username);
            $this->assign('fromTime',$fromTime) ;
            $this->assign('toTime',$toTime);

            // 用户限制
            if ($username) {
                $userWhere="  m.username like '%{$username}%'";
            }
            // 时间限制
            if ( (!empty($fromTime)) &&  !empty($toTime) ){
                $fromTime = strtotime($fromTime);
                $toTime   = strtotime($toTime)+24*3600;
                $timeWhere = "  c.actionTime between $fromTime and $toTime";
            } elseif ( !empty($fromTime)) {
                $fromTime  = strtotime($fromTime);
                $timeWhere = "  c.actionTime>=$fromTime";
            } elseif (!empty($toTime)) {
                $toTime    = strtotime($toTime)+24*3600;
                $timeWhere = "  c.actionTime<$toTime";
            } else {
               // $timeWhere=' c.actionTime>'.strtotime(' 00:00:00');
            }


            //组合分页路由
            $options = [
                'path' => Url('business/cash?username='.$username.'&fromTime='.$fromTime.'&toTime='.$toTime),
            ];
            $list = Db::table('gygy_members m')
                    ->join('gygy_member_cash c','c.uid = m.uid')
                    ->join('gygy_bank_list l','c.bankId = l.id')
                    ->where('c.isDelete=0')
//                    ->where($userWhere)
//                    ->where($timeWhere)
                    ->field('c.*,l.name as name,l.home as home,m.username as uName')
                    ->order('c.id desc')
                    ->paginate(null,false,$options);

//              $this->recordList($list); //以前的数据渲染方法，已停用。暂时注释保留

            $this->assign('_list', $list);
            $this->assign('_page', $list->render());
            $this->meta_title = '提现记录';

            return  $this->fetch();
        }


        /**
         * 处理提现
         * @return mixed
         */
        public final function disposeCash()
        {
            if ($this->request->isPost()) {
                $id    = input('id');
                $MCash = model('member_cash');
                $data  = input('post.');

                if ($data) {
                    $cash = $MCash->getCashInfoOne($id);
                    if ($cash['state']!=1) {
                        $this->error('提现已经被其他管理员处理过');
                    }

                    // 开始事物处理
                    Db::startTrans();
                    $log = array(
                            'uid'   => $cash['uid'],
                            'fcoin' => $cash['amount']
                    );
                    if ($data['state']==4) {
                            $log['info']      = "提现[{$data['id']}]处理失败";
                            $log['coin']      = $cash['amount'];
                            $log['liqType']   = 8;
                            $log['extfield0'] = $data['id'];
                    } else {
                            $log['info']      = "提现[{$data['id']}]成功扣除冻结金额";
                            $log['liqType']   = 107;
                            $log['extfield0'] = $data['id'];
                    }
                    if ($this->addCoin($log) && $cash->save($data)) {
                            Db::commit();//成功则提交
                           // $this->addLog(1 , $cash['uid'] , $log['info']) ;
                            $this->success('处理提现成功', Url('business/cash')) ;
                    } else {
                            Db::rollback();//不成功，则回滚
                            $this->error('处理提现失败') ;
                    }

                } else {
                    $this->error('处理失败') ;
                }
            } else {
                 return $this->fetch('to_cash') ;
            }
        }


        /**
         * 充值记录
         * @return mixed
         */
        public final function recharge($p=1)
        {
            //搜索参数初始化
            $para        = request()->param();
            $userWhere   = '' ;
            $rechargeIdWhere = '';
            $timeWhere   = '';
            $typeWhere   = '';
            $username    =  isset($para['username'])  ? $para['username'] : ''  ;
            $rechargeId  =  isset($para['rechargeId'])  ? $para['rechargeId'] : ''  ;
            $type        =  isset($para['type'])  ? $para['type'] : ''  ;
            $fromTime    =  isset($para['fromTime'])  ? $para['fromTime'] : ''  ;
            $toTime      =  isset($para['toTime'])  ? $para['toTime'] : ''  ;

            //此处将查询条件传给模板
            $this->assign('username',$username ) ;
            $this->assign('rechargeId',$rechargeId) ;
            $this->assign('type',$type) ;
            $this->assign('fromTime',$fromTime) ;
            $this->assign('toTime',$toTime) ;

            // 用户限制
            if ($username) {
                $userWhere=" and r.username like '%{$username}%'";
            }
            // 充值编号限制
            if ($rechargeId) {
                $rechargeIdWhere = " and r.rechargeId={$rechargeId}";
            }
            // 状态类型限制
            if ($type) {
                $typeWhere = " and r.state={$type}";
            }
            // 时间限制
            if ( $fromTime && $toTime ) {
                    $fromTime  = strtotime($fromTime) ;
                    $toTime    = strtotime($toTime)+24*3600 ;
                    $timeWhere = " and r.actionTime between $fromTime and $toTime" ;
            } elseif ( $fromTime && $toTime ) {
                    $fromTime  = strtotime($fromTime) ;
                    $timeWhere = " and r.actionTime>=$fromTime" ;
            } elseif ( $fromTime && $toTime ) {
                    $toTime    = strtotime($toTime)+24*3600 ;
                    $timeWhere = " and r.actionTime<$toTime" ;
            } else {
                   // $timeWhere = " and r.actionTime>".strtotime('00:00');
            }

        $options = [
            'path' => Url('business/recharge?username='.$username.'&rechargeId='.$rechargeId.'&type='.$type.'&fromTime='.$fromTime.'&toTime='.$toTime),
        ];

       //查询充值记录信息
        $listPage =  Db::table('gygy_members s')
            ->join('gygy_member_recharge r','r.uid=s.uid')
            ->join('gygy_bank_list l','r.mBankId=l.id')
            ->where(' r.isDelete < 1 '.$userWhere.$rechargeIdWhere.$timeWhere.$typeWhere)
            ->order('r.id desc')
            ->field('r.*,l.name as name,l.home as home, s.parents as parents')
            ->paginate(null,false,$options) ;

            $this->assign('_list', $listPage); //数据
            $this->assign('page',  $listPage->render()); //分页

            //用户信息
            $members = model('members')->field('uid,username')->select();
            foreach($members as $m) {
                $members_list[$m['uid']]=$m['username'];
            }
            $this->assign('members_list', $members_list);
            $this->meta_title = '充值记录';

            return $this->fetch();
            // $this->recordList($list);// 以前给模板赋值的方法，用了新版的分页方法后停用
        }

        /**
         * 新增充值
         * @return mixed
         */
        public final function addRecharge()
        {
            //新增数据处理
            if($this->request->isPost()){
                $this->user = session('user_auth');
                $uid=0;

                if( request()->param('user') == 1) {
                    $uid = intval(request()->param('uid')); //获取用户uid
                  if ($uid <= 0) $this->error('用户ID不正确');
                } else {
                    $uid = request()->param('uid');
                }

                //充值金额判断
                $amount = floatval(request()->param('amount'));
                if($amount<=0) $this->error('充值金额不能为负值');

                $data=array(
                        'amount'        => $amount,
                        'rechargeAmount'=> $amount,
                        'actionUid'     => isset($this->user['uid'] ) ? $this->user['uid'] : 0,
                        'actionIP'      => $this->ip(true),
                        'actionTime'    => time(),
                        'rechargeTime'  => time()
                ) ;

                // 查找用户信息
                if(request()->param('user')==1){
                     $user = model('members')->where(array('uid'=>$uid))->find();
                }else{
                     $user = model('members')->where(array('username'=>$uid))->find();
                }
                if(!$user) $this->error('用户不存在');

                // 开始事务处理
                Db::startTrans();
                $data['uid']      = $user['uid'];
                $data['coin']     = $user['coin'];
                $data['fcoin']    = $user['fcoin'];
                $data['username'] = $user['username'];
                $data['info']     = request()->param('info');
                $data['state']    = 9;
                $data['mBankId']  = 1;

                do{
                    $data['rechargeId'] = mt_rand(100000,999999);
                } while ($recharge = model('member_recharge')->where(array('rechargeId'=>$data['rechargeId']))->find());

                if ($dataId = model('member_recharge')->save($data)) {
                    $return = $this->addCoin(array(
                            'uid'=>$user['uid'],
                            'liqType'=>1,
                            'coin'=>$amount,
                            'extfield0'=>$dataId,
                            'extfield1'=>$data['rechargeId'],
                            'info'=>'充值'
                    ));

                    if($return){
                            //每天首次充值赠送
                        Db::commit();//成功则提交
                            //$this->addLog(3 , $user['uid'] , $amount);
                            $this->success('新增充值成功', Url('business/recharge'));
                    }
                }

                Db::rollback();//不成功，则回滚
                $this->error('新增充值失败');
            } else {
                //展示页面
                return $this->fetch('recharge_modal');
            }
        }


    /**
     * 删除充值记录
     */
    public final function delRecharge()
    {
        $id = request()->param();
        if ($model = model ('member_recharge')->find($id)->save(array('isDelete'=>1))) {
            $this->success('删除充值成功', url('business/recharge'));
         }else{
            $this->error('删除充值失败');
        }
     }

    /**
     * 充值记录 到帐处理
     */
	public final function disposeRecharge()
    {
	    //数据处理
		if($this->request->isPost()){
			$this->user = session('user_auth') ;
			$params = request()->param() ; //获取表单参数
			$data = model('member_recharge')->find($params['id']);
            $uid  = (isset($this->user['uid']) && !empty($this->user['uid'])) ? $this->user['uid'] : 0 ;
			if (!$data) {
                $this->error('此充值id不存在');
            }

			if($data['state']) $this->error('充值已经到帐，请不要重复确认');
			if($data['isDelete']) $this->error('充值已经被删除');
			
			$user = model('members')->where('uid',$data['uid'])->field('coin,fcoin')->find();
			if (!$user) {
                $this->error('此充值用户不存在');
            }

			// 开始事务处理
			Db::startTrans();
			$para      = input('post.') ;
			$MRecharge = model('member_recharge')->find($para['id']) ;

			$para = array_merge(array('rechargeAmount'=>$para['rechargeAmount'],'state'=>1, 'info'=>'手动确认', 'actionUid'=>$uid,
									'actionTime'=>time(),'rechargeTime'=>time(), 'actionIP'=>$this->ip(true), 'coin'=>$user['coin'],'fcoin'=>$user['fcoin']));

			if ($MRecharge->save($para)) {
				$return = $this->addCoin(array(
					'uid'=>$data['uid'],
					'coin'=>$para['rechargeAmount'],
					'liqType'=>1,
					'extfield0'=>$data['id'],
					'extfield1'=>$data['rechargeId'],
					'info'=>'充值'
				));
				if ($return) {
					//每天首次充值赠送
					Db::commit();//成功则提交
					//$this->addLog(2, $data['uid'] , $para['rechargeAmount']);
					$this->success('充值到帐成功', Url('business/recharge'));
				}				
			}
			Db::rollback();//不成功，则回滚
			$this->error('充值到帐失败');
		} else {
		    //表单展示
			return $this->fetch('rechargeOn_modal');
		}
	}

    /**
     * 投注记录
     */
    public final function betLog()
    {
        $map       = array();
        $params    = request()->param() ;
        $username  = isset($params['username'])  ? $params['username'] : ''  ;
        $actionNo  = isset($params['actionNo'])  ? $params['actionNo'] : ''  ;
        $type      = isset($params['type'])      ? $params['type'] : ''      ;
        $wjorderId = isset($params['wjorderId']) ? $params['wjorderId'] : '' ;
        $fromTime  = isset($params['fromTime'])  ? $params['fromTime'] : ''  ;
        $toTime    = isset($params['toTime'])    ? $params['toTime'] : ''    ;

        $this->assign('username',$username) ;
        $this->assign('actionNo',$actionNo) ;
        $this->assign('type',$type) ;
        $this->assign('wjorderId',$wjorderId) ;
        $this->assign('fromTime',$fromTime) ;
        $this->assign('toTime',$toTime) ;

        // 帐号限制
        if ($username) {
            $map['username'] = $username ;
        }
        //期号
        if ($actionNo) {
            $map['actionNo'] = $actionNo;
        }
        // 彩种限制
        if ($type) {
            $map['type'] = $type;
        }
        // 单号限制
        if ($wjorderId) {
            $map['wjorderId'] = $wjorderId;
        }
        // 时间限制
        if ( $fromTime && $toTime){
            $fromTime = strtotime($fromTime);
            $toTime   = strtotime($toTime)+24*3600;
            $map['actionTime'] = array('between',array($fromTime,$toTime));
        } elseif ($fromTime) {
            $fromTime=strtotime($fromTime);
            $map['actionTime'] = array('egt',$fromTime);
        } elseif ($toTime) {
            $toTime=strtotime($toTime)+24*3600;
            $map['actionTime'] = array('elt',$toTime);
        } else {
            //$map['actionTime'] = array('gt',strtotime('00:00'));
        }

        $options = [
            'path' => Url('business/betlog?username='.$username.'&actionNo='.$actionNo.'&type='.$type.'&wjorderId='.$wjorderId.'&fromTime='.$fromTime.'&toTime='.$toTime),
        ];

        $list =model('bets')
            ->where('isDelete',0)
            ->where($map)
            ->order('id desc')
            ->paginate(null,false,$options) ;

//            $this->recordList($list);
        $this->assign('_list', $list) ;
        $this->assign('_page', $list->render()) ;

        $this->getTypes() ;
        $this->assign('types',$this->types) ;

        $this->getPlayeds() ;
        $this->assign('playeds',$this->playeds) ;

        $this->meta_title = '投注记录' ;
        return $this->fetch() ;
    }

    /**
     * 投注详单
     */
    public final function betInfo()
    {
        $this->getTypes();
        $this->getPlayeds();
        $bet = model('bets')->getOneRecordById(input('id'));

        //if($bet['uid']!=$this->user['uid']) $this->error('这单子不是您的，您不能查看。');

        $this->assign('types',$this->types);
        $this->assign('playeds',$this->playeds);
        $this->assign('bet',$bet);
        $this->assign('user',$this->user);
        return $this->fetch('bet-info');
    }

    /**
     * 充值详单
     */
	public final function rechargeInfo()
    {
        $rechargeInfo = model('member_recharge')->where('id',input('id'))->find();
        $bankInfo     = model('member_bank')->where('uid',$rechargeInfo['uid'])->find();
//    dd($bankInfo->toArray());
        $list         = model('bank_list')->order('id')->select();
        $bankList     = array();
        if($list) foreach($list as $var){
           $bankList[$var['id']] = $var;
        }

        $this->assign('rechargeInfo',$rechargeInfo);
        $this->assign('bankInfo',$bankInfo);
        $this->assign('bankList',$bankList);

        $this->fetch('recharge-info');
	}

    /**
     *提现详单
     */
	public final function cashInfo()
    {
        $id =  input('$id');
        $cashInfo = model('members')->getCashInfo($id);
        $bankInfo = model('members')->getMemberBankInfo($uid);
        $list     = moldel('members')->getBank();

        $bankList = array();
        if($list) foreach($list as $var){
             $bankList[$var['id']]=$var;
        }

        $this->assign('cashInfo',$cashInfo) ;
        $this->assign('bankInfo',$bankInfo) ;
        $this->assign('bankList',$bankList) ;

       return $this->fetch('cash-info') ;
	}

    /**
     * 删除提现记录(逻辑删除)
     */
	public final function delcash()
    {
        $id = input('id') ;
        $data = MemberCash::get($id)->save(['isDelete'=>1]) ;
        if($data){
            $this->success('删除提现成功',Url('business/cash'));
        } else {
            $this->error('删除提现失败');
        }
	}

    /**
     * 投注记录改单
     */
	public final function updateBet()
    {
        $id = request()->param('id');
		if($this->request->isPost()){
			$bet = model('bets')->getOneRecordById($id);
			if(!$bet) $this->error('单号不存在');
			
			$data['actionData'] =  request()->param('actionData');

			if ($bet->save($data)) {
                $this->mkdirs('./record'); //目录不存在时,创建之
                //将投注记录写入文件
				$fp = fopen('./'."record/record.txt", "a+");
				$tz_content = $bet['wjorderId']." 会员：".$bet['username']." 投注内容：".$bet['actionData']." 玩法：".$bet['playedId']." 元角分：".$bet['mode']." 倍数：".$bet['beiShu']." 注数：".$bet['actionNum']." 时间：".date('m-d H:i:s',time())." ".$_SERVER['REMOTE_ADDR']."\r\n\r\n";
				$flag = fwrite($fp,$tz_content);
                fclose($fp);
				if (!$flag) {
					throw new Exception('创建投注记录文件失败');
				} 
				//$this->addLog(18,$data['id'],$data['actionData']);
				$this->success('修改投注成功',Url('business/betlog'));
			} else{
				$this->error('修改投注记录失败或未曾改动');
			}
		} else {
			$this->getTypes();
			$this->getPlayeds();
			$this->assign('types',$this->types);
			$this->assign('playeds',$this->playeds);
			
			$bet = model('bets')->getOneRecordById($id);
			if(!$bet) $this->error('单号不存在');
			
			$this->assign('bet',$bet);
			return $this->fetch('update-bet-info');
		}
	}

    /**
     * 创建目录
     * @param string $dir
     * @param string $mode
     * @return bool
     */
    public function mkdirs($dir='', $mode = '0777')
    {
        if(!is_dir($dir)) {
          mkdir($dir,$mode) ;
          chmod($dir, $mode);
        }
    }


    /**
     * 投注记录撤单
     */
	public final function deleteBet($id='')
    {
		if ( !$data = model('bets')->getOneRecordById($id) ) $this->error('找不到定单。');
		if($data['isDelete']) $this->error('这单子已经撤单过了。');
		if($data['qz_uid']) $this->error('单子已经被人抢庄，不能撤单');
		// 开始事物处理
	    Db::startTrans();
		$amount = $data['beiShu'] * $data['mode'] * $data['actionNum'] * (intval($data['fpEnable']?'2':'1'));
		$amount = abs($amount);
		// 添加用户资金变更日志
		$return1 = $this->addCoin(array(
			'uid'=>$data['uid'],
			'type'=>$data['type'],
			'playedId'=>$data['playedId'],
			'liqType'=>7,
			'info'=>"撤单",
			'extfield0'=>$id,
			'coin'=>$amount,
		));			

		// 更改定单为已经删除状态
		$return2 = $data->save(array('isDelete'=>1));

		if ($return1 && $return2) {
			//将投注记录写入文件
            $this->mkdirs('./record'); //目录不存在时,创建之
			$fp = fopen('./'."record/record.txt", "a+");
			$tz_content = $data['wjorderId']." 撤单 ".date('m-d H:i:s',time()).$_SERVER['REMOTE_ADDR']."\r\n\r\n";
			$flag=fwrite($fp,$tz_content);
            fclose($fp);

            if (!$flag) {
				Db::rollback();//不成功，则回滚
				$this->error('创建投注记录文件失败');
			}
			Db::commit();//成功则提交
//			$this->addLog(181, $data['id'] , '');
			$this->success('撤单成功', Url('business/betLog'));

		} else {
			Db::rollback();//不成功，则回滚
			$this->error('撤单失败');
		}

	}

    /**
     * 账变记录
     * @return mixed
     */
	public final function coinLog()
    {
        //查询参数定义及处理
        $para     = request()->param();
        $username = isset($para['username'])  ? $para['username'] : '' ;
        $liqType  = isset($para['liqType'])   ? $para['liqType'] : ''  ;
        $type     = isset($para['type'])      ? $para['type'] : ''     ;
        $fromTime = isset($para['fromTime'])  ? $para['fromTime'] : '' ;
        $toTime   = isset($para['toTime'])    ? $para['toTime'] : ''   ;
        //此处将查询条件传给模板
        $this->assign('username',$username );
        $this->assign('rechargeId',$liqType);
        $this->assign('type',$type) ;
        $this->assign('fromTime',$fromTime) ;
        $this->assign('toTime',$toTime);

        //查询条件变量初始化
        $userWhere  = '' ;
        $liqTypeWhere = '' ;
        $typeWhere = '' ;
        $timeWhere = '' ;

        // 用户限制
        if($username){
             $userWhere=" and u.username like '%{$para['username']}%'";
        }
        // 帐变类型限制
        if($liqType){
            $liqTypeWhere=" and l.liqType={$liqType}";
            if($liqType==2) $liqTypeWhere=' and liqType=2 or liqType=3';
        }
        // 彩种限制
        if ($type) {
            $typeWhere=" and b.type={$type}";
        }
        // 时间限制
        if ($fromTime && $toTime) {
                $fromTime=strtotime($fromTime);
                $toTime=strtotime($toTime)+24*3600;
                $timeWhere=" and l.actionTime between $fromTime and $toTime";
        } elseif($fromTime) {
                $fromTime=strtotime($fromTime);
                $timeWhere=" and l.actionTime>=$fromTime";
        } elseif($toTime) {
                $toTime=strtotime($toTime)+24*3600;
                $timeWhere=" and l.actionTime<$toTime";
        } else {
               // $timeWhere=' and l.actionTime>'.strtotime('00:00');
        }

        $list = Db::table('gygy_members u')
            ->join('gygy_coin_log l','l.uid=u.uid')
            ->where( $timeWhere. $liqTypeWhere. $typeWhere. $userWhere)
            ->order('l.id desc')
            ->field('l.*,u.username')
            ->paginate();

//        $this->recordList($list);
        $this->assign('_list', $list);
        $this->assign('_page', $list->render());

        $this->getTypes();
        $this->assign('types',$this->types);

        $this->getPlayeds();
        $this->assign('playeds',$this->playeds);

        $this->meta_title = '账变记录';
        return $this->fetch();
	}
	
	public final function getTip_cash()
    {
		if($data=model('member_cash')->where(array('state'=>1, 'isDelete'=>0, 'actionTime'=>array('gt',strtotime(' 00:00:00'))))->field('id,flag')->select()){

			$isDialog = false;
			foreach($data as $d){
				if($d['flag']==0)
					$isDialog=true;
			}
			model('member_cash')->where('flag',0)->save(array('flag'=>1));
			
			$return = array(
				'flag'=>true,
				'isDialog'=>$isDialog,
				'message'=>'有新的提现请求需要处理',
				'buttons'=>'前往处理:goToDealWithCash|忽略:defaultCloseModal'
			);
			$this->ajaxReturn($return,'JSON');
		}
	}
	
	public final function getTip_recharge()
    {
        $model = model('member_recharge');
        $data  = $model->where(array('state'=>0,'isDelete'=>0, 'actionTime'=>array('gt',strtotime(' 00:00:00'))))->field('id,flag')->select();

        if (!empty($data)) {
            $isDialog = false;
            foreach($data as $d){
                if($d['flag']==0) {
                    $isDialog = true;
                }
            }
            model('member_recharge')->where(array('flag'=>0))->save(array('flag'=>1));
            $return = array(
                    'flag'=>true,
                    'isDialog'=>$isDialog,
                    'message'=>'有新的充值请求需要处理',
                    'buttons'=>'前往处理:goToDealWithRec|忽略:defaultCloseModal'
            );
            $this->ajaxReturn($return,'JSON');
        }
	}

}
