<?php

namespace app\admin\controller;

use app\admin\Login;

use think\Db;

use think\Request;

use think\Config;

use think\Exception;

class money1 extends Login{

	public $bank = array(

		'1'=>array(

				'0'=>array(

					'card_bankName'=>'中国工商银行',

					'card_ID'=>'2019025101032771921',

					'card_userName'=>'邓海辉',

					'card_address'=>'广东省揭阳揭西棉湖支行',

				),

				'1'=>array(

					'card_bankName'=>'建设银行（支付宝）',

					'card_ID'=>'6227007100200005530',

					'card_userName'=>'罗欣悦',

					'card_address'=>'贵州省贵安支行',

				),

				'2'=>array(

					'card_bankName'=>'支付宝',

					'card_ID'=>'m13268065386@163.com',

					'card_userName'=>'北京中鸿世嘉商贸有限公司',

					'card_address'=>'',

				)

		)	

	);

	public function zhifu_api(){

	    date_default_timezone_set('PRC');
		$id = isset($_GET['id']) ? $_GET['id'] : '0';

		$page = isset($_GET['page']) ? $_GET['page'] : '1';

		$action = isset($_GET['action']) ? $_GET['action'] : '';

		if($id>0 && $action==''){

			$rs = Db::table('web_pay')

			->where(array('id'=>$id))

			->find();

			$this->assign('rs',$rs);

		}

		if($action=="add" && $id==0){

			$data['name'] =	$_POST["name"];

			$data['url'] =	$_POST["url"];

			$data['sid'] =	$_POST["sid"];

			$data['pass'] =	$_POST["pass"];

			$data['ok'] =	$_POST["ok"];

			Db::table('web_pay')

			->insert($data);

			message("支付接口添加成功！",url('money/zhifu_api'));

		}elseif($action=="edit" && $id>0){

			$data['name'] =	$_POST["name"];

			$data['url'] =	$_POST["url"];

			$data['sid'] =	$_POST["sid"];

			$data['pass'] =	$_POST["pass"];

			$data['ok'] =	$_POST["ok"];

			Db::table('web_pay')

			->where(array('id'=>$id))

			->update($data);

			message("支付接口修改成功！",url('money/zhifu_api'));

		}

		$count = Db::table('web_pay')

		->count();

		$rows = Db::table('web_pay')

		->order('id desc')

		->paginate(20,$count);

		$pages = $rows->render();

		

		$rs = isset($rs) ? $rs : null;

		

		$this->assign('rows',$rows);

		$this->assign('rs',$rs);

		$this->assign('id',$id);

		$this->assign('page',$page);

		$this->assign('pages', $pages);

		return $this->fetch('zhifu_api');

	}

	

