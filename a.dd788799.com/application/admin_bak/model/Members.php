<?php
namespace app\admin\model;
use think\Model;
use think\Db;


/**
 * 用户模型
 * @author mack
 */
class Members extends Model {

    // 操作状态
    const MODEL_INSERT          =   1;      //  插入模型数据
    const MODEL_UPDATE          =   2;      //  更新模型数据
    const MODEL_BOTH            =   3;      //  包含上面两种方式
    const MUST_VALIDATE         =   1;      // 必须验证
    const EXISTS_VALIDATE       =   0;      // 表单存在字段则验证
    const VALUE_VALIDATE        =   2;      // 表单值不为空则验证

    protected $_validate = array(
        array('username', '1,16', '用户名长度为1-16个字符', self::EXISTS_VALIDATE, 'length'),
        array('username', '', '昵称被占用', self::EXISTS_VALIDATE, 'unique'), //用户名被占用
		array('password', '6,32', '密码长度6-32位', self::EXISTS_VALIDATE, 'length'), 
		array('fanDian', '1,32', '返点不能为空', self::EXISTS_VALIDATE, 'length'), 
		array('fanDianBdw', '1,32', '不定位返点不能为空', self::EXISTS_VALIDATE, 'length'), 
    );

    public function lists($status = 1, $order = 'uid DESC', $field = true){
        $map = array('status' => $status);
        return $this->field($field)->where($map)->order($order)->select();
    }

    /**
     * 登录指定用户
     * @param  integer $uid 用户ID
     * @return boolean      ture-登录成功，false-登录失败
     */
    public function login($uid){
        /* 检测是否在当前应用注册 */
        $user = $this->field(true)->find($uid);
        if(!$user || 1 != $user['status']) {
            $this->error = '用户不存在或已被禁用！'; //应用级别禁用
            return false;
        }

        //记录行为
        action_log('user_login', 'member', $uid, $uid);

        /* 登录用户 */
        $this->autoLogin($user);
        return true;
    }

    /**
     * 注销当前用户
     * @return void
     */
    public function logout(){
        session('user_auth', null);
        session('user_auth_sign', null);
    }

    /**
     * 自动登录用户
     * @param  integer $user 用户信息数组
     */
    private function autoLogin($user){
        /* 更新登录信息 */
        $data = array(
            'uid'             => $user['uid'],
            'login'           => array('exp', '`login`+1'),
            'last_login_time' => NOW_TIME,
            'last_login_ip'   => get_client_ip(1),
        );
        $this->save($data);

        /* 记录登录SESSION和COOKIES */
        $auth = array(
            'uid'             => $user['uid'],
            'username'        => $user['nickname'],
            'last_login_time' => $user['last_login_time'],
        );

        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));

    }

    public function getNickName($uid){
        return $this->where(array('uid'=>(int)$uid))->getField('nickname');
    }
   
    //获取交易信息
    public function  getCashInfo($id)
    {            
        return Db::table('gygy_member_cash')->where($id)->select();
    }
    
    //获取交易信息
    public function  getCashInfoOne($id)
    {
        return MemberCash::get($id);
    }
    
    //获取交易信息
    public function  getMemberBankInfo($uid)
    {
        return Db::table('gygy_member_bank')->where($uid)->find();
    }
    
    //获取交易信息
    public function  getBank()
    {
        return Db::table('gygy_bank')->order('id desc')->select();
    }

}
