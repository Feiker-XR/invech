<?php
namespace app\index;
use think\Controller;
use think\Cache;
use app\model\config;

class Base extends Controller{
    protected function _initialize(){
        $uid = session('uid');
        if($uid){
            //$user = db('k_user')->where('uid',$uid)->find();
            $user = db('k_user')->cache()->find($uid);
            $session_id = session_id();
            if($session_id != $user['session_id']){
                session(null);
                //$this->redirect('index/home');
            }
        }


        $cache = new Cache();
        //$cache::rm('sysConfig');
       

        $ipxz = $cache->get('ipxz') ?: [];
        $dqxz = $cache->get('dqxz') ?: [];
        $ip = $this->request->ip();
        //$json = json_decode(file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$ip),true);
        $iplookup = config('iplookup');      
		$json = json_decode(file_get_contents("{$iplookup}?format=json&ip=".$ip),true);        
        $region = $json['province'] ?? '';
        if(in_array($ip,$ipxz)){
            exit('您的IP'.$ip.'不在我们的服务范围内') ;
        }
        foreach ($dqxz as $v){
            if($region){
                if(strstr($region, $v) || strstr($v,$region)){
                    exit('您所在的地区:"'.$region.'"不在我们的服务范围内!');
                }
            }
        }        	
        
        $cache::rm('sysConfig');
        $sysConfig = $cache->get('sysConfig');
        if(!$sysConfig){
            $config = new config();
            $sysConfig = $config->get(1)->getData();
            $cache->set('sysConfig',$sysConfig);
        }
        if($sysConfig['close']){
            exit($sysConfig['why']);
        }
        $notice = new \app\model\notice();
        $notices = $notice->all(function ($query){
            $query -> where('is_show',1)->limit(10)->order('nid','desc');
        });
        $domain = $this->request->domain();
        //if(strstr($domain,'http://hg.dd788799.com' )){
		$view_path = APP_PATH.$this->request->module().DS.'newview'.DS;
            $this->view->config('view_path',$view_path);
        //}
        /*
        $forcepc = input('gopc');
        if($forcepc == ''){
            $forcepc = cookie('forcepc');
        }else{
            cookie('forcepc',$forcepc);
        }
        if($this->request->isMobile()){
            $domain = request()->host();
            $parts = explode('.',$domain);
            if($parts[0] == 'm' && cookie('forcepc')){
                $parts[0] = 'www';
                $gourl = implode('.', $parts);
                header('location:http://'.$gourl.'/index/index/gopc/1');
            }
            if(!cookie('forcepc')){
                $view_path = APP_PATH.$this->request->module().DS.'mview'.DS;
                $this->view->config('view_path',$view_path);
            }
        }
        */
            $domain = request()->host();
            $parts = explode('.',$domain);
            if($parts[0] == 'm' || $domain == '99206app.com' ||$domain == 'www.99206app.com' || $domain== 'sj66657.com' || $domain == 'sj99206.com'){
                $view_path = APP_PATH.$this->request->module().DS.'mview'.DS;
                $this->view->config('view_path',$view_path);
            }

        $this->assign('sysConfig',$sysConfig);
        $this->assign('notice',$notices);
    } 
    
    
    /**
	 * 读取将要开奖期号
	 *
	 * @params $type		彩种ID
	 * @params $time		时间，如果没有，当默认当前时间
	 * @params $flag		如果为true，则返回最近过去的一期（一般是最近开奖的一期），如果为flase，则是将要开奖的一期
	 */
	public function getGameNo($type, $time=null){
		$type=intval($type);
		if($time===null) $time=$this->time;
		if($type==34){ //六合彩
			$atime=date('Y-m-d H:i:s', $time);
			$atimedb=$this->prename.'lhc_time';
		}else{
			$atime=date('H:i:s', $time);
			$atimedb=$this->prename.'data_time';
		}
		
		$sql="select actionNo, actionTime from {$atimedb} where type=$type and actionTime>? order by actionTime limit 1";
		$return = $this->getRow($sql, $atime);
		
		if(!$return){
			$sql="select actionNo, actionTime from {$atimedb} where type=$type order by actionTime limit 1";
			$return =$this->getRow($sql, $atime);
			$time=$time+24*3600;
		}
		$types=$this->getTypes();
		if(($fun=$types[$type]['onGetNoed']) && method_exists($this, $fun)){
			$this->$fun($return['actionNo'], $return['actionTime'], $time);
		}
		
		return $return;
	}
	