	public function huikuan_api(){ 
	    date_default_timezone_set('PRC');
	    $action = $this->request->param('act');
	    $info = array();
	    $act = 'add';
	    if($action == 'edit'){
	        $id = $_REQUEST['id'];
	        $info = Db::table('huikuan_bank')->find($id);
	        $act = 'save';
	    }
	    if($action == 'add'){
	        $data['card_bankName'] = $this->request->param('card_bankName');
	        $data['card_ID'] = $this->request->param('card_ID');
	        $data['card_userName'] = $this->request->param('card_userName');
	        $data['card_address'] = $this->request->param('card_address');
	        $data['card_group'] = $this->request->param('card_group');
	        $data['card_logo'] = $this->request->param('card_logo');
	        $data['card_qrcode'] = $this->request->param('card_qrcode');
	        $data['card_msg'] = $this->request->param('card_msg');
	        Db::table('huikuan_bank')->insert($data);
	    }
	    if($action == 'save'){
	        $data['card_bankName'] = $this->request->param('card_bankName');
	        $data['card_ID'] = $this->request->param('card_ID');
	        $data['card_userName'] = $this->request->param('card_userName');
	        $data['card_address'] = $this->request->param('card_address');
	        $data['card_group'] = $this->request->param('card_group');
	        $data['card_logo'] = $this->request->param('card_logo');
	        $data['card_qrcode'] = $this->request->param('card_qrcode');
	        $data['card_msg'] = $this->request->param('card_msg');
	        $data['id'] = $this->request->param('id');
	        Db::table('huikuan_bank')->update($data);
	        $this->success("修改成功!");
	    }
	    $this->assign('info',$info);
	    $this->assign('act',$act);
	    if($action == 'del'){
	        $id = $this->request->param('id');
	        $gid = $this->request->param('gid');
	        Db::table('huikuan_bank')->where('id','eq',$id)->where('card_group','eq',$gid)->delete();
	    }
	    $group	=	array();
	    $count = Db::table('k_group')
	    ->count();
	    $rows = Db::table('k_group')
	    ->order('id desc')
	    ->paginate(10,$count);
	    
	    $pages = $rows->render();
	    foreach ($rows as $v){
	        $group[$v['id']] = $v['name'];
	    }
	    $cards = Db::table('huikuan_bank')->select();
	    $list = array();
	    foreach ($cards as $v){
	        $list[$v['card_group']]['cards'][] = $v;
	        $list[$v['card_group']]['name'] = $group[$v['card_group']];
	    }
	    $this->assign('group',$group);
	    $this->assign('list', $list);
	    return $this->fetch('huikuan_api');
	}

