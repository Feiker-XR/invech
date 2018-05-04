<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace app\mobile;

use think\Controller;
use think\Config;
use think\Db;
use think\Session;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class Base extends Controller {

    /* 空操作，用于输出404页面 */
    // common function _empty(){
    // 	echo 404; //TODO:完成404页面
    // }
    // TODO: 为了调试方便，暂时注释

    public $memberSessionName='session-name';
    public $time;
    public $settings;
    public $prename;
    public $user;

    public $types;
    public $playeds;
    public $groups;

    protected function _initialize()
    {
//        $this->time = time();
////        $this->prename = config('DB_PREFIX');
//
//        $this->time=intval($_SERVER['REQUEST_TIME']);
//
//        if(session('user_auth_sign2')!=data_auth_sign($_SERVER['HTTP_USER_AGENT'])){//检测ip信息是否与session中存储的一致，防止session被盗，他人登录
//
//            if(strpos(__ACTION__,'login')===false && strpos(__ACTION__,'register')===false){
//                //没有登录
//                header('location: '.Url('user/login'));
//                //$this->error('您还没有登录',U('user/login'));
//                return;
//            }
//        }
//
//        if(session('user')){
//            $this->user = session('user');
//
//            //更新session
//            $data['id']=$this->user['sessionId'];
//            $data['accessTime'] = time();
//            model('member_session')->save($data);
//        }
//
//        $this->assign('user',$this->user);
//
//        if(!S('settings')){
//            $this->getSystemSettings();
//            S('settings',$this->settings,15*60);
//        }
//
//        $this->settings = S('settings');
//        S('WEB_NAME',$this->settings['webName'],15*60);
//        $this->assign('settings',$this->settings);
//        $switchWeb = $this->settings['switchWeb'];
//        if($switchWeb && $switchWeb == '1')
//        {
//
//        }
//        else
//        {
//            $this->error('站点已经关闭，请稍后访问~');
//        }

        // 模拟数据 (调试时打开以下注释,可以自动登录)
//        $session = array(
//            'uid'         => '312',
//            'username'    => 'aaa666',
//            'session_key' => md5('hello,world'), //session_id(),
//            'loginTime'   =>time() ,
//            'accessTime'  =>time() ,
//            'loginIP'     => ip2long('118.99.60.16'),
//            'fanDian'     => 4.4,
//            'fanDianBdw'  => 0,
//            'admin' => 0,
//            'type'  => 1,
//            'grade' => 1,
//            'coinPassword' => '150ba83deb19f420b93a1cadc2a4dbaa',
//            'parents' => '',
//        ) ;
//        session('user',null)     ;
//        session('user',$session) ;
//        session('user_auth_sign2',null) ;
//        session('user_auth_sign2',true) ;

        //是否登录判断
        $actionName = request()->action() ; //获取当前访问方法名
        if ( !session('user') || !session('user_auth_sign2') ) {
            //登录和退出登录不受控制
            if ( $actionName!='login' && $actionName!='logout' ) {
                $this->redirect( Url('user/login') ) ;
            }
        }

        //系统参数处理
        $this->settings = $this->getSystemSettings() ;
        $switchWeb = $this->settings['switchWeb'] ;
        if ($switchWeb && $switchWeb == '1') {
        } else {
            $this->error('站点已经关闭，请稍后访问~');
        }

        //登录用户参数值设置,方便前端使用
        $this->prename  = 'gygy_';
        $this->time     = intval($_SERVER['REQUEST_TIME']) ;
        cache('WEB_NAME',$this->settings['webName'],15*60) ;
        $this->assign('user',$this->user) ;
        $this->assign('settings',$this->settings) ;


    }

    protected function doLogin($username,$pwd='',$remember=false){

            if($pwd){
                $pwd = md5($pwd);
                $pwd = think_ucenter_md5($password, UC_AUTH_KEY) ;

                $user = model('members')
                ->where('username',$username)
                ->where('password',$pwd)
                ->find();

            }else{//记住我
                $user = model('members')
                ->where('remember',$username)
                ->find();
            }

            if(empty($user)){
                return null;
            }

            session('uid',$user['id']);
            session('user',$user);

            //只记住7天;
            if ($remember) {
                $remember_token = md5($user['username'].$user['password'].time());
                cookie('remember', $remember_token, 24 * 3600 * 7);
                db('members')->where('id',$user['uid'])->update(['remember'=>$remember_token,]);
            }            

            return $user;
    }   

    protected function isLogin(){
        $uid = session('uid');
        if(!$uid){
            if (cookie('?remember')) {
                $user = $this->doLogin(cookie('remember'));
                if($user)return $user['id'];
            }
            return 0;
        }else{
            return $uid;
        }
    }    


    protected function getTypes()
    {
        $this->types = model('type')->cache(true,10*60,'xcache')->where(array('isDelete'=>0))->order('sort')->select() ;
        $data = array() ;
        if ($this->types) {
            foreach ($this->types as $var) {
                $data[$var['id']]=$var ;
            }
        }
        return $this->types = $data ;
    }

    /**
     *  获取玩法数据
     * @return array
     */
    protected function getPlayeds()
    {
        $this->playeds = model('played')->cache(true,10*60,'xcache')->where(array('enable'=>1))->order('sort')->select();
        $data = array();
        if ( $this->playeds ) {
            foreach($this->playeds as $var){
                $data[$var['id']]=$var;
            }
        }
        return $this->playeds = $data;
    }

    protected function getGroups()
    {
        $this->groups = model('played_group')->cache(true,10*60,'xcache')->where(array('enable'=>1))->order('sort,id')->select();
        $data  = array();
        if($this->groups) foreach($this->groups as $var){
            $data[$var['id']]=$var;
        }
        return $this->groups = $data;
    }

    /**
     * 获取系统配置
     */
    protected function getSystemSettings()
    {
        $this->settings = array();

        if ($data = model('params')->select()) {
            foreach($data as $var){
                //\Think\Log::write('xief name:'.$var['name'].' value:'.$var['value']);
                $this->settings[$var['name']]=$var['value'];
            }
        }
        return $this->settings;
    }

    protected function getGameLastNo($type, $time=null)
    {
        if($time===null) $time = $this->time;
        $kjTime = $this->getTypeFtime($type) ;
        $atime  = date('H:i:s', $time+$kjTime) ;
        //$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type and actionTime<='".$atime."' order by actionTime desc limit 1";
        $return = model('data_time')->where(array('type'=>$type, 'actionTime'=>array('elt',$atime)))->order('actionTime desc')->limit(1)->find() ;
        if (!$return) {
            //$sql="select actionNo, actionTime from {$this->prename}data_time where type=$type order by actionNo desc limit 1";
            $return = model('data_time')->where(array('type'=>$type))->order('actionNo desc')->limit(1)->find() ;
            $time   = $time-24*3600 ;
        }
        $types = $this->getTypes() ;
        foreach($types as $play) {
            if($play['id'] == $type) {
                $fun = $play['onGetNoed'];
            }
        }

        if (method_exists($this, $fun)) {
//            $this->$fun($return['actionNo'], $return['actionTime'], $time);
        }
        return $return;
    }


    /**
     * 读取将要开奖期号
     *
     * @params $type		彩种ID
     * @params $time		时间，如果没有，当默认当前时间
     * @params $flag		如果为true，则返回最近过去的一期（一般是最近开奖的一期），如果为flase，则是将要开奖的一期
     */
    protected function getGameNo($type, $time=null)
    {
        if ($time===null) $time = $this->time ;
        $kjTime = $this->getTypeFtime($type) ;
        $atime  = date('H:i:s', $time+$kjTime);
        $return = model('data_time')->where(array('type'=>$type, 'actionTime'=>array('gt',$atime)))->order('actionTime')->limit(1)->find();

        if(!$return){
            $return = model('data_time')->where(array('type'=>$type))->order('actionTime')->limit(1)->find();
            $time=$time+24*3600;
        }

        $types=$this->getTypes();
        foreach($types as $play){
            if($play['id']==$type)
            {
                $fun=$play['onGetNoed'];
            }
        }

        if(method_exists($this, $fun)){
//            $this->$fun($return['actionNo'], $return['actionTime'], $time);
        }

        return $return;
    }

    /**
     * 获取延迟时间
     * @param $type
     * @return int
     */
    protected function getTypeFtime($type)
    {
        if($type){
            //$Ftime=$this->getValue("select data_ftime from {$this->prename}type where id = ".$type);
            $data = model('type')->where(array('id'=>$type))->field('data_ftime')->find();
            $Ftime = $data['data_ftime'];
        }
        if(!$Ftime)
            $Ftime=0;
        return intval($Ftime);
    }
    //////

    /**
     * 获取当期时间
     * @param $type
     * @param int $old
     * @return false|int
     */
    protected function getGameActionTime($type,$old=0){
        $actionNo=$this->getGameNo($type);

        if($type==1 && $actionNo['actionTime']=='00:00'){
            $actionTime=strtotime($actionNo['actionTime'])+24*3600;
        }else{
            $actionTime=strtotime($actionNo['actionTime']);
        }
        if(!$actionTime) $actionTime=$old;
        return $actionTime;
    }/////


    /**
     * 获取当期期数
     * @param $type
     * @return mixed
     */
    protected function getGameActionNo($type)
    {
        $actionNo = $this->getGameNo($type);
        return $actionNo['actionNo'];
    }

    /**
     * 重庆时时彩
     * @param $actionNo
     * @param $actionTime
     * @param null $time
     */
    public function noHdCQSSC(&$actionNo, &$actionTime, $time=null)
    {
        $this->setTimeNo($actionTime, $time);
        if($actionNo==0||$actionNo==120){
            //echo 999;
            $actionNo=date('Ymd-120', $time - 24*3600);
            $actionTime=date('Y-m-d 00:00', $time);

        } else{
            $actionNo=date('Ymd-', $time).substr(1000+$actionNo,1);
        }
    }

    /**
     * 天津时时彩
     * @param $actionNo
     * @param $actionTime
     * @param null $time
     */
    private function no0Hd(&$actionNo, &$actionTime, $time=null)
    {
        $this->setTimeNo($actionTime, $time);
        $actionNo=date('Ymd-', $time).substr(1000+$actionNo,1);
    }

    //新疆时时彩
    private function noxHd(&$actionNo, &$actionTime, $time=null)
    {
        $this->setTimeNo($actionTime, $time);
        if($actionNo>=84){
            $time-=24*3600;
        }

        $actionNo=date('Ymd-', $time).substr(100+$actionNo,1);
    }

    //福彩3D、排列三
    private function pai3(&$actionNo, &$actionTime, $time=null)
    {
        $this->setTimeNo($actionTime, $time);
        //echo $actionTime,' ',date('Y-m-d H:i:s', $time);
        $actionNo=date('Yz', $time);
        $actionNo=substr($actionNo,0,4).substr(substr($actionNo,4)+994,1);
        if ($actionTime >= date('Y-m-d H:i:s', $time)) {

        } else {
            $kjTime=$this->getTypeFtime($this->type);
            if(date('Y-m-d H:i:s', time()+$kjTime)<date('Y-m-d 23:59:59',time())) {
                $actionTime=date('Y-m-d 19:30', time()+24*60*60);
            } else {
                $actionNo = $actionNo+1;
                $actionTime=date('Y-m-d 19:30', time()+24*60*60);
            }
        }
    }

    //北京PK10
    private function BJpk10(&$actionNo, &$actionTime, $time=null)
    {
        $this->setTimeNo($actionTime, $time);
        $actionNo = 179 * (strtotime(date('Y-m-d', $time)) - strtotime('2007-11-11')) / 3600 / 24 + $actionNo - 2520;
    }

    //北京快乐8
    public function Kuai8(&$actionNo, &$actionTime, $time=null)
    {
        $this->setTimeNo($actionTime, $time);
        $actionNo = 179*(strtotime(date('Y-m-d', $time))-strtotime('2004-09-19'))/3600/24+$actionNo-2584;
    }
    // 韩国1.5分彩
    private function hgssc(&$actionNo, &$actionTime, $time=null)
    {
        $this->setTimeNo($actionTime, $time);
        $actionNo = intval((strtotime($actionTime) - 30 - strtotime('2016-09-09 13:04:00')) / 90) + 1633053;
        $actionNo = strval($actionNo);
        //$actionTime = date('Y-m-d H:i:s', strtotime($actionTime) + 30);
        //echo $actionTime.' '.$actionNo;exit;
    }
    private function setTimeNo(&$actionTime, &$time=null)
    {
        if(!$time) $time = $this->time;
        $actionTime=date('Y-m-d ', $time).$actionTime;
    }
    /**
     * 用户资金变动
     *
     * 请在一个事务里使用
     */
    protected function addCoin($log)
    {
        return true ;
        if(!isset($log['uid'])) $log['uid']     = $this->user['uid'];
        if(!isset($log['info'])) $log['info']   = '';
        if(!isset($log['coin'])) $log['coin']   = 0;
        if(!isset($log['type'])) $log['type']   = 0;
        if(!isset($log['fcoin'])) $log['fcoin'] = 0;
        if(!isset($log['extfield0'])) $log['extfield0']=0;
        if(!isset($log['extfield1'])) $log['extfield1']='';
        if(!isset($log['extfield2'])) $log['extfield2']='';

        $sql = " call setCoin({$log['coin']}, {$log['fcoin']}, {$log['uid']}, {$log['liqType']}, {$log['type']}, '{$log['info']}', {$log['extfield0']}, '{$log['extfield1']}', '{$log['extfield2']}')";

        //echo $sql;exit;
        if(Db::execute($sql)===false) {
            return false;
        } else {
            return true;
        }
        return false;
    }

    /**
     * 获取来访IP地址
     */
    protected static final function ip($outFormatAsLong=false)
    {
        $ip = get_client_ip($outFormatAsLong);
        //dump('ip:'.$_SERVER['HTTP_USER_AGENT']);
        return $ip;
    }

    /**
     * 数据集分页
     * @param array $records 传入的数据集
     */
    public function recordList($records , $count=10)
    {
        $request    =  request()->param() ;
        $total      =   $records ? count($records) : 1 ;

        if ( isset($request['r']) ) {
            $listRows = (int)$request['r'];
        } else {
            $listRows = config('paginate.list_rows') > 0 ? config('paginate.list_rows') : $count ;
        }
        $page       =   new \app\classes\page($total, $listRows, $request) ;
        $voList     =   array_slice($records, $page->firstRow, $page->listRows) ;
        $p			=	$page->show() ;
        $this->assign('_list', $voList) ;
        $this->assign('_page', $p? $p: '') ;
    }

}
