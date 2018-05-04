<?php
namespace app\v2;
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
        
        /*
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
        
        */
        
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
        $servername = request()->server('SERVER_NAME');
        $domain = request()->host(); 
        $parts = explode('.',$domain);
        //if($servername == 'www.dd788799.com' && request()->isMobile()){
        //    $murl = 'm.'.$parts[count($parts) -2 ].'.'.$parts[count($parts) -1 ];
        //    header('location:http://'.$murl);
        //}
        
        
        //if($parts[0] != 'm' && $domain !=  '99206app.com' && $domain == 'www.99206app.com' && $domain== 'sj66657.com' && $domain == 'sj99206.com' &){
          //  header('location:http://m.'.$domain);
        //}
        /*
        if($parts[0] == 'm' || $domain == '99206app.com' ||$domain == 'www.99206app.com' || $domain== 'sj66657.com' || $domain == 'sj99206.com'){
            $view_path = APP_PATH.$this->request->module().DS.'mview'.DS;
            $this->view->config('view_path',$view_path);
        }
        */
        if($domain == 'http://www.99206000.com' || $domain == 'http://99206000.com'){
            exit('hello,world');
        }else{
            $servername = request()->server('SERVER_NAME');
            $domain = request()->host();
            $parts = explode('.',$domain);
            if($servername == 'www.dd788799.com' && request()->isMobile()){
                $murl = 'm.'.$parts[count($parts) -2 ].'.'.$parts[count($parts) -1 ];
                header('location:http://'.$murl);
            }
            if($parts[0] == 'm' || $domain == 'm.99205.site' || $domain == 'xhg.8889s.com' || $domain == 'vip.99205.site' || $domain == '99206app.com' ||$domain == 'www.99206app.com' || $domain== 'sj66657.com' || $domain == 'sj99206.com'){
                $view_path = APP_PATH.$this->request->module().DS.'newmview'.DS;
                $this->view->config('view_path',$view_path);
            }
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

	
    
	/**
	 * 是否是APP下注
	 * @return boolean
	 */
	protected function getDevice(){
	    $domain = $this->request->domain();
	    if($domain == '99206app.com' ||$domain == 'www.99206app.com' || $domain== 'sj66657.com' || $domain == 'sj99206.com'){
	        return 'APP';
	    }
	    if($this->request->isMobile()){
	        return 'MOBILE';
	    }else{
	        return 'PC';
	    }
	    
	}
	
	
	
}
