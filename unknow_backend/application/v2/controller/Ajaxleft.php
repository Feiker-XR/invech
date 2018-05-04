<?php
namespace app\v2\controller;
use app\v2\Base;
use think\Session;
use think\cache;
use app\logic\bet_match;
use app\logic\baseball_match;
use app\logic\lq_match;
use app\logic\guanjun;
use app\logic\jinrong;
use app\logic\tennis_match;
use app\logic\volleyball_match;
class ajaxleft extends Base
{

    public function islogin()
    {
        $this->request->isMobile();
        if (Session('uid')) {
            return ['islogin' => '1'];
        } else {
            return ['islogin' => '0'];
        }
    }

    public function bet_match()
    {
        $uid = Session('uid');
        $this->sessionBet($uid);
        $this->islogin_match($uid); //未登陆，退出登陆状态
        $rows=bet_match::getmatch_info(intval($_POST["match_id"]),$_POST["point_column"],$_POST["ball_sort"]);
        $touzhuxiang = $_POST["touzhuxiang"];
        $temp_array=explode("-",$touzhuxiang);
        if($temp_array[0]=="让球" || $temp_array[0]=="上半场让球"){
            $touzhuxiang = $temp_array[0]."-".preg_replace("/[0-9.\/]{1,}/",$rows["match_rgg"],$temp_array[1])."-".$temp_array[2];
        }
        if($temp_array[0]=="大小" || $temp_array[0]=="上半场大小"){
            $uo			 = ($_POST["point_column"]=="Match_Bdpl" || $_POST["point_column"]=="Match_DxDpl" || $_POST["point_column"]=="Match_BHo") ? "O" : "U";
            $touzhuxiang = preg_replace("/[U0-9O.\/]{2,}/",$uo.$rows["match_dxgg"],$touzhuxiang);
        }
        
        $tzx = $touzhuxiang;
        
        $temp_array=explode("-",$touzhuxiang);
        if(count($temp_array)>2){
            $touzhuxiang=$temp_array[0].$temp_array[1]."</p><p style=\"text-align:center\">".$temp_array[2];
        }
        include_once CACHE_PATH.'group_'.Session('gid').'.php';
        $this->assign('dz_db',$dz_db);
        $this->assign('dc_db',$dc_db);
        $this->assign('rows',$rows);
        $this->assign('temp_array',$temp_array);
        $this->assign('tzx',$tzx);
        echo $this->fetch('bet_match');exit;
    }
    
    public function lq_match(){
        $uid = Session('uid');
        $this->sessionBet($uid);
        $this->islogin_match($uid); //未登陆，退出登陆状态
        $rows = lq_match::getmatch_info(intval($_POST["match_id"]),$_POST["point_column"],$_POST["ball_sort"]);
        $touzhuxiang	=	$_POST["touzhuxiang"];
        $temp_array		=	explode("-",$touzhuxiang);
        if($temp_array[0]=="让球"){
            $touzhuxiang = preg_replace("/[0-9\.\/]{1,}-/",$rows["match_rgg"]."-",$touzhuxiang);
        }
        if($temp_array[0]=="大小"){
            $touzhuxiang = preg_replace("/[0-9.]{1,}/",$rows["match_dxgg"],$touzhuxiang);
        }
        include_once CACHE_PATH.'group_'.Session('gid').'.php';
        $this->assign('dz_db',$dz_db);
        $this->assign('dc_db',$dc_db);
        $this->assign('rows',$rows);
        $this->assign('touzhuxiang',$touzhuxiang);
        $this->assign('temp_array',$temp_array);
        echo $this->fetch('lq_match');exit;
    }
    
    public function tennis_match(){
        $uid = Session('uid');
        $this->sessionBet($uid);
        $this->islogin_match($uid); //未登陆，退出登陆状态
        $rows=tennis_match::getmatch_info(intval($_POST["match_id"]),$_POST["point_column"]);
        $touzhuxiang	=	$_POST["touzhuxiang"];
        $temp_array		=	explode("-",$touzhuxiang);
        if($temp_array[0]=="让球"){
            $touzhuxiang = preg_replace("/0-9\.\/]{1,}-/",$rows["match_rgg"]."-",$touzhuxiang);
        }
        if($temp_array[0]=="大小"){
            $touzhuxiang = preg_replace("/[0-9.]{1,}/",$rows["match_dxgg"],$touzhuxiang);
        }
        include_once CACHE_PATH.'group_'.Session('gid').'.php';
        $this->assign('dz_db',$dz_db);
        $this->assign('dc_db',$dc_db);
        $this->assign('rows',$rows);
        $this->assign('temp_array',$temp_array);
        echo $this->fetch('tennis_match');exit;
    }
    
