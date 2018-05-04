<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Db;
use think\Cache;
use think\Request;
class config extends Login{
	public $adminquanxian = array(
        array('en'=>'config','cn'=>'常规设置'),
        array('en'=>'user','cn'=>'会员管理'),
        array('en'=>'money','cn'=>'财务管理'),
        array('en'=>'agent','cn'=>'代理管理'),
        array('en'=>'sports','cn'=>'体育管理'),
        array('en'=>'lottery','cn'=>'彩票管理'),
        array('en'=>'data','cn'=>'数据管理'),
        array('en'=>'log','cn'=>'日志管理'),
        array('en'=>'manage','cn'=>'管理员管理'),
        array('en'=>'banner','cn'=>'轮播图管理'),
	);
	public function banner(){
        $type = input('type/d', 1);
	    if($this->request->isPost()){
	        $data = $this->request->param();
	        if($id = $this->request->get('id/d')){
                db("banner")->where("id",$id)->update($data);
            }else{
                db("banner")->insert($data);
            }
        }else if($id = $this->request->get('id/d')){
	        if(input('act/s') == 'del'){
                db("banner")->where("id",$id)->delete();
            }else{
	            $info = db("banner")->where("id",$id)->find();
                $this->assign('info', $info);
            }
        }
	    $data = db("banner")->where("type", $type)->select();
        $this->assign('type', $type);
	    $this->assign('list', $data);
	    return $this->fetch();
    }
    public function fengpan(){
    	if (isset($_POST['set_submit'])) {
    		$nameArr = array();
    		foreach ($_POST as $key => $value) {
    			if (preg_match("/(.+?)_reason/",$key,$match)) {
    				$nameArr[] = $match[1];
    			}
    		}
    		foreach ($nameArr as $key => $value) {
    			$tempName = $value;
    			$tempReason = isset($_POST[$value.'_reason']) ? $_POST[$value.'_reason'] : '';
    			$tempClose = isset($_POST[$value.'_is_close']) ? $_POST[$value.'_is_close'] : '';
    			if (!empty($tempClose)) {
    				$tempClose = 1;
    			} else {
    				$tempClose = 0;
    			}
    			$data = array(
    				'weihu'=>$tempClose,
    				'reason'=>$tempReason,
    			);
    			Db::table('k_fengpan')->where(array('name'=>$tempName))->update($data);
    		}
    		$lottery_close = Db::table('fengpan')->select();
    		cache('lotteryConfig',$lottery_close);
    		//var_dump(cache('lotteryConfig'));
    	}
    	
    	$setArr = Db::table('fengpan')->select();
    	$this->assign('setArr',$setArr);
    	return $this->fetch('index');
    }
    
    public function base(){
    	if (isset($_POST['set_submit'])) {
    		$data = array(
    			'web_name'=>$_POST["web_name"],
    			'pic_url'=>$_POST["pic_url"],
    			'close'=>$_POST["close"],
    			'zrclose'=>$_POST["zrclose"],
    			'vipclose'=>$_POST["vipclose"],
    			'bbclose'=>$_POST["bbclose"],
    			'xtdclose'=>$_POST["xtdclose"],
    			'why'=>$_POST["why"],
    			'reg_msg_title'=>$_POST["reg_msg_title"],
    			'reg_msg_info'=>$_POST["reg_msg_info"],
    			'reg_msg_from'=>$_POST["reg_msg_from"],
    			'agents'=>$_POST["agents"],
    			'ds_sp'=>$_POST["ds_sp"],
    			'ds_xp'=>$_POST["ds_xp"],
    			'dx_sp'=>$_POST["dx_sp"],
    			'dx_xp'=>$_POST["dx_xp"],
    			'reg_ip'=>$_POST["reg_ip"],
    			'reg_name'=>$_POST["reg_name"],
    			'reg_tel'=>$_POST["reg_tel"],
    			'reg_mail'=>$_POST["reg_mail"],
    			'feixin'=>$_POST["feixin"],
    			'mobile'=>$_POST["mobile"],
    			'fxpass'=>$_POST["fxpass"],
    		);
    		Db::table('web_config')
    		->where(array('int'=>1))
    		->update($data);	
    		$sysConfig = Db::table('web_config')->find();
    		Cache::set('sysConfig',$sysConfig);
    	}
    	$base = Cache::get('sysConfig');
    	if($base==''){
    		$base = Db::table('web_config')->find();
    	}
    	$this->assign('base',$base);
    	return $this->fetch('base');
    }
    
