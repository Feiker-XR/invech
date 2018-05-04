<?php
// +----------------------------------------------------------------------
// | FileName: base.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年10月6日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------
namespace app\admin;
use app\admin\model\Menu;
use think\Controller;
use think\Config;
use think\Db;

class Base extends Controller{
    
    /* 保存禁止通过url访问的公共方法,例如定义在控制器中的工具方法 ;deny优先级高于allow*/
    static protected $deny  = array('getMenus','tableList','recordList');
    
    /* 保存允许访问的公共方法 */
    static protected $allow = array( 'login','logout','get');
    
    public $user;
    public $settings;
    
    public $types;
    public $playeds;
    public $groups;

    public $viewPath = '' ; //模板路径，用来控制模板访问
    
    public $adminLogType=array(
        1=>'提现处理',
        2=>'充值确认',
        3=>'管理员充值',
        4=>'增加用户',
        5=>'修改用户',
        55=>'启用/禁用/删除/用户',
        
        6=>'删除用户',
        7=>'添加管理员',
        8=>'修改管理员密码',
        9=>'删除管理员',
        10=>'修改系统设置',
        
        11=>'银行添加',
        111=>'银行删除',
        
        12=>'彩种设置',
        13=>'玩法played设置',
        131=>'玩法groups设置',
        
        14=>'等级设置修改',
        15=>'兑换订单处理',
        16=>'兑换商品操作',
        17=>'添加开奖',
        171=>'手动派奖',
        
        18=>'修改投注记录',
        181=>'后台撤单',
        
        19=>'清除管理员',
        
        20=>'清理用户',
        21=>'清理数据',
        
        22=>'修改开奖时间',
        23=>'重置用户银行',
    );
    
    /**
     * 后台控制器初始化
     */
    protected function _initialize() {
        //判断是否登录
        if(session('user_auth_sign')!=data_auth_sign($_SERVER['HTTP_USER_AGENT']) || empty(session('user'))){//检测ip信息是否与session中存储的一致，防止session被盗，他人登录
            //获取当前控制和方法
            $actionName     = strtolower(request()->action()) ;
            $controllerName = strtolower(request()->controller()) ;

            if ($actionName!='login' && $controllerName!='adminlogin') {
                $this->redirect('Adminlogin/login');
                //$this->error('您还没有登录',U('user/login'));
                return;
            }
        }

        /* 读取数据库中的配置 */
        $config	=	cache('DB_CONFIG_DATA');
        if(!$config){
            $config	=	api('Config/lists');
            cache('DB_CONFIG_DATA',$config);
        }
        Config::set($config); //添加配置

        // 是否是超级管理员
        //define('IS_ROOT',   is_administrator());
        // 检测访问权限
        // $access =   $this->accessControl();
        // if ( $access === false ) {
        // $this->error('403:禁止访问');
        // }elseif( $access === null ){
        // $dynamic        =   $this->checkDynamic();//检测分类栏目有关的各项动态权限
        // if( $dynamic === null ){
        // //检测非动态权限
        // $rule  = strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
        // if ( !$this->checkRule($rule,array('in','1,2')) ){
        // $this->error('提示:无权访问,您可能需要联系管理员为您授权!');
        // }
        // }elseif( $dynamic === false ){
        // $this->error('提示:无权访问,您可能需要联系管理员为您授权!');
        // }
        // }
        $this->user = session('user') ;
        $this->assign('__controller__', $this);
    }
    
    /**
     * 权限检测
     * @param string  $rule    检测的规则
     * @param string  $mode    check模式
     * @return boolean
     * @author 朱亚杰  <xcoolcc@gmail.com>
     */
    final protected function checkRule($rule, $type=AuthRuleModel::RULE_URL, $mode='url'){
        if(IS_ROOT){
            return true;//管理员允许访问任何页面
        }
        static $Auth    =   null;
        if (!$Auth) {
            $Auth       =   new \ORG\Util\Auth();
        }
        if(!$Auth->check($rule,UID,$type,$mode)){
            return false;
        }
        return true;
    }
    
