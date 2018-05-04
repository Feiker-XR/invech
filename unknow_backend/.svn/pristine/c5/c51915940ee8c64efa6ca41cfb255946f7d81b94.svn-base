<?php
namespace app\v2\controller;
use app\v2\Base;
use app\wechat\WXBizMsgCrypt;
use think\Cache;
use think\Db;
class oauth extends Base{
    
    private $token = 'g5r7li6uqga1wwtm';
    private $encodingAesKey = 'daskkq8sm68l9578041mj7jh5gqkqw9bgu3g0xyl94s';
    private $oathurl = 'http://front.8889s.com/index.php/oauth/index.html';
    private $appid = 'wx863988e21769c689';
    private $appSecert = '371975a85efa3c75a4b0b496ea7b6ad2';
    private $access_token = '';
    private $refresh_token = '';
    public function _initialize(){
        $openid = Session('openid');
        $ation = $this->request->action();
        if($ation != 'getopenid'){
           if(!$openid){
               $redirect_uri = urlencode('http://77158.5awo.com/oauth/getopenid.html');
               $url = "https://open.weixin.qq.com/connect/oauth2/authorize?";
               $url .= "appid={$this->appid}&redirect_uri=$redirect_uri&response_type=";
               $url .= "code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
               $this->redirect($url);
           }
        }
        if($this->request->action() != 'testauth'){
            $tokenInfo = Cache::get('accessTokenInfo');
            if($tokenInfo == ''){
                $tokenInfo = $this->getAccessToken();
                Cache::set('tokenInfo', $tokenInfo);
            }else{
                if(time() >$tokenInfo['expires_in']){
                    $tokenInfo = $this->getAccessToken();
                    Cache::set('tokenInfo', $tokenInfo);
                }
            }
            $this->access_token = $tokenInfo['access_token'];
        }
        
    }
    
    public function getopenid(){
        $code = $_REQUEST['code'];
        $state = $_REQUEST['state'];
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token';
        $param = [
            'appid'     => $this->appid,
            'secret'    => $this->appSecert,
            'code'      => $code,
            'grant_type'=> 'authorization_code',
        ];
        $content = $this->http($url, $param,'GET');
        $info = json_decode($content,TRUE);
        if($info['errcode']){
            $this->error('获取用户信息失败,无效的CODE');
        }else{
            $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$info['access_token']}&openid={$info['openid']}&lang=zh_CN";
            $param = [
                'access_token'  => $info['access_token'],
                'openid'        => $info['openid'],
                'lang'          => 'zh_CN',
            ];
            $userinfo = json_decode($this->http($url,$param),true);
            if($userinfo['errcode']){
                $this->error('获取用户信息失败,无效的用户ID');
            }else{
                /*
                openid	用户的唯一标识
                nickname	用户昵称
                sex	用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
                province	用户个人资料填写的省份
                city	普通用户个人资料填写的城市
                country	国家，如中国为CN
                headimgurl	用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空。若用户更换头像，原有头像URL将失效。
                privilege	用户特权信息，json 数组，如微信沃卡用户为（chinaunicom）*/
                $openid = $userinfo['openid'];
                $nickname = $userinfo['nickname'];
                $sex = $userinfo['sex'];
                $province = $userinfo['province'];
                $city = $userinfo['city'];
                $country = $userinfo['country'];
                $headimgurl = $userinfo['headimgurl'];
                $privileg = $userinfo['privilege'];
                var_dump($userinfo);exit;
                Session('openid',$openid);
                session('nickname',$nickname);
                Cache::set($openid, $userinfo);
                $memberInfo = Db::name('k_user')->where('wechat_id','=',$openid)->select();
                if($memberInfo){ 
                    /**
                     *如果用户存在,则执行登录操作
                     */
                    $this->redirect(url('oauth/index'));
                }else{
                    /**
                     * 用户不存在,则执行注册操作!
                     */
                    return $this->fetch('reg');
                }
                
            }
        }
    }
    
    
    
    public function login(){
        var_dump($_REQUEST);
    }
    
    public function reg(){
        $data['username'] = validate();
    }
    
    
    public function index(){
        echo '获取到的openid是', Session('openid'),'<br/>';
        echo '获取到的昵称是',Session('nickname'),'<br/>';
    }
    
    private function getAccessToken(){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->appSecert";
        $content = file_get_contents($url);
        $info = json_decode($content,true);
        return ['access_token' => $info['access_token'],'expires_in'=>time() + $info['expires_in'] -3 ];
    }
    
    private function getUserinfo(){
        
    }
    
    /**
     * 用来验证token的
     */
    public function testauth(){
        $echostr = $this->request->get('echostr');
        echo $echostr;
        exit();
        /*
        $pc = new WXBizMsgCrypt($this->token, $this->encodingAesKey, $this->appid);
        $msgSignature = $this->request->input('signature');
        $timestamp = $this->request->input('timestamp');
        $nonce = $this->request->input('nonce');
        $echostr = $this->request->input('echostr');
        $msg = '';
        $errCode = $pc -> decryptMsg($msgSignature, $nonce, $postData, $msg);*/
    }
    
    private function http($url, $params, $method = 'GET', $header = array(), $multi = false){
        $opts = array(
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER     => $header
        );
        /* 根据请求类型设置特定参数 */
        switch(strtoupper($method)){
            case 'GET':
                $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
                break;
            case 'POST':
                //判断是否传输文件
                $params = $multi ? $params : http_build_query($params);
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            default:
                throw new Exception('不支持的请求方式！');
        }
        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if($error) throw new Exception('请求发生错误：' . $error);
        return  $data;
    }
    
}