    public function noticle($type = 0){
    	$page = isset($_GET['page']) ? $_GET['page'] : '1';
    	$action = isset($_GET['action']) ? $_GET['action'] : '';
    	$nid = isset($_GET['nid']) ? $_GET['nid'] : '0';
    	if($action){
    		if($action=='add' && $nid==0){
    			$data['msg'] = $_POST["msg"];
    			$data['end_time'] = $_POST["end_time"];
    			$data['is_show'] = $_POST["is_show"];
    			$data['is_class'] =	$_POST["is_class"];
    			$data['sort'] =	$_POST["sort"];
    			Db::table('k_notice')
    			->insert($data);
    		}
    		if($nid>0 && $action=='edit'){
    			$res['msg'] = $_POST["msg"];
    			$res['end_time'] = $_POST["end_time"];
    			$res['is_show'] = $_POST["is_show"];
    			$res['is_class'] =	$_POST["is_class"];
    			$res['sort'] =	$_POST["sort"];
    			Db::table('k_notice')
    			->where(array('nid'=>$nid))
    			->update($res);
    		}
    		if($nid>0 && $action=='delete'){
    			Db::table('k_notice')
    			->where(array('nid'=>$nid))
    			->delete();
    		}
    	}
    	
    	if($nid>0 && !isset($_GET['action'])){
    		$rs = Db::table('k_notice')
    		->where(array('nid'=>$nid))
    		->find();
    	}

    	$rs = isset($rs) ? $rs: null;
    	$count = Db::table('k_notice')->where(array('is_class'=>$type))->count();
    	$noticle = Db::table('k_notice')
    	->where(array('is_class'=>$type))
    	->order('sort desc,nid desc')
    	->paginate(20,$count);
    	$pages = $noticle->render();
    	$this->assign('noticle',$noticle);
    	$this->assign('rs',$rs);
    	$this->assign('type',$type);
    	$this->assign('nid',$nid);
    	$this->assign('page',$page);
    	$this->assign('pages',$pages);
    	return $this->fetch('noticle');
    }
    
    public function aboutus(){
    	$id = isset($_GET['id']) ? $_GET['id'] : '1';
    	$action = isset($_GET['action']) ? $_GET['action'] : '';
    	$aboutus = Db::table('web_about')
    	->where(array('id'=>$id))
    	->find();
    	if($action=='save'){
    		$data = array(
    			'content'=>$_POST["content"]
    		);
    		Db::startTrans();//开启事务
    		try{
    			$res = Db::table('web_about')
    			->where(array('id'=>$id))
    			->update($data);
    			Db::commit();  //事务成功    
    			message("保存成功","/index.php/config/aboutus?id=$id");
    		}catch(Exception $e){
    			Db::rollback();  //数据回滚
    		}
    	}
    	$this->assign('aboutus',$aboutus);
    	$this->assign('id',$id);
    	return $this->fetch('aboutus');
    }
    
    public function pingbi(){
    	$action = isset($_GET['action']) ? $_GET['action'] : '';
    	if($action == 'save'){
    	    $dqxz = Cache::get('dqxz');
    	    $str = array_unique(explode(',', trim($_POST['dq'],',')));
    		if($dqxz){
    		    $dqxz = array_unique(array_merge($dqxz,$str));
    		    Cache::set('dqxz',$dqxz);
    		}else{
    		    if($str){
    		        $dqxz = $str ;
    		        Cache::set('dqxz',$dqxz);
    		    }
    		}
    	}
    	if($action == 'del'){
    		$id = $_GET['id'];
    		$dqxz = Cache::get('dqxz');
    		unset($dqxz[$id]);
    		$dqxz = Cache::set('dqxz',$dqxz);
    	}
    	$dqxz = Cache::get('dqxz');
    	$this->assign('dqxz',$dqxz);
    	return $this->fetch('pingbi');
    }
    
    public function pingbi_ip(){
    	$action = isset($_GET['action']) ? $_GET['action'] : '';
    	if($action == 'save'){
    		$ipxz = Cache::get('ipxz');
    		$str = array_unique(explode(',',trim($_POST['dq'],',')));
    		if($ipxz){
    		    $ipxz = array_unique(array_merge($ipxz,$str));
    		    $ipxz = Cache::set('ipxz',$ipxz);
    		}else{
    		    if($str){
    		        $ipxz = $str;
    		        $ipxz = Cache::set('ipxz',$ipxz);
    		    }
    		}
    	}
    	if($action == 'del'){
    		$id = $_GET['id'];
    		$ipxz = Cache::get('ipxz');
    		unset($ipxz[$id]);
    		$ipxz = Cache::set('ipxz',$ipxz);
    	}
    	$ipxz = Cache::get('ipxz');
    	$this->assign('ipxz',$ipxz);
    	return $this->fetch('pingbi_ip');
    }
    