    /**
     * 检测是否是需要动态判断的权限
     * @return boolean|null
     *      返回true则表示当前访问有权限
     *      返回false则表示当前访问无权限
     *      返回null，则会进入checkRule根据节点授权判断权限
     *
     * @author 朱亚杰  <xcoolcc@gmail.com>
     */
    protected function checkDynamic(){
        if(IS_ROOT){
            return true;//管理员允许访问任何页面
        }
        return null;//不明,需checkRule
    }
    
    
    /**
     * action访问控制,在 **登陆成功** 后执行的第一项权限检测任务
     *
     * @return boolean|null  返回值必须使用 `===` 进行判断
     *
     *   返回 **false**, 不允许任何人访问(超管除外)
     *   返回 **true**, 允许任何管理员访问,无需执行节点权限检测
     *   返回 **null**, 需要继续执行节点权限检测决定是否允许访问
     * @author 朱亚杰  <xcoolcc@gmail.com>
     */
    final protected function accessControl(){
        if(IS_ROOT){
            return true;//管理员允许访问任何页面
        }
        $controller = 'Admin\\Controller\\'.CONTROLLER_NAME.'Controller';
        if ( !is_array($controller::$deny)||!is_array($controller::$allow) ){
            $this->error("内部错误:{$controller}控制器 deny和allow属性必须为数组");
        }
        $deny  = $this->getDeny();
        $allow = $this->getAllow();
        if ( !empty($deny)  && in_array(ACTION_NAME,$deny) ) {
            return false;//非超管禁止访问deny中的方法
        }
        if ( !empty($allow) && in_array(ACTION_NAME,$allow) ) {
            return true;
        }
        return null;//需要检测节点权限
    }
    
//    /**
//     * 对数据表中的单行或多行记录执行修改 GET参数id为数字或逗号分隔的数字
//     *
//     * @param string $model 模型名称,供M函数使用的参数
//     * @param array  $data  修改的数据
//     * @param array  $where 查询时的where()方法的参数
//     * @param array  $msg   执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
//     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
//     *
//     * @author 朱亚杰  <zhuyajie@topthink.net>
//     */
//    final protected function editRow ( $model ,$data, $where , $msg ){
//        $id    = array_unique((array)input('id',0));
//        $id    = is_array($id) ? implode(',',$id) : $id;
//        $where = array_merge( array('uid' => array('in', $id )) ,(array)$where );
//        $msg   = array_merge( array( 'success'=>'操作成功！', 'error'=>'操作失败！', 'url'=>'' ,'ajax'=>IS_AJAX) , (array)$msg );
//        if ($data['isDelete']) {
//            $ret = model($model)->where($where)->delete($data)!==false;
//        } else {
//            $ret = model($model)->where($where)->save($data)!==false;
//        }
//        if( $ret ) {
//            $this->success($msg['success'],$msg['url'],$msg['ajax']);
//        }else{
//            $this->error($msg['error'],$msg['url'],$msg['ajax']);
//        }
//    }


    /**
     * 对数据表中的单行或多行记录执行修改 GET参数id为数字或逗号分隔的数字
     *
     * @param string $model 模型名称,供M函数使用的参数
     * @param array  $data  修改的数据
     * @param array  $where 查询时的where()方法的参数
     * @param array  $msg   执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     * @author 朱亚杰  <zhuyajie@topthink.net>
     */
    final protected function editRow ( $model ,$data, $where , $msg ){
        $id    = array_unique((array)input('id',0));
        $id    = is_array($id) ? implode(',',$id) : $id;
        $where = array_merge( array('uid' => array('in', $id )) ,(array)$where );
        $msg   = array_merge( array( 'success'=>'操作成功！', 'error'=>'操作失败！', 'url'=>Url('user/index') ,'time'=>1) , (array)$msg );
        if (isset($data['isDelete']) && !empty($data['isDelete'])) {
            $ret = model($model)->where($where)->update($data);
        } else {
            $ret = model($model)->where($where)->update($data) !== false;
        }
        if( $ret ) {
            $this->success($msg['success'],$msg['url'],$msg['time']);
        }else{
            $this->error($msg['error'],$msg['url'],$msg['time']);
        }
    }
    
