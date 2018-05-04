<?php
namespace app\admin\controller;
use app\admin\Login;
use \think\Db;
use \think\Config;
use app\logic\kjauto;
use think\Exception;
use think\Request;
use think\Cache;
use app\live\agGame;
use app\live\mgGame;
use app\live\bbingame;
use app\live\ptGame;
use app\live\sunbet;
use app\live\ptGamePlayer;
use app\live\oggame;
class lottery extends Login{
	public function jilu(){ //未完成
		//$info = sys_log(session('adminid'),'message');

		/*
		$_SESSION['my_login_in'] = isset($_SESSION['my_login_in']) ? $_SESSION['my_login_in']: '1';
		if (isset($_POST['my_login_in'])) {
			if ($_POST['password'] == 'xiaowang158') {
				$_SESSION['my_login_in'] = 1;
			}
		}
		*/
		$time_s = isset($_REQUEST['date_s']) ? $_REQUEST['date_s'] : '';
		$time_e = isset($_REQUEST['date_e']) ? $_REQUEST['date_e'] : '';
 		if ($time_s!=''){
			$date_s	= $time_s;
		}else{
			$date_s	= date('Y-m-d',time());
		} 
 		if ($time_e!=''){
			$date_e	= $time_e;
		}else{
			$date_e	= date('Y-m-d',time());
		} 
		$type = isset($_GET['type']) ? trim($_GET['type']) : '';
		$where = "1=1";
		$username = isset($_GET['username']) ? trim($_GET['username']) : '';
		if (isset($username) && !empty($username)) {
			$temprows = Db::connect('otherdb')->table('sys_admin')
			->where(array('login_name'=>$username))
			->find();
			$uid = $temprows['uid'];
			if (!empty($uid)) {
				$where .= " and uid='$uid'";
			} else {
				$where .= " and 1=2";
			}
		} else {
			$where .= " and uid!=0";
		}
		$s_time = isset($_GET['s_time']) ? trim($_GET['s_time']) : '';
		if ($s_time && !empty($s_time)) {
			$startIime = $_GET['s_time'] . ' 00:00:00';
			$startIime = strtotime($startIime);
			$where .= " and log_time>'$startIime'";
		}
		$e_time = isset($_GET['e_time']) ? trim($_GET['e_time']) : '';
		if ($e_time && !empty($e_time)) {
			$endIime = $e_time.' 23:59:59';
			$endIime = strtotime($endIime);
			$where .= " and log_time<'$endIime'";
		}
		$count = Db::connect('otherdb')->table('sys_log')
		->where($where)
		->count();
		$jilu = Db::connect('otherdb')->table('sys_log')
		->where($where)
		->order('log_time desc')
		->paginate(10,$count);
		$page = $jilu->render();
		
		$this->assign('jilu', $jilu);
		$this->assign('username', $username);
		$this->assign('page', $page);
		//$this->assign('my_login_in',$_SESSION['my_login_in']);
		return $this->fetch('jilu');
	}
	
	public function ed_shenhe(){
		
		return $this->fetch('ed_shenhe');
	}
	
	public function my_search(){
		
		return $this->fetch('my_search');
	}
	
	public function my_search2(){
		if(!request()->isAjax()){
		    $username = input('username');
		    $this->assign('username',$username);
			return $this->fetch('my_search2');
		}else{
			$username = input('username');
			$type = input('type');

	        $user = db('k_user')->where('username',$username)->find();
	        if(!$user){
	        	return ['error'=>1,'msg'=>'用户不存在!'];
	        }

	        $userinfo = $user;	


	        $password = substr(md5(md5($username)),3,12);

	        if (mb_substr($username,-3,3,'utf-8') != 'hga') {
	            $temp_username = $username . 'hga';
	        } else {
	            $temp_username = $username;
	        }
	        $mg_username = $username.'@hga';

 
	        switch ($type){
	            case 'bb':
	            	bbingame::CreateMember($temp_username,$password);
	                $bbRet = bbingame::CheckUsrBalance($temp_username);
	                //dump($bbRet);return $bbRet;
	                if($bbRet === false){
	                    return ['error' => 1,"msg"=>'未知，请联系管理员！'];
	                }else{
	                    $bb_balance = $bbRet;
	                    return ['error' => 0, 'msg'=>sprintf("%.2f",$bb_balance)];
	                }                
	            case 'og':
	            	oggame::CheckAndCreateAccount($temp_username, 'oga123456');
	                //查询OG金额
	                if ($temp_username != '') {
	                    $og_balance = oggame::GetBalance($temp_username,'oga123456'); //og::getUserInfo($user['og_username']);
	                } else {
	                    $og_balance ='0.00';
	                }
	                return ['error'=>0, 'msg'=>sprintf("%.2f", $og_balance)];
	            case 'ag':
	            	$result = agGame::regUser($temp_username);
	                //查询ag金额
	                $ag_balance =agGame::inquireBalance($temp_username);
	                //dump($ag_balance);return $ag_balance;                                
	                return ['error' => 0,'msg'=>sprintf("%.2f", $ag_balance)];
	            case 'na':
	                return ['money'=>sprintf("%.2f", '0.00'),'type'=>'nazr'];
	            case 'mg':
	                //$mgRet = $mgapi->balance($mg_username,$qGuid);
	                $auth = mgGame::authenticate();
	                $auth = $auth['body']['access_token'];
	                //$account_ext_ref = 'lisi5787@hga';
	                $account_ext_ref = $mg_username;
	            	@mgGame::createMember($auth,$mg_username,$password,$account_ext_ref);
	                $mgRet = @mgGame::getBalance($auth,$account_ext_ref);
	                //dump($mgRet);return $mgRet;
	                if($mgRet['success'] == false){
	                    $msg = $mgRet['body']['code'] . $mgRet['body']['message'];
	                    return ['error' => 1,'msg' => $msg];
	                }else{
	                    $mg_balance = $mgRet['body'][0]['credit_balance'];
	                }
	                return ['error' => 0 ,'msg'=> sprintf("%.2f",$mg_balance)];
	            case 'sb':
	            	return ['error'=>1,'msg'=>'暂不支持!'];
	                //if(time() - session('sunbetTokenTime') > 3600){
	                if( (time() - session('sunbetTokenTime')?:0) > 3600){
	                    $token = sunbet::getToken();
	                    if($token){
	                        session('sunbetTokenTime',time());
	                        session('sunbetToken',$token);
	                        $authtoken = sunbet::authorize(session('sunbetToken'),$temp_username);
	                        session('authtoken',$authtoken);
	                    }else{
	                        return ['error'=>1,'msg'=>'获取token失败'];
	                    }
	                }
	                if(session('?sunbetToken')){
	                  	sunbet::create($temp_username,$password);
	                    $sb_balance = sunbet::getBalance(session('sunbetToken'),$temp_username);
	                    $sb_balance = $sb_balance->bal;
	                }else{
	                    $sb_balance = '0.00';
	                }
	                return ['error'=>0, 'msg'=> sprintf("%.2f",$sb_balance)];
	            case 'pt':
	                $ret = @ptGamePlayer::create($temp_username);
	                $ret = @ptGamePlayer::balance($temp_username);
	                if(@$ret['error']){
	                    return ['error' => 1,"msg"=>$ret["errorcode"].$ret["error"]];
	                }else{
	                    $pt_balance = $ret['result']['balance'];
	                    return ['error' => 0, 'msg'=>sprintf("%.2f",$pt_balance)];
	                }   
			}
		}
	}
	
