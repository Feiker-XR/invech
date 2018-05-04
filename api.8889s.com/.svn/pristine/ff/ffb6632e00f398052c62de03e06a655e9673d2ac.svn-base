<?php 
namespace app\v1\controller;
use app\v1\Base;
use think\Cache;

class pub extends Base {
    public function test(){
        $key = 'http://api.dd788799.com|111.125.82.186:timer';
        echo Cache::get($key);
    }
    public function notice(){
        /**
         * 0首页公告
         * 1体育公告
         * 2彩票公告
         * 3真人公告
         * 888代理公告
         * @var Ambiguous $type
         */
        $type = intval($this->request->param('type')); 
        $num  = $this->request->param('num');
        $num  = ($num) ? $num : 5 ;
        $page = $this->request->param('page');
        
        $where['is_class'] = ['eq',$type];
        $where['is_show'] = ['eq',1];
        $info = db('k_notice')->field(['nid','msg as content','add_time as time'])->where($where)->paginate($num,false,['page'=>$page]);
        //$info = json_decode(json_encode($info),true);
        $info = $info->toArray();
        
        $data = $info['data'];
        foreach($data as $k=>$v){
            $v['content'] = html_entity_decode($v['content']);
            $tmp[] = $v;
        }
        $info['data'] = $tmp;
        $info['status'] = 0;
        return $info;
    }
    
    public function lunbo(){
        $info = [
            'status'    => 0,
            'data'      => [
                [
                    'url'  => 'http://5000fa.com/img/b2017111401.png',
                    'href' => 'http://5000fa.com'
                ],
                [
                    'url'  => 'http://5000fa.com/images/flash/f1.jpg',
                    'href' => 'http://5000fa.com'
                ],
                [
                    'url'  => 'http://5000fa.com/images/flash/f2.png',
                    'href' => 'http://5000fa.com'
                ],
                [
                    'url'  => 'http://5000fa.com/images/flash/f3.png',
                    'href' => 'http://5000fa.com'
                ]
            ]
        ];
        return $info;
    }
    
    public function promotions(){

        $titles = [
            '/images/hot/20171122001t.png',
            '/images/hot/20171122002t.png',
            '/images/hot/20171122003t.png',
            '/images/hot/20171122004t.png',
            '/images/hot/20171122005t.png',
        ];
        $contents = [
            '/images/hot/20171122001c.png',
            '/images/hot/20171122002c.png',
            '/images/hot/20171122003c.png',
            '/images/hot/20171122004c.png',
            '/images/hot/20171122005c.png',
        ];

        $domain = request()->domain();

        $data = [];

        foreach ($titles as $key => $title) {
            $titles[$key] = $domain . $titles[$key];
            $contents[$key] = $domain . $contents[$key];
            $data[] = [
                'title'  => $titles[$key] ,
                'content'=> $contents[$key],
            ];
        }

        $info = [
            'status'    => 0,
            'data'      => $data,
        ];
        return $info;
    }
/*  
    public function rule($type){
        $lotterys = ['cqssc','xyft','xjssc','csf','gsf','pk10','gxsf','jsk3','six'];
        if(!in_array($type,$lotterys)){
            return $this->api_error('彩种不存在!');
        }
        if('csf' == $type){
            $type = 'cqklsf';
        }
        if('gsf' == $type){
            $type = 'gdklsf';
        }
        if('gxsf' == $type){
            $type = 'gxklsf';
        }        
        if('pk10' == $type){
            $type = 'bjpk10';
        }                

        $url = url('rule/'.$type,[],true,true);
        return $this->api_success($url);
    }
*/
    public function help($id=1){
        config('default_return_type','html');
        $about = new \app\model\about();
        $info = $about->get($id);
        $menu = $about->getList('1,2,3,4,5');
        $this->assign('current',$id);
        $this -> assign('menu',$menu);
        $this->assign('info',$info); 
        return $this->fetch('about/index');
    }