    /**
     * 禁用条目
     * @param string $model 模型名称,供D函数使用的参数
     * @param array  $where 查询时的 where()方法的参数
     * @param array  $msg   执行正确和错误的消息,可以设置四个元素 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     * @author 朱亚杰  <zhuyajie@topthink.net>
     */
    protected function forbid ( $model , $where = array() , $msg = array( 'success'=>'状态禁用成功！', 'error'=>'状态禁用失败！')){
        $data    =  array('enable' => 0);
        $this->editRow( $model , $data, $where, $msg);
    }
    
    /**
     * 恢复条目
     * @param string $model 模型名称,供D函数使用的参数
     * @param array  $where 查询时的where()方法的参数
     * @param array  $msg   执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     * @author 朱亚杰  <zhuyajie@topthink.net>
     */
    protected function resume (  $model , $where = array() , $msg = array( 'success'=>'状态恢复成功！', 'error'=>'状态恢复失败！')){
        $data    =  array('enable' => 1);
        $this->editRow(   $model , $data, $where, $msg);
    }
    
    /**
     * 还原条目
     * @param string $model 模型名称,供D函数使用的参数
     * @param array  $where 查询时的where()方法的参数
     * @param array  $msg   执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     * @author huajie  <banhuajie@163.com>
     */
    protected function restore (  $model , $where = array() , $msg = array( 'success'=>'状态还原成功！', 'error'=>'状态还原失败！')){
        $data    = array('status' => 1);
        $where   = array_merge(array('status' => -1),$where);
        $this->editRow(   $model , $data, $where, $msg);
    }
    
    /**
     * 条目假删除
     * @param string $model 模型名称,供D函数使用的参数
     * @param array  $where 查询时的where()方法的参数
     * @param array  $msg   执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     * @author 朱亚杰  <zhuyajie@topthink.net>
     */
    protected function delete ( $model , $where = array() , $msg = array( 'success'=>'删除成功！', 'error'=>'删除失败！')) {
        $data['isDelete']         =   1;
        //$data['update_time']    =   NOW_TIME;
        $this->editRow(   $model , $data, $where, $msg);
    }
    
    protected function undelete ( $model , $where = array() , $msg = array( 'success'=>'恢复成功！', 'error'=>'恢复失败！')) {
        $data['isDelete']         =   0;
        //$data['update_time']    =   NOW_TIME;
        $this->editRow(   $model , $data, $where, $msg);
    }
    /**
     * 获取控制器中允许禁止任何人(超管除外)通过url访问的方法
     * @param  string  $controller   控制器类名(不含命名空间)
     * @author 朱亚杰  <xcoolcc@gmail.com>
     */
    final static protected function getDeny($controller=CONTROLLER_NAME){
        $controller =   'Admin\\Controller\\'.$controller.'Controller';
        $data       =   array();
        if ( is_array( $controller::$deny) ) {
            $deny   =   array_merge( $controller::$deny, self::$deny );
            foreach ( $deny as $key => $value){
                if ( is_numeric($key) ){
                    $data[] = strtolower($value);
                }else{
                    //可扩展
                }
            }
        }
        return $data;
    }
    