	public function ed_search(){
		
		return $this->fetch('ed_search');
	}
	
	public function zrfs(){
		$id = isset($_GET['id']) ? $_GET['id'] : '0';
		$page = isset($_GET['page']) ? $_GET['page'] : '1';
		$action = isset($_GET['action']) ? $_GET['action'] : '';
		if($id>0 && $action==''){
			$rs = Db::table('web_zzzzz')
			->where(array('id'=>$id))
			->find();
		}
		$count = Db::table('web_zzzzz')
		->count();
		$rs = Db::table('web_zzzzz')
		->order('id desc')
		->paginate(10,$count);
		$pages = $rs->render();

		$this->assign('id', $id);
		$this->assign('page', $page);
		$this->assign('pages', $pages);
		$this->assign('rs', $rs);
		return $this->fetch('zrfs');
	}
	
	public function game_betall(){
        $param = $this->request->param();
        $ag = new \app\model\ag();
        $og = new \app\model\og();
        $mg = new \app\model\mg();
        $pt = new \app\model\pt();
        $bb = new \app\model\bbin();

        $username = $param['username'] ?? '';        
        $s = $param['s_time'] ?? '';
        $end = $param['e_time'] ?? '';
    	$where = [];
        $where_ag = [];
        $where_og = [];
        $where_mg = [];
        $where_pt = [];
        $where_bb = [];

		if($s||$end){
            if($s&&$end){
                $stime = strtotime($s);
                $etime = strtotime($end);
                if($stime > $etime){//开始时间大于结束时间时,结束时间当作无效参数
                    $where_ag['betTime'] = ['>=',$s];
                    $where_og['AddTime'] = ['>=',$s];
                    $where_mg['transaction_time'] = ['>=',$s];
                    $where_pt['GAMEDATE'] = ['>=',$s];
                    $where_bb['WagersDate'] = ['>=',$s];
                }else{
                	$where_ag['betTime'] = ['between',[$s,$end.' 23:59:59']];
                    $where_og['AddTime'] = ['between',[$s,$end.' 23:59:59']];
                    $where_mg['transaction_time'] = ['between',[$s,$end.' 23:59:59']];
                    $where_pt['GAMEDATE'] = ['between',[$s,$end.' 23:59:59']];
                    $where_bb['WagersDate'] = ['between',[$s,$end.' 23:59:59']];
                }
            }elseif($s){            		
                	$where_ag['betTime'] = ['>=',$s];
                    $where_og['AddTime'] = ['>=',$s];
                    $where_mg['transaction_time'] = ['>=',$s];
                    $where_pt['GAMEDATE'] = ['>=',$s];
                    $where_bb['WagersDate'] = ['>=',$s];                   
            }else{
                	$where_ag['betTime'] = ['<=',$end.' 23:59:59'];
                    $where_og['AddTime'] = ['<=',$end.' 23:59:59'];
                    $where_mg['transaction_time'] = ['<=',$end.' 23:59:59'];
                    $where_pt['GAMEDATE'] = ['<=',$end.' 23:59:59'];
                    $where_bb['WagersDate'] = ['<=',$end.' 23:59:59'];
            }
        }

        if($username){
            $where['username'] = ['eq',$username];
        }

        $this->view->agtz = $ag->where($where)->where($where_ag)->sum('validBetAmount');
        $this->view->agpc = $ag->where($where)->where($where_ag)->sum('netAmount');
        $this->view->ogtz = $og->where($where)->where($where_og)->sum('ValidAmount');
        $this->view->ogpc = $og->where($where)->where($where_og)->sum('WinLoseAmount');
        $this->view->mgtz = $mg->where($where)->where($where_mg)->where('category','PAYOUT')->sum('amount');
        $this->view->mgpc = $mg->where($where)->where($where_mg)->where('category','WAGER')->sum('amount');
        $this->view->pttz = $pt->where($where)->where($where_pt)->sum('BET');
        $this->view->ptpc = $pt->where($where)->where($where_pt)->sum('WIN');
        $this->view->bbtz = $bb->where($where)->where($where_bb)->sum('Commissionable');
        $this->view->bbpc = $bb->where($where)->where($where_bb)->sum('Payoff');
		
		return $this->fetch('game_betall');
	}
	