    public function manage(){
        Session("login_name",'admin'); // 测试
    	$action = isset($_GET['action']) ? $_GET['action'] : '';
    	$sysadmin =  Db::connect('otherdb')->table('sys_admin')
    	->order('uid desc')
    	->select();
    	$id = isset($_GET['id']) ? $_GET['id'] : '';
    	if($id && $action  == 'del'){
    		Db::connect('otherdb')->table('sys_admin')
    		->where(array('uid'=>$id))
    		->delete();
    	}
    	if($id && $action == 'out'){
    		$data = array(
    			'is_login'=>0,
    			'yz'=>'logout',
    		);
    		Db::connect('otherdb')->table('sys_admin')
    		->where(array('uid'=>$id))
    		->update($data);
    	}
    	$adminquanxian = $this->adminquanxian;
    	$this->assign('login_name',Session("login_name"));
    	$this->assign('adminquanxian',$adminquanxian);
    	$this->assign('sysadmin',$sysadmin);
    	return $this->fetch('manage');
    }
    
    public function manage_edit(){
    	$id = isset($_GET['id']) ? $_GET['id'] : '';
    	$action = isset($_GET['action']) ? $_GET['action'] : '';
    	if($action == 'save'){
    	    $data['quanxian'] = implode(',',$_POST['quanxian']);
    	    $data['about'] = trim($_POST['about']);
    	    $data['ip'] = trim($_POST['ip']);
    	    $data['address'] = trim($_POST['address']);
    	    Db::connect('otherdb')->table('sys_admin')
    	    ->where(array('uid'=>$id))
    	    ->update($data);
    	}
    	$sysadmin =  Db::connect('otherdb')->table('sys_admin')
    	->where(array('uid'=>$id))
    	->find();
    	
    	$myquanxian = explode(',',$sysadmin['quanxian']);
    	$this->assign('quanxian',$myquanxian);
    	$adminquanxian = $this->adminquanxian;
    	$this->assign('sysadmin',$sysadmin);
    	$this->assign('adminquanxian',$adminquanxian);
    	return $this->fetch('manage_edit');
    }
    
    public function pass(){
    	$id = isset($_GET['id']) ? $_GET['id'] : '';
    	$action = isset($_GET['action']) ? $_GET['action'] : '';
    	$sysadmin =  Db::connect('otherdb')->table('sys_admin')
    	->where(array('uid'=>$id))
    	->find();
    	if($action == 'save'){
    		$data['login_pwd'] = md5($_POST['password']);
    		Db::connect('otherdb')->table('sys_admin')
    		->where(array('uid'=>$id))
    		->update($data);
    		$res['uid'] = Session("adminid");
    		$res['log_info'] = "修改了管理员ID为".$id."的密码";
    		$res['log_ip'] = $request->ip();
    		Db::connect('otherdb')->table('sys_log')
    		->insert($res);
    		message("修改成功","/index.php/config/pass?action=save&id=$id");
    	}
    	$this->assign('sysadmin',$sysadmin);
    	return $this->fetch('pass');
    }
    
    public function addmanage(){
    	$action = isset($_GET['action']) ? $_GET['action'] : '';
    	if($action == 'save'){
    	    $data['login_name'] = trim($_POST['login_name']);
    	    $info = Db::connect('otherdb')->table('sys_admin')->where('login_name','eq',$data['login_name'])->find();
    	    if($info){
    	        $this->error('此管理员已经存在!');
    	    }
    		$data['quanxian'] = " ".implode(',',$_POST['quanxian']);
    		$data['ip'] = trim($_POST['ip']);
    		$data['login_pwd'] = md5($_POST['login_pwd']);
    		$data['about'] = trim($_POST['about']);
    		$data['address'] = trim($_POST['address']);
    		Db::connect('otherdb')->table('sys_admin')
    		->insert($data);
    		$res['uid'] = Session("adminid");
    		$res['log_info'] ="添加了后台管理员 ".$_POST['login_name'];
    		$res['log_ip'] = $this->request->ip();
    		Db::connect('otherdb')->table('sys_log')
    		->insert($res);
    		message("修改成功","/index.php/config/manage");
    	}
    	$adminquanxian = $this->adminquanxian;
    	$this->assign('adminquanxian',$adminquanxian);
    	return $this->fetch('addmanage');
    }
    