    /**
     * 获取控制器中允许所有管理员通过url访问的方法
     * @param  string  $controller   控制器类名(不含命名空间)
     * @author 朱亚杰  <xcoolcc@gmail.com>
     */
    final static protected function getAllow($controller=CONTROLLER_NAME){
        $controller =   'Admin\\Controller\\'.$controller.'Controller';
        $data       =   array();
        if ( is_array( $controller::$allow) ) {
            $allow  =   array_merge( $controller::$allow, self::$allow );
            foreach ( $allow as $key => $value){
                if ( is_numeric($key) ){
                    $data[] = strtolower($value);
                }else{
                    //可扩展
                }
            }
        }
        return $data;
    }
    
    /**
     * 获取控制器菜单数组,二级菜单元素位于一级菜单的'_child'元素中
     * @author 朱亚杰  <xcoolcc@gmail.com>
     */
    final public function getMenus($controller=''){
//         $menus  =   session('ADMIN_MENU_LIST'.$controller);
        $request=  \think\Request::instance();
        //获取控制器名称
        if (empty($controller)) {
            $controller = $request->controller() ;
        }
        $actionName = $request->action(); //方法名称
        $moduleName = $request->module(); //模型名称

        if(empty($menus)){
            $menuModel = new Menu(); //实例化菜单模型
            $nav = ''; //
            $nav_first_title = '' ; //

            // 获取主菜单
            $where['pid']	=	0;
            $where['hide']	=	0;
            if(!config::get('DEVELOP_MODE')){ // 是否开发者模式
                $where['is_dev']	=	0;
            }
            $menus['main']  =	db('Menu')->where($where)->order('sort asc')->select();
            $menus['child'] = array(); //设置子节点

            //高亮主菜单 //加上排序，使最后添加的排最前 不然取得是之前未删掉的旧值 by xief 20160304
            $current = $menuModel->fetchSql(true)->where("url like '%{$controller}/".$actionName."%'")->order('id desc')->field('id')->find();

            if(isset($current['id']) && !empty($current['id'])) {
                $nav = $menuModel->getPath($current['id']);
                $nav_first_title = $nav[0]['title'];
            }

            foreach ($menus['main'] as $key => $item) {
                if (!is_array($item) || empty($item['title']) || empty($item['url']) ) {
                    $this->error('控制器基类$menus属性元素配置有误');
                }
                if( stripos($item['url'],$moduleName)!==0 ){
                    $item['url'] = $moduleName.'/'.$item['url'];
                }
                // 判断主菜单权限
//                if ( !IS_ROOT && !$this->checkRule($item['url'],AuthRuleModel::RULE_MAIN,null) ) {
//                    unset($menus['main'][$key]);
//                    continue;//继续循环
//                }

                // 获取当前主菜单的子菜单项
                if($item['title'] == $nav_first_title){
                    $menus['main'][$key]['class']='current';
                    //生成child树
                    $groups = $menuModel->where("pid = {$item['id']}")->distinct(true)->field("`group`")->select();
                    if($groups){
                        $groups = array_column($groups, 'group');
                    }else{
                        $groups	=	array();
                    }
                    
                    //获取二级分类的合法url
                    $where			=	array();
                    $where['pid']	=	$item['id'];
                    $where['hide']	=	0;
                    if(!C('DEVELOP_MODE')){ // 是否开发者模式
                        $where['is_dev']	=	0;
                    }
                    $second_urls = db('Menu')->where($where)->getField('id,url');
                    
                    // trace($second_urls);
                    if(!IS_ROOT){
                        // 检测菜单权限
                        $to_check_urls = array();
                        foreach ($second_urls as $key=>$to_check_url) {
                            if( stripos($to_check_url,MODULE_NAME)!==0 ){
                                $rule = MODULE_NAME.'/'.$to_check_url;
                            }else{
                                $rule = $to_check_url;
                            }
                            if($this->checkRule($rule, AuthRuleModel::RULE_URL,null))
                                $to_check_urls[] = $to_check_url;
                        }
                    }
                    // 按照分组生成子菜单树
                    foreach ($groups as $g) {
                        $map = array('group'=>$g);
                        if(isset($to_check_urls)){
                            if(empty($to_check_urls)){
                                // 没有任何权限
                                continue;
                            }else{
                                $map['url'] = array('in', $to_check_urls);
                            }
                        }
                        $map['pid']	=	$item['id'];
                        $map['hide']	=	0;
                        if(!C('DEVELOP_MODE')){ // 是否开发者模式
                            $map['is_dev']	=	0;
                        }
                        $menuList = db('Menu')->where($map)->field('id,pid,title,url,tip')->order('sort asc')->select();
                        $menus['child'][$g] = list_to_tree($menuList, 'id', 'pid', 'operater', $item['id']);
                    }
                    if($menus['child'] === array()){
                        //$this->error('主菜单下缺少子菜单，请去系统=》后台菜单管理里添加');
                    }
                }
            }
            
            // session('ADMIN_MENU_LIST'.$controller,$menus);
        }

        return $menus;
    }
    
