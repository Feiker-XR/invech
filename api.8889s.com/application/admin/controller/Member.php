<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Db;
class member extends Login{
	public $vipArr = array(
			array('vip'=>'9','money'=>'10000'),
			array('vip'=>'8','money'=>'8000'),
			array('vip'=>'7','money'=>'5000'),
			array('vip'=>'6','money'=>'2000'),
			array('vip'=>'5','money'=>'880'),
			array('vip'=>'4','money'=>'380'),
			array('vip'=>'3','money'=>'200'),
			array('vip'=>'2','money'=>'100'),
			array('vip'=>'1','money'=>'8.8'),
	);
  
	public function ti($uid){
	    db('k_user')->where('uid','eq',$uid)->field('session_id')->find();
	    $rows = DB::table('k_user') ->where('uid','eq',$uid)->update(array('session_id'=>''));
	    if($rows){
	        echo "<script>alert('踢线成功!');history.go(-1);</script>";
	    }else{
	        echo "<script>alert('踢线失败!');history.go(-1);</script>";
	    }
	}
  
	public function vip_add_money(){
		$_SESSION['my_login_in'] = 1; 
		if (isset($_POST['my_login_in'])) {
			if ($_POST['password'] == 'fahai158') {
				$_SESSION['my_login_in'] = 1;
			}
		}
		if (isset($_POST['ajax'])) {
			$user = Db::table('k_user')
			->select();
			foreach ($user as $v){
				$userID = $v['uid'];
				$money = $this->judge_vip($v['vip']);
				if ($money > 0) {
					$data['money'] = +$money+$v['money'];
					$qiandao_set = Db::table('k_user')
					->where(array('uid'=>$userID))
					->update($data);
					$msg = '尊敬的VIP用户，每月好运金'.$money.'元已经添加到您的账户中！';
					$msg_time = date("Y-m-d H:i:s");
					$res['msg_from'] = "系统";
					$res['uid'] = $userID;
					$res['msg_title'] = "每月好运金";
					$res['msg_info'] = $msg;
					$res['msg_time'] = $msg_time;
					Db::table('k_user_msg')->insert($res);
					
					$about = '每月好运金奖励[管理员结算]';
					$rs['uid'] = $userID;
					$rs['m_value'] = $money;
					$rs['status'] = 1;
					$rs['m_make_time'] = $msg_time;
					$rs['about'] = $about;
					$rs['type'] = 1;
					Db::table('k_money')->insert($rs);
				}
			}
			echo 'ok';
			exit;
		}
		$this->assign('my_login_in',Session('my_login_in'));
		return $this->fetch('vip_add_money');
	}
	
	
	public function hecha(){
	    $param = $this->request->param();
	    $action = $param['action'] ?? '';
	    if($action == 'save'){
	        $sql = "Update k_user Set money=".$param['money']." Where uid=".$param['uid'];
	        Db::query($sql);
	        $this->success('会员资金修复成功!');	        
	    }
	    if($action == 'jian'){
	        if($param['money'] <= 0){
	            $this->error('无需进行操作!');
	        }else{
	            $sql ="Update k_user Set money=money-".$param['money']." Where uid=".$param['uid'];
	            Db::query($sql);
	            $this->success('扣除成功!');
	        }
	    }
	    $finalArr = array();
	    $user_exists = false;
	    $username = $param['username'] ?? '';
	    if($username){
	        $sql	=	"select uid,username,money from k_user where username='".$username."' limit 1";
	        $rows = Db::query($sql);
	        if($rows){
	            $rows = $rows[0];
	            $last_ag = 0;
	            $last_bbin = 0;
	            $user_exists = true;
	            $hechaArr = array();
	            //开始统计会员存款、赠送、反水、其他入款、扣款、取款总计
	            $sql_m		=	"select sum(case when type=1 or type = 100 then m_value else 0 end) as ck,sum(case when type=2000 then m_value else 0 end) as zs,sum(case when type=3 then m_value else 0 end) as fs,sum(case when type=4000 then m_value else 0 end) as qt,sum(case when type=11 or type=255 then m_value else 0 end) as qk,sum(case when type=120 then m_value else 0 end) as kk from k_money where uid=".$rows["uid"]." and status=1";
	            $rs_m 		=	Db::query($sql_m)[0];
	            //开始统计会员汇款总计
	            $sql_h		=	"select sum(money) as hk,sum(money-zsjr) as hk2,sum(zsjr) as hk3 from huikuan where uid=".$rows["uid"]." and status=1";
	            $rs_h 		=	Db::query($sql_h)[0];
	            $cunkuan	=	round($rs_m['ck'] + $rs_h['hk'],2);
	            $qukuan		=	round($rs_m['qk'] + $rs_m['kk'],2);
	            $zengsong	=	round($rs_m['zs'] + $rs_m['fs'] + $rs_m['qt'],2);
	            
	            
	            $cunkuan2	=	round($rs_m['ck'] + $rs_h['hk2'],2);
	            $cunkuan3	=	round($rs_h['hk3'],2);
	            	            
	            // 12 13 14 111
	            $sql_zr		=	"select sum(amount) as money from zz_info where uid=".$rows["uid"]." and type in ('12','13','14','111') and status=1";
	            $rs_zr 		=	Db::query($sql_zr)[0];
	            $zhuanru	=	round($rs_zr['money'],2);
	            
	            // 22 23 24 211
	            $sql_zc		=	"select sum(amount) as money from zz_info where uid=".$rows["uid"]." and type in ('22','23','24','211') and status=1";
	            $rs_zc 		=	Db::query($sql_zc)[0];
	            $zhuanchu	=	round($rs_zc['money'],2);
	            
	            
	            $userID = $rows["uid"];
	            $username = $_GET["username"];
	            $start_Time = date('Y-m-d',time()) . " 00:00:00";
	            $end_Time = date('Y-m-d',time()) . " 23:59:59";
	            
	            $liushui_today = 0;
	            $sql_temp = "SELECT sum(`bet_money`) as total_bet_money FROM k_bet_cg_group where gid>0 and uid='$userID' and bet_time>='$start_Time' and bet_time<='$end_Time'";
	            $arr_temp 		=	Db::query($sql_temp)[0];
	            $liushui_today += $arr_temp['total_bet_money'];
	            
	            $sql_temp = "SELECT sum(`bet_money`) as total_bet_money from k_bet where lose_ok=1 and uid='$userID' and bet_time>='$start_Time' and bet_time<='$end_Time'";
	            $arr_temp 		=	Db::query($sql_temp)[0];
	            $liushui_today += $arr_temp['total_bet_money'];
	            
	            $sql_temp = "SELECT sum(`money`) as total_bet_money from c_bet_lt where money>0 and uid='$userID' and addtime>='$start_Time' and addtime<='$end_Time'";
	            $arr_temp 		=	Db::query($sql_temp)[0];
	            $liushui_today += $arr_temp['total_bet_money'];
	            
	            $sql_temp = "SELECT sum(`money`) as total_bet_money from c_bet where money>0 and uid='$userID' and addtime>='$start_Time' and addtime<='$end_Time'";
	            $arr_temp 		=	Db::query($sql_temp)[0];
	            $liushui_today += $arr_temp['total_bet_money'];
	            
	            $sql_temp = "SELECT sum(`putin`) as total_bet_money from table1 where username='$username' and date_time>='$start_Time' and date_time<='$end_Time'";
	            $arr_temp 		=	Db::query($sql_temp)[0];
	            $liushui_today += $arr_temp['total_bet_money'];
	            
	            //ag
	            $sql_temp ="select sum(validBetAmount) as total_bet_money from ag_gameresult where username ='$username' and betTime>='$start_Time' and  betTime<='$end_Time'";
	            $arr_temp = Db::query($sql_temp)[0];
	            if($arr_temp){
	                $liushui_today += $arr_temp['total_bet_money'];
	                $ag_today = $arr_temp['total_bet_money'];
	            }else{
	                $liushui_history += 0;
	                $ag_today = 0;
	            }
	            
	            //bbin
	            $sql_temp = "select username,sum(BetAmount) as total_bet_money from bbin_gameresult where username='$username' and  WagersDate > '{$start_Time}' and WagersDate < '{$end_Time}' ";
	            $arr_temp = Db::query($sql_temp)[0];
	            if($arr_temp){
	                $liushui_today += $arr_temp['total_bet_money'];
	                $bbin_today = $arr_temp['total_bet_money'];
	            }else{
	                $liushui_history += 0;
	                $bbin_today =0;
	            }
	            
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
	            
	            //ag
	            $sql_temp ="select sum(validBetAmount) as total_bet_money from ag_gameresult where username ='$username' ";
	            $arr_temp 		=	Db::query($sql_temp)[0];
	            if($arr_temp){	                
	                $liushui_history += $arr_temp['total_bet_money'];
	            }else{
	                $liushui_history += 0;
	            }
	            
	            //bbin
	            $sql_temp = "select username,sum(Commissionable) as total_bet_money from bbin_gameresult where username='$username' ";
	            $arr_temp 		=	Db::query($sql_temp)[0];
	            if($arr_temp){
	                $liushui_history += $arr_temp['total_bet_money'];
	            }else{
	                $liushui_history += 0;
	            }
	            
	            
	            
	            $sql_temp = "SELECT * from my_tongji where username='$username'";
	            $arr_temp 		=	Db::query($sql_temp);
	            if (!empty($arr_temp)) {
	                $arr_temp = $arr_temp[0];
	                $liushui_yiqian = $arr_temp['liushui'];
	                $chongzhi_yiqian = $arr_temp['chongzhi'];
	                $xinzeng_liushui = $liushui_history - $liushui_yiqian;
	                $xinzeng_cunkuan = $cunkuan - $chongzhi_yiqian;
	            } else {
	                $xinzeng_liushui = $xinzeng_cunkuan = 'error';
	            }
	            
	            
	            $sql_temp = "SELECT m_make_time,m_value from k_money where uid='$rows[uid]' and status=1 and type=1 order by m_make_time desc limit 1";
	            $arr_temp1 		=	Db::query($sql_temp);
	            
	            //echo $sql_temp;
	            
	            $sql_temp = "SELECT adddate,money from huikuan where uid='$rows[uid]' and status=1 order by adddate desc limit 1";
	            $arr_temp2		=	Db::query($sql_temp);
	            
	            if (!empty($arr_temp1) && !empty($arr_temp2)) {
	                $arr_temp1 = $arr_temp1[0];
	                $arr_temp2 = $arr_temp2[0];
	                if ($arr_temp1['m_make_time'] > $arr_temp2['adddate']) {
	                    $last_cunkuan_time = $arr_temp1['m_make_time'];
	                    $last_cunkuan = $arr_temp1['m_value'];
	                } else {
	                    $last_cunkuan_time = $arr_temp2['adddate'];
	                    $last_cunkuan = $arr_temp2['money'];
	                }
	            } else if (!empty($arr_temp1)) {
	                $arr_temp1 = $arr_temp1[0];
	                $last_cunkuan_time = $arr_temp1['m_make_time'];
	                $last_cunkuan = $arr_temp1['m_value'];
	            } else if (!empty($arr_temp2)) {
	                $arr_temp2 = $arr_temp2[0];
	                $last_cunkuan_time = $arr_temp2['adddate'];
	                $last_cunkuan = $arr_temp2['money'];
	            } else {
	                $last_cunkuan_time = 0;
	                $last_cunkuan = 0;
	            }
	            
	            $last_zhudan = 0;
	            if ($last_cunkuan_time == 0) {
	                $last_zhudan = 0;
	            } else {
	                //$sql_temp = "select sum(bet_money) as all_money from k_bet where uid=".$rows["uid"]." and status in(1,2,4,5) and bet_time>'$last_cunkuan_time'";
	                $sql_temp = "select sum(bet_money) as all_money from k_bet where uid=".$rows["uid"]." and bet_time>'$last_cunkuan_time'";
	                $arr_temp 		=	Db::query($sql_temp)[0];
	                $last_zhudan += $arr_temp['all_money'];
	                
	                //$sql_temp = "select sum(bet_money) as all_money from k_bet_cg_group where uid=".$rows["uid"]." and status in(1,2) and bet_time>'$last_cunkuan_time'";
	                $sql_temp = "select sum(bet_money) as all_money from k_bet_cg_group where uid=".$rows["uid"]." and bet_time>'$last_cunkuan_time'";
	                $arr_temp 		=	Db::query($sql_temp)[0];
	                $last_zhudan += $arr_temp['all_money'];
	                
	                $last_cunkuan_time = date('Y-m-d H:i:s',strtotime('-12 hours',strtotime($last_cunkuan_time)));
	                $sql_temp = "select sum(money) as all_money from c_bet where uid=".$rows["uid"]." and addtime>'$last_cunkuan_time'";
	                $arr_temp 		=	Db::query($sql_temp)[0];
	                $last_zhudan += $arr_temp['all_money'];
	                
	                $sql_temp = "select sum(money) as all_money from c_bet_lt where uid=".$rows["uid"]." and addtime>'$last_cunkuan_time'";
	                $arr_temp 		=	Db::query($sql_temp)[0];
	                $last_zhudan += $arr_temp['all_money'];
	                
	                $sql_temp = "select sum(putin) as all_money from table1 where username='".$rows["username"]."' and date_time>'$last_cunkuan_time'";
	                //echo $sql_temp;
	                $arr_temp 		=	Db::query($sql_temp)[0];
	                $last_zhudan += $arr_temp['all_money'];
	                
	                //ag
	                
	                $sql_temp ="select sum(validBetAmount) as all_money from ag_gameresult where username ='$username' and betTime>='$last_cunkuan_time'";
	                $arr_temp 		=	Db::query($sql_temp)[0];
	                if($arr_temp){
	                    
	                    $last_zhudan += $arr_temp['all_money'];
	                    $last_ag  = $arr_temp['all_money'];
	                }else{
	                    $last_zhudan += 0;
	                }
	                
	                //bbin
	                
	                $sql_temp = "select username,sum(BetAmount) as all_money from bbin_gameresult where username='$username' and  WagersDate > '{$last_cunkuan_time}' ";
	                $arr_temp 		=	Db::query($sql_temp);
	                if($arr_temp){
	                    $arr_temp = $arr_temp[0];
	                    $last_zhudan += $arr_temp['all_money'];
	                    $last_bbin = $arr_temp['all_money'];
	                }else{
	                    $last_zhudan += 0;
	                }
	            }
	            
	            //开始统计体育输赢总计
	            $sql_ty		=	"select sum(bet_money) as all_money,sum(win) as win from k_bet where uid=".$rows["uid"]." and status in(1,2,4,5)";
	            $rs_ty 		=	Db::query($sql_ty)[0];
	            $tiyusy		=	round($rs_ty['win']-$rs_ty['all_money'],2);
	            $sql_cg		=	"select sum(bet_money) as all_money,sum(win) as win from k_bet_cg_group where uid=".$rows["uid"]." and status in(1,2)";
	            $rs_cg		=	Db::query($sql_cg)[0];
	            $tiyucg		=	round($rs_cg['win']-$rs_cg['all_money'],2);
	            //开始统计体育未结算总计
	            $sql_tys	=	"select sum(bet_money) as all_money from k_bet where uid=".$rows["uid"]." and status=0";
	            $rs_tys		=	Db::query($sql_tys)[0];
	            $tiyusys	=	round($rs_tys['all_money'],2);
	            $sql_cgs	=	"select sum(bet_money) as all_money from k_bet_cg_group where uid=".$rows["uid"]." and status=0";
	            $rs_cgs		=	Db::query($sql_cgs)[0];
	            $tiyucgs	=	round($rs_cgs['all_money'],2);
	            //开始统计彩票输赢总计
	            $sql_cp		=	"select sum(money) as all_money,sum(win) as win from c_bet where uid=".$rows["uid"]." and js=1";
	            
	            $rs_cp 		=	Db::query($sql_cp)[0];
	            $caipiaosy	=	round($rs_cp['win']-$rs_cp['all_money'],2);
	            //开始统计彩票未结算总计
	            $sql_cps	=	"select sum(money) as all_money from c_bet where uid=".$rows["uid"]." and js=0";
	            $rs_cps		=	Db::query($sql_cps)[0];
	            $caipiaosys	=	round($rs_cps['all_money'],2);
	            
	            //开始统计新彩票输赢总计
	            $sql_cp1		=	"select sum(money) as all_money,sum(win) as win from c_bet_lt where uid=".$rows["uid"]." and js=1";
	            $rs_cp1 		=	Db::query($sql_cp1)[0];
	            $caipiaosy1	=	round($rs_cp1['win']-$rs_cp1['all_money'],2);
	            
	            //开始统计新彩票未结算总计
	            $sql_cps1	=	"select sum(money) as all_money from c_bet_lt where uid=".$rows["uid"]." and js=0";
	            $rs_cps1		=	Db::query($sql_cps1)[0];
	            $caipiaosys1	=	round($rs_cps1['all_money'],2);
	            
	            //开始统计新彩票追号冻结
	            $sql_cpzh1	=	"select sum(zmoney) as z_money, sum(cmoney) as c_money from c_bet_lt_zh where uid=".$rows["uid"]." and state=1";
	            $rs_cpzh1		=	Db::query($sql_cpzh1)[0];
	            $caipiaozh1	=	round($rs_cpzh1['z_money']-$rs_cpzh1['c_money'],2);
	            
	            
	            // 以下是别的
	            $uid = $rows["uid"];
	            $username = $param["username"];
	            
	            $totalArr = array();
	            $sql_adjust = "select adjustmoney from my_tongji where username ='{$username}'";
	            $rs_adjust = Db::query($sql_adjust);
	            if($rs_adjust){
	                $adjustmoney = $rs_adjust[0]['adjustmoney'];
	            }else{
	                $adjustmoney = 0;
	            }
	            
	            
	            
	            // 存款
	            $sql = "select * from k_money where status=1 and uid='$uid' and type in (1,100) and about not like '%管理员结算%'";
	            $tmprows2 = Db::query($sql);
	            foreach($tmprows2 as $rows2){
	                $temp = array();
	                $temp['time'] = $rows2['m_make_time'];
	                $temp['cunkuan'] =$this->get_date($rows2['m_make_time'])."&nbsp;&nbsp;&nbsp;<span class=\"bigred\">".$rows2['m_value']."</span>&nbsp;&nbsp;&nbsp;"./*'余额:<span class="bigred">'.$rows2['h_qian'].'</span>';*/
	   	                $temp['tikuan'] = '';
	   	                $temp['shuoming'] = '在线支付';
	   	                $totalArr[] = $temp;
	            }
	            
	            // 汇款
	            $sql = "select * from huikuan where status=1 and uid='$uid'";
	            $tmprows2 = Db::query($sql);
	            foreach ($tmprows2 as $rows2){
	                $temp = array();
	                $temp['time'] = $rows2['adddate'];
	                $temp['cunkuan'] =$this->get_date($rows2['adddate'])."&nbsp;&nbsp;&nbsp;<span class=\"bigred\">".$rows2['money']."+".$rows2['zsjr']."</span>&nbsp;&nbsp;&nbsp;"./*'余额:<span class="bigred">'.$rows2['h_qian'].'</span>';*/
	   	                $temp['tikuan'] = '';
	   	                $temp['shuoming'] = '公司入款';
	   	                $totalArr[] = $temp;
	            }
	            
	            
	            // 提款
	            $sql = "select * from k_money where status=1 and uid='$uid' and m_value<0 and type in (11,12,255)";
	            $tmprows2 = Db::query($sql);
	            foreach ($tmprows2 as $rows2){
	                $temp = array();
	                $temp['time'] = $rows2['m_make_time'];
	                $temp['cunkuan'] = '';
	                $temp['tikuan'] =$this->get_date($rows2['m_make_time'])."&nbsp;&nbsp;&nbsp;<span class=\"bigred\">".$rows2['m_value']."</span>&nbsp;&nbsp;&nbsp;"./*'余额:<span class="bigred">'.$rows2['h_qian'].'</span>';*/
	   	                $temp['shuoming'] = '';
	   	                $totalArr[] = $temp;
	            }
	            
	            // 红利赠送+说明
	            $sql = "select * from k_money where status=1 and uid='$uid' and about like '%管理员结算%'";
	            $tmprows2 = Db::query($sql);
	            foreach ($tmprows2 as $rows2){
	                $temp = array();
	                $temp['time'] = $rows2['m_make_time'];
	                $temp['cunkuan'] =$this->get_date($rows2['m_make_time'])."&nbsp;&nbsp;&nbsp;<span class=\"bigred\">".$rows2['m_value']."</span>&nbsp;&nbsp;&nbsp;"./*'余额:<span class="bigred">'.$rows2['h_qian'].'</span>';*/
	   	                $temp['tikuan'] = '';
	   	                $temp['shuoming'] = str_replace(array('【公司入款】','【在线支付】','[管理员结算]'),'',$rows2['about']);
	   	                $totalArr[] = $temp;
	            }
	            
	            usort($totalArr,'self::my_sort');
	            
	            $sum = count($totalArr);
	            $thisPage	=	1;
	            $pagenum	=	25;
	            if($param['page'] ?? ''){
	                $thisPage	=	$param['page'];
	            }
	            $CurrentPage=isset($param['page'])?$param['page']:1;
	            $myPage=new \app\logic\pager($sum,intval($CurrentPage),$pagenum);
	            $pageStr= $myPage->GetPagerContent();
	            
	            $totalArr_begin = ($CurrentPage-1)*$pagenum;
	            $totalArr = array_slice($totalArr,$totalArr_begin,$pagenum);
	            
	            if ($xinzeng_liushui=='error') {
	                $last_ti = '暂无记录';
	            } else {
	                $last_ti = '新增充值:<span style="color:red">'.round($xinzeng_cunkuan,2).'</span>, 新增流水:<span style="color:red">'.round($xinzeng_liushui,2).'</span>';
	            }
	            
	            $hechaArr[] = array('keyname'=>'最后一次提款后:','keyvalue'=>$last_ti);
	            $hechaArr[] = array('keyname'=>'最后一次存款:','keyvalue'=>'<span style="color:red">'.round($last_cunkuan,2)."</span>元 流水{<span style=\"color:red\">".round($last_zhudan,2)."</span>}元");
	            $hechaArr[] = array('keyname'=>'会员账号:','keyvalue'=>$rows["username"].'&nbsp;&nbsp;'.'<input onclick="location.href=\'/zhudan/c_bet_search.php?find=1&username='.$rows["username"].'\'" style="color:red" type="button" class="" value="会员异常注单核查" />');
	            $hechaArr[] = array('keyname'=>'红利赠送、存款、汇款总计:','keyvalue'=>$cunkuan2);
	            $hechaArr[] = array('keyname'=>'公司入款赠送总计:','keyvalue'=>$cunkuan3);
	            $hechaArr[] = array('keyname'=>'取款、扣款总计:','keyvalue'=>$qukuan);
	            $hechaArr[] = array('keyname'=>'红利反水、其他入款总计:','keyvalue'=>$zengsong);
	            $hechaArr[] = array('keyname'=>'今日总投注流水:','keyvalue'=>round($liushui_today,2));
	            $hechaArr[] = array('keyname'=>'历史总投注流水:','keyvalue'=>round($liushui_history,2));
	            $hechaArr[] = array('keyname'=>'真人转入总计:','keyvalue'=>$zhuanru);
	            $hechaArr[] = array('keyname'=>'真人转出总计:','keyvalue'=>$zhuanchu);
	            $hechaArr[] = array('keyname'=>'体育输赢总计:','keyvalue'=>$tiyusy+$tiyucg);
	            $hechaArr[] = array('keyname'=>'体育未结算金额:','keyvalue'=>$tiyusys+$tiyucgs);
	            $hechaArr[] = array('keyname'=>'彩票输赢总计:','keyvalue'=>$caipiaosy);
	            $hechaArr[] = array('keyname'=>'彩票未结算金额:','keyvalue'=>$caipiaosys);
	            $hechaArr[] = array('keyname'=>'新彩票输赢总计:','keyvalue'=>$caipiaosy1);
	            $hechaArr[] = array('keyname'=>'新彩票未结算金额:','keyvalue'=>$caipiaosys1);
	            $hechaArr[] = array('keyname'=>'新彩票追号冻结金额:','keyvalue'=>$caipiaozh1);
	            $hechaArr[] = array('keyname'=>'AG当日有效投注金额:','keyvalue'=>$ag_today);
	            $hechaArr[]	= array('keyname' => '上次存款后AG有效投注金额:','keyvalue'=>$last_ag);
	            $hechaArr[] = array('keyname'=>'BBIN当日有效投注金额:','keyvalue'=>$bbin_today);
	            $hechaArr[]	= array('keyname' => '上次存款后BBIN有效投注金额:','keyvalue'=>$last_bbin);
	            
	            $hechaArr[] = array('keyname'=>'理论账户余额:','keyvalue'=>round($cunkuan+$zengsong+$qukuan+$tiyusy+$tiyucg+$caipiaosy+$caipiaosy1+$adjustmoney-$tiyusys-$tiyucgs-$caipiaosys-$caipiaosys1-$caipiaozh1+$zhuanchu-$zhuanru,2));
	            $hechaArr[] = array('keyname'=>'实际账户余额:','keyvalue'=>round($rows["money"],2));
	            $hechaArr[] = array('keyname'=>'删除数据时差额:','keyvalue'=>$adjustmoney);
	            $wucha = round($rows["money"],2)-round($cunkuan+$zengsong+$qukuan+$tiyusy+$tiyucg+$caipiaosy+$caipiaosy1-$tiyusys-$tiyucgs-$caipiaosys-$caipiaosys1-$caipiaozh1+$zhuanchu-$zhuanru,2)-$adjustmoney;
	            $wucha = round($wucha,2);
	            $hechaArr[] = array('keyname'=>'误差值:','keyvalue'=>'<font color="#FF0000">'.$wucha.'</font> 元 &nbsp;&nbsp;<input onclick="location.href=\''.url('member/hecha').'?action=jian&username='.$rows['username'].'&uid='.$rows['uid'].'&money='.$wucha.'\'" type="button" class="" value="扣除异常金额">(误差小于10属于正常)');
	            $hechaArr[] = array('keyname'=>'计算方式:','keyvalue'=>'所有入款+真人转出-真人转入-所有出款+体育输赢+彩票输赢-体育未结算金额-彩票未结算金额 =理论账户余额');
	            $finalArr = $this->my_merger($hechaArr,$totalArr);
	        }
	        
	        $this->assign('pageStr',$pageStr);
	        $this->assign('finalArr',$finalArr);
	        
	    }
	    $this->assign('user_exists',$user_exists);
	    $this->assign('username',$username);
	    return $this->fetch();
	}
	
	
	/*
	 * 判断要添加的金额
	 * @param string $vip 会员级别
	 */
	protected function judge_vip($vip){
		$vipArr = $this->vipArr;
		foreach ($vipArr as $key=>$value){
			if ($vip == $value['vip']) {
				return $value['money'];
			}
		}
		return 0;
	}
	
	
	private function get_date($date) {
	    return date('Y-m-d H:i:s',strtotime($date));
	}
	
	private function my_sort($a,$b) {
	    if ($a['time'] == $b['time']) {
	        return 0;
	    }
	    
	    if ($a['time'] > $b['time']) {
	        return -1;
	    } else {
	        return 1;
	    }
	}
	
	// 自定义合并数组的函数
	private function my_merger($hechaArr,$detailArr) {
	    $resultArr = array();
	    if (count($hechaArr) > count($detailArr)) {
	        foreach ($hechaArr as $key => $value) {
	            $temp = array();
	            $temp['hecha'] = $value;
	            $temp['detail'] = $detailArr[$key] ?? '';
	            $resultArr[] = $temp;
	        }
	    } else {
	        foreach ($detailArr as $key => $value) {
	            $temp = array();
	            $temp['hecha'] = $hechaArr[$key] ?? '';
	            $temp['detail'] = $value;
	            $resultArr[] = $temp;
	        }
	    }
	    return $resultArr;
	}
}