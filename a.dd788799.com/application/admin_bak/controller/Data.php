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
 * 数据管理控制器
 * @author root
 */
class Data extends Base {

    static protected $allow = array( 'verify');

    /**
     * 首页
     * @author root
     */
    public function index()
    {
        $type = (!request()->param('type')) ? 1 : request()->param('type') ; //开奖数据默认重庆彩
		$this->assign('type',$type); //将彩票类型传到前台
		
		// 默认取今天的数据
		if ( request()->param('date') ) {
			$date=strtotime(request('date'));
		 } else {
			$date=strtotime('00:00');
		}
		$this->assign('date',$date);
		
		$types = model('type')->where('enable',1)->select();
		$this->assign('types',$types);
		
		$kjData = array();
		$i      = 0;

		if ( request()->param('number') ) {
			$data = model('data')->where(array('type'=>$type,'number'=>request()->param('number')))->find() ;
			$bet  = model('bets')->field('sumodel(mode * beiShu * actionNum) betAmount,sumodel(bonus) zjAmount, sumodel(fanDianAmount) fanDianAmount')->where(array('type'=>$type,'isDelete'=>0,'actionNo'=>$data['number']))->select() ;
			
			$kjData[$i]['actionNo']      = request()->param('number') ;
			$kjData[$i]['actionTime']    = $data['time']?date('Y-m-d H:i:s',$data['time']):'--' ;
			$kjData[$i]['betAmount']     = $bet[0]['betAmount'] ;
			$kjData[$i]['zjAmount']      = $bet[0]['zjAmount']  ;
			$kjData[$i]['fanDianAmount'] = $bet[0]['fanDianAmount'] ;
			
			if ($data['data']) {
                $kjData[$i]['data'] = $data['data'];
            } else {
                $kjData[$i]['data'] = '--';
            }

		} else {
			$Model = model('data_time');
            $list  = $Model->where('type',intval($type))->order('actionNo')->select();

			foreach($list as $var) {

			    if ($type == 1) {
					// 重庆彩特殊处理
					$number = 1000+$var['actionNo'];
					if ($var['actionNo']==120) {
						$number=date('Ymd-', strtotime(date('Y-m-d',$date - 1*24*60*60))).substr($number,1);
					} else {
						$number=date('Ymd-', $date).substr($number,1);
					}
//					$data = model('data')->where(array('type'=>$type,'number'=>$number))->find();
					$data = model('data')->where(array('type'=>$type,'number'=>$number))->find() ;

				} elseif ($type == 34) {
					// 新疆彩特殊处理
					$number = 1000+$var['actionNo'] ;
					if ($var['actionNo'] > 719) {
						$number = date('Ymd-', strtotime(date('Y-m-d',$date - 1*24*60*60))).substr($number,1) ;
					}else{
						$number = date('Ymd-', $date).substr($number,1) ;
					}
					$data = model('data')->where(array('type'=>$type,'number'=>$number))->find();

				} elseif ($type == 12) {
					// 新疆彩特殊处理
					$number = 100+$var['actionNo'];
					if($var['actionNo']>83){
						$number = date('Ymd-', strtotime(date('Y-m-d',$date - 1*24*60*60))).substr($number,1);
					}else{
						$number = date('Ymd-', $date).substr($number,1);
					}
					$data = model('data')->where(array('type'=>$type,'number'=>$number))->find();

				} elseif ( $type==9 || $type==10 ) {
					// 福彩3D
					$number = date('Yz', $date)-7;
					$number = substr($number,0,4).substr(substr($number,4)+1000,1);

					$data = model('data')->where(array('type'=>$type,'number'=>$number))->find();

				} elseif( $type==20 ) {
					// PK10
					$number = 179*(strtotime(date('Y-m-d', $date))-strtotime('2007-11-11'))/3600/24+$var['actionNo']-14;
					$data   = model('data')->where(array('type'=>$type,'number'=>$number))->find();

				} elseif( $type==24 ) {
					// 快8
					$number = 179*(strtotime(date('Y-m-d', $date))-strtotime('2004-09-19'))/3600/24+$var['actionNo']-77;;
					$data   = model('data')->where(array('type'=>$type,'number'=>$number))->find();

				} elseif( $type==11 ) {
					// 时时乐
					$number = 100+$var['actionNo'] ;
					$number = date('Ymd-', $date).substr($number,1) ;
					$data   = model('data')->where(array('type'=>$type,'number'=>$number))->find() ;

				} else {
					//$data=$this->getRow($sql . 'time='. strtotime($dateString . $var['actionTime']));
					$number = 1000+$var['actionNo'] ;
					$number = date('Ymd-', $date).substr($number,1) ;
					$data   = model('data')->where(array('type'=>$type,'number'=>$number))->find() ;
				}

//				$bet = model('bets')->field('sumodel(mode * beiShu * actionNum) betAmount,sumodel(bonus) zjAmount, sumodel(fanDianAmount) fanDianAmount')->where(array('type'=>$type,'isDelete'=>0,'actionNo'=>$data['number']))->select();
                $bet  = model('bets')
                      ->where(array('type'=>$type,'isDelete'=>0))
                      ->paginate() ;

				$kjData[$i]                  = $var ;
				$kjData[$i]['actionNo']      = $number ;
				$kjData[$i]['actionTime']    = date('Y-m-d ',$date).$kjData[$i]['actionTime']  ;
				$kjData[$i]['betAmount']     = isset($bet[0]['betAmount'])     ? $bet[0]['betAmount'] : ''  ;
				$kjData[$i]['zjAmount']      = isset($bet[0]['zjAmount'])      ? $bet[0]['zjAmount']  : ''   ;
				$kjData[$i]['fanDianAmount'] = isset($bet[0]['fanDianAmount']) ? $bet[0]['fanDianAmount'] : '' ;

				if ($data['data']) {
                    $kjData[$i]['data'] = $data['data'];
                } else {
                    $kjData[$i]['data'] = '--';
                }
				$i++;
			}
		}

		$this->recordList($kjData);
//        $this->assign('_list',$kjData) ;
//        $this->assign('_page',$bet->render()) ;
        $this->meta_title = '开奖数据' ;
        return $this->fetch() ;
    }