    /**
     * 供子类读取基类中的私有属性
     * @param string $val  属性名
     * @author 朱亚杰  <xcoolcc@gmail.com>
     */
    final protected function getVal($val){
        return $this->$val;
    }
    
    /**
     * 返回后台节点数据
     * @param boolean $tree    是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
     * @retrun array
     *
     * 注意,返回的主菜单节点数组中有'controller'元素,以供区分子节点和主节点
     *
     * @author 朱亚杰 <xcoolcc@gmail.com>
     */
    final protected function returnNodes($tree = true){
        static $tree_nodes = array();
        if ( $tree && !empty($tree_nodes[(int)$tree]) ) {
            return $tree_nodes[$tree];
        }
        if((int)$tree){
            $list = db('Menu')->field('id,pid,title,url,tip,hide')->order('sort asc')->select();
            foreach ($list as $key => $value) {
                if( stripos($value['url'],MODULE_NAME)!==0 ){
                    $list[$key]['url'] = MODULE_NAME.'/'.$value['url'];
                }
            }
            $nodes = list_to_tree($list,$pk='id',$pid='pid',$child='operator',$root=0);
            foreach ($nodes as $key => $value) {
                if(!empty($value['operator'])){
                    $nodes[$key]['child'] = $value['operator'];
                    unset($nodes[$key]['operator']);
                }
            }
        }else{
            $nodes = db('Menu')->field('title,url,tip,pid')->order('sort asc')->select();
            foreach ($nodes as $key => $value) {
                if( stripos($value['url'],MODULE_NAME)!==0 ){
                    $nodes[$key]['url'] = MODULE_NAME.'/'.$value['url'];
                }
            }
        }
        $tree_nodes[(int)$tree]   = $nodes;
        return $nodes;
    }
    
    
    /**
     * 通用分页列表数据集获取方法,获取的数据集主要供tableList()方法用来生成表格列表
     *
     *  可以通过url参数传递where条件,例如:  index.html?name=asdfasdfasdfddds
     *  可以通过url空值排序字段和方式,例如: index.html?_field=id&_order=asc
     *  可以通过url参数r指定每页数据条数,例如: index.html?r=5
     *
     * @param sting|Model  $model   模型名或模型实例
     * @param array        $where   where查询条件(优先级: $where>$_REQUEST>模型设定)
     * @param array|string $order   排序条件,传入null时使用sql默认排序或模型属性(优先级最高);
     *                              请求参数中如果指定了_order和_field则据此排序(优先级第二);
     *                              否则使用$order参数(如果$order参数,且模型也没有设定过order,则取主键降序);
     *
     * @param array        $base    基本的查询条件
     * @param boolean      $field   单表模型用不到该参数,要用在多表join时为field()方法指定参数
     * @author 朱亚杰 <xcoolcc@gmail.com>
     *
     * @return array|false
     * 返回数据集
     */
    protected function lists ($model,$where=array(),$order='',$base = array('status'=>array('egt',0)),$field=true){
        $options    =   array();
        $REQUEST    = request()->param() ;

        if(is_string($model)){
            $model  = model($model);
        }

        $OPT        =   new \ReflectionProperty($model,'value');
        $OPT->setAccessible(true);

        $pk         =   $model->getPk();
        if($order===null){
            //order置空
        }else if ( isset($REQUEST['_order']) && isset($REQUEST['_field']) && in_array(strtolower($REQUEST['_order']),array('desc','asc')) ) {
            $options['order'] = '`'.$REQUEST['_field'].'` '.$REQUEST['_order'];
        }elseif( $order==='' && empty($options['order']) && !empty($pk) ){
            $options['order'] = $pk.' desc';
        }elseif($order){
            $options['order'] = $order;
        }
        unset($REQUEST['_order'],$REQUEST['_field']);

        $options['where'] = array_filter(array_merge( (array)$base, $REQUEST, (array)$where ),function($val){
            if($val===''||$val===null){
                return false;
            }else{
                return true;
            }
        });
            if( empty($options['where'])){
                unset($options['where']);
            }
            $options      =   array_merge( (array)$OPT->getValue($model), $options );
            $total        =   $model->where($options['where'])->count();

            if( isset($REQUEST['r']) ){
                $listRows = (int)$REQUEST['r'];
            }else{
                $listRows = config('paginate.list_rows') > 0 ? config('paginate.list_rows') : 10;
            }
            $page = new \app\classes\page($total, $listRows, $REQUEST);
            if($total>$listRows){
                $page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            }
            $p = $page->show();
            $this->assign('_page', $p? $p: '');
            $this->assign('_total',$total);
            $options['limit'] = $page->firstRow.','.$page->listRows;

            $model->setProperty('options',$options);
            
            return $model->field($field)->select();
    }
    