	public function upload(){
	    $file = $this->request->file('imgFile');
	    if($file){
	        $info = $file->validate(['ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
	        if($info){
	            // 成功上传后 获取上传信息
	            // 输出 jpg
	            //echo $info->getExtension();
	            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
	            //echo $info->getSaveName();
	            // 输出 42a79759f284b767dfcb2a0197904287.jpg
	            //echo $info->getFilename();
	            $url = 'http://www.99206a.com/'. 'uploads/'.$info->getSaveName();
	            echo json_encode(array('error'=>0,'url'=>$url));
	        }else{
	            // 上传失败获取错误信息
	            //echo $file->getError();
	            echo json_encode(array('error'=>1,'message'=>'上传错误!'));
	        }
	    }
	    exit();
	}

	public function zhifu(){
	    date_default_timezone_set('PRC');
	    $request = Request::instance();

	    $username = $request-> param('username') ? $request->param('username') : '';

	    $type = $request->param('type') ? $request->param('type') : '1,3,200';

	    $this->assign('type',$type);

	    $this->assign('username',$username);

	    $status = $request -> param('status') !== '' ? $request->param('status') : 2;

	    $order = $request -> param('order') ? $request->param('order') : 'm_id';

	    $where = [];

	    if($username){

	        $conf['username'] = $username;

	        $where['username'] = ['=',$username];

	    }

	    if($status < 3 ){

	        $where['status'] = ['=',$status];

	    }

	    $conf['type'] = $type;

	    if($type == 200 && $status == 1){

	        $where['about'] = ['like','%管理员结算%'];

	    }elseif($type == '1'){

	        $where['type'] = ['in','1,100'];

	        $where['about'] = ['notlike','%管理员结算%'];

	    }else{

	        $where['type'] = ['in',$type];

	    }

	    $conf['status'] = $status;

	    $stime = $request->param('sdate') ? $request->param('sdate') : '';

	    $etime = $request->param('edate') ? $request->param('edate') : '';

	    $this->assign('sdate',$stime);

	    $this->assign('edate',$etime);

	    if($stime){
	        $conf['sdate'] = $stime;
	        $stime = $stime .' 00:00:00';

	        //$where['m_make_time'] = ['>=',$stime];

	    }else{
	        $stime = date('Y-m-d 00:00:00');
	    }

	    if($etime){
	        $this->assign('etime',$etime);
	        $conf['edate'] = $etime;
	        $etime = $etime .' 23:59:59';
	        //$where .= " and m_make_time <= '$etime'";

	        //$where['m_make_time'] = ['<=',$etime];

	    }else{
	        $etime = date('Y-m-d 23:59:59');
	    }
	    $where['m_make_time'] = ['between',[$stime,$etime]];
	    $where['m_value'] = ['>',0];

	    $sum = Db::view('k_money a','m_id,m_order,m_value,sxf,m_make_time,about,status')

	    ->view('k_user b',['pay_name','username'],'a.uid = b.uid ')->where($where)->sum('a.m_value');

	    $sumzsjr = Db::view('k_money a','m_id,m_order,m_value,sxf,m_make_time,about,status')

	    ->view('k_user b',['pay_name','username'],'a.uid = b.uid ')->where($where)->sum('a.sxf');
	    $this->assign('sum',$sum);

	    $this->assign('sumzsjr',$sumzsjr);

	    $this->assign('currentsum','0');

	    $this->assign('currentzsjrsum','0');
	    $conf['order'] = $order;
	    Config::set('paginate.query',$conf);
	    $list = Db::view('k_money a','m_id,m_order,m_value,sxf,m_make_time,about,status')
	    ->view('k_user b',['pay_name','username'],'a.uid = b.uid ')->where($where)->order($order .' desc')->paginate(20);
	    $this -> assign('list',$list);
	    $this->assign('status', $status);
	    $this->assign('order', $order);
	    return $this->fetch('zhifu');
	}

	

	

	

	public function user(){

	    date_default_timezone_set('PRC');
	    $param = $this->request->param();

	    $action = $param['action'] ?? '';

	    if($action == 'save'){

	        $type = $param['type'];

	        $data['uid']	=	$param["uid"];

	        //$data['uname']	=	$param["username"];

	        $data['m_value']	=	floatval($param["m_value"]);

	        $data['about']	=	$param["about"];
	        $data['assets'] = Db::table('k_user')->where('uid','eq',$data['uid'])->field(['money'])->find()['money'];
	        $data['q_qian'] = $data['assets'];

	        if($type == ''){

	            $this->error('请选择操作类型!');

	        }

	        if($type < 10 || $type == 888 || $type == 200){

	            try{

    	            Db::startTrans();

    	            $data['balance'] = ($data['assets'] + $data['m_value']);

    	            $data['h_qian'] = ($data['assets'] + $data['m_value']);

    	            $data['status'] = 1;

    	            $data['m_order'] = 'RSJ'.date('YmdHis').rand(100,999);

    	            $data['type'] = $type;

    	            DB::table('k_money')->insert($data);

    	            Db::table('k_user')->where('uid','eq',$data['uid'])->update(['money'=>['exp','money+'.$data['m_value']]]);

    	            sys_log(Session('adminid'), "对用户ID".$data['uid']."的账户金额增加了".$data['m_value'].",理由".$data['about']);

    	            Db::commit();

    	            $this->success('加款成功!');

	            }catch (Exception $e){

	                Db::rollback();

	                $this->error('系统错误:'.$e->getMessage().'加款失败!');

	            }

	        }else{

	            try{

	                Db::startTrans();

	                $data['balance'] = $data['assets'] - $data['m_value'];

	                $data['h_qian'] = $data['assets'] - $data['m_value'];

	                $data['status'] = 2;

	                $data['m_order'] = 'KSJ'.date('YmdHis').rand(100,999);

	                $data['type'] = $type;

	                DB::table('k_money')->insert($data);

	                Db::table('k_user')->where('uid','eq',$data['uid'])->update(['money'=>['exp','money-'.$data['m_value']]]);

	                sys_log(Session('adminid'), "对用户ID".$data['uid']."的账户金额扣除了".$data['m_value'].",理由".$data['about']);

	                Db::commit();

	                $this->success('扣款成功!');

	            }catch (Exception $e){

	                Db::rollback();

	                $this->error('系统错误!'.$e->getMessage().'扣款失败!');

	            }

	        }

	    }

		$username = isset($_GET['username']) ? $_GET['username'] : '';

		if($username){

			$user = Db::table('k_user')

			->where(array('username'=>$username))

			->find();

		}

		$user = isset($user) ? $user: null;

		$this->assign('user',$user);

		$this->assign('username',$username);

		return $this->fetch('user');

	}

	

	public function huikuan(){
	    date_default_timezone_set('PRC');

		$request = Request::instance();

		$username = $request-> param('username') ? $request->param('username') : '';

		$this->assign('username',$username);

		$status = $request -> param('status') !== '' ? $request->param('status') : 0;

		$order = $request -> param('order') ? $request->param('order') : 'id';

		$where = '';

		$test = [];

		if($username){

		    $conf['username'] = $username;

		    //$where .= " and username='$username'";

		    $test['username'] = ['=',$username];

		}

		if($status < 3 ){

		    //$where .= ' and status='.$status;

		    $test['status'] = ['=',$status];

		}

		$conf['status'] = $status;

		$stime = $request->param('stime') ? $request->param('stime') : '';

		$etime = $request->param('etime') ? $request->param('etime') : '';

		$this->assign('stime',$stime);

		$this->assign('etime',$etime);

		if($stime){

		    $conf['stime'] = $stime;

		    $stime = $stime .' 00:00:00';

		    //$where .= " and adddate >= '$stime' ";

		}else{
		    $stime = date('Y-m-d 00:00:00'); 
		}
		

		if($etime){

		    $this->assign('etime',$etime);

		    $conf['etime'] = $etime;

		    $etime = $etime .' 23:59:59';

		    //$where .= " and adddate <= '$etime'";
		}else{
		    $etime = date('Y-m-d 23:59:59');
		}
		$test['adddate'] = ['between',[$stime,$etime]];
		
		$sum = Db::view('huikuan a','id,money,zsjr,adddate,bank,manner,address,lsh,status')

		->view('k_user b',['username'],'a.uid = b.uid ')->where($test)->sum('a.money');

		$sumzsjr = Db::view('huikuan a','id,money,zsjr,adddate,bank,manner,address,lsh,status')

		->view('k_user b',['username'],'a.uid = b.uid ')->where($test)->sum('a.zsjr');


		$this->assign('sum',$sum);

		$this->assign('sumzsjr',$sumzsjr);

		$this->assign('currentsum','0');

		$this->assign('currentzsjrsum','0');

		$conf['order'] = $order;

		Config::set('paginate.query',$conf);

		$list = Db::view('huikuan a','id,money,zsjr,adddate,bank,manner,address,lsh,status')

		->view('k_user b',['username'],'a.uid = b.uid ')->where($test)->order($order .' desc')->paginate(20);

		$this -> assign('list',$list);

		$this->assign('status', $status);

		$this->assign('order', $order);

		return $this->fetch('huikuan');

	}

	

	public function huikuan2(){

	    date_default_timezone_set('PRC');
		$action = $this->request->param('action');

		$temp = Db::table('web_config')

		->where(array('int'=>1))

		->find();

		$my_zengsong = $temp['zengsong'];

		if (empty($my_zengsong)) {

			$my_zengsong = 0;

		}

		if($action=="true"){

			if (!preg_match("/^[\d\.]+$/",$_POST["money"])) {

				message("汇款金额格式错误！");

			}

			if(date("I",time()+1*12*3600)){

				$lottery_time = time();

			}else{

				$lottery_time = time();

			}

			$money = (float)$_POST["money"];

			$username = trim($_POST["username"]);

			$bank = trim($_POST["bank"]);

			$date = date('Y-m-d H:i:s',$lottery_time);

			if ($money <= 0) {

				message("汇款金额必须大于0");

			}

			if (empty($username)) {

				message("用户名不能为空");

			}

			$zsjr = 0;

			if($_POST['is_zsjr']==1) {

				$zsjr = floor($_POST["hf_sxf"]);

			}

			$userinfo = Db::table('k_user')

			->where(array('username'=>$username))

			->find();

			if (empty($userinfo)) {

				message("用户名不存在");

			}

			$moneyTotal = $money + $zsjr;

			$balance = $userinfo['money'] + $moneyTotal;

			Db::startTrans();//开启事务

			try {

				$data['money'] = $moneyTotal;

				$data['status'] = 1;

				$data['zsjr'] = $zsjr;

				$data['balance'] = $balance;

				$data['uid'] = $userinfo['uid'];

				$data['date'] = $date;

				$data['adddate'] = $date;

				$data['manner'] = "管理员添加";

				$data['bank'] = $bank;

				Db::table('huikuan')

				->insert($data);

				$res['money'] = +$moneyTotal+$userinfo['money'];

				Db::table('k_user')

				->where(array('username'=>$username))

				->update($res);

				$log_msg = '为（'.$username.'）手动公司入款了（'.$moneyTotal.'）元';

				$rs['uid'] = $userinfo['uid'];

				$rs['log_info'] = $log_msg;

				$rs['log_ip'] = $this->request->ip();

				Db::connect(config('otherdb'))->table('sys_log')

				->insert($rs);

				Db::commit();  //事务成功

				message("充值成功",url("money/huikuan2"));

			}catch(Exception $e){

				Db::rollback();  //数据回滚

				$this->error('系统错误:'.$e->getMessage().'!充值失败!');

			}

		}

		

		$this->assign('my_zengsong',$my_zengsong);

		return $this->fetch('huikuan2');

	}

	

	public function huikuan_ok(){

	    $param = $this->request->param();

	    $action = $param['action'] ?? '';

	    if($action ){

	        $status = $param["hf_status"];

	        $id		= $param["hf_id"];

	        $sxf	= $param["hf_sxf"];

	        $zsjr	= 0;

	        $num	= 0;

	        if($_POST['is_zsjr']==1){ //赠送1%，最高45元

	            $zsjr	= floor($param["hf_sxf"]);

	        }

	        $msg	=	'失败';

	        if($status == "1"){

	            $sql	=	"update k_user,huikuan set k_user.money=k_user.money+huikuan.money+$zsjr,huikuan.status=1,zsjr=$zsjr,huikuan.money=huikuan.money+$zsjr,huikuan.balance=k_user.money+huikuan.money+$zsjr where k_user.uid=huikuan.uid and huikuan.id=$id and huikuan.`status`=0";

	            $msg	=	'成功';

	            $num	= 	2;

	        }else{

	            $sql	=	"update huikuan set `status`=2,balance=assets where id=$id and `status`=0";

	            $num	= 	1;

	        }

	        

	        Db::startTrans();

	        try{

	            $q1 = Db::execute($sql);

	            if($q1 == $num){

	                Db::commit(); //事务提交

	                sys_log(Session('adminid'),"审核了编号为".$id."的汇款单,".$msg);

	                $this->success('操作成功!');

	            }else{

	                Db::rollback(); //数据回滚

	                $this->error('操作失败!');

	            }

	        }catch(Exception $e){

	            Db::rollback(); //数据回滚

	            $this->error('由于系统问题:'.$e->getMessage().';操作失败!');

	        }

	    }

	    $id = $param['id'];

	    $rs = Db::table('huikuan_user')->where('id','eq',$id)->find();

	    $gid = $rs['gid'];

	    $my_zengsong = Db::table('k_group')->where('id','eq',$gid)->field(['rkyh'])->find()['rkyh'];

	    $this->assign('rs',$rs);

	    $this->assign('id',$id);

	    $this->assign('my_zengsong',$my_zengsong);

	    return $this->fetch();

	    

	}

    public function tikuan(){

        date_default_timezone_set('PRC');
        $request = request()->param();
        $status     = isset($request['status'])?$request['status']:3;
        $types      = !empty($request['types'])?$request['types']:'';
        $orders     = !empty($request['orders'])?$request['orders']:'';
        $start_time = !empty($request['start_time'])?$request['start_time']:'1970-10-1 00:00:00';
        $end_time   = !empty($request['end_time'])?$request['end_time']:date("Y-m-d H:i",time()) ;
        $username   = !empty($request['username'])?$request['username']:'';
        $statuArr = [
            ['name'=>'未处理','val'=>2],
            ['name'=>'提款失败','val'=>0],
            ['name'=>'提款成功','val'=>1],
            ['name'=>'全部提款','val'=>3],
        ];
        $typeArr = [
            ['name'=>'全部类型','val'=>'11,12,120,255,900'],
            ['name'=>'会员提款','val'=>'11,255,900'],
            ['name'=>'后台扣款','val'=>'120'],
        ];
        $orderArr = [
            ['name'=>'默认排序','val'=>'m_id'],
            ['name'=>'提款金额','val'=>'m_value'],
            ['name'=>'手续费','val'=>'sxf'],
        ];
        $where_key = [];
        $where_order = $where_type = $where_time = '';
        if (!empty($status)&&$status!=3||$status==0){
                $where_key['status'] = intval($request['status']);
            }
            if (!empty($types)&&$types!=$typeArr[0]['val']){
                $where_type = "type in ($types)";
            }
            if (!empty($orders)){
                $where_order = "$orders asc";
            }
            if (!empty($start_time)||!empty($end_time)){
                $where_time = "m_make_time > '$start_time' and m_make_time < '$end_time'";
            }
            if (!empty($request['username'])){
                $where_key['username'] = $request['username'];
            }
//        $money = db('k_money')->where($where_key)->where($where_type)->where($where_time)->getLastSql();
        $money = db('k_money')->where($where_key)->where($where_type)->where($where_time)->order($where_order)->paginate(10,false,['query'=>request()->param(),]);
            $page = $money->render();
            $sum = Db::view('k_money a','m_id,m_order,m_value,sxf,m_make_time,about,status')
                ->view('k_user b',['pay_name','username'],'a.uid = b.uid ')->where($where_key)->sum('a.m_value');

            $sumzsjr = Db::view('k_money a','m_id,m_order,m_value,sxf,m_make_time,about,status')
                ->view('k_user b',['pay_name','username'],'a.uid = b.uid ')->where($where_key)->sum('a.sxf');


            $this->assign('sum',$sum);
            $this->assign('sumzsjr',$sumzsjr);
            //返回get参数
            $this->assign('status',$status);
            $this->assign('types',$types);
            $this->assign('orders',$orders);
            $this->assign('start_time',$start_time);
            $this->assign('end_time',$end_time);
            $this->assign('username',$username);


            //返回所有参数
            $this->assign('statuArr',$statuArr);
            $this->assign('typeArr',$typeArr);
            $this->assign('orderArr',$orderArr);

            $this->assign('money',$money);
            $this->assign('page',$page);

            $this->assign('currentsum','0');
            $this->assign('currentzsjrsum','0');
            return $this->fetch('tikuan');
    }


    public function tikuan_bac(){

	    date_default_timezone_set('PRC');
		$request = Request::instance();

		$username = $request-> param('username') ? $request->param('username') : '';

		$type = $request->param('type')  ? $request->param('type') : '11,120,255';

		$this->assign('type',$type);

		$this->assign('username',$username);

		//$status = $request -> param('status') !== '' ? $request->param('status') : 2;
		$status = input('status') ?? 2;

		$order = $request -> param('order') ? $request->param('order') : 'm_id';

		$where = '';

		if($username){

		    $conf['username'] = $username;

		    $test['username'] = ['=',$username];

		}

		if($status < 3 ){

		    $test['status'] = $status;

		}

		$conf['type'] = $type; 

		$test['type'] = ['in',$type];

		$conf['status'] = $status;

		$stime = $request->param('stime') ? $request->param('stime') : '';

		$etime = $request->param('etime') ? $request->param('etime') : '';

		$this->assign('stime',$stime);

		$this->assign('etime',$etime);

		if($stime){

		    $conf['stime'] = $stime;

		    $stime = $stime .' 00:00:00';

		    //$test['m_make_time'] = ['>=',$stime];

		}else{
		    $stime = date('Y-m-d 00:00:00');
		}

		if($etime){

		    $this->assign('etime',$etime);

		    $conf['etime'] = $etime;

		    $etime = $etime .' 23:59:59';

		    //$test['m_make_time'] = ['<=',$etime];

		}else{
		    $etime = date('Y-m-d 23:59:59');
		}
		$test['m_make_time'] = ['between',[$stime,$etime]];

		$test['m_value'] = ['<',0];

		$sum = Db::view('k_money a','m_id,m_order,m_value,sxf,m_make_time,about,status')

		->view('k_user b',['pay_name','username'],'a.uid = b.uid ','left')->where($test)->sum('a.m_value');

		$sumzsjr = Db::view('k_money a','m_id,m_order,m_value,sxf,m_make_time,about,status')

		->view('k_user b',['pay_name','username'],'a.uid = b.uid ','left')->where($test)->sum('a.sxf');

		$this->assign('sum',sprintf('%.2f',$sum));

		$this->assign('sumzsjr',$sumzsjr);

		$this->assign('currentsum','0');

		$this->assign('currentzsjrsum','0');

		$conf['order'] = $order;

		Config::set('paginate.query',$conf);

		$list = Db::view('k_money a','m_id,m_order,m_value,sxf,m_make_time,about,status')

		->view('k_user b',['pay_name','username'],'a.uid = b.uid ','left')->where($test)->order($order .' desc')->paginate(20);

		$this -> assign('list',$list);

		$this->assign('status', $status);

		$this->assign('order', $order);

		return $this->fetch('tikuan');

	}

	

	public function tikuan_ok(){
	    Config::set('debug',true);
	    Config::set('trace',true);
	    date_default_timezone_set('PRC');
	    $param = $this->request->param();

	    $action = $param['action'] ?? '';

	    if($action == 'save'){

	        $m_order  =   $param["m_order"] ?? '';
	        $msg   =   '';
	        $num   =   '';

	        if($param['status'] == 1){

	            $sxf   = trim($param['sxf']);

	            $sql	=	"update k_money set `status`=1,update_time=now(),sxf=$sxf,about='结算成功' where `status`=2 and m_order='$m_order'";

	            $msg	=	"审核了编号为".$m_order."的提款单,已支付";

	            $num	=	1;

	            $userID = $param['uid'];

	            $username = $param["username"];

	            $start_Time = date('Y-m-d',time()) . " 00:00:00";

	            $end_Time = date('Y-m-d',time()) . " 23:59:59";

	            

	            $sql_m		=	"select sum(case when type=1 or type = 100 then m_value else 0 end) as ck,sum(case when type=2000 then m_value else 0 end) as zs,sum(case when type=3 then m_value else 0 end) as fs,sum(case when type=4000 then m_value else 0 end) as qt,sum(case when type=11 or type = 900 then m_value else 0 end) as qk,sum(case when type=120 then m_value else 0 end) as kk from k_money where uid=".$userID." and status=1";

	            $rs_m 		=	Db::query($sql_m)[0];

	            

	            $sql_h		=	"select sum(money) as hk from huikuan where uid=".$userID." and status=1";

	            $rs_h 		=	Db::query($sql_h)[0];

	            $cunkuan	=	round($rs_m['ck'] + $rs_h['hk'],2);

	            

	            $liushui_history = 0;

	            $sql_temp = "SELECT sum(`bet_money`) as total_bet_money FROM k_bet_cg_group where gid>0 and uid='$userID'";

	            $arr_temp 		=	Db::query($sql_temp)[0];

	            $liushui_history += $arr_temp['total_bet_money'];

	            

	            $sql_temp = "SELECT sum(`bet_money`) as total_bet_money from k_bet where lose_ok=1 and uid='$userID'";

	            $arr_temp 		=	Db::query($sql_temp)[0];

	            $liushui_history += $arr_temp['total_bet_money'];

	            

	            $sql_temp = "SELECT sum(`money`) as total_bet_money from c_bet_lt where money>0 and uid='$userID'";

	            $arr_temp 		=	Db::query($sql_temp)[0];

	            $liushui_history += $arr_temp['total_bet_money'];

	            

	            $sql_temp = "SELECT sum(`money`) as total_bet_money from c_bet where money>0 and uid='$userID'";

	            $arr_temp 		=	Db::query($sql_temp)[0];

	            $liushui_history += $arr_temp['total_bet_money'];

	            

	            $sql_temp = "SELECT sum(`putin`) as total_bet_money from table1 where username='$username'";

	            $arr_temp 		=	Db::query($sql_temp)[0];

	            $liushui_history += $arr_temp['total_bet_money'];

	            

	            $sql_temp = "select * from my_tongji where username='$username'";

	            $arr_temp = Db::query($sql_temp);

	            if (empty($arr_temp)) {

	                $sql_temp = "insert into my_tongji (`username`,`liushui`,`chongzhi`) values ('$username','$liushui_history','$cunkuan')";

	                Db::query($sql_temp);

	            } else {

	                $sql_temp = "update my_tongji set `liushui`='$liushui_history',`chongzhi`='$cunkuan' where `username`='$username'";

	                Db::query($sql_temp);

	            }

	        }elseif($param['status'] == 0){

	            if(strpos($_POST['m_order'],'代理额度')){ //代理申请额度失败，要把申请额度记录删除

	                $sql	=	"update k_money set `status`=0,update_time=now(),about='".$_POST["about"]."' where `status`=2 and m_order='$m_order'";

	                $num	=	1;

	            }else{ //会员正常取款失败，得还款到账户上

	                $sql	=	"update k_money,k_user set k_money.status=0,k_money.update_time=now(),k_money.about='".$_POST["about"]."',k_user.money=k_user.money-k_money.m_value,k_money.balance=k_user.money-k_money.m_value where k_user.uid=k_money.uid and k_money.status=2 and k_money.m_order='$m_order'";

	                $num	=	2;

	                $msg	=	"审核了编号为".$m_order."的提款单,未支付,原因".$_POST["about"];

	            }

	        }else{

	            $this->error('操作无效!');

	        }

	        Db::startTrans();

	        try{

	            $bool	=	true; //默认删除代理提款申请成功

	            $q1		=	Db::execute($sql);

	            if($param["status"] == 0){ //得判断一下

	                if(strpos($param['m_order'],'代理额度')){ //代理申请额度失败，要把申请额度记录删除

	                    $sql	=	"delete from k_user_daili_result where uid=".$_POST['uid']." and `type`=2 and month like('".date("Y-m",time())."%')";

	                    $q2		=	Db::query($sql);

	                    if($q2 != 1) $bool	=	false; //删除失败

	                }

	            }

	            if($q1 == $num && $bool){

	                Db::commit();

	                if($num==2 && $_POST["about"]!=""){

	                    $umsg = new \app\model\msg();

	                    $umsg->msg_add($_POST['uid'],'结算中心',$_POST['title'],$_POST["about"]);

	                }

	                sys_log(Session("adminid"),$msg);

	                $this->success('操作成功!');

	            }else{

	                Db::rollback();

	                $this->success('操作失败!');

	            }

	        }catch(Exception $e){

	            var_dump(db()->getLastSql());
	            Db::rollback(); //数据回滚
	            
	            $this->error('系统错误:'.$e->getMessage().'!操作失败!');

	        }

	    }

	    $info = Db::view('k_money m','*')->view('k_user u',['username','pay_name'],'m.uid = u.uid')->where('m.m_order','eq',$this->request->param('order'))->find();

	    $this->assign('rows',$info);

	    return $this -> fetch();

	}

}