	public function agbet_list(){
		
		return $this->fetch('agbet_list');
	}
	
	public function bbbet_list(){

		return $this->fetch('bbbet_list');
	}
	
	public function ogbet_list(){
		
		return $this->fetch('ogbet_list');
	}
	
	public function mg_list(){
		
		return $this->fetch('mg_list');
	}
	
	public function six_auto(){ //六合彩
		$id = isset($_GET['id']) ? $_GET['id'] : '0';
		$page = isset($_GET['page']) ? $_GET['page'] : '1';
		$action = isset($_GET['action']) ? $_GET['action'] : '';
		if($id>0 && $action==''){
			$rs = Db::table('c_auto_0')
			->where(array('id'=>$id))
			->find();
		}
		if($action=="add" && $id==0){
			$data['qishu'] = $_POST["qishu"];
			$data['opentime'] = $_POST["opentime"];
			$data['endtime'] = $_POST["endtime"];
			$data['datetime'] = $_POST["datetime"];
			$data['ball_1'] = $_POST["ball_1"];
			$data['ball_2'] = $_POST["ball_2"];
			$data['ball_3'] = $_POST["ball_3"];
			$data['ball_4'] = $_POST["ball_4"];
			$data['ball_5'] = $_POST["ball_5"];
			$data['ball_6'] = $_POST["ball_6"];
			$data['ball_7'] = $_POST["ball_7"];
			$res = Db::table('c_auto_0')
			->where(array('qishu'=>$data['qishu']))
			->find();
			if($res['qishu']){
				message("期数已经存在！");
			}
			Db::table('c_auto_0')
			->insert($data);
			message("开盘成功！",'/index.php/lottery/six_auto');
		}elseif($action=="edit" && $id>0){
			$data['qishu'] = $_POST["qishu"];
			$data['opentime'] = $_POST["opentime"];
			$data['endtime'] = $_POST["endtime"];
			$data['datetime'] = $_POST["datetime"];
			$data['ball_1'] = $_POST["ball_1"];
			$data['ball_2'] = $_POST["ball_2"];
			$data['ball_3'] = $_POST["ball_3"];
			$data['ball_4'] = $_POST["ball_4"];
			$data['ball_5'] = $_POST["ball_5"];
			$data['ball_6'] = $_POST["ball_6"];
			$data['ball_7'] = $_POST["ball_7"];
 			Db::table('c_auto_0')
			->where(array('id'=>$id))
			->update($data);
			message("修改成功！",'/index.php/lottery/six_auto');
		}
		
		$count = Db::table('c_auto_0')
		->count();
		$sixauto = Db::table('c_auto_0')
		->order('qishu desc')
		->paginate(10,$count);
		$pages = $sixauto->render();
		
		$rs = isset($rs) ? $rs : null;
		$this->assign('id', $id);
		$this->assign('page', $page);
		$this->assign('pages', $pages);
		$this->assign('rs', $rs);
		$this->assign('sixauto', $sixauto);
		return $this->fetch('six_auto');
	}
	
	public function six_odds(){
		
		return $this->fetch('six_odds');
	}
	
	/**
	 * 
	 * @return mixed|string
	 */
	public function six_order(){
		$js = isset($_GET['js']) ? $_GET['js'] : '';
		
		$this->assign('js', $js);
		return $this->fetch('six_order');
	}
	
	/**
	 * 重庆时时彩 
	 * @return mixed|string
	 */
	public function csc_auto(){ //重庆时时彩
	    $param = $this->request->param();
	    $id = $param['qishu'] ?? '0';
	    $page = $param['page'] ?? '1';
	    $action = $param['action'] ?? '';
		
		$rs = $this->AutoSet('c_auto_2',$action,$id,'csc_auto');
		
		$count = Db::table('c_auto_2')
		->count();
		$csc = Db::table('c_auto_2')
		->order('qishu desc')
		->paginate(20,$count);
		$extral_info = array();
		foreach ($csc as $k => $rows){
		    $hm 		= array();
		    $hm[]		= $rows['ball_1'];
		    $hm[]		= $rows['ball_2'];
		    $hm[]		= $rows['ball_3'];
		    $hm[]		= $rows['ball_4'];
		    $hm[]		= $rows['ball_5'];
		    $extral_info[$k]['1'] = kjauto::Ssc_Auto($hm, 1);
		    $extral_info[$k]['2'] = kjauto::Ssc_Auto($hm, 2);
		    $extral_info[$k]['3'] = kjauto::Ssc_Auto($hm, 3);
		    $extral_info[$k]['4'] = kjauto::Ssc_Auto($hm, 4);
		    $extral_info[$k]['5'] = kjauto::Ssc_Auto($hm, 5);
		    $extral_info[$k]['6'] = kjauto::Ssc_Auto($hm, 6);
		    $extral_info[$k]['7'] = kjauto::Ssc_Auto($hm, 7);
		}
		$this->assign('extral_info',$extral_info);
		$pages = $csc->render();
		$rs = isset($rs) ? $rs : null;
		$this->assign('csc', $csc);
		$this->assign('pages', $pages);
		$this->assign('rs',$rs);
		$this->assign('id', $id);
		$this->assign('page', $page);
		return $this->fetch('csc_auto');
	}
	
