<?php
namespace app\index\controller;
use app\index\Base;
use think\Session;
use think\Cache;
use think\Db;
class lottery extends Base{
    public $config = array(
        'csc' => array(
            'time_table' => 'c_opentime_2',
            'data_table' => 'c_auto_2',
            'odds_table' => 'c_odds_2',
        ),
        'csc_1' => array(
            'time_table' => 'c_opentime_2',
            'data_table' => 'c_auto_2',
            'odds_table' => 'c_odds_2',
        ),        
        'cqssc' => array(
            'time_table' => 'c_opentime_2',
            'data_table' => 'c_auto_2',
            'odds_table' => 'c_odds_2',
        ),
        'cqssc_1' => array(
            'time_table' => 'c_opentime_2',
            'data_table' => 'c_auto_2',
            'odds_table' => 'c_odds_2',
        ),                    
        'csf' => array(
            'time_table' => 'c_opentime_4',
    		'data_table' => 'c_auto_4',
    		'odds_table' => 'c_odds_4',
        ),
        'csf_1' => array(
            'time_table' => 'c_opentime_4',
            'data_table' => 'c_auto_4',
            'odds_table' => 'c_odds_4',
        ),        
    	'xyft' => array(
    		'time_table' => 'c_opentime_9',
    		'data_table' => 'c_auto_9',
    		'odds_table' => 'c_odds_9',
    	),
        'xyft_1' => array(
            'time_table' => 'c_opentime_9',
            'data_table' => 'c_auto_9',
            'odds_table' => 'c_odds_9',
        ),        
        'gsf' => array(
            'time_table' => 'c_opentime_1',
            'data_table' => 'c_auto_1',
            'odds_table' => 'c_odds_1',
        ),
        'Gdsf_1' => array(
            'time_table' => 'c_opentime_1',
            'data_table' => 'c_auto_1',
            'odds_table' => 'c_odds_1',
        ),
        'Gdsf_2' => array(
            'time_table' => 'c_opentime_1',
            'data_table' => 'c_auto_1',
            'odds_table' => 'c_odds_1',
        ),
        'xsc' => array(
            'time_table' => 'c_opentime_7',
            'data_table' => 'c_auto_7',
            'odds_table' => 'c_odds_7',
        ),
        'xsc_1' => array(
            'time_table' => 'c_opentime_7',
            'data_table' => 'c_auto_7',
            'odds_table' => 'c_odds_7',
        ),        
        'pk10' => array(
            'time_table' => 'c_opentime_3',
            'data_table' => 'c_auto_3',
            'odds_table' => 'c_odds_3',
        ),
        'pk10_1' => array(
            'time_table' => 'c_opentime_3',
            'data_table' => 'c_auto_3',
            'odds_table' => 'c_odds_3',
        ),        
        'gxsf' => array(
            'time_table' => 'c_opentime_5',
            'data_table' => 'c_auto_5',
            'odds_table' => 'c_odds_5',
        ),
        'jsk3' => array(
            'time_table' => 'c_opentime_6',
            'data_table' => 'c_auto_6',
            'odds_table' => 'c_odds_6',
        ),
    );
    
    public function _initialize(){
        parent::_initialize();
        //var_dump(input('type'));
                    //检测彩种是否关闭
    }
    
    public function home(){
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
    	
    	$this->assign('user',$user); 
    	return $this->fetch('home');
    }
    
    public function index($type='cqssc'){
	$lottery_close = cache('lotteryConfig');
        if(!$lottery_close){
            $lottery_close = Db::table('k_fengpan')->select();
            cache('lotteryConfig',$lottery_close);
        }
        $types = [
            'csc'=>'cqssc',
            'csc_1'=>'cqssc',
            'cqssc'=>'cqssc',
            'cqssc_1'=>'cqssc',

            'cqklsf' => 'cqklsf',
            'xsc' => 'xjssc',
            'xsc_1' => 'xjssc',
            'xyft'  => 'xyft',
            'xyft_1'  => 'xyft',
            'csf' => 'cqklsf',
            'csf_1' => 'cqklsf',

            'gsf' => 'gdklsf',

            //手机站入口
            'Gdsf_1' => 'gdklsf',
            'Gdsf_2' => 'gdklsf', 

            'pk10' => 'bjpk10',
            'pk10_1' => 'bjpk10',

            'gxsf' => 'gxklsf',
            'jsk3' => 'jsk3',
        ];

        foreach ($lottery_close as $v){
            if($v['name'] == $types[$this->request->param('type')] && $v['weihu'] == '1'){
                $this->error($v['reason']);
            }
        }
    	$uid = Session::get('uid');
    	$user = Db::table('k_user')->where(array('uid'=>$uid))->find();
        if(!array_key_exists($type, $this->config)){
           $this->error('改彩种尚未开放!');
        }
        $this->assign('user',$user);
        $this->assign('type',$type);
        return $this->fetch($type);
        
    }
    
    public function odds($gid = 'cqssc'){
        $odds = new \app\logic\odds();
        $info = $odds->$gid();
        echo $info;
    }
    
    public function auto($gid = 'cqssc'){
        $auto = new \app\logic\auto();
        $info = $auto->$gid();
        echo $info;
    }
    
    public function getjson($gid){
        
    }
    
    public function history($gid = 'cqssc'){
        date_default_timezone_set('PRC');
        include_once APP_PATH .'../common/lottery/auto_class.php';

        $t = @$_GET["t"];
        $t = intval($t);
        if ($t <= 0 || $t > 7 || !$t) {
            $t = 1;
        }        
        $this->assign('t',$t);

        $table = $this->config[$gid]['data_table'];
        if($gid == 'xsc'){
            $gid = 'xjssc';
        }

	    $lottery_time = time();	
        $da = date('Y-m-d H:i:s',$lottery_time);
        $this->assign('lottery_time',$lottery_time);

        $tday = date("Ymd",$lottery_time-($t-1)*24*3600);
        //$tday = '20170824';
        $rows = db($table)->where('datetime','between',[date('Y-m-d 00:00:00',$lottery_time-($t-1)*24*3600),date('Y-m-d 23:59:59',$lottery_time-($t-1)*24*3600)])->order("qishu desc")->select();      
        $history = new \app\logic\history();
        $rows = $history->$gid($rows);
        $this->assign('rows',$rows);
        return $this->fetch(ucfirst($gid).'_list');
    }
    
    public function order($type){
        
    }
    
    public function changlong($code = '新疆时时彩'){
        $changlong = \app\logic\changlong::_inital($code);
        echo json_encode($changlong);exit;
    }
    
    public function weihu($type){
        $weihuinfo = Cache::get('gameweihu');
        if($weihuinfo == ''){
            $weihuinfo = DB::table('k_fengpan')->select();
            Cache::set('gameweihu',$weihuinfo);
        }
        foreach($weihuinfo as $v){
            if($v['name1'] == $type){
                return $v['weihu'];
            }
        }
        return 0;
    }
    
    
}