	public function getGameLastNo($type, $time=null){
		$type=intval($type);
		if($time===null) $time=$this->time;
		if($type==34){ //六合彩
			$atime=date('Y-m-d H:i:s', $time);
			$atimedb=$this->prename.'lhc_time';
		}else{
			$atime=date('H:i:s', $time);
			$atimedb=$this->prename.'data_time';
		}
		
		$sql="select actionNo, actionTime from {$atimedb} where type=$type and actionTime<=? order by actionTime desc limit 1";

		$return = $this->getRow($sql, $atime);
		
		if(!$return){
			$sql="select actionNo, actionTime from {$atimedb} where type=$type order by actionNo desc limit 1";
			$return =$this->getRow($sql, $atime);
			//$return['actionTime']=date('Y-m-d ', $time-24*3600).$return['actionTime'];
			$time=$time-24*3600;
		}
		$types=$this->getTypes();
		if(($fun=$types[$type]['onGetNoed']) && method_exists($this, $fun)){
			$this->$fun($return['actionNo'], $return['actionTime'], $time);
		}
		return $return;
	}

	/*
	public function getGamenextNo($type, $time=null){
		$type=intval($type);
		if($time===null) $time=$this->time;
		$kjTime=$this->getTypeFtime($type);
		$atime=date('H:i:s', $time);
		$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type and actionTime>? order by actionTime limit 1";
		$return = $this->getRow($sql, $atime);
		if(!$return){
			$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type order by actionTime limit 1";
			$return =$this->getRow($sql, $atime);
			$time=$time+24*3600;
		}
		$types=$this->getTypes();
		if(($fun=$types[$type]['onGetNoed']) && method_exists($this, $fun)){
			$this->$fun($return['actionNo'], $return['actionTime'], $time);
		}
		return $return;
	}
	
	public function getGameNos($type, $num=0, $time=null){
		$type=intval($type);
		if($time===null) $time=$this->time;
		if($type==34){ //六合彩
			$atime=date('Y-m-d H:i:s', $time);
			$atimedb=$this->prename.'lhc_time';
		}else{
			$atime=date('H:i:s', $time);
			$atimedb=$this->prename.'data_time';
		}
		
		$sql="select actionNo, actionTime from {$atimedb} where type=$type and actionTime>? order by actionTime";
		if($num) $sql.=" limit $num";
		$return = $this->getRows($sql, $atime);

		$types=$this->getTypes();
		if(($fun=$types[$type]['onGetNoed']) && method_exists($this, $fun)){
			if($return) foreach($return as $i=>$var){
				$this->$fun($return[$i]['actionNo'], $return[$i]['actionTime'], $time);
				$return[$i]['actionTime']=strtotime($return[$i]['actionTime']);
			}
		}
		
		if(count($return)<$num){
			$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type order by actionTime limit " . ($num-count($return));
			$return1=$this->getRows($sql);

			if(($fun=$types[$type]['onGetNoed']) && method_exists($this, $fun)){
				if($return1) foreach($return1 as $i=>$var){
					$this->$fun($return1[$i]['actionNo'], $return1[$i]['actionTime'], $time+24*3600);
					
					$return1[$i]['actionTime']=strtotime($return1[$i]['actionTime']);
				}
			}
			$return=array_merge($return, $return1);
		}
		
		return $return;
	}
	
	private function setTimeNo(&$actionTime, &$time=null){
		$actionTime=wjStrFilter($actionTime);
		if(!$time) $time=$this->time;
		$actionTime=date('Y-m-d ', $time).$actionTime;
	}
	
	public function noHdCQSSC(&$actionNo, &$actionTime, $time=null){
		$actionNo=wjStrFilter($actionNo);
		$this->setTimeNo($actionTime, $time);
		if($actionNo==0||$actionNo==120){
			$actionNo=date('Ymd-120', $time - 24*3600);
			$actionTime=date('Y-m-d 00:00', $time);
			//echo $actionTime;
		}else{
			$actionNo=date('Ymd-', $time).substr(1000+$actionNo,1);
		}
	}
	
	public function onHdXjSsc(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		if($actionNo>=96){
			$actionNo=date('Ymd-'.$actionNo, $time - 24*3600);
		}else{
			$actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
		}
	}
	
	public function noHd(&$actionNo, &$actionTime, $time=null){
		//echo $actionNo;
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
	}
	
	public function noxHd(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		if($actionNo>84){
			$time-=24*3600;
		}
		
		$actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
	}

	public function no0Hd(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Ymd-', $time).substr(1000+$actionNo,1);
	}

	public function no6Hd(&$actionNo, &$actionTime, $time=null){
		if(!$time) $time=$this->time;
		$actionNo=substr(date('Yz', $time),0,4).substr(1000+$actionNo,1);
	}

	public function no0Hdk3(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('md', $time).substr(100+$actionNo,1);
	}

	public function no0Hdf(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Ymd-', $time).substr(10000+$actionNo,1);
	}
	
	public function pai3(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Yz', $time);
		$actionNo=substr($actionNo,0,4).substr(substr($actionNo,4)+994,1);
		if($actionTime >= date('Y-m-d H:i:s', $time)){
			
		}else{
			$actionTime=date('Y-m-d 18:30', $time);
		}
	}
	
	public function GXklsf(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Yz', $time).substr(100+$actionNo,1)+100;
		$actionNo=substr($actionNo,0,4).substr(substr($actionNo,4)+100000,1);
	}
	//北京PK10
	public function BJpk10(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo = 179*(strtotime(date('Y-m-d', $time))-strtotime('2007-11-11'))/3600/24+$actionNo-3773;
	}
	//北京快乐8
	public function bjkl8(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo = 179*(strtotime(date('Y-m-d', $time))-strtotime('2004-09-19'))/3600/24+$actionNo-3837;
	}
	//澳门快乐8
	public function amkl8(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo = 288*(strtotime(date('Y-m-d', $time))-strtotime('2004-09-19'))/3600/24+$actionNo-1234;
	}
	//韩国快乐8
	public function hgkl8(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo = 288*(strtotime(date('Y-m-d', $time))-strtotime('2004-09-19'))/3600/24+$actionNo-4567;
	}
	//澳门幸运农场
	public function amxync(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('17md', $time).substr(1000+$actionNo,1);
	}	
	
	//台湾幸运农场
	public function twxync(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('17md', $time).substr(1000+$actionNo,1);
	}		
	//澳门PK10
	public function ampk10(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo = 288*(strtotime(date('Y-m-d', $time))-strtotime('2007-11-11'))/3600/24+$actionNo-6789;
	}
	//台湾PK10
	public function twpk10(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo = 288*(strtotime(date('Y-m-d', $time))-strtotime('2007-11-11'))/3600/24+$actionNo-4321;
	}	
	//天津时时彩
	public function tjssc(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		if($actionNo>84){
			$time-=24*3600;
		}
		
		$actionNo=date('17md', $time).substr(1000+$actionNo,1);
	}	
	//广东11选5
	public function gd11(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		if($actionNo>84){
			$time-=24*3600;
		}
		
		$actionNo=date('17md', $time).substr(100+$actionNo,1);
	}	
	//江西11选5
	public function jx11(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		if($actionNo>84){
			$time-=24*3600;
		}
		
		$actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
	}	
	//山东11选5
	public function sd11(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		if($actionNo>90){
			$time-=24*3600;
		}
		
		$actionNo=date('17md', $time).substr(100+$actionNo,1);
	}	
	//上海11选5
	public function sh11(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('17md', $time).substr(100+$actionNo,1);
	}
	//江苏快3
	public function jsk3(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		$actionNo=date('Ymd', $time).substr(1000+$actionNo,1);
	}	
	
	public function xjssc(&$actionNo, &$actionTime, $time=null){
		$this->setTimeNo($actionTime, $time);
		if($actionNo>84){
			$time-=24*3600;
		}
		
		$actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
	}
	*/
    
    /**
     *  获取玩法表数据
     * @return array
     */
	protected function getPlayeds()
    {
	    $this->playeds = db('gfwf_played')->cache(true,10*60,'xcache')->where(array('enable'=>1))->order('sort')->select() ;
	    $data = array() ;
	    if($this->playeds) {
            foreach($this->playeds as $var) {
                $data[$var['id']] = $var;
            }
        }
	    return $this->playeds = $data;
	}

    /**
     * 获取玩法组数据
     * @return array
     */
	protected function getGroups()
    {
	    $this->groups = db('gfwf_group')->cache(true,10*60,'xcache')->where(array('enable'=>1))->order('sort,id')->select() ;
	    $data = array();
	    if($this->groups) foreach($this->groups as $var){
	        $data[$var['id']]=$var;
	    }
	    return $this->groups = $data;
	}	
	
}