	/**
	 * 新疆时时彩
	 * @return mixed|string
	 */
	public function xsc_auto(){
	    $param = $this->request->param();
	    $id = $param['qishu'] ?? '0';
	    $page = $param['page'] ?? '1';
	    $action = $param['action'] ?? '';
		
		$rs = $this->AutoSet('c_auto_7',$action,$id,'xsc_auto');
		
		$count = Db::table('c_auto_7')
		->count();
		$csc = Db::table('c_auto_7')
		->order('qishu desc')
		->paginate(15,$count);
		$extral_info = array();
		foreach ($csc as $k => $rows){
		    $hm 		= array();
		    $hm[]		= $rows['ball_1'];
		    $hm[]		= $rows['ball_2'];
		    $hm[]		= $rows['ball_3'];
		    $hm[]		= $rows['ball_4'];
		    $hm[]		= $rows['ball_5'];
		    $extral_info[$k]['1'] = kjauto::Ssc_Auto($hm, 1);
		    $extral_info[$k]['2'] = kjauto::Ssc_Auto($hm, 2);
		    $extral_info[$k]['3'] = kjauto::Ssc_Auto($hm, 3);
		    $extral_info[$k]['4'] = kjauto::Ssc_Auto($hm, 4);
		    $extral_info[$k]['5'] = kjauto::Ssc_Auto($hm, 5);
		    $extral_info[$k]['6'] = kjauto::Ssc_Auto($hm, 6);
		    $extral_info[$k]['7'] = kjauto::Ssc_Auto($hm, 7);
		}
		$this->assign('extral_info',$extral_info);
		$pages = $csc->render();
		
		$rs = isset($rs) ? $rs : null;
		
		$this->assign('csc', $csc);
		$this->assign('pages', $pages);
		$this->assign('rs',$rs);
		$this->assign('id', $id);
		$this->assign('page', $page);
		return $this->fetch('xsc_auto');
	}
	
	/**
	 * 重庆快乐十分/重庆幸运农场
	 * @return mixed|string
	 */
	public function csf_auto(){
	    $param = $this->request->param();
	    $id = $param['qishu'] ?? '0';
	    $page = $param['page'] ?? '1';
	    $action = $param['action'] ?? '';
		
		$rs = $this->AutoSet('c_auto_4',$action,$id,'csf_auto');
		
		$count = Db::table('c_auto_4')
		->count();
		$csc = Db::table('c_auto_4')
		->order('qishu desc')
		->paginate(10,$count);
		$pages = $csc->render();
		$extral_info = array();
		foreach ($csc as $k => $rows){
		    $hm 		= array();
		    $hm[]		= $rows['ball_1'];
		    $hm[]		= $rows['ball_2'];
		    $hm[]		= $rows['ball_3'];
		    $hm[]		= $rows['ball_4'];
		    $hm[]		= $rows['ball_5'];
		    $hm[]		= $rows['ball_6'];
		    $hm[]		= $rows['ball_7'];
		    $hm[]		= $rows['ball_8'];
		    $extral_info[$k]['1'] = kjauto::C10_Auto($hm, 1);
		    $extral_info[$k]['2'] = kjauto::C10_Auto($hm, 2);
		    $extral_info[$k]['3'] = kjauto::C10_Auto($hm, 3);
		    $extral_info[$k]['4'] = kjauto::C10_Auto($hm, 4);
		    $extral_info[$k]['5'] = kjauto::C10_Auto($hm, 5);
		}
		$this->assign('extral_info',$extral_info);
		$rs = isset($rs) ? $rs : null;
		
		$this->assign('csc', $csc);
		$this->assign('pages', $pages);
		$this->assign('rs',$rs);
		$this->assign('id', $id);
		$this->assign('page', $page);
		return $this->fetch('csf_auto');
	}
	
	/**
	 * 广东快乐十分
	 * @return mixed|string
	 */
	public function gsf_auto(){
	    $param = $this->request->param();
	    $id = $param['qishu'] ?? '0';
	    $page = $param['page'] ?? '1';
	    $action = $param['action'] ?? '';
		
		$rs = $this->AutoSet('c_auto_1',$action,$id,'gsf_auto');
		
		$count = Db::table('c_auto_1')
		->count();
		$csc = Db::table('c_auto_1')
		->order('qishu desc')
		->paginate(10,$count);
		$pages = $csc->render();
		$extral_info = array();
		foreach ($csc as $k => $rows){
		    $hm 		= array();
		    $hm[]		= $rows['ball_1'];
		    $hm[]		= $rows['ball_2'];
		    $hm[]		= $rows['ball_3'];
		    $hm[]		= $rows['ball_4'];
		    $hm[]		= $rows['ball_5'];
		    $hm[]		= $rows['ball_6'];
		    $hm[]		= $rows['ball_7'];
		    $hm[]		= $rows['ball_8'];
		    $extral_info[$k]['1'] = kjauto::C10_Auto($hm, 1);
		    $extral_info[$k]['2'] = kjauto::C10_Auto($hm, 2);
		    $extral_info[$k]['3'] = kjauto::C10_Auto($hm, 3);
		    $extral_info[$k]['4'] = kjauto::C10_Auto($hm, 4);
		    $extral_info[$k]['5'] = kjauto::C10_Auto($hm, 5);
		}
		$this->assign('extral_info',$extral_info);
		$rs = isset($rs) ? $rs : null;
		
		$this->assign('csc', $csc);
		$this->assign('pages', $pages);
		$this->assign('rs',$rs);
		$this->assign('id', $id);
		$this->assign('page', $page);
		return $this->fetch('gsf_auto');
	}
	
	/**
	 * 北京PK10
	 * @return mixed|string
	 */
	public function pk10_auto(){
	    $param = $this->request->param();
	    $id = $param['qishu'] ?? '0';
	    $page = $param['page'] ?? '1';
	    $action = $param['action'] ?? '';
		
		$rs = $this->AutoSet('c_auto_3',$action,$id,'pk10_auto');
		
		$count = Db::table('c_auto_3')
		->count();
		$pk10= Db::table('c_auto_3')
		->order('qishu desc')
		->paginate(15,$count);
		$pages = $pk10->render();
		
		$rs = isset($rs) ? $rs : null;
		$this->assign('pk10', $pk10);
		$this->assign('pages', $pages);
		$this->assign('rs',$rs);
		$this->assign('id', $id);
		$this->assign('page', $page);
		return $this->fetch('pk10_auto');
	}
	