    public function register_bak(){
        $conf = Cache::get('sysConfig');
 
        if($conf['regYzm']){
            if(!captcha_check($_POST['zcyzm'])){
                $this->error('验证码错误!');
            }
        }
        $data = array(
            'username'      =>  input('zcname'),
            'password'      =>  input('zcpwd1'),
            'repassword'    =>  input('zcpwd2'),
            'zcturename'    =>  input('zcturename'),
            'qkpwd1'        =>  input('qkpwd1'),
            'qkpwd2'        =>  input('qkpwd2'),
            'zcanswer'      =>  input('zcanswer'),
        );
        $validate = new \app\index\validate\user();
        if($validate->scene('reg')->check($data)){
            $user = new \app\model\user();
            $sysConfig = cache('sysConfig');
            $data['password'] = md5($data['password']);
            $data['zcquestion'] = input('zcquestion');
            $data['currency']   = input('currency');
            $reg_ip = $data['reg_ip']     = $this->request->ip();
            //限制IP
            if($sysConfig['reg_ip'] && 0){
                $info = $user->get(function ($query) use ($reg_ip){
                    $query->where('reg_ip',$reg_ip);
                });
                if($info){
                    return ['status'=>1,'msg'=>'当前限制每个IP只能注册一个用户!',];
                }
            }

            //限制用户真实姓名
            if($sysConfig['reg_name']){
                $truename= $data['zcturename'];
                $info = $user->get(function ($query) use ($truename){
                    $query->where('pay_name',$truename);
                });
                if($info){
                    return ['status'=>1,'msg'=>'用户真实姓名已经存在!',];
                }
            }
            $data['pay_name'] = $data['zcturename'];
            $data['ask'] = $data['zcquestion'];
            $data['answer'] = $data['zcanswer'];
            $data['gid'] = 1;
            $user->allowField(True)->save($data);
                return ['status'=>0,'msg'=>'注册成功!请登录!',];
        }else{
                return ['status'=>1,'msg'=>$validate->getError(),];
        }        
    }    

    //app注册只需要用户名和密码即可;
    public function register(){
        $conf = Cache::get('sysConfig');
 
        if($conf['regYzm']){
            if(!captcha_check($_POST['zcyzm'])){
                $this->error('验证码错误!');
            }
        }
        $data = array(
            'username'      =>  input('zcname'),
            'password'      =>  input('zcpwd1'),
            'repassword'    =>  input('zcpwd2'),
            'zcturename'    =>  input('zcturename'),
            'qkpwd1'        =>  input('qkpwd1'),
            'qkpwd2'        =>  input('qkpwd2'),
            'zcanswer'      =>  input('zcanswer'),
        );
        $validate = new \app\index\validate\user();
        if($validate->scene('reg_api')->check($data)){
            $user = new \app\model\user();
            $sysConfig = cache('sysConfig');
            $data['password'] = md5($data['password']);
            $data['zcquestion'] = input('zcquestion');
            $data['currency']   = input('currency',1);
            $reg_ip = $data['reg_ip']     = $this->request->ip();
            //限制IP
            if($sysConfig['reg_ip'] && 0){
                $info = $user->get(function ($query) use ($reg_ip){
                    $query->where('reg_ip',$reg_ip);
                });
                if($info){
                    return ['status'=>1,'msg'=>'当前限制每个IP只能注册一个用户!',];
                }
            }
            /*
            //限制用户真实姓名
            if($sysConfig['reg_name']){
                $truename= $data['zcturename'];
                $info = $user->get(function ($query) use ($truename){
                    $query->where('pay_name',$truename);
                });
                if($info){
                    return ['status'=>0,'msg'=>'用户真实姓名已经存在!',];
                }
            }
            */
            $data['pay_name'] = $data['zcturename'];
            $data['ask'] = $data['zcquestion'];
            $data['answer'] = $data['zcanswer'];
            $data['gid'] = 1;
            $user->allowField(True)->save($data);
                return ['status'=>0,'msg'=>'注册成功!请登录!',];
        }else{
                return ['status'=>1,'msg'=>$validate->getError(),];
        }        
    }    