    public function tycaiji(){
    	if (isset($_POST['set_submit'])) {
    		$idArr = array();
    		foreach ($_POST as $key => $value) {
    			if (preg_match("/id_(\d+)/",$key,$match)) {
    				$idArr[] = $match[1];
    			}
    		}
     		foreach ($idArr as $key => $value) {
    			$tempID = $value;
    			$tempWangzhi = isset($_POST['wangzhi_'.$value]) ? $_POST['wangzhi_'.$value]: '';
    			$tempZhanghao = isset($_POST['zhanghao_'.$value]) ? $_POST['wangzhi_'.$value]: '';
    			$tempMima = isset($_POST['mima_'.$value]) ? $_POST['mima_'.$value]: '';
    			$data['wangzhi'] = $tempWangzhi;
    			$data['zhanghao'] = $tempZhanghao;
    			$data['mima'] = $tempMima;
    			Db::table('wangzhi_manage')
    			->where(array('id'=>$tempID))
    			->update($data);
    		} 
    	}
    	$setArr = Db::table('wangzhi_manage')
    	->select();
    	$this->assign('setArr',$setArr);
    	return $this->fetch('tycaiji');
    }
    
    public function tanchuang(){
    	$id = isset($_GET['id']) ? $_GET['id'] : '1';
    	$action = isset($_GET['action']) ? $_GET['action'] : '';
    	if($action=="save"){
    		$show = intval($_POST['show'] ?? '');
    		$content = stripslashes($_POST["content"]);
    		$data = array(
    			'content'=>	$content,
    			'show'=>$show
    		);
    		Db::startTrans();//开启事务
    		try {
    			Db::table('web_tc')
    			->where(array('id'=>1))
    			->update($data);
    			Db::commit();  //事务成功
    			message("保存成功","/config/tanchuang");
    		}catch(Exception $e){
    			Db::rollback();  //数据回滚
    		}
    	}
    	$webtc = Db::table('web_tc')
    	->where(array('id'=>1))
    	->find();
    	Cache::set('content', $webtc);
    	$this->assign('id',$id);
    	$this->assign('webtc',$webtc);
    	return $this->fetch('tanchuang');
    }
    
    public function mg_edit(){
    	$id = isset($_GET['id']) ? $_GET['id'] : '0';
    	$page = isset($_GET['page']) ? $_GET['page'] : '1';
    	$action = isset($_GET['action']) ? $_GET['action'] : '';
    	if($action=="edit" && $id>0){
    		$data['platform'] =	$_POST["platform"];
    		$data['gamename'] =	$_POST["gamename"];
    		$data['gameid'] =	$_POST["gameid"];
    		$data['gameid2'] =	$_POST["gameid2"];
    		$data['imageurl'] =   $_POST["imageurl"];
    		$data['gametype'] =	$_POST["gametype"];
    		$data['ishot'] =	$_POST["ishot"];
    		$data['isnew'] =	$_POST["isnew"];
    		Db::table('dzyx')
    		->where(array('id'=>$id))
    		->update($data);
    		message("游戏修改成功！","/index.php/config/mg_addgame");
    	}
    	$game = Db::table('dzyx')
    	->where(array('id'=>$id))
    	->find();
    	$this->assign('game',$game);
    	$this->assign('page',$page);
    	$this->assign('id',$id);
    	return $this->fetch('mg_edit');
    }
    
    public function mg_addgame(){
    	$id = isset($_GET['id']) ? $_GET['id'] : '0';
    	$page = isset($_GET['page']) ? $_GET['page'] : '1';
    	$action = isset($_GET['action']) ? $_GET['action'] : '';
    	$where = '1=1';
    	if(isset($_GET["likevalue"])){
    		$where  = $_GET['selecttype']." like '%".$_GET['likevalue']."%'";
    	}
    	
    	if($action=="add" && $id==0){
    		$data['platform'] =	$_POST["platform"];
    		$data['gamename'] =	$_POST["gamename"];
    		$data['gameid'] =	$_POST["gameid"];
    		$data['gameid2'] =	$_POST["gameid2"];
    		$data['imageurl'] =   $_POST["imageurl"];
    		$data['gametype'] =	$_POST["gametype"];
    		$data['ishot'] =	$_POST["ishot"];
    		$data['isnew'] =	$_POST["isnew"];
    		if($data['platform']==''){
    			message("平台类型不能为空！","/index.php/config/mg_addgame");
    			return;
    		}
    		Db::table('dzyx')
    		->insert($data);
    		message("游戏添加成功！","/index.php/config/mg_addgame");
    	}elseif($action=="del" && $id>0){
    		Db::table('dzyx')
    		->where(array('id'=>$id))
    		->delete();
    		message("游戏删除成功！","/index.php/config/mg_addgame");
    	}
    	
    	$count = Db::table('dzyx')
    	->where($where)
    	->count();
    	$game = Db::table('dzyx')
    	->where($where)
    	->order('ishot desc,id desc')
    	->paginate(10,$count);
    	$pages = $game->render();
    	
    	$this->assign('id',$id);
    	$this->assign('page',$page);
    	$this->assign('game',$game);
    	$this->assign('pages',$pages);
    	return $this->fetch('mg_addgame');
    }