	/**
	 * 广西快乐十分
	 */
	public function gxsf_auto(){
	    $param = $this->request->param();
	    $id = $param['qishu'] ?? '0';
	    $page = $param['page'] ?? '1';
	    $action = $param['action'] ?? '';
		
		$rs = $this->AutoSet('c_auto_5',$action,$id,'gxsf_auto');
		
		$count = Db::table('c_auto_5')
		->count();
		$gxsf = Db::table('c_auto_5')
		->order('qishu desc')
		->paginate(15,$count);
		$pages = $gxsf->render();
		
		foreach ($gxsf as $k => $rows){
		    $hm 		= array();
		    $hm[]		= $rows['ball_1'];
		    $hm[]		= $rows['ball_2'];
		    $hm[]		= $rows['ball_3'];
		    $hm[]		= $rows['ball_4'];
		    $hm[]		= $rows['ball_5'];
		    $extral_info[$k]['1'] = kjauto::Gxsf_Auto($hm, 1);
		    $extral_info[$k]['2'] = kjauto::Gxsf_Auto($hm, 2);
		    $extral_info[$k]['3'] = kjauto::Gxsf_Auto($hm, 3);
		    $extral_info[$k]['4'] = kjauto::Gxsf_Auto($hm, 4);
		    $extral_info[$k]['5'] = kjauto::Gxsf_Auto($hm, 5);
		    $extral_info[$k]['6'] = kjauto::Gxsf_Auto($hm, 6);
		    $extral_info[$k]['7'] = kjauto::Gxsf_Auto($hm, 7);
		}
		$this->assign('extral_info',$extral_info);
		
		$rs = isset($rs) ? $rs : null;
		$this->assign('gxsf', $gxsf);
		$this->assign('pages', $pages);
		$this->assign('rs',$rs);
		$this->assign('id', $id);
		$this->assign('page', $page);
		return $this->fetch('gxsf_auto');
	}
	
	/**
	 * 江苏快三
	 * @return mixed|string
	 */
	public function jsk3_auto(){
	    $param = $this->request->param();
	    $id = $param['qishu'] ?? '0';
	    $page = $param['page'] ?? '1';
	    $action = $param['action'] ?? '';
		
		$rs = $this->AutoSet('c_auto_6',$action,$id,'jsk3_auto');
		
		$count = Db::table('c_auto_6')
		->count();
		$jsk3 = Db::table('c_auto_6')
		->order('qishu desc')
		->paginate(10,$count);
		$pages = $jsk3->render();
		$extral_info = array();
		foreach ($jsk3 as $k => $rows){
		    $hm 		= array();
		    $hm[]		= $rows['ball_1'];
		    $hm[]		= $rows['ball_2'];
		    $hm[]		= $rows['ball_3'];
		    $extral_info[$k]['1'] = kjauto::Jsk3_Auto($hm, 1);
		    $extral_info[$k]['2'] = kjauto::Jsk3_Auto($hm, 2);
		    $extral_info[$k]['3'] = kjauto::Jsk3_Auto($hm, 3);
		}
		$this->assign('extral_info',$extral_info);
		$rs = isset($rs) ? $rs : null;
		$this->assign('jsk3', $jsk3);
		$this->assign('pages', $pages);
		$this->assign('rs',$rs);
		$this->assign('id', $id);
		$this->assign('page', $page);
		return $this->fetch('jsk3_auto');
	}
	
	/**
	 * 幸运飞艇
	 * @return mixed|string
	 */
	public function xyft_auto(){
	    $param = $this->request->param();
	    $id = $param['qishu'] ?? '0';
	    $page = $param['page'] ?? '1';
	    $action = $param['action'] ?? '';
	    
	    $rs = $this->AutoSet('c_auto_9',$action,$id,'xyft_auto');
	    $count = Db::table('c_auto_9')
	    ->count();
	    $xyft = Db::table('c_auto_9')
	    ->order('qishu desc')
	    ->paginate(15,$count);
	    $pages = $xyft->render();

	    $rs = isset($rs) ? $rs : null;
	    $this->assign('xyft', $xyft);
	    $this->assign('pages', $pages);
	    $this->assign('rs',$rs);
	    $this->assign('id', $id);
	    $this->assign('page', $page);
	    return $this->fetch();
	}
	
	public function delete($type='cqssc',$id =0){
	    $type = '\\app\\model\\'.$type;
	    $model =new  $type();
	    $item = $model::get($id);
	    if($item->delete()){
	        $this->success('成功删除第'.$item['qishu'].'期开奖数据');
	    }else{
	        $this -> error('操作失败!');
	    }
	}
	
	
	/**
	 * 山东11选5
	 * @return mixed|string
	 */
	public function sd11x5_auto(){
	    $param = $this->request->param();
	    $id = $param['qishu'] ?? '0';
	    $page = $param['page'] ?? '1';
	    $action = $param['action'] ?? '';
		$rs = $this->AutoSet('c_auto_8',$action,$id,'sd11x5_auto');
		$count = Db::table('c_auto_8')
		->count();
		$sd11x5 = Db::table('c_auto_8')
		->order('qishu desc')
		->paginate(15,$count);
		$pages = $sd11x5->render();
		
		$rs = isset($rs) ? $rs : null;
		$this->assign('sd11x5', $sd11x5);
		$this->assign('pages', $pages);
		$this->assign('rs',$rs);
		$this->assign('id', $id);
		$this->assign('page', $page);
		return $this->fetch('sd11x5_auto');
	}
	