    public function login(){
        $validate = new \app\index\validate\user();
        $sysConfig = Cache::get('sysConfig');
        //var_dump($sysConfig);
        if($sysConfig['loginYzm'] == '1' && isset($_POST['dlyzm'])){
            if(!captcha_check($_POST['dlyzm'])){
                exit(json_encode(array('status'=>1,'msg'=>'验证码错误!',)));
            }
        }
        $username = input('username');
        $password = input('password');
        $username = trim($username);
        $password = trim($password);
        if(!$username || !$password){
            return ['status'=>1,'msg'=>'用户名或密码不能为空!'];
        }
        $data = array(
                'username'  =>  $username,
                'password'  =>  $password,
        );
        if($validate->scene('login')->check($data)){
            return $this->is_login($username, $password);
        }else {
            return ['status'=>1,'msg'=>$validate->getError()];
      
        } 
    }

    /**
     * 登录&验证
     * @param string $username 用户名
     * @param string $password 密码
     */
    protected function is_login($username,$password){
        date_default_timezone_set('PRC');
        $request = request();
        $ClientSity = GetIpLookup($request->ip());//取出客户端IP所在城市
        $ipinfo = config('ipinfo');
        //$json = file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$request->ip());
                
        if($_SERVER['REMOTE_ADDR'] == '127.0.0.1'){
            $json = '{"code":0,"data":{"country":"\u5185\u7f51IP","country_id":"-1","area":"","area_id":"-1","region":"","region_id":"-1","city":"\u5185\u7f51IP","city_id":"local","county":"\u5185\u7f51IP","county_id":"local","isp":"\u5185\u7f51IP","isp_id":"local","ip":"127.0.0.1"}}';  
        }else{
            $json = file_get_contents("{$ipinfo}?ip=".$request->ip());    
        }
                
        $arr = json_decode($json);
        $arr = object2array($arr);
        if(empty($arr)){
            if($ClientSity['city']!=''){
                $city = $ClientSity['city'];
            }else {
                $city = $ClientSity['country'];
            }
        }else {
            if($arr['data']['city']!=''){
                $city = $arr['data']['city'];
            }else {
                $city = $arr['data']['country'];
            }
        }
        $user = db('k_user')->where(array('username'=>$username,'password'=>md5($password)))->find();
        if(!$user){
            return ['status'=>1,'msg'=>'用户名称或密码错误!'];
        }
        if($user["is_delete"] == 1 && $user["is_stop"] == 1){   //停用，或被删除，或其它信息
            return ['status'=>1,'msg'=>'账户异常无法登陆，如有疑问请联系在线客服!'];
        }
        //Session::init();
        $session_id = session_id();
        $res['is_kick'] = 0;
        $res['login_time'] = date("Y-m-d H:i:s", time());
        $res['login_ip'] = $request->ip();
        $res['lognum'] = +$user['lognum']+1;
        $res['session_id'] = $session_id;

        db('k_user')->where('uid',$user['uid'])->cache()->update($res);
        
        $userlogin = db('k_user_login')->where('uid',$user['uid'])->find();
        $url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $time   =   time();
        $date   =   date('YmdHis');
        if($userlogin){
            $r['login_id'] = $time."_".$user['uid']."_".$username;
            $r['login_time'] = $time;
            $r['is_login'] = 1;
            $r['www'] = $url;
            db('k_user_login')->where('uid',$user['uid'])->update($r);
        }else {
            $r['login_id'] = $time."_".$user['uid']."_".$username;
            $r['uid'] = $user['uid'];
            $r['login_time'] = $time;
            $r['is_login'] = 1;
            $r['www'] = $url;
            db('k_user_login')->insert($r);
        }
        /*
        $db = \Db::connect(Config::get('otherdb'));
        $sql = " insert into `history_login` (`uid`,`username`,`ip`,`ip_address`,`login_time`,`www`) VALUES (".$user['uid'].",'$username','".$request->ip()."','".$city."','".date("Y-m-d H:i:s", time())."','$url') ";
        $db->query($sql);
        */
        $history_login['uid'] = $user['uid'];
        $history_login['username'] = $username;
        $history_login['ip'] = $request->ip();
        $history_login['ip_address'] = $city;
        $history_login['login_time'] = date("Y-m-d H:i:s", time());
        $history_login['www'] = $url;
        
        db('history_login','otherdb')->insert($history_login);
        session('uid',$user['uid']);
        session('username',$username);
        session('is_daili',$user['is_daili']);
        session('gid',$user['gid']);
        session('denlu','one');
        session('user_login_id',$time.'_'.$user["uid"].'_'.$username);

        //throw new \Exception('abc');        
        return ['status'=>0,'msg'=>'登录成功','data'=>'',];
    }
	