    /**
     * 添加开奖号码
     */
	public final function add()
    {
		if($this->request->isPost()){
			$para = $_POST;
			if($data = model('data')->where(array('type'=>$para['type'],'number'=>$para['number']))->find()) $this->error('开奖号已经存在，不需要手动添加');
            //写入日志
			$this->addLog(17, $para['type'], '[期号:'.$para['number'].']'.'[开奖号码：'.$para['data'].']');

			$add_ret = model('data')->save(array(
				'type' => $para['type'],
				'time' => $para['time'],
				'number' => $para['number'],
				'data' => $para['data'],
			));
			if (!$add_ret) $this->error('添加开奖数据失败');
			$this->handLottery(false, array(
				'type' => $para['type'],
				'actionNo' => $para['number'],
				'data' => $para['data'],
			));
			$this->success('添加开奖结果成功', Url('Data/index?type='.request()->param('type')));
		} else {
		    //根据开奖期号，获取到开奖数据
		    $actionNo = request()->param('actionNo') ;
		    $model    = new \app\admin\model\Data() ;
		    $data     = $model->getOneByActionNo($actionNo) ;
            $this->assign('data',$data) ;
			return $this->fetch() ;
		}
	}



    /**
     * 手动派奖
     * @param bool $is_page
     * @param array $para
     */
	public final function handLottery ($is_page = true, $para = array())
    {
        //为空时补充数据
		if (empty($para)) {
			$para = array(
				'type'      => request()->param('type'),
				'actionNo'  => request()->param('number') ,
				'data'      => request()->param('data'),
			);
		}

		$rows = model('bets')->where(array('type'=>$para['type'],'actionNo'=>$para['actionNo'],'isDelete'=>0,'lotteryNo'=>''))->select();

		if ($rows) {
			$funcs = array() ;
			$playes = model('played')->select() ;
		    foreach ($playes as $play) {
                $funcs[$play['id']] = $play['ruleFun'] ;
            }

		    require_once(dirname(__FILE__).'/parse-calc-count.php'); //加载算法文件

			foreach ($rows as $row) {
				$func       = $funcs[$row['playedId']];
				$id         = $row['id'];
				$actionData = $row['actionData']; //投注号码
				$data       = $para['data'];   //开奖号码
				$weiShu     = $row['weiShu'];  //位数
                $zjcount    = $func($actionData,$data) ; //得到开奖结果
			   db('bets')->execute("call kanJiang($id, $zjcount, '$data', 'ssc-cc40bfe6d972ce96fe3a47d0f7342cb0')");
			}
		}
		if ($is_page) {
        	$this->addLog(171, $para['type'], '[期号:'.$para['actionNo'].']'.'[开奖号码：'.$para['data'].']');
			$this->success('派奖成功',Url('Data/index?type='.request()->param('type')));
		}
	}

//    /**
//     * 手动派奖
//     * @param bool $is_page
//     * @param array $para
//     */
//    public final function handLottery ($is_page = true, $para = array())
//    {
//        if (!$para) {
//            $para = array(
//                'type'      => request()->param('type'),
//                'actionNo'  => request()->param('number') ,
//                'data'      => request()->param('number'),
//            );
//        }
//
//        $rows = model('bets')->where(array('type'=>$para['type'],'actionNo'=>$para['actionNo'],'isDelete'=>0,'lotteryNo'=>''))->select();
//
//        if ($rows) {
//            $funcs = array() ;
//            $playes = model('played')->select() ;
//
//            foreach ($playes as $play) $funcs[$play['id']] = $play['ruleFun'] ;
//            $v8 = new \V8Js();
//            $calc_code = file_get_contents(dirname(__FILE__).'/parse-calc-count.js');
//            foreach ($rows as $row) {
//                $func       = 'exports.'.$funcs[$row['playedId']];
//                $id         = $row['id'];
//                $actionData = $row['actionData'];
//                $data       = $para['data'];
//                $weiShu     = $row['weiShu'];
//                $JS = <<< EOT
//{$calc_code}
//print({$func}('{$actionData}','{$data}','{$weiShu}')||0);
//EOT;
//                ob_start();
//                $v8->executeString($JS);
//                $zjcount = ob_get_contents();
//                ob_end_clean();
//                model()->execute("call kanJiang($id, $zjcount, '$data', 'ssc-cc40bfe6d972ce96fe3a47d0f7342cb0')");
//            }
//        }
//
//        if ($is_page) {
////			$this->addLog(171, $para['type'], '[期号:'.$para['number'].']'.'[开奖号码：'.$para['data'].']');
//            $this->success('派奖成功',Url('Data/index?type='.request()->param('type')));
//        }
//    }

}
