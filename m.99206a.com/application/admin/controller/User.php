<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Db;
use think\Config;
use app\logic\ip2addr;
class user extends Login {
    
    public function index(){
        $where = [];
        $param = $this->request->param();
        $selecttype = '';
        $likevalue = '';
        if(isset($param['selecttype'] )){
            $selecttype = $param['selecttype'] ?? '';
            $conf['selecttype'] = $selecttype;
        }
        if(isset($param['likevalue'])){
            $likevalue = $param['likevalue'];
            $conf['likevalue'] = $likevalue;
            if($likevalue){
                $where[$selecttype] = ['like','%'.$likevalue.'%'];
            }
        }
        $mtypes = array('online','all','youxiao','stop');
        $mtype = $param['mtype'] ?? 'all';
        $conf['mtype'] = $mtype;
        
        switch($mtype){
            case 'online':
                $where['ul_type'] = ['eq','1'];
                
                break;
            case 'youxiao':
                $where['money'] = ['gt','0'];
                break;
            case 'stop':
                $where['is_stop'] = ['eq','1'];
                break;
            default:
                break;
                    
        }
        
        Config::set('paginate.query',$conf);
        //$list = Db::table('g_user_login')->where($where)->order('reg_date','desc')->paginate(20);
        $query = db('g_user_login')->where($where);
        $options = $query->getOptions();
        $list = $query->order('reg_date','desc')->paginate(20);
        $record = $query->options($options)->count();
        $list->extra(['总记录'=>$record]);
        
        $this->assign('page', $list);
        $this->assign('selecttype',$selecttype);
        $this->assign('likevalue',$likevalue);
        return $this->fetch('index');
    }
    
    public function test(){
        $param = $this->request->param();
    }
    
    public function edit($id){
        $users = new \app\model\user();
        $info = $users->get($id);
        $question = new \app\model\question();
        $questions = $question->all();
        $group = new \app\model\level();
        $groups = $group->all();
        $this->assign('info',$info);
        $this->assign('questions',$questions);
        $this->assign('groups',$groups);
        return $this->fetch("edit");
    }
    
    public function stop(){
        $param = $this->request->param();
        $arr= $param['uid'];
        $go = $param['go'];
        $uid= '';
        $i= 0;
        foreach($arr as $k=>$v){
            $uid .= $v.',';
            $i++;
        }
        $uid	=	rtrim($uid,',');
        if($go == 1){
            $sql = "UPDATE k_user set `is_kick` = 1, is_stop=1,why=concat_ws('，',why,'管理员：".Session('login_name')." 停用此账户') where uid in ($uid) and (is_stop=0 or is_stop is null)";
            Db::query($sql);
            Db::query("update `k_user_login` set `is_login`=0 WHERE uid in ($uid)");
            $this->success('操作成功!');
        }elseif($go == '0'){
            $sql = "UPDATE k_user set is_stop=0 where uid in ($uid) and is_stop=1";
        }elseif($go == 3){//踢线
            Db::query("update `k_user` set `is_kick`=1 WHERE uid in ($uid)");
            $sql = "update k_user_login set `is_login`=0 where uid in ($uid) and `is_login`>0";
        }elseif($go == 4){
            $sql = "update k_user set is_daili=0 where uid in ($uid) and is_daili=1";
        }
        $msg	=	'操作失败！';
        Db::startTrans();
        try{
            $q1		=	Db::execute($sql);
            if($q1==$i){
                Db::commit(); //事务提交
                $msg	=	'操作成功！';
            }else{
                Db::rollback(); //数据回滚
            }
        }catch(Exception $e){
            Db::rollback(); //数据回滚
        }
        $this->success($msg);
    }
    
    public function delete($id = 0){
        
    }
    
    public function stopzr($id=0){
        
    }
    
    public function save(){
        $post = $this->request->post();
        $id = $post['uid'];
        if($post['pass']){
            $post['password'] = md5($post['pass']);
        }
        if($post['pass1']){
            $post['qk_pwd'] = md5($post['pass1']);
        }
        $user = new \app\model\user();
        if($id){
            $status = $user->allowField(true)->save($post,['uid' => $id]);
        }else{
            $status = $user->allowField(true)->save($post);
        }
        if($status){
            $this->success('处理成功!');
        }else{
            $this->error('处理失败!');
        }
    }
    
    public function add(){
        
    }
    
    public function hecha($id){
        
    }
    