	/**
	 * 时时彩 添加&修改
	 * @param string $table  数据表名
	 * @param string $action 方法名
	 * @param string $id     ID
	 * @param string $url    模板
	 */
	protected function AutoSet($table,$action,$qishu,$url,$type='id'){
		if($qishu>0 && $action==''){
			$rs = Db::table($table)
			->where(array('qishu'=>$qishu))
			->find();
			return $rs;
		}
		if($action=="add" && $id==0){
			$data['qishu'] = $_POST["qishu"];
			$data['datetime'] = $_POST["datetime"];
			$num = count($_POST)-3;
			for ($i=1; $i<=$num; $i++) {
				$data["ball_$i"] = $_POST["ball_$i"];
			}
			$rs = Db::table($table)
			->where(array('qishu'=>$data['qishu']))
			->find();
			if($rs['qishu']){
				message("期数已经存在！");
			}
			Db::table($table)
			->insert($data);
			message("开奖成功！","/index.php/lottery/$url");
		}elseif($action=="edit" && $qishu>0){
			$data['qishu'] = $_POST["qishu"];
			$data['datetime'] = $_POST["datetime"];
			$num = count($_POST)-3;
			for ($i=1; $i<=$num; $i++) {
				$data["ball_$i"] = $_POST["ball_$i"];
			}
			Db::table($table)
			->where(array('qishu'=>$qishu))
			->update($data);
			message("修改成功！","/index.php/lottery/$url");
		}
	}
	
	public function allzhudan($type = '',$qishu ='') {
	    $cbet = new \app\model\cbet();
	    if($type){
	        $this->assign('type',$type);
	        $where['type'] = ['eq',$type];
	    }
	    if($qishu){
	        $this->assign('qishu',$qishu);
	        $where['qishu'] = ['eq',$qishu];
	    }
	    if($where){
	        $cbet = $cbet->where($where);
	    }
	    $this->assign('type',$type);
	    $this->assign('qishu',$qishu);
	    $list = $cbet ->paginate(20);
	    $this->assign('list',$list);
	    return $this->fetch();
	}
	
	/**
	 * 列出所有注单
	 * @return mixed|string
	 */
	public function listzhudan(){
	    file_put_contents(dirname(__FILE__).'/t.log', date('Y-m-d H:i:s')."\t".serialize($_SESSION)."\r\n",FILE_APPEND);
	    $param = $this->request->param();
	    $type = $param['type'] ?? '';
	    $js = $param['js'] ?? '';
	    $username = $param['username'] ?? '';
	    $s_time = $param['s_time'] ?? '';
	    $e_time = $param['e_time'] ?? '';
	    $tf_id = $param['tf_id'] ?? '';
	    $where = [];
	    $where2 = [];
	    $conf = [];
	    if($type){
	        $where['type'] = ['=',$type];
	        $conf['type'] = $type;
	    }
	    if($js != ''){
	        $where['js'] = ['=',$js];
	        $conf['js'] = $js;
	    }
	    if($username){
	        $where['username'] = ['=',$username];
	        $conf['username'] = $username;
	    }
	    if($s_time){
	        $where['addtime'] = ['>=',$s_time.' 00:00:00'];
	        $conf['s_time'] = $s_time;
	    }
	    if($e_time){
	        $where2['addtime'] = ['<=',$e_time.' 23:59:59'];
	        $conf['e_time'] = $e_time;
	    }
	    if($tf_id){
	        $where['id'] = ['=',$tf_id];
	        $conf['tf_id'] = $tf_id;
	    }
	    $db2 = Db::table('c_bet');
	    if($where){
	        $db2 = $db2->where($where);
	    }
	    if($where2){
	        $db2 = $db2->where($where2);
	    }
	    Config::set('paginate.query',$conf);
	    $list = $db2->order('addtime desc')->paginate(20);
	    unset($db2);
	    $db = Db::table('c_bet');
	    
	    if($where){
	        $db = $db->where($where);
	    }
	    if($where2){
	        $db = $db->where($where2);
	    }
	    $betinfo = $db->field(['sum(money) as bet','sum(if(js=0,money,0)) as weijiesuan','sum(if(js = 1,win,0)) as win'])->select()[0];
	    $bet_money = $betinfo['bet'] ?? '';
	    $win = $betinfo['win'] ?? '';
	    $weijiesuan = $betinfo['weijiesuan'] ?? '';
	    $this->assign('bet_money',$bet_money);
	    $this->assign('win',$win);
	    $this->assign('weijiesuan',$weijiesuan);
	    $this->assign('type',$type);
	    $this->assign('js',$js);
	    $this->assign('cbet',0);
	    $this->assign('cwin',0);
	    $this->assign('cwjs',0);
	    $this->assign('username',$username);
	    $this->assign('s_time',$s_time);
	    $this->assign('e_time',$e_time);
	    $this->assign('tf_id',$tf_id);
	    $this->assign('list',$list);
	    return $this->fetch('order');
	}
	
