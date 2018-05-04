<?php
namespace app\index\controller;
use app\index\Base;
use think\db;
use think\Session;
class six extends Base{
    
    public function _initialize(){    
      parent::_initialize();        
      $title = '香港六合彩';
      $this->assign('title',$title);
    }


    public function index(){
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	
    	$this->assign('user',$user); 
        return $this->fetch('index');
    }
        
    public function six_1(){
        return $this->fetch('six_1');
    }
    
    public function six_1_6(){
        return $this->fetch('six_1_6');
    }
    
    public function six_2(){
        return $this->fetch('six_2');
    }
    
    public function six_3(){
        return $this->fetch('six_3');
    }
    
    public function six_4(){
        return $this->fetch('six_4');
    }
    
    public function six_5(){
        return $this->fetch('six_5');
    }
    
    public function six_6(){
        return $this->fetch('six_6');
    }
    
    public function six_7_1(){
        return $this->fetch('six_7_1');
    }
    
    public function six_7_2(){
        return $this->fetch('six_7_2');
    }
    
    public function six_8_1(){
        return $this->fetch('six_8_1');
    }
    
    public function six_8_2(){
        return $this->fetch('six_8_2');
    }
    
    public function six_9(){
        return $this->fetch('six_9');
    }
    
    public function six_10(){
        return $this->fetch('six_10');
    }
    
    public function six_11(){
        return $this->fetch('six_11');
    }
    
    public function six_12(){
        return $this->fetch('six_12');
    }
    
    public function six_13(){
        return $this->fetch('six_13');
    }
    
    public function six_14(){
        return $this->fetch('six_14');
    }
    
    public function six_15(){
        return $this->fetch('six_15');
    }
    
    public function auto(){
        return $this->fetch('auto');
    }
    
    public function time(){
        date_default_timezone_set('PRC');
        $lottery_time = time();
        $ctime = date('Y-m-d H:i:s',$lottery_time);
        $qs = Db::table('c_auto_0') -> where('opentime','<=',$ctime)->where('endtime','>=',$ctime) -> order('id asc') -> find();
        if($qs){
            $qishu	= $qs['qishu'];
            $close	= strtotime($qs['endtime'])-$lottery_time;
        }else{
            $qishu	= -1;
            $close	= -1;
        }
        $rs = Db::table('c_auto_0') -> where('ok',1)->order('id desc')->limit(1) -> find();
        $k_qi		= $rs['qishu'];
        $k_hm[]		= str_pad($rs['ball_1'],2,'0',STR_PAD_LEFT);
        $k_hm[]		= str_pad($rs['ball_2'],2,'0',STR_PAD_LEFT);
        $k_hm[]		= str_pad($rs['ball_3'],2,'0',STR_PAD_LEFT);
        $k_hm[]		= str_pad($rs['ball_4'],2,'0',STR_PAD_LEFT);
        $k_hm[]		= str_pad($rs['ball_5'],2,'0',STR_PAD_LEFT);
        $k_hm[]		= str_pad($rs['ball_6'],2,'0',STR_PAD_LEFT);
        $k_hm[]		= str_pad($rs['ball_7'],2,'0',STR_PAD_LEFT);
        $arr = array(   
            'number' => $qishu, 
        	'close' => $close, 
        	'k_number' => $k_qi,
        	'k_hm' => $k_hm,
        );  
        $json_string = json_encode($arr);   
        echo $json_string; 
    }
    
    public function order(){
        
    }
    
    public function list_s(){       
        $file = APP_PATH .'../common/lottery/auto_class.php';
        if(file_exists($file)){
            include_once $file;
        }else{
            $this->error('算法文件不存在!');
        }
        $uid = Session("uid");
        $rs = Db::table('c_auto_0') -> where('ok','=',1) -> order('qishu desc') -> find();
        $sx1 = Get_ShengXiao($rs['ball_1']);
        $sx2 = Get_ShengXiao($rs['ball_2']);
        $sx3 = Get_ShengXiao($rs['ball_3']);
        $sx4 = Get_ShengXiao($rs['ball_4']);
        $sx5 = Get_ShengXiao($rs['ball_5']);
        $sx6 = Get_ShengXiao($rs['ball_6']);
        $sx7 = Get_ShengXiao($rs['ball_7']);
        $this->assign('sx1',$sx1);
        $this->assign('sx2',$sx2);
        $this->assign('sx3',$sx3);
        $this->assign('sx4',$sx4);
        $this->assign('sx5',$sx5);
        $this->assign('sx6',$sx6);
        $this->assign('sx7',$sx7);
        return $this -> fetch('list_s');
    }
    
    public function list(){
        //include ("class/auto_class.php");
        $file = APP_PATH .'../common/lottery/auto_class.php';
        if(file_exists($file)){
            include_once $file;
        }else{
            $this->error('算法文件不存在!');
        }        
        $list = db('c_auto_0')->where('ok',1)->order('id desc')->limit(50)->select();
        foreach ($list as $k => $v){
            $list[$k]['dx']		=  Six_DaXiao($v['ball_7']);
            $list[$k]['ds']		= Six_DanShuang($v['ball_7']);
            $list[$k]['hsdx']	= Six_HeShuDaXiao($v['ball_7']);
            $list[$k]['hsds']	= Six_HeShuDanShuang($v['ball_7']);
            $list[$k]['wsdx']	= Six_WeiShuDaXiao($v['ball_7']);
            $list[$k]['ws']		= Six_WeiShu($v['ball_7']);
            $list[$k]['bs']		= Six_Bose($v['ball_7']);
            $list[$k]['sx']		= Get_ShengXiao($v['ball_7']);
            $list[$k]['zhdx'] = Six_ZongHeDaXiao($v['ball_1']+$v['ball_2']+$v['ball_3']+$v['ball_4']+$v['ball_5']+$v['ball_6']+$v['ball_7']);
            $list[$k]['zhds'] = Six_ZongHeDanShuang($v['ball_1']+$v['ball_2']+$v['ball_3']+$v['ball_4']+$v['ball_5']+$v['ball_6']+$v['ball_7']);
        }
        $this->assign('list',$list);
        return $this -> fetch('auto');
    }
    
}