	/**
	 *返回支付地址
	 *
	 */
	public function pay_content($order_id){
        $order = db('vc_order')->where('order_id',$order_id)->find();
        echo $order['pay_content']? $order['pay_content']  : '';
    }

    /**
     *  获取 在线客服跳转地址
     * @return mixed
     */
    public function getCustomerHelpUrl()
    {
       $data['status'] = 0 ;
       $data['url']    = 'https://static.meiqia.com/dist/standalone.html?_=t&eid=74300' ;
       return $data ;
    }

    public function session()
    {
        $uid = session('uid');
        $session_id = session_id();
        session(null);
        $ret = session_regenerate_id(true);
        //session_regenerate_id 只是将原来的session数据对应的session_id改变;
        //session('uid')还是可以获取到数据
        $data['status'] = 0 ;
        return $data ;
    }
    
    /**
     * 关于我们
     */
    public function aboutus(){
        $info = db('web_about')->where('id','eq','1')->find();
        $str = $info['content'];
        $str = html_entity_decode($str);
        $str = preg_replace('/<br\\s*?\/??>/i','',$str);
        $str = strip_tags($str);
        $str = str_replace('&nbsp;', '', $str);
        $data['status'] = 0;
        $data['content'] = $str;
        $json = json_encode($data);
        $json = str_replace("\\r", '', $json);
        $data = json_decode($json,true);
        return $data;
    }
    
    /**
     * 博彩责任
     */
    public function bczr(){
        $info = db('web_about')->where('id','eq','2')->find();
        $str = $info['content'];
        $str = html_entity_decode($str);
        $str = preg_replace('/<br\\s*?\/??>/i','',$str);
        $str = strip_tags($str);
        $str = str_replace('&nbsp;', '', $str);
        $data['status'] = 0;
        $data['content'] = $str;
        $json = json_encode($data);
        $json = str_replace("\\r", '', $json);
        $data = json_decode($json,true);
        return $data;
    }
    
    /**
     * 隐私政策
     */
    public function yszc(){
        $info = db('web_about')->where('id','eq','3')->find();
        $str = $info['content'];
        $str = html_entity_decode($str);
        $str = preg_replace('/<br\\s*?\/??>/i','',$str);
        $str = strip_tags($str);
        $str = str_replace('&nbsp;', '', $str);
        $data['status'] = 0;
        $data['content'] = $str;
        $json = json_encode($data);
        $json = str_replace("\\r", '', $json);
        $data = json_decode($json,true);
        
        return $data;
    }
    
    /**
     * 规则条款
     */
    public function gztk(){
        $info = db('web_about')->where('id','eq','4')->find();
        $str = $info['content'];
        $str = html_entity_decode($str);
        $str = preg_replace('/<br\\s*?\/??>/i','',$str);
        $str = strip_tags($str);
        $str = str_replace('&nbsp;', '', $str);
        $data['status'] = 0;
        $data['content'] = $str;
        $json = json_encode($data);
        $json = str_replace("\\r", '', $json);
        $data = json_decode($json,true);
        return $data;
    }
    