    /**
     * pc-优惠管理
     */
    public function  pc_discount()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : '1';
        //读取数据
        $data = $this->getDiscountData(0) ;
        //读取待编辑数据
        $info = $this->getDiscountEdit();
        //渲染分页
        $pages = $data->render();
        //传参
        $this->assign('data',$data);
        $this->assign('info',$info);
        $this->assign('page',$page);
        $this->assign('pages',$pages);
        return $this->fetch('pc_discount');
    }

    /**
     * 手机-优惠管理
     */
    public function  m_discount()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : '1';
        //读取数据
        $data = $this->getDiscountData(1) ;
        //读取待编辑数据
        $info = $this->getDiscountEdit();
        //渲染分页
        $pages = $data->render();
        //传参
        $this->assign('data',$data);
        $this->assign('info',$info);
        $this->assign('page',$page);
        $this->assign('pages',$pages);
        return $this->fetch('m_discount');
    }

    /**
     * 新增优惠管理
     */
    public function add_discount()
    {
       $func = (isset($_REQUEST['func']) && !empty($_REQUEST['func'])) ? $_REQUEST['func'] : '' ;
       $act  = (isset($_REQUEST['act']) && !empty($_REQUEST['act'])) ? $_REQUEST['act'] : '' ;

       if (isset($_POST['func'])) {  unset($_POST['func']); } //移动端还是PC端处理
       if (isset($_POST['act'])) {  unset($_POST['act']); } // 新增还是修改
       if (empty($_POST['id'])) {unset($_POST['id']);} //如果ID为空 那么删除这个字段

       if ( $_SERVER['REQUEST_METHOD'] =='POST') {
           $params = $_POST ;
           if ($act=='edit') {
                //修改处理
               if (db("web_hot")->update($params)) {
                   message("优惠信息修改成功！","/index.php/config/".$func.'?id='.$params['id'].'&act=edit');
               } else {
                   message("优惠信息修改失败！","/index.php/config/".$func.'?id='.$params['id'].'&act=edit');
               }
           } elseif($act=='add') {
               //新增处理
               $params['addtime'] =  date('Y-m-d H:i:s',time()) ;
               if (db("web_hot")->insert($params)) {
                   message("优惠信息添加成功！","/index.php/config/".$func);
               } else {
                   message("优惠信息添加失败！","/index.php/config/".$func);
               }
           }
       }
    }

    /**
     *  删除优惠活动
     */
    public function del_discount()
    {
        $id   = (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) ? $_REQUEST['id'] : $_REQUEST['id'] ;
        $func = (isset($_REQUEST['func']) && !empty($_REQUEST['func'])) ? $_REQUEST['func'] : '' ;
        if ($id) {
            if ( db('web_hot')->where('id','eq',$id)->delete() ){
                message("优惠信息删除成功！","/index.php/config/".$func);
            } else {
                message("优惠信息删除失败！","/index.php/config/".$func);
            }
        }
    }

    //获取待编辑数据
    private  function getDiscountEdit()
    {
        $id  =  (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) ? $_REQUEST['id'] : '' ;
        $data= [] ;
        if ($id) {
            $data = Db::table('web_hot')->find($id);
        } else {
            //如果没有数据,这里定义出数据格式,方便前端展示,减少前端判断
            $data = [
                'id' =>'',
                'title' =>'',
                'img' =>'',
                'url' =>'',
                'content' =>'',
                'addtime' =>'',
                'overdate' =>'',
                'sort' =>'',
                'ok' =>'',
                'ismobile' =>'',
            ] ;
        }
        return $data ;
    }

    /**
     * 获取优惠数据
     * @param int $ismobile 查询PC端数据,还是移动端数据
     * @param int $page
     * @return \think\Paginator
     */
    private  function getDiscountData($ismobile=0)
    {
        $record = 10 ; //每页多少条
        $count = Db::table('web_hot')->where('ismobile','eq',$ismobile)->count(); //获取总条数
        $pages = Db::table('web_hot')->where('ismobile','eq',$ismobile)->order('sort DESC')
            ->paginate($record,$count);;
        return $pages ;
    }




    
}