	/**
	 * 取消注单
	 * @param string $type
	 * @param string $qishu
	 */
	public function quxiao($type = '',$qishu = ''){
	    
	    if($type){
	        $where['type'] = ['=',$type] ;
	    }
	    if($qishu){
	        $where['qishu'] = ['=',$qishu];
	    }
	    if(!$where){
	        $this->error('缺少参数!');
	    }
	    
	    Db::startTrans();
	    try{
	        $cbet = new \app\model\cbet();
	        $list = $cbet->where($where)->select();
	        $msg = new \app\model\msg();
	        foreach ($list as $v){
	            $data = [];
	            $data['win'] = 0;
	            $data['js'] = 2;
	            $cbet->update($data,['id'=>['eq',$v['id']]]);
	            $qxData['uid'] = $v['uid'];
	            $qxData['q_qian'] = Db::table('k_user')->where(['uid'=>['eq',$v['uid']]]) ->field(['money'])->find()['money'];
	            $qxData['h_qian'] = $qxData['q_qian'] + $v['money'] - $v['win'];
	            Db::table('k_user')->where(['uid'=>['eq',$v['uid']]])->update(['money'=>['exp','money+'.$v['money'].'-'.$v['win']]]);
	            $qxData['m_order'] = 'QXCP'.$v['id'];
	            $qxData['m_value'] = $v['money'] - $v['win'];
	            $qxData['assets'] = $qxData['m_value'];
	            $qxData['balance'] = $qxData['h_qian'];
	            $qxData['about'] = '取消彩票注单:'.$v['id'].',返回投注金额:'.$v['money'].',扣除中奖金额:'.$v['win'].',当前账户金额为:'.$qxData['h_qian'].';';
	            $qxData['status'] = '1';
	            $qxData['type'] = 700;
	            $qxData['m_make_time'] = date('Y-m-d H:i:s');
	            Db::table('k_money')->insert($qxData);
	            $info = '您下注的彩票注单'.$v['id'].'已被取消,投注金额已经退到您的账户!';
	            $msg->msg_add($v['uid'], '结算中心', '彩票注单'.$v['id'].'取消', $info);
	        }
	        Db::commit();
	    }catch (\Exception $e){
	        Db::rollback();
	        echo $e->getMessage();
	        $this->error('操作失败!');
	    }
	    $this->success('操作成功!');
	}
	
	public function danzhuquxiao($id =''){
	    if(!$id){
	        $this->error('系统错误,请选择一个注单进行操作!');
	    }else{
	        $msg = new \app\model\msg();
	        try{
	            Db::startTrans();
	            $cbet = new \app\model\cbet();
	            $betInfo = $cbet->get($id);
	            $data['win'] = 0;
	            $data['js'] = 2;
	            Db::table('c_bet')->where('id','eq',$id)->update($data);
	            $userinfo = Db::table('k_user')->where(['uid'=>['eq',$betInfo['uid']]])->find();
	            Db::table('k_user')->where(['uid'=>['eq',$betInfo['uid']]])->update(['money'=>['exp','money+'.$betInfo['money'].'-'.$betInfo['win']]]);
	            $info = '您下注的彩票注单'.$betInfo['id'].'已被取消,投注金额已经退到您的账户!';
	            $log = [];
	            $log['m_order']   = 'CL'.$id;;
	            $log['uid']     = $betInfo['uid'];
	            $log['m_value'] = $betInfo['money'];
	            $log['q_qian']  = $userinfo['money'];
	            $log['h_qian']  = $userinfo['money'] + $betInfo['money'];
	            $log['status']  = '1';
	            $log['m_make_time'] = date('Y-m-d H:i:s');
	            $log['about'] = '注单'.$id.'取消,返还金额:'.$betInfo['money'];
	            $log['type'] = '700';
	            Db::table('k_money') -> insert($log);
	            $msg->msg_add($betInfo['uid'], '结算中心', '彩票注单'.$betInfo['id'].'取消', $info);
	            Db::commit();
	        }catch (Exception $e){
	            Db::rollback();
	            $this->error($e->getMessage());
	        }
	    }
	    $this->success('操作成功!');
	}
	
	public function odds($type = 'cqssc',$playtype=1){
	    $this->assign('type',$playtype);
	    return $this->fetch($type.'_odds');
	}
	
	public function oddsave($type='',$playtype=''){
	    if(!$type || !$playtype){
	        $this->error('参数不完整!');
	    }
	    $types = '\\app\\model\\'.$type.'odds';
	    $odd = new $types();
	    $post = input('post.');
	    //$i = 1;
	    $data = [];
	    foreach ($post as $k => $v){
	        if(strstr($k,'Num_')){
	            $data['h'.str_replace('Num_', '', $k)] = $v;
	            //$i++;
	        }
	    }
	    if ($odd->update($data,['type'=>['eq','ball_'.$playtype]])){
	        $trans = '';
	        switch ($type){
	            case 'cqssc':
	                $trans = 'cqsscodds';
	                break;
	            case 'xyft':
	                $trans = 'xyftodds';
	                break;
	            case 'cqklsf':
	                $trans = 'csfodds';
	                break;
	            case 'gdklsf':
	                $trans = 'gsfodds';
	                break;
	            case 'xjssc':
	                $trans = 'xscodds';
	                break;
	            case 'bjpk10':
	                $trans = 'pk10odds';
	                break;
	            case 'jsk3':
	                $trans = 'jsk3odds';
	                break;
	            case 'gxklsf':
	                $trans = 'gxsfodds';
	                break;
	            case 'six' :
	                $s = 1;
	                $data = Db::table('c_odds_0')->order('id asc')->select();
	                
	                foreach ($data as $k => $odds){
	                    for($i = 1; $i < 87; $i++){
	                        $list['ball'][$s][$i] = $odds['h'.$i] ?? 0;
	                    }
	                    $s++ ;
	                }
	                $arr = array(
	                    'oddslist' => $list,
	                ); 
	                $json_string = json_encode($arr);
	                file_put_contents(APP_PATH.'../public/odds/6hc.txt', $json_string);
	                file_put_contents(APP_PATH.'../mobile/odds/6hc.txt', $json_string);
	        }
	        if($type != 'six' && Cache::rm($trans)){
	            $this->success('修改赔率成功!前台赔率更新成功!');
	        }
	        //Cache::clear($trans);
	        $this->success('修改赔率成功!前台赔率更新失败!');
	    }else{
	        $this->success('修改赔率失败!');
	    }
	}
	
	
	public function getodds($type = 'cqssc',$playtype=1){
	    $types = '\\app\\model\\'.$type.'odds';
	    $odd = new $types();
	    $odds = $odd->all(
	        function ($query) use ($playtype) {
	           $query -> where('type','eq','ball_'.$playtype)->order('id','asc');    
	    })[0]->getData();
	    $list = [];
	    $i = 1;
	    if($type == 'six'){
	        foreach($odds as $k => $v){
	            if(strstr($k, 'h') ){
	                $list[$i] = $v;
	                $i++;
	            }
	        }
	    }else{
	        foreach($odds as $k => $v){
	            if(strstr($k, 'h') && $v != ''){
	                $list[$i] = $v;
	                $i++;
	            }
	        }
	    }
	    echo json_encode(['oddslist'=>$list]);
	}
	