    /**
     * 常见问题
     */
    public function cjwt(){
        $info = db('web_about')->where('id','eq','5')->find();
        $str = $info['content'];
        $str = html_entity_decode($str);
        $str = preg_replace('/<br\\s*?\/??>/i','',$str);
        $str = strip_tags($str);
        $str = str_replace('&nbsp;', '', $str);
        $data['status'] = 0;
        $data['content'] = $str;
        $json = json_encode($data);
        $json = str_replace("\\r", '', $json);
        $data = json_decode($json,true);
        return $data;
    }
    
    /**
     * 存款帮助
     */
    public function ckbz(){
        $info = db('web_about')->where('id','eq','6')->find();
        $str = $info['content'];
        $str = html_entity_decode($str);
        $str = preg_replace('/<br\\s*?\/??>/i','',$str);
        $str = strip_tags($str);
        $str = str_replace('&nbsp;', '', $str);
        $data['status'] = 0;
        $data['content'] = $str;
        $json = json_encode($data);
        $json = str_replace("\\r", '', $json);
        $data = json_decode($json,true);
        return $data;
    }
    
    /**
     * 取款帮助
     */
    public function qkbz(){
        $info = db('web_about')->where('id','eq','7')->find();
        $str = $info['content'];
        $str = html_entity_decode($str);
        $str = preg_replace('/<br\\s*?\/??>/i','',$str);
        $str = strip_tags($str);
        $str = str_replace('&nbsp;', '', $str);
        $data['status'] = 0;
        $data['content'] = $str;
        $json = json_encode($data);
        $json = str_replace("\\r", '', $json);
        $data = json_decode($json,true);
        return $data;
    }
    
    /**
     * 代理方案
     */
    public function dl(){
        $info = db('web_about')->where('id','eq','8')->find();
        $str = $info['content'];
        $str = html_entity_decode($str);
        $str = preg_replace('/<br\\s*?\/??>/i','',$str);
        $str = strip_tags($str);
        $str = str_replace('&nbsp;', '', $str);
        $data['status'] = 0;
        $data['content'] = $str;
        $json = json_encode($data);
        $json = str_replace("\\r", '', $json);
        $data = json_decode($json,true);
        return $data;
    }

    
    /**
     *代理协议
     */
    public function dlxy(){
        $info = db('web_about')->where('id','eq','9')->find();
        $str = $info['content'];
        $str = html_entity_decode($str);
        $str = preg_replace('/<br\\s*?\/??>/i','',$str);
        $str = strip_tags($str);
        $str = str_replace('&nbsp;', '', $str);
        $data['status'] = 0;
        $data['content'] = $str;
        $json = json_encode($data);
        $json = str_replace("\\r", '', $json);
        $data = json_decode($json,true);
        return $data;
    }
    
    //data=1未上线   
    public function online(){
        return ['status'=>0,'msg'=>'','data'=>'1',];
    }

    //data=1未上线   
    public function online_ocr(){
        return ['status'=>0,'msg'=>'','data'=>'0',];
    }

    public function deviceToken(){
        $token = input('token');
        if(!$token || 64!=strlen($token)){
            return ['status'=>1,'msg'=>'token不合法','data'=>null];
        }   
        db('device_toen')->insert(['token'=>$token]);
        return ['status'=>0,'msg'=>'','data'=>null];
    }