    public function volleyball_match(){
        $uid = Session('uid');
        $this->sessionBet($uid);
        $this->islogin_match($uid); //未登陆，退出登陆状态
        $rows=volleyball_match::getmatch_info(intval($_POST["match_id"]),$_POST["point_column"]);
        $touzhuxiang	=	$_POST["touzhuxiang"];
        $temp_array		=	explode("-",$touzhuxiang);
        if($temp_array[0]=="让球"){
            $touzhuxiang = preg_replace("/[0-9\.\/]{1,}-/",$rows["match_rgg"]."-",$touzhuxiang);
        }
        if($temp_array[0]=="大小"){
            $touzhuxiang = preg_replace("/[0-9.]{1,}/",$rows["match_dxgg"],$touzhuxiang);
        }
        include_once CACHE_PATH.'group_'.Session('gid').'.php';
        $this->assign('dz_db',$dz_db);
        $this->assign('dc_db',$dc_db);
        $this->assign('rows',$rows);
        $this->assign('temp_array',$temp_array);
        echo $this->fetch('volleyball_match');exit;
    }
    
    public function guanjun(){
        $uid = Session('uid');
        $this->sessionBet($uid);
        $this->islogin_match($uid); //未登陆，退出登陆状态
        $rows = guanjun::getmatch_info(intval(@$_POST["tid"]));
        include_once CACHE_PATH.'group_'.Session('gid').'.php';
        $this->assign('dz_db',$dz_db);
        $this->assign('dc_db',$dc_db);
        $this->assign('rows',$rows);
        echo $this->fetch('guanjun');exit;
    }
    
    public function jinrong(){
        $uid = Session('uid');
        $this->sessionBet($uid);
        $this->islogin_match($uid); //未登陆，退出登陆状态
        $rows = jinrong::getmatch_info(intval(@$_POST["tid"]));
        include_once CACHE_PATH.'group_'.Session('gid').'.php';
        $this->assign('dz_db',$dz_db);
        $this->assign('dc_db',$dc_db);
        $this->assign('rows',$rows);
        echo $this->fetch('jinrong');exit;
    }
    
    public function baseball_match(){
        $uid = Session('uid');
        $this->sessionBet($uid);
        $this->islogin_match($uid); //未登陆，退出登陆状态
        $rows=baseball_match::getmatch_info(intval($_POST["match_id"]),$_POST["point_column"],$_POST["ball_sort"]);
        $touzhuxiang	=	$_POST["touzhuxiang"];
        $temp_array		=	explode("-",$touzhuxiang);
        if($temp_array[0]=="让球" || $temp_array[0]=="上半场让球"){
            $touzhuxiang = preg_replace("/[0-9\.\/]{1,}-/",$rows["match_rgg"]."-",$touzhuxiang);
        }
        if($temp_array[0]=="大小" || $temp_array[0]=="上半场大小"){
            $touzhuxiang = preg_replace("/[0-9.]{1,}/",$rows["match_dxgg"],$touzhuxiang);
        }
        include_once CACHE_PATH.'group_'.Session('gid').'.php';
        $this->assign('dz_db',$dz_db);
        $this->assign('dc_db',$dc_db);
        $this->assign('rows',$rows);
        $this->assign('temp_array',$temp_array);
        echo $this->fetch('baseball_match');exit;
    }

    private function sessionBet($uid)
    {
        if(!Session('bets')){
            Session('bets',0);
            Session('betTime',time());
        }
        $time3 = time() - Session('betTime');
        if($time3 >= 15){
            Session('bets',0);
            Session('betTime',time());
        }
        if(Session('betif') != ''){
            if($time3 >= 30){
                Session('bets',0);
                Session('betTime',time());
                Session('betif' ,'');
            }
        }
        if(Session('bets') < 10){
            Session('bets', Session('bets') + 1);
        }else{
            Session('betTime',time());
            Session('betif',rand(100000,99999));
            echo "<div class=\"pollbox\" id =\"idcs\"> 
			      <p style=\"text-align:center\"></p> 
				  <p style=\" text-align:center\"></p>
				  <p style=\"font-size:12px;\"><font style=\"color:red;text-align:center;\">）：您点击次数太快了..<br />为了保证网站数据安全..<br />请您稍等<span id='miao'>30</span>秒后再操作..</font></p></div>
				  
	<script language=\"javascript\">\r\n
		var i = 31;\r\n
		var timeouts;\r\n
		clearTimeout(timeouts);\r\n
		checkidcs();\r\n
		function checkidcs(){\r\n
			i = i-1;\r\n
			document.getElementById('miao').innerHTML	= '';\r\n
			document.getElementById('miao').innerHTML	=i;\r\n
			if(i == 0){\r\n
			clearTimeout(timeouts);\r\n
				document.getElementById('bet_moneydiv').style.display='none';\r\n
				document.getElementById('idcs').style.display='none';\r\n
				document.getElementById('maxmsg_div').style.display='none';\r\n
			}else{\r\n
				timeouts=setTimeout(\"checkidcs()\",1000);\r\n
			}
		}\r\n
</script>\r\n";
            exit();
        }
        
        return true;
    }
    
    private function islogin_match($uid){
        if($uid){
            return true;
        }else{
            Session::destroy();
            echo "<script>window.location.href='/left.php';</script>";
            exit;
        }
    }
}