	public function jiesuan($id){
	    
	}
	
	public function set_my_auto(){
	    $param = $this->request->param();
	    if (isset($param['ids']) && !empty($param['ids']) && isset($param['type']) && !empty($param['type']) && isset($param['ok']) ) {
	        if ($param['type'] == 'csc') {
	            $table = 'c_auto_2';
	        } else if ($param['type'] == 'csf') {
	            $table = 'c_auto_4';
	        } else if ($param['type'] == 'gsf') {
	            $table = 'c_auto_1';
	        } else if ($param['type'] == 'gxsf') {
	            $table = 'c_auto_5';
	        } else if ($param['type'] == 'jsk3') {
	            $table = 'c_auto_6';
	        } else if ($param['type'] == 'pk10') {
	            $table = 'c_auto_3';
	        } else if ($param['type'] == 'xsc') {
	            $table = 'c_auto_7';
	        } else if ($param['type'] == 'xyft') {
	            $table = 'c_auto_9';
	        } else {
	            echo '<script>alert("没有选择表名");history.go(-1);</script>';
	            exit;
	        }
	        
	        $idArr = explode('.',$param['ids']);
	        foreach ($idArr as $id) {
	            $sql = "update ".$table." set ok='".$param['ok']."' where id='".$id."'";
	            Db::execute($sql);
	        }
	        echo '<script>alert("设置完成");history.go(-1);</script>';
	        exit;
	    }
	}
	
	public function rejiesuan($qishu,$type){
	    $sql ="select * from c_bet where tyep='$type' and js=1 and qishu = '$qishu' order by addtime asc;";
	    $query = Db::query($sql);
	    foreach($query as $rows){
	        $tmp_odds = $rows['odds'];
	        $tmp_money = $rows['money'];
	        $tmp_win = $rows['win'];
	        $tmp_uid = $rows['uid'];
	        
	        $temp_will_win = $tmp_odds*$tmp_money;
	        $tmp_id = $rows['id'];
	        $sql2 = "update c_bet set js=0, win='$temp_will_win' where id='$tmp_id'";
	        Db::query($sql2);
	        
	        $sql2 = "update k_user set money=money-$tmp_win where uid='$tmp_uid'";
	        Db::query($sql2);
	    }
	}
	
	public function jsdz($id){
	    
	}

    public function statistics(){
        $field = 'a.uid,a.username,';
        $field .= "sum(case when js=1 then b.money else 0 end) js,sum(case when commissioned=1 then commission else 0 end) ts,count(case when js=1 then 1 else null end) as js_cnt,";
        $field .= "sum(case when js=0 then b.money else 0 end) wjs,count(case when js=0 then 1 else null end) wjs_cnt,";
        $field .= "sum(b.money) bet_money,sum(win) win,count(*) cnt, sum(b.money-win) as profit";
        $where = [];
        $order = input('order');
        if(!$order){
            $order = 'a.uid';
        }
        $sdate = \input('sdate');
        if(!$sdate){
            $stime = date('Y-m-d 00:00:00');
        }else{
            $stime = $sdate;
        }
        $edate = \input('edate');
        if(!$edate){
            $etime = date('Y-m-d H:i:s');
        }else{
            $etime = $edate.' 23:59:59';
        }
        $where['addtime'] = ['between', [$stime, $etime]];

        if($username = \input('username')){
            $where['a.username'] = $username;
        };
        if($type = \input('type')){
            $where['type'] = $type;
        };
        $list = Db::name('k_user a')->join('c_bet b','a.uid=b.uid')->field($field)->where($where)->order($order)->group('a.uid')->paginate(20);
        $sum = Db::name('c_bet')->field("sum(money) bet_money,sum(win) win,count(*) cnt, sum(money-win) as profit")->where($where)->find();
        //echo Db::name('k_user a')->getLastSql();
        $item = $list->items();
        $page_sum = [
            'bet_money' => 0,
            'win' => 0,
            'cnt' => 0,
            'profit' => 0,
        ];
        foreach ($item as &$value){
            $value['win'] = round($value['win'], 2);
            $value['profit'] = round($value['profit'], 2);

            $page_sum['bet_money'] += $value['bet_money'];
            $page_sum['win'] += $value['win'];
            $page_sum['cnt'] += $value['cnt'];
            $page_sum['profit'] += $value['profit'];

            $value['profit'] = $value['profit']>0?"<font color='green'>{$value['profit']}</font>":"<font color='red'>{$value['profit']}</font>";
        }
        $this->assign('page_sum', $page_sum);
        $this->assign("sum", $sum);
        $this->assign("list", $item);
        $this->assign("type", $type);
        $this->assign("order", $order);
        $this->assign("stime", $sdate);
        $this->assign("etime", $edate);
        $this->assign("username", $username);
        $this->assign("page", $list->appends(['type'=>$type,'sdate'=>$stime,'edate'=>$etime,'order'=>$order])->render());
        return $this->fetch();
    }
}