    /**
     * 数据集分页
     * @param array $records 传入的数据集
     */
    public function recordList($records)
    {
        $request    =  request()->param() ;
        $total      =   $records?count($records) : 1 ;
        if ( isset($request['r']) ) {
            $listRows = (int)$request['r'];
        } else {
            $listRows = config('paginate.list_rows') > 0 ? config('paginate.list_rows') : 10 ;
        }
        $page       =  new \app\classes\page($total, $listRows, $request) ;
        $voList     =  array_slice($records, $page->firstRow, $page->listRows) ;
        $p			=  $page->show() ;
        $this->assign('_list', $voList) ;
        $this->assign('_page', $p? $p: '') ;
    }
    
    /**
     * 通用表格列表
     *
     * @param array $list     select 数据集
     * @param array $thead    表头配置数组
     *
     * @author 朱亚杰 <zhuyajie@topthink.net>
     */
    public function tableList( $list, $thead ){
        $list = (array)$list;
        if(APP_DEBUG){
            //debug模式检测数据
            $List  = new \RecursiveArrayIterator($list);
            $RList = new \RecursiveIteratorIterator($List,\RecursiveIteratorIterator::CHILD_FIRST);
            foreach($RList as $v){
                if($RList->getDepth()==2){
                    //数据集不是二维数组
                    die('<h1>'.'严重问题：表格列表数据集参数不是二维数组'.'</h1>');
                    break;
                }
            }
            
            $keys   =   array_keys( (array)reset($list) );
            foreach($list as $row){
                $keys = array_intersect( $keys, array_keys($row) );
            }
            $s_thead =  serialize($thead);
            if(!empty($list)){
                preg_replace_callback('/\$([a-zA-Z_]+)/',function($matches) use($keys){
                    if( !in_array($matches[1],$keys) ){
                        die('<h1>'.'严重问题：数据列表表头定义使用了数据集中不存在的字段:$'.$matches[1].', 请检查表头和数据集.</h1>');
                    }
                },$s_thead);
            }
        }
        $keys       =   array_keys($thead);//表头所有的key
        array_walk($list,function(&$v,$k) use($keys,$thead) {
            $arr    =   array();//保存数据集字段的值
            foreach ($keys as $value){
                //判断表头key是否在数据集中存在对应字段
                if ( isset($v[$value]) ) {
                    $arr[$value] = $v[$value];
                }elseif( strpos($value,'_')===0 ){
                    $arr[$value] = @$thead[$value]['td'];
                }elseif( isset($thead[$value]['_title']) ){
                    $arr[$value] = '';
                }
            }
            $v      =   array_merge($arr,$v);//根据$arr的顺序更新数据集字段顺序
        });
            $this->assign('_thead',$thead);
            $this->assign('_list',$list);
            return $this->fetch('public:_list');
    }
    
    
    /**
     * 获取系统配置
     */
    public function getSystemSettings($expire=null){
        
        $this->settings=array();
        if($data=db('params')->where()->select()){
            foreach($data as $var){
                $this->settings[$var['name']]=$var['value'];
            }
        }
        
        return $this->settings;
    }
    