    public function more_detail(){
        $param = $this->request->param();
        $uid = $param['uid'];
        if (empty($uid)) {
            echo 'uid can not empty';
            exit;
        }
        
        $sql = "select * from k_user where uid='$uid'";
        $rows = Db::query($sql) ?? ''; 
        if(!$rows){
            $this->error('用户不存在!');
        }else{
            $rows = $rows[0];
        }
        $username = $rows['username'];
        
        /*
         最近5次在线支付 时间和金额
         最近1次 1000 2016-10-25 15：08
         最次2次 1000 2016-10-25 15：08
         最近3次 1000 2016-10-25 15：08
         最近4次 1000 2016-10-25 15：08
         最近5次 1000 2016-10-25 15：08
         */
        $sql = "select * from k_money where status=1 and uid='$uid' and type in (1) and about not like '%管理员结算%' order by m_make_time desc limit 5";
        $tmprows = Db::query($sql);
        $var1 = array();
        $i = 1;
        foreach($tmprows as $rows){
            $temp = array();
            $temp['index'] = '最近'.$i.'次';
            $temp['value'] = $rows['m_value'];
            $temp['time'] = $rows['m_make_time'];
            $var1[] = $temp;
            $i++;
        }
        
        /*
         最近5次公司入款 时间和金额
         最近1次 1000 2016-10-25 15：08
         最次2次 1000 2016-10-25 15：08
         最近3次 1000 2016-10-25 15：08
         最近4次 1000 2016-10-25 15：08
         最近5次 1000 2016-10-25 15：08
         */
        $sql = "select * from huikuan where status=1 and uid='$uid' order by adddate desc limit 5";
        $tmprows = Db::query($sql);
        $var2 = [];
        $i = 1;
        foreach($tmprows as $rows){
            $temp = array();
            $temp['index'] = '最近'.$i.'次';
            $temp['value'] = $rows['money'];
            $temp['time'] = $rows['adddate'];
            $var2[] = $temp;
            $i++;
        }
        /*
         最近5次在线提款 时间和金额
         最近1次 1000 2016-10-24 15：01
         最次2次 1000 2016-10-24 15：01
         最近3次 1000 2016-10-24 15：01
         最近4次 1000 2016-10-25 15：08
         最近5次 1000 2016-10-25 15：08
         */
        $sql = "select * from k_money where status=1 and uid='$uid' and m_value<0 and type in (11,12) order by m_make_time desc limit 5";
        $tmprows = Db::query($sql);
        $var3 = [];
        $i = 1;
        foreach($tmprows as $rows){
            $temp = array();
            $temp['index'] = '最近'.$i.'次';
            $temp['value'] = $rows['m_value'];
            $temp['time'] = $rows['m_make_time'];
            $var3[] = $temp;
            $i++;
        }
        
        /*
         历史总提款数
         */
        $sql = "select sum(m_value) as total_m_value from k_money where status=1 and uid='$uid' and m_value<0 and type in (11,12)";
        $var4 = '';
        $i = 1;
        $rows = Db::query($sql);
        $var4 = $rows[0]['total_m_value'] ?? 0;
        
        
        /*
         历史在线支付
         */
        $sql = "select sum(m_value) as total_m_value from k_money where status=1 and uid='$uid' and type in (1) and about not like '%管理员结算%'";
        $var5 = '';
        $i = 1;
        $rows = Db::query($sql);
        $var5 = $rows[0]['total_m_value'] ?? 0;
        
        /*
         历史公司入款
         */
        $sql = "select sum(money) as total_m_value from huikuan where status=1 and uid='$uid'";
        $var6 = '';
        $i = 1;
        $rows = Db::query($sql);
        $var6 = $rows[0]['total_m_value'] ?? 0;
        
        /*
         历史红利赠送
         */
        $sql = "select sum(m_value) as total_m_value from k_money where status=1 and uid='$uid' and about like '%管理员结算%'";
        $var7 = '';
        $i = 1;
        $rows = Db::query($sql);
        $var7 = $rows[0]['total_m_value'] ?? 0;
        
        /*
         最近5次红利赠送 时间和金额
         最近1次 1000 2016-10-24 15：01
         最次2次 1000 2016-10-24 15：01
         最近3次 1000 2016-10-24 15：01
         最近4次 1000 2016-10-25 15：08
         最近5次 1000 2016-10-25 15：08
         */
        $sql = "select * from k_money where status=1 and uid='$uid' and about like '%管理员结算%' order by m_make_time desc limit 5";
        $var8 = [];
        $i = 1;
        $tmprows = Db::query($sql);
        foreach ($tmprows as $rows  ){
            $temp = array();
            $temp['index'] = '最近'.$i.'次';
            $temp['value'] = $rows['m_value'];
            $temp['time'] = $rows['m_make_time'];
            $var8[] = $temp;
            $i++;
        }
        $this->assign('username',$username);
        $this->assign('var1',$var1);
        $this->assign('var2',$var2);
        $this->assign('var3',$var3);
        $this->assign('var4',$var4);
        $this->assign('var5',$var5);
        $this->assign('var6',$var6);
        $this->assign('var7',$var7);
        $this->assign('var8',$var8);
        return $this->fetch();
    }
}