    private function send(){

        //手机注册时候返回的设备号，在xcode中输出的，复制过来去掉空格
        //$deviceToken = ‘70653cf189aeed1fbf207437446b6c9f6dbc406b57de38e52d1667edf1cd8a05‘;        
        $deviceToken = 'bbe51b4b28aaeee9d166aa70fab9abb07184b84060bd7023d9abffaf5a367e48';

        //刚刚合并pem文件时候自己设置的密码
        $pass = '123456';    
        //消息内容
        $message = 'new abc!'.time();
        //badge，也就是app中得小红点数
        //$badge = 1;
        //sound，是提示音， default是代表系统默认的提示音，也就是apple那个来通知的特别俗的提示音
        $sound = 'default';
        //通知的内容，必须是json
        $body = array();
        $body['aps'] = array('alert' => $message);
        static $badge=1;
        $body['aps']['badge'] = $badge += 1;
        if ($sound)
          $body['aps']['sound'] = $sound;
        //把数组数据转换为json数据
        $payload = json_encode($body);  
        //这个注释的是上线的地址，下边是测试地址，对应的是发布和开发：ssl://gateway.sandbox.push.apple.com:2195这个是沙盒测试地址，ssl://gateway.push.apple.com:2195正式发布地址
        //创建推送流，然后配置推送流。
        $perm_path = APP_PATH . request()->module() . DS . 'apns-dis.pem';  
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $perm_path);   //刚刚合成的pem文件
        stream_context_set_option($ctx, 'ssl', 'passphrase', $pass);
        //$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60,STREAM_CLIENT_CONNECT, $ctx);
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60,STREAM_CLIENT_CONNECT, $ctx);

        if (!$fp) {
            print "Failed to connect $err $errstr\n";
            return;
        }
        else {
           print "Connection OK\n<br/>";
        }
        // send message
        $msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) .$payload;
        //推送和关闭当前流
        fwrite($fp, $msg);
        fclose($fp);

    }

    public function send_ocr(){

        //手机注册时候返回的设备号，在xcode中输出的，复制过来去掉空格
        //$deviceToken = ‘70653cf189aeed1fbf207437446b6c9f6dbc406b57de38e52d1667edf1cd8a05‘;        
        $deviceToken = '40601dfb6fa5815a0a5ce74d7be2f1d19d5900f793136063559ef21cb8c7afb2';

        //刚刚合并pem文件时候自己设置的密码
        $pass = '123456';    
        //消息内容
        $message = 'new abc!'.time();
        //badge，也就是app中得小红点数
        //$badge = 1;
        //sound，是提示音， default是代表系统默认的提示音，也就是apple那个来通知的特别俗的提示音
        $sound = 'default';
        //通知的内容，必须是json
        $body = array();
        $body['aps'] = array('alert' => $message);
        static $badge=1;
        $body['aps']['badge'] = $badge += 1;
        if ($sound)
          $body['aps']['sound'] = $sound;
        //把数组数据转换为json数据
        $payload = json_encode($body);  
        //这个注释的是上线的地址，下边是测试地址，对应的是发布和开发：ssl://gateway.sandbox.push.apple.com:2195这个是沙盒测试地址，ssl://gateway.push.apple.com:2195正式发布地址
        //创建推送流，然后配置推送流。
        $perm_path = APP_PATH . request()->module() . DS . 'apns_dis_ocr.pem';   
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $perm_path);   //刚刚合成的pem文件
        stream_context_set_option($ctx, 'ssl', 'passphrase', $pass);
        //$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60,STREAM_CLIENT_CONNECT, $ctx);
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60,STREAM_CLIENT_CONNECT, $ctx);

        if (!$fp) {
            print "Failed to connect $err $errstr\n";
            return;
        }
        else {
           print "Connection OK\n<br/>";
        }
        // send message
        $msg = chr(0) . pack("n",32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n",strlen($payload)) .$payload;
        //推送和关闭当前流
        fwrite($fp, $msg);
        fclose($fp);

    }

    public function app(){
        $name = input('name');
        if(empty($name)){
            $name = 'default';
        }
        $status = config('app_shenhe');
        $data = $status[$name]??[];
        return ['status'=>0,'msg'=>'','data'=>$data,];
                
    }
}