    /**
     * 获取来访IP地址
     */
    public final function ip($outFormatAsLong=false){
        $request = \think\Request::instance();
        $ip = $request->ip(1);
        return $ip;
    }
    
    /**
     * 管理员日志
     */
    public function addLog($type, $extfield0=0, $extfield1=''){
        $log=array(
            'uid'      => isset($this->user['uid']) ? $this->user['uid']  : '',
            'username' => isset($this->user['username']) ? $this->user['username'] : '',
            'type'     => $type,
            'actionTime' => time(),
            'actionIP'   => $this->ip(true),
            'action'     => $this->adminLogType[$type],
            'extfield0'  => $extfield0,
            'extfield1'  => $extfield1
        );

        $model = model('admin_log')->save($log);

        //\Think\Log::write('xiefff  '.M('admin_log')->getLastSql());
    }
    
    /**
     * 用户资金变动
     *
     * 请在一个事务里使用
     */
    protected function addCoin($log) {
        return true ;
        if(!isset($log['uid'])) $log['uid']     = (isset($this->user['uid']) && !empty($this->user['uid'])) ? $this->user['uid'] : 0 ;
        if(!isset($log['info'])) $log['info']   = '';
        if(!isset($log['coin'])) $log['coin']   = 0 ;
        if(!isset($log['type'])) $log['type']   = 0 ;
        if(!isset($log['fcoin'])) $log['fcoin'] = 0 ;
        if(!isset($log['extfield0'])) $log['extfield0'] = 0  ;
        if(!isset($log['extfield1'])) $log['extfield1'] = '' ;
        if(!isset($log['extfield2'])) $log['extfield2'] = '' ;

        $sql=" call setCoin({$log['coin']}, {$log['fcoin']}, {$log['uid']}, {$log['liqType']}, {$log['type']}, '{$log['info']}', {$log['extfield0']}, '{$log['extfield1']}', '{$log['extfield2']}')";

        if(Db::query($sql)===false) {
            return false;
        } else {
            return true;
        }

    }
    
    public function getTypes(){
        
        $this->types = db('type')->where(array('isDelete'=>0))->order('sort')->select();
        $data=array();
        if($this->types) foreach($this->types as $var){
            $data[$var['id']]=$var;
        }
        return $this->types = $data;
    }
    
    public function getPlayeds(){
        
        $this->playeds = db('played')->where(array('enable'=>1))->order('sort')->select();
        $data=array();
        if($this->playeds) foreach($this->playeds as $var){
            $data[$var['id']]=$var;
        }
        return $this->playeds = $data;
    }
    
    public function getGroups(){
        
        $this->groups = db('played_group')->where(array('enable'=>1))->order('sort,id')->select();
        $data=array();
        if($this->groups) foreach($this->groups as $var){
            $data[$var['id']]=$var;
        }
        return $this->groups = $data;
    }
    
}