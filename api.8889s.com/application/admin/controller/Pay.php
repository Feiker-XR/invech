<?php
namespace app\admin\controller;
use app\admin\Login;
use think\db\Query;
class Pay extends Login{

    /**     
     * 初始化测试数据,合并时候需要删除
     */
    public function _initialize()
    {
        parent::_initialize();
        
        if(config('pay_use_alone')){
            $controller = request()->controller();
            $action = request()->action();
            if('login' != $action && !session('adminid')){
                //return redirect(url('pay/login'));
                $this->redirect(url('login'));
            }
        }
        
        $user = session('adminname');
        $level = session('level')?:1;
        $nickname = session('nickname')?:'leon';
        
        $this->assign('user',$user);
        $this->assign('level',$level);
        $this->assign('nickname',$nickname);
        
        $appSet['company']  = '支付平台';
        $appSet['company_year'] = date('Y');
        $appSet['company_url'] = '#';
        $appSet['app_name'] = '订单管理系统';
        
        $this->assign('appSet',$appSet);
        
        config('paginate',[
            'type'      => 'Pay',
            'var_page'  => 'page',
            'list_rows' => 10,
        ]);
    }
    
    public function index(){
        
        
        $totalNum = db('vc_order')->where('order_state',1)->count(); 
        $todayNum = db('vc_order')->where('order_state',1)
        ->where('date(from_unixtime(order_time)) = date(now())')->count();
        
        $totalMoney = db('vc_order')->where('order_state',1)->sum('order_money');
        $todayMoney = db('vc_order')->where('order_state',1)
        ->where('date(from_unixtime(order_time)) = date(now())')->sum('order_money');

        $result = db('vc_order')->where('order_state',1)
        //->where('date(from_unixtime(order_time)) = date(now())')
        ->group('pay_api')->order('sum desc')
        ->field('sum(order_money) as sum,pay_api')->paginate();
        
        $record = count($result);
        
        $this->assign('totalNum',$totalNum);
        $this->assign('todayNum',$todayNum);
        $this->assign('totalMoney',$totalMoney);
        $this->assign('todayMoney',$todayMoney);
        $this->assign('result',$result);
        $this->assign('record',$record);
       
        return $this->fetch();
    }
    
    /**
     *菜单入口:支付通道分组
    */
    public function set(){

        $sql_where = " where 1 = 1 ";
        if(!empty($keywords)){
            $sql_where .= " and (name like '%".$keywords."%' or type like '%".$keywords."%') ";
        }

        $keywords = input('keywords');
        
        $query = db('vc_set');
        if($keywords){
            $query->where('name','like',"%".$keywords."%");
            $query->whereOr('type','like',"%".$keywords."%");                      
        }
        
        $options = $query->getOptions();
        $set = $query->order('sort desc')->paginate();

        $sortMax = $query->max('sort');
        $record = $query->options($options)->count();
        
        $set->extra(['总记录'=>$record]);
        //$sql = $query->getLastSql();
        //dump($sql);die;
        
        $this->assign('set',$set);
        $this->assign('sortMax',$sortMax);
        $this->assign('record',$record);
        
        return $this->fetch();
    }

    public function set_add(){
        date_default_timezone_set('PRC');
        $name = input('name');
        $type = input('ename');
        $sort = input('sort');
        $setclass = input('setclass');
        $pic = input('pic');
        if(!preg_match("/^[a-zA-Z\s]+$/",$type)){                                        
            return ['stat' => 1,'msg' =>'必须为英文!',];
        }
        if(!is_numeric($sort)){
            return ['stat' => 1,'msg' =>'排序必须为数字!',];
        }
        
        $addset = db('vc_set')->where('name = '. "'$name'" . ' or type = '. "'$type'")->select();
        if($addset){
            return ['stat' => 1,'msg' =>'分组已存在!',];
        }else {
            $setArr = array(
                'name'=>$name,
                'type'=>$type,
                'status'=>0,//默认开启
                'sort'=>$sort,
                'setclass'=>$setclass,
                'pic'=>$pic,
                'add_time'=>time(),
            );
            
            db('vc_set')->insert($setArr);
            
            return ['stat' => 0,];            
        }
    }   

    public function set_img(){
        date_default_timezone_set('PRC');
        $id = input('setid');
        $set = db('vc_set')->where(['id'=>$id])->find();
       
        if($set){
            $class0 = $class1 = "";
            if($set['status']=='0'){
                $class0 = "checked='checked'";
            }
            if($set['status']=='1'){
                $class1 = "checked='checked'";
            }
            $html = "
            <div id='paycontent'>
            <div class='paylabel'>是否开启
            <label class='label_set'>
            <input type='radio' {$class0} name='set_name_class' class='radio_label_class' value='0'>
            <span class='new_setclass'>开启</span>
            </label>
            <label class='label_set'>
            <input type='radio' {$class1} name='set_name_class' class='radio_label_class' value='1'>
            <span class='new_setclass'>关闭</span>
            </label>
            </div>
            <input type='hidden' id='status' value='{$set['status']}'>
            <input type='hidden' id='set_id' value='{$set['id']}'>
            <div class='contentinput'>分组名称<input  id='onname' value='{$set['name']}'></div>
            <div class='contentinput'>英文名称<input  id='onename' value='{$set['type']}'></div>
            <div class='contentinput'>分组排序<input  id='onsort' disabled='disabled' value='{$set['sort']}'></div>
            <div class='contentinput'>分组图片<img id='contentimg' src='{$set['pic']}'></div>
            <div class='control-group'>
            <div class='controls up_files'>
            <form id='imageform' method='post' enctype='multipart/form-data' action='" . url('upload') . "' style='width:400px;margin-left: 65px;margin-top: 20px;'>
            <div id='up_status' style='display:none'><img src='/images/base_loading_bar.gif' alt='uploading'/></div>
            <div id='up_btn' class='btn' style='margin-left: 172px;'>
            <input id='photoimg' type='file' name='photoimg'>
            </div>
            </form>
            <div id='preview'></div>
            </div>
            </div>
            <div class='control-group' style='clear: both;margin-left: 252px;'>
            <div class='controls' style='margin-left: 106px;'>
            <input type='button' id='EditSave' class='btn btn-success' value='修改保存'>
            </div>
            </div>
            </div>
            <style>
            .contentinput input{margin-left:20px;padding:5px;}
            </style>
            ";       
            return ['stat' => 0,'html' => $html,];
        }else{
            return ['stat' => 1,'msg' =>'错误:没有这条分组信息!',];
        }
    
    }
    
    public function set_edit(){
        date_default_timezone_set('PRC');
        $id = input('set_id');
        $set = db('vc_set')->where(['id'=>$id])->find();
        if($set){
            $name = input('onname');
            $type = input('onename');
            $sort = input('onsort');
            $status = input('status');
            $setpic = input('onpic');
            $newpic = input('onnewpic');
            if($newpic==null){
                $pic = $setpic;
            }else {
                $pic = $newpic;
            }
            $setArr = array(
                'name'=>$name,
                'type'=>$type,
                'status'=>$status,
                'sort'=>$sort,
                'pic'=>$pic,
                'update_time'=>time(),
            );
            db('vc_set')->where(['id'=>$id])->update($setArr);
            return ['stat' => 0,];
        }else{
            return ['stat' => 1,'msg' =>'错误:没有这条分组信息!',];
        }
    }
    
    public function set_del(){
        date_default_timezone_set('PRC');
        $id = input('setid');
        $set = db('vc_set')->where(['id'=>$id])->find();
        if($set){
            db('vc_set')->where(['id'=>$id])->delete();             //删除分组
            db('vc_set_config')->where(['set_id'=>$id])->delete();  //删除通道
            db('vc_thirdcode')->where(['setid'=>$id])->delete();    //删除第三方配置
            return ['stat' => 0];
        }else {
            return ['stat' => 1,'msg' =>'错误:没有这条分组信息!',];
        }
    }

    public function set_sort(){
        date_default_timezone_set('PRC');
        $sort = input('sort');
        $id = input('id');
        
        $OldSetSort = db('vc_set')->where(['sort'=>$sort])->find();        
        $NewSetSort = db('vc_set')->where(['id'=>$id])->find();

        if($OldSetSort || $NewSetSort){
            $OldArr = array(
                'sort'=>$NewSetSort['sort'],
                'update_time'=>time(),
            );
            db('vc_set')->where(['id'=>$OldSetSort['id']])->update($OldArr);
            
            $NewArr = array(
                'sort'=>$OldSetSort['sort'],
                'update_time'=>time(),
            );
            db('vc_set')->where(['id'=>$NewSetSort['id']])->update($NewArr);                        
            
            return  ['stat' => 0,'msg' =>'更新排序成功',];
        }else {
            return ['stat' => 1,'msg' =>'错误:没有这条分组信息!',];
        }
    }
    
    public function upload(){
        date_default_timezone_set('PRC');
        //echo ROOT_PATH;die;
        $file = request()->file('photoimg');
        //$path = "uploads/";
        $path = ROOT_PATH . 'houtai' . DS . 'uploads';
        $info = $file->move($path);
        if($info){
            //dump($info);return;
            $type = input('itemtype');
            $ext = $info->getExtension();
            if(!$type){//上传图片
                if(!in_array($ext,['png','jpg'])){
                    echo "图片扩展名有误！";
                }
                
                $url = DS . 'uploads'. DS . $info->getSaveName();
                echo '<img src="' . $url . '"  class="preview">';         
                $picArr = array(
                    'img'=>$url,
                    'add_time'=>time(),
                );
                db('vc_set_images')->insert($picArr);
            }
            if(in_array($type, ['pubkey','prikey'])){//上传公私密钥
                if(!in_array($ext,['txt','pem'])){
                    echo "文件扩展名有误！";
                }
                
                $id = input('itemid');
                if(!$id){echo "id参数错误!";return;}
                //$content = file_get_contents($filename);
                $filename = $info->getSaveName();
                $data = [$type=>$filename];
                db('vc_thirdpay')->where('id',$id)->update($data);
                echo $filename;
            }
        }else{
            echo '上传出错了！';
        }
        
        /*
        $path = "uploads/";
        if(!file_exists($path)){
            mkdir("$path",0700);        //0700最高权限
        }
        
        $extArr = array("jpg", "png", "gif","jpeg");
        
        if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];
            
            if(empty($name)){
                echo '请选择要上传的图片';
                exit;
            }

            $extend = pathinfo($name);
            $ext = strtolower($extend["extension"]);

            if(!in_array($ext,$extArr)){
                echo '图片格式错误！';
                exit;
            }
            if($size>(100*1024)){
                echo '图片大小不能超过100KB';
                exit;
            }
            $image_name = time().rand(100,999).".".$ext;
            $tmp = $_FILES['photoimg']['tmp_name'];
            
            if(move_uploaded_file($tmp,$path.$image_name)){
                echo '<img src="/'.$path.$image_name.'"  class="preview">';
                $pic = "/uploads/$image_name";
                $picArr = array(
                    'img'=>$pic,
                    'add_time'=>time(),
                );
                db('vc_set_images')->insert($picArr);
            }else{
                echo '上传出错了！';
            }
            exit;
        }
        exit;
        */
    }
    
    public function setconfig(){
        date_default_timezone_set('PRC');
        $id = input('id');
        $set = db('vc_set')->where(['id' => $id])->find();                  
        $scname = db('vc_set_config')->where(['set_id'=>$id])->find();
        $this->assign('id',$id);
        $this->assign('set',$set);
        $this->assign('scname',$scname);
        
        $keywords = input('keywords');
        
        $query = db('vc_set_config');
        $query->where(['set_id'=>$set['id']]);
        if($keywords){
            $query->where(function($query2) use($keywords){
                $query2->where('name','like',"%".$keywords."%");
                $query2->whereOr('code','like',"%".$keywords."%");
            });            
        }

        $options = $query->getOptions();
        $setconfig = $query->order('id desc')->paginate();
        $setconfig->appends('id',$id);
        
        $record = $query->options($options)->count();
        
        $setconfig->extra(['总记录'=>$record]);
        //$sql = $query->getLastSql();
        //dump($sql);die;
     
        $this->assign('setconfig',$setconfig);
        
        $this->assign('record',$record);
        
        return $this->fetch();
    }

    public function setconfig_add(){
        date_default_timezone_set('PRC');
        $set_id =  input('set_id');
        $set = db('vc_set')->where(['id'=>$set_id])->find();
        $name = input('name');
        $pic = input('pic');

        if($set['type']=='diankapay'){
            $code = "DK".input('code');
        }else {
            $code = strtoupper(input('code'));
        }

        $addsetconfig = db('vc_set_config')->where('name',$name)->whereOr('code',$code)->select(); 
        
        if($addsetconfig){
            return ['stat' => 1,'msg' => '通道已存在',];
        }else {
            $setconfigArr = array(
                'set_id'=>$set_id,
                'name'=>$name,
                'code'=>$code,
                'img'=>$pic,
                'add_time'=>time(),
            );            
            db('vc_set_config')->insert($setconfigArr);
            return ['stat' => 0];
        }
    }   
    
    public function setconfig_img(){
        date_default_timezone_set('PRC');
        $id = input('configid');
        $setconfig = db('vc_set_config')->where(['id'=>$id,])->find();        
        if($setconfig){
            $html = "
            <div id='paycontent'>
            <input type='hidden' id='set_id' value='{$setconfig['id']}'>
            <div class='contentinput'>通道名称<input  id='onname' value='{$setconfig['name']}'></div>
            <div class='contentinput'>通道代码<input  id='onename' value='{$setconfig['code']}'></div>
            <div class='contentinput'>通道图片<img id='contentimg' src='{$setconfig['img']}'></div>
            <div class='control-group'>
            <div class='controls up_files'>
            <form id='imageform' method='post' enctype='multipart/form-data' action='" . url('upload') . "' style='width:400px;margin-left: 65px;margin-top: 20px;'>
            <div id='up_status' style='display:none'><img src='/images/base_loading_bar.gif' alt='uploading'/></div>
            <div id='up_btn' class='btn' style='margin-left: 172px;'>
            <input id='photoimg' type='file' name='photoimg'>
            </div>
            </form>
            <div id='preview'></div>
            </div>
            </div>
            <div class='control-group' style='clear: both;margin-left: 252px;'>
            <div class='controls' style='margin-left: 106px;'>
            <input type='button' id='EditSave' configid='{$setconfig['id']}' class='btn btn-success' value='修改保存'>
            </div>
            </div>
            </div>
            <style>
            .contentinput input{margin-left:20px;padding:5px;}
            </style>
            ";
            return ['stat' => 0,'html' =>$html,];
        }else{
            return ['stat' => 1,'msg' =>'错误:没有这条通道信息!',];
        }	
    }
    
    public function setconfig_edit(){
        date_default_timezone_set('PRC');
        $id = input('configid');
        $setconfig = db('vc_set_config')->where(['id'=>$id,])->find();
        $set = db('vc_set')->where(['id'=>$setconfig['set_id'],])->find();
        if($setconfig){
            $name = input('onname');
            if($set['type']=='diankapay'){
                $code = "DK".input('onename');
            }else {
                $code = strtoupper(input('onename'));
            }
            $setpic = input('onpic');
            $newpic = input('onnewpic');
            if($newpic==null){
                $pic = $setpic;
            }else {
                $pic = $newpic;
            }
            $setconfigArr = array(
                'name'=>$name,
                'code'=>$code,
                'img'=>$pic,
                'update_time'=>time(),
            );                        
            db('vc_set_config')->where(['id'=>$id])->update($setconfigArr);
            return ['stat' => 0,];
        }else{
            return ['stat' => 1,'msg' =>'错误:没有这条通道信息!',];
        }
    }

    public function setconfig_del(){
        $id = input('configid');
        $setconfig = db('vc_set_config')->where(['id'=>$id,])->find();         
        if($setconfig){
            db('vc_set_config')->where(['id'=>$id,])->delete();
            db('vc_thirdcode')->where(['set_configid'=>$id,])->delete();
            return ['stat' => 0];
        }else {
            return ['stat' => 1,'msg' =>'错误:没有这条通道信息!',];
        }
    }
    
    public function scthird(){
        $scid = input('scid');
        $scname = db('vc_set_config')->where(['id'=>$scid,])->find();
        $setname = db('vc_set')->where('id',$scname['set_id'])->find();
        
        $this->assign('scid',$scid);
        $this->assign('scname',$scname);
        $this->assign('setname',$setname);
                
        $thirdcode = db('vc_thirdcode')->where('set_configid',$scid)->order('id desc')->paginate();
        $result = array();
        foreach ($thirdcode as $k=>$v){
            $result[$k]['id'] = $v['id'];
            $result[$k]['setid'] = $v['setid'];
            $result[$k]['set_configid'] = $v['set_configid'];
            $result[$k]['thirdid'] = $v['thirdid'];            
            $thirdpay = db('vc_thirdpay')->where(['id'=>$v['thirdid'],])->find();
            $result[$k]['name'] = $thirdpay['name'];
            $result[$k]['type'] = $thirdpay['type'];
            $result[$k]['code'] = $v['code'];
            $result[$k]['min'] = $v['min'];
            $result[$k]['max'] = $v['max'];
            $result[$k]['add_time'] = $v['add_time'];
            $result[$k]['update_time'] = $v['update_time'];
            $result[$k]['status'] = $v['status'];
            $result[$k]['warntime'] = $v['warntime'];
        }      
        $record = db('vc_thirdcode')->where('set_configid',$scid)->count();
        $thirdcode->extra(['总记录'=>$record]);
        
        $this->assign('result',$result);
        $this->assign('thirdcode',$thirdcode);
        $this->assign('record',$record);
        
        return $this->fetch();
    }
    
    public function scthird_edit(){        
        date_default_timezone_set('PRC');
        $status = input('status');
        $setid = input('setid');
        $setconfigid = input('setconfigid');
        $thirdid = input('thirdid');
        $code = input('code');
        $min = input('min');
        $max = input('max');        
        $warntime = input('warntime/d',0);
        if($warntime<0){
            return ['stat' => 1,'msg' =>'报警时间参数有误！',];
        }        
        $thirdcode = db('vc_thirdcode')->where(['set_configid'=>$setconfigid,'thirdid'=>$thirdid])->select();
        if($thirdcode){
            $UpdateArr = array(
                'status'=>$status,
                'code'=>$code,
                'min'=>$min,
                'max'=>$max,
                'update_time'=>time(),
                'warntime'=>$warntime,
            );
            db('vc_thirdcode')->where(['set_configid'=>$setconfigid,'thirdid'=>$thirdid])->update($UpdateArr);
            return ['stat' => 0,'msg' =>'保存成功',];
        }else {
            return ['stat' => 1,'msg' =>'错误,没有这条第三方配置信息',];
        }
    }
    
    /**
     * 菜单入口:添加第三方
     */
    public function paythird(){
        date_default_timezone_set('PRC');
        $keywords = input('keywords');
        
        $query = db("vc_thirdpay");
        if($keywords){
            $query->where('name', 'like', '%'.$keywords.'%')->whereOr('type', 'like', '%'.$keywords.'%');
        }

        $options = $query->getOptions();
        $thirdpay = $query->order("id desc")->paginate();
        $record = $query->options($options)->count();
        $thirdpay->extra(['总记录'=>$record]);
        
        $this->assign('thirdpay',$thirdpay);      
        $this->assign('record',$record);
        
        return $this->fetch();       
    }
    
    public function paythird_add(){
        date_default_timezone_set('PRC');
        $name = input('Tname');
        $type = input('FolderName');
        $pid = input('Tid');
        $pkey = input('Tkey');
        $purl = input('Turl');
        $hrefbackurl = input('Threfbackurl');
        $callbackurl = input('Tcallbackurl');
        $queryurl = input('Tqueryurl');
        if(preg_match('/[\x{4e00}-\x{9fa5}]/u', $callbackurl)>0){
            return ['stat' => 1,'msg' =>'异步回调地址错误:不能含有中文或者传参数!',];
        }
        
        $paytype = db('vc_thirdpay')->where(['name'=>$name,'type'=>$type])->select();
        if(!$paytype){
            $thirdArr = array(
                'name'=>$name,
                'type'=>$type,
                'pid'=>$pid,
                'pkey'=>$pkey,
                'purl'=>$purl,
                'hrefbackurl'=>$hrefbackurl,
                'callbackurl'=>$callbackurl,
                'queryurl'=>$queryurl,
                'add_time'=>time(),
            );
            db('vc_thirdpay')->insert($thirdArr);            
            return ['stat' => 0,'msg' =>'添加成功',];
        }else {
            return ['stat' => 1,'msg' =>'该第三方已经存在,无需添加',];
        }
    }
    
    public function paythird_gethtml(){
        date_default_timezone_set('PRC');
        $id = input('id');
        $thirdpay = db('vc_thirdpay')->where(['id'=>$id,])->find();
        if($thirdpay){
            $html = "
            <div id='paycontent'>
            <input type='hidden' id='thirdid' value='{$thirdpay['id']}'>
            <div class='contentinput'><span>第三方名称</span><input  id='name' value='{$thirdpay['name']}'></div>
            <div class='contentinput'><span>文件夹名称</span><input  id='type' value='{$thirdpay['type']}'></div>
            <div class='contentinput'><span>商户 ID</span><input  id='pid' value='{$thirdpay['pid']}'></div>
            <div class='contentinput'><span>商户密钥</span><input  id='pkey' value='{$thirdpay['pkey']}'></div>
            <div class='contentinput'><span>网关地址</span><input  id='purl' value='{$thirdpay['purl']}'></div>
            <div class='contentinput'><span>同步回调地址</span><input  id='hrefbackurl' value='{$thirdpay['hrefbackurl']}'></div>
            <div class='contentinput'><span>异步回调地址</span><input  id='callbackurl' value='{$thirdpay['callbackurl']}'></div>
            <div class='contentinput'><span>查询订单地址</span><input  id='queryurl' value='{$thirdpay['queryurl']}'></div>            
            <input type='button' id='EditSave' thirdid='{$thirdpay['id']}' class='btn btn-success' value='修改保存'>
            </div>
            <style>
            .contentinput input{margin-left:20px;padding:5px;}
            #paycontent .contentinput{}
            #paycontent{text-align: center;padding-top:20px;}
            #paycontent .contentinput span{display:inline-block;width:100px;}
            #paycontent .contentinput input{margin-bottom:10px;width: 345px;}
            #EditSave{float:right;margin-right:109px;margin-top: 20px;}
            </style>
            ";
            return ['stat' => 0,'html'=>$html,];
        }else {
            return ['stat' => 1,'msg' =>'错误:没有这条第三方信息!',];
        }
    }
    
    public function paythird_edit(){
        date_default_timezone_set('PRC');
        $id = input('thirdid');
        $name = input('name');
        $type = input('type');
        $pid = input('pid');
        $pkey = input('pkey');
        $purl = input('purl');
        $hrefbackurl = input('hrefbackurl');
        $callbackurl = input('callbackurl');
        $queryurl = input('queryurl');
        if(!$name || !$type){
            return ['stat' => 1,'msg' =>'错误:第三方信息不能为空!',];
        }
        $thirdpay = db('vc_thirdpay')->where(['id'=>$id,])->find();
        if($thirdpay){
            $thirdpayArr = array(
                'name'=>$name,
                'type'=>$type,
                'pid'=>$pid,
                'pkey'=>$pkey,
                'purl'=>$purl,
                'hrefbackurl'=>$hrefbackurl,
                'callbackurl'=>$callbackurl,
                'queryurl'=>$queryurl,
                'update_time'=>time(),
            );            
            db('vc_thirdpay')->where(['id'=>$id])->update($thirdpayArr);
            return ['stat' => 0,];
        }else {
            return ['stat' => 1,'msg' =>'错误:没有这条第三方信息!',];
        }
    }
    
    public function paythird_del(){
        $id = input('id');
        $thirdpay = db('vc_thirdpay')->where(['id'=>$id,])->find();
        if($thirdpay){
            db('vc_thirdpay')->where(['id'=>$id,])->delete();
            return ['stat' => 0];
        }else {
            return ['stat' => 1,'msg' =>'错误:没有这条第三方信息!',];
        }
    }
    
    /*
     * 添加第三方 的 三方支付项 的 配置页面
     */
    public function paythird_set(){
        $id = input('id');
        $thirdpay = db('vc_thirdpay')->where(['id'=>$id,])->find();        
        $set = db('vc_set')->select();
        
        $this->assign('id',$id);
        $this->assign('thirdpay',$thirdpay);
        $this->assign('set',$set);

        $setid = input('setid');
        $this->assign('setid',$setid);
        
        $query = db('vc_set_config');
        if($setid && is_numeric($setid)){
            $query->where('set_id',$setid);
        }
        
        $options = $query->getOptions();
        $set_config = $query->order('id desc')->paginate();
        
        $set_config->appends('id',$id);
        if($setid){            
            $set_config->appends('setid',$setid);            
        }
        
        foreach ($set_config as $k=>$v){
            $result[$k]['id'] = $v['id'];
            $result[$k]['set_id'] = $v['set_id'];
            $setN = db('vc_set')->where('id',$v['set_id'])->find();
            $result[$k]['name'] = $setN['name'];
            $result[$k]['cname'] = $v['name'];
            $result[$k]['thirdname'] = $thirdpay['name'];            
            $thirdcode = db("vc_thirdcode")->where('set_configid',$v['id'])->where('thirdid',$thirdpay['id'])->find();             
            $result[$k]['code'] = $thirdcode['code'];
            $result[$k]['min'] = $thirdcode['min'];
            $result[$k]['max'] = $thirdcode['max'];
            $result[$k]['status'] = $thirdcode['status'];
            $result[$k]['warntime'] = $thirdcode['warntime'];
            $result[$k]['money_decimal'] = $thirdcode['money_decimal'];
        }
        
        $record = db('vc_set_config')->options($options)->count();
        $set_config->extra(['总记录'=>$record]);
        
        $this->assign('set_config',$set_config);
        $this->assign('result',$result);
        $this->assign('record',$record);
        
        return $this->fetch();
    }
    
    public function paythird_set_edit(){
        date_default_timezone_set('PRC');
        $status = input('status');
        $setid = input('setid');
        $setconfigid = input('setconfigid');
        $thirdid = input('thirdid');
        $code = input('code');
        $min = input('min');
        $max = input('max');
        $warntime = input('warntime/d',0);
        if($warntime<0){
            return ['stat' => 1,'msg' =>'报警时间参数有误！',];
        }
        $decimal = input('decimal',0);
        $thirdcode = db('vc_thirdcode')->where('set_configid',$setconfigid)
        ->where('thirdid',$thirdid)->find();
        if(!$thirdcode){
            $thirdcodeArr = array(
                'status'=>$status,
                'setid'=>$setid,
                'set_configid'=>$setconfigid,
                'thirdid'=>$thirdid,
                'code'=>$code,
                'min'=>$min,
                'max'=>$max,
                'add_time'=>time(),
                'warntime'=>$warntime,                
            );            
            db('vc_thirdcode')->insert($thirdcodeArr);
            return ['stat' => 0,'msg' =>'添加成功',];
        }else {
            $thirdcodeArr = array(
                'status'=>$status,
                'code'=>$code,
                'min'=>$min,
                'max'=>$max,
                'update_time'=>time(),
                'warntime'=>$warntime,
                'money_decimal'=>$decimal,
            );
            db('vc_thirdcode')->where('set_configid',$setconfigid)
            ->where('thirdid',$thirdid)->update($thirdcodeArr);            
            return ['stat' => 0,'msg' =>'更新成功',];
        }
    }

    public function paythird_key_view(){
        $id = input('id/d');
        $type = input('type');
        if(!$id){
            return ['stat' => 1,'msg' =>'id参数不能为空！',];
        }
        if(!in_array($type, ['pubkey','prikey'])){
            return ['stat' => 1,'msg' =>'type参数不合法！',];
        }
        $thirdpay = db('vc_thirdpay')->where('id',$id)->find(); 
        
        $path = ROOT_PATH . 'houtai' . DS . 'uploads' . DS;        
        $file = $path . $thirdpay[$type];
         
        //return ['stat' => 1,'msg' =>$file,];
        //$content = file_get_contents("/www/wwwroot/site/houtai/uploads/20170805/4c051373c8b96cac31f09010e9137c6e.pem");
        if(!is_file($file)){
            return ['stat' => 1,'msg' =>'文件不存在！',];
        }
            
        $content = file_get_contents($file);
        $content = str_replace('\r\n', '<br>', $content);
        return ['stat' => 0,'html' =>$content,];
    }
    
    private function deal_lock($url){
        //$adminid = session('adminid');
        //$user = db('k_user')->where('uid',$adminid)->find();
        //$adminname = session('adminname');
        
        $lock_ok = 0; $unlock_ok = 0; $confirm_ok = 0;
        $action = input('get.action');
        $id = input('id');
        if('lock' == $action){
            if($id){
                $info = db('vc_order')->where('id',$id)->find();
                if($info['state'] == "5"){
                    return message("当前订单已经是锁定状态,无法进行锁定操作",$url);
                }
                if($info['state'] != "0"){
                    return message("当前订单已经处理过了,无法进行锁定操作",$url);
                }
                //$database->update(DB_PREFIX."order",array('state'=>5,'lock_id'=>$_SESSION['card_admin']['username']),array('id'=>$id));
                //lock_id原本是vc_sys.sys_user,现改为k_user.username
                $update_data = [
                    'state' => 5,
                    'lock_id' => session('adminname'),
                ];
                $ret = db("vc_order")->where('id',$id)->update($update_data);
                //Alert('锁定成功！','#');//调用了exit
                //header("Location:deal_list.php");
                $lock_ok = 1;
            }
        }
        if('unlock' == $action){
            if($id){
                $info = db('vc_order')->where('id',$id)->find();
                if($info['state'] == "5"){
                    db("vc_order")->where('id',$id)->update(['state'=>0,'lock_id'=>'']);
                    //header("Location:deal_list.php");
                    $unlock_ok = 1;
                }else{
                    return message("当前订单不是锁定状态,无法进行解锁操作",$url);
                }
            }
        }
        if('confirm' == $action){
            if($id){
                $info = db('vc_order')->where('id',$id)->find();
                if($info['state'] == "5"){                    
                    db("vc_order")->where('id',$id)->update(['state'=>1]);
                    $confirm_ok = 1;                    
                }else{
                    return message("当前订单不是锁定状态,无法进行确认操作",$url);
                }
                $confirm_ok = 1;
            }
        }
        $this->assign('lock_ok',$lock_ok);
        $this->assign('unlock_ok',$unlock_ok);
        $this->assign('confirm_ok',$confirm_ok);
    }
    

    
    private function deal_patch($url){
        //$adminid = session('adminid');
        //$user = db('k_user')->where('uid',$adminid)->find();
        
        //$ids = input('ids');
        $all_lock_ok = 0; $all_unlock_ok = 0; $all_confirm_ok = 0;
        if(isset($_POST['ids'])) {
            $tmp = count($_POST['ids']);
            if($tmp <=0) {
                message("请先选择订单",$url);
            }
            //$ids = implode(",",$_POST['ids']);
            $ids = $_POST['ids'];
            
            if(!isset($_POST['tmp1'])){
                //deal_list的全部锁定
                $update_data = [
                    'state' => 5,
                    'lock_id' => session('adminname'),
                ];
                db('vc_order')->where('id','in',$ids)->update($update_data);                       
                //echo "<script>alert('锁定成功，共处理了".$tmp."条订单');location.href='deal_list.php'</script>";
                $all_lock_ok = 1;
            }else if($_POST['tmp1']=='111') {
                //my_list的批量解锁
                $update_data = [
                    'state' => 0,
                    'lock_id' => session('adminname'),
                ];
                db('vc_order')->where('state',5)->where('id','in',$ids)->update($update_data);
                //echo "<script>alert('解锁成功，共处理了".$tmp."条订单');location.href='my_list.php'</script>";
                $all_unlock_ok = 1;                                
            } else if($_POST['tmp1']=='222') {
                //my_list的批量确认
                $update_data = [
                    'state'=>1,                    
                ];
                db('vc_order')->where('state',5)->where('id','in',$ids)->update($update_data);                
                //echo "<script>alert('确认成功，共处理了".$tmp."条订单');location.href='my_list.php'</script>";
                $all_confirm_ok = 1;
            }
            $this->assign('tmp',$tmp);

        }
        $this->assign('all_lock_ok',$all_lock_ok);
        $this->assign('all_unlock_ok',$all_unlock_ok);
        $this->assign('all_confirm_ok',$all_confirm_ok);                        
    }

    private function deal_delete($url){
        date_default_timezone_set('PRC');
        $action = input('get.action');
        $id = input('id');
        if('delete' == $action){
            if($id){
                db('vc_order')->where('id',$id)->delete();
                message("删除订单成功",$url);
            }
        }
        if('del' == $action){
            $query = db('vc_order');
            
            $keywords = input('keywords');
            if(!empty($keywords)){
                $query->where(function($query2) use($keywords){
                    $query2->where('order_id',$keywords)
                    ->whereOr('user_name',$keywords)
                    ->whereOr('pay_order',$keywords)
                    ->whereOr('lock_id',$keywords)
                    ->whereOr('order_desc','like','%'.$keywords.'%');
                });
            }
            
            $order_state = input('order_state');
            if(is_numeric($order_state) ){
                $query->where('order_state',$order_state);
            }
            
            $state = input('state');
            if(is_numeric($state) ){
                $query->where('state',$state);
            }
            
            $pay_type = input('pay_type');
            if($pay_type){
                $query->where('pay_type',$pay_type);
            }
            
            $start_time = input('start_time');
            $end_time = input('end_time');
            if($start_time||$end_time){
                if($start_time&&$end_time){
                    $stime = strtotime($start_time);
                    $etime = strtotime($end_time);
                    if($stime > $etime){//开始时间大于结束时间时,结束时间当作无效参数
                        $query->where('order_time','>=',$stime);
                    }else{
                        $query->where('order_time','between',[$stime,$etime]);
                    }
                }elseif($start_time){
                    $stime = strtotime($start_time);
                    $query->where('order_time','>=',$stime);
                }else{
                    $etime = strtotime($end_time);
                    $query->where('order_time','<=',$etime);
                }
            }
            
            $query->delete();
            message("清空数据成功",$url);
        }
    }
    
    /**
     * 待处理订单 state=0
     */
    public function deal_list(){
        date_default_timezone_set('PRC');
        //dump(session('auto_refresh'));return;
        
        //操作部分,设置自动刷新,刷新间隔，锁定订单,解锁订单
        
        $act = input('get.act');
        if($act == "set1"){
            $interval = input('get.interval/d',10);
            session('interval',$interval);            
        }        
        if($act == "set2"){
            $auto_refresh = input('get.auto_refresh/d',1);            
            session('auto_refresh',$auto_refresh);
        }
        
        //$adminid = session('adminid');
        //$user = db('k_user')->where('uid',$adminid)->find();
        
        $this->deal_lock(url('deal_list'));
        $this->deal_patch(url('deal_list'));

        //本页面自动刷新,查询报警时间内 成功订单数为0 的三分支付;
        
        //三方支付的通道 的 报警检测
        /* 不建议连表查询
        $result = db('vc_order')->where('order_state',1)
        //->where('date(from_unixtime(order_time)) = date(now())') 当天
        //order_time > UNIX_TIMESTAMP(NOW())-60*30 //30分钟
        ->group('pay_api')->order('count desc')
        ->field('count(*) as count,pay_api')->select();
        */
        /*
        1>thirdcode表查 warntime>0的记录;
        2>thirdcode.setconfigid 和 thirdcode.thirdid 得到 通道.Code 和 third.name
        3>订单表查询 order.pay_type =通道.Code order.pay_api = thirdpay.name 最后一条记录;
        4>满足则放入结果集
        */
        //$warn_codes = collection([]);
        $warn_codes = [];
        $warn = 0;
        $thirdcodes = db('vc_thirdcode')->where('warntime','>',0)->select();
        foreach($thirdcodes as $k => $row){
            $seconds = $row['warntime']*60;//分转为秒
            $set_config = db('vc_set_config')->where('id',$row['set_configid'])->find();
            $thirdpay = db('vc_thirdpay')->where('id',$row['thirdid'])->find();
            $order = db('vc_order')->where('pay_type',$set_config['code'])
            ->where('pay_api',$thirdpay['name'])
            ->where("order_time > UNIX_TIMESTAMP(NOW())-$seconds")
            ->find();
            if( !$order ){
                $set = db('vc_set')->where('id',$row['setid'])->find();
                $row['set_name']        =   $set['name'];
                $row['paythird_name']   =   $thirdpay['name'];                
                $row['setconfig_name']  =   $set_config['name'];                
                $warn_codes[] = $row;
            }
        }
        if(count($warn_codes)>0){
            $warn = 1;           
        }
        $this->assign('warn',$warn);
        $this->assign('warn_codes',$warn_codes);
        $warn_content = $this->fetch('warn_codes');
        //$warn_content = $this->fetch('warn_codes',['warn_codes'=>$warn_codes]);
        $warn_content = str_replace("\r\n", "", $warn_content);        
        $warn_content = str_replace("\n", "", $warn_content);
        $warn_content = str_replace("\t", "", $warn_content);
        $this->assign('warn_content',$warn_content);
        //dump($warn_content);return; 
        
        
        //查询开始        
        $query = db('vc_order')->where('state',0);

        $keywords = input('keywords');
        if(!empty($keywords)){
            $query->where(function($query2) use($keywords){
                $query2->where('order_id',$keywords)
                ->whereOr('user_name',$keywords);
            });
        }
        
        $order_state = input('order_state',1);
        if(is_numeric($order_state) ){
            $query->where('order_state',$order_state);
        }
        
        $pay_type = input('pay_type');
        if($pay_type){
            $query->where('pay_type',$pay_type);
        }
        
        $pay_api = input('pay_api');
        if($pay_api){
            $query->where('pay_api',$pay_api);
        }
        
        $this->assign('keywords',$keywords);
        $this->assign('order_state',$order_state);
        $this->assign('pay_type',$pay_type);
        $this->assign('pay_api',$pay_api);
        
        $options = $query->getOptions();
        $datas = $query->order('id')->paginate();        
        $record = $query->options($options)->count();
        $xiaofei = $query->options($options)->sum('order_money');
        $datas->extra(['总记录'=>$record,'总金额'=>$xiaofei]);
        
        if($keywords){
            $datas->appends('keywords',$keywords);
        }
        //if($order_state){            
            $datas->appends('order_state',$order_state);
        //}
        if($pay_type){            
            $datas->appends('pay_type',$pay_type);
        }
        if($pay_api){
            $datas->appends('pay_api',$pay_api);            
        }
        
        $result = [];
        foreach ($datas as $k=>$v){
            $result[$k]['id'] = $v['id'];
            $result[$k]['order_id'] = $v['order_id'];
            $result[$k]['user_name'] = $v['user_name'];
            $result[$k]['order_money'] = $v['order_money'];
            $result[$k]['order_time'] = $v['order_time'];
            $result[$k]['sys_time'] = $v['sys_time'];
            $result[$k]['order_state'] = $v['order_state'];
            $result[$k]['state'] = $v['state'];
            $result[$k]['order_desc'] = $v['order_desc'];
            $result[$k]['order_msg'] = $v['order_msg'];
            $result[$k]['pay_type'] = $v['pay_type'];
            $result[$k]['pay_order'] = $v['pay_order'];
            $result[$k]['pay_api'] = $v['pay_api'];
            $result[$k]['lock_id'] = $v['lock_id'];            
            $setconfig = db('vc_set_config')->where('code',$v['pay_type'])->find();
            $result[$k]['setid'] = $setconfig['set_id'];
            $result[$k]['name'] = $setconfig['name'];
        }
                
        $setcg = db('vc_set_config')->select();//所有通道        
        $thirdcg = db('vc_thirdpay')->select();//所有第三方
        $this->assign('setcg',$setcg);
        $this->assign('thirdcg',$thirdcg);
        
        $tongji = '<li><a href="javascript:;">总金额：'.$xiaofei.'</a></li>';        
        $interval = session('interval');
        if(empty($interval))$interval = 10;
        $auto_refresh = session('auto_refresh');
        if(empty($auto_refresh))$auto_refresh = 1;
        
        $this->assign('tongji',$tongji);
        $this->assign('interval',$interval);
        $this->assign('auto_refresh',$auto_refresh);
        
        $flag = false;
        $totalcount = session('totalcount');
        if(is_null($totalcount)){           
            $totalcount = db('vc_order')->where('state',0)->count();
        }                    
        $count = db('vc_order')->where('state',0)->count();
        session('totalcount',$count);        
        if($count > $totalcount){
            $flag = true;
        }
                
        $this->assign('flag',$flag);
        $this->assign('datas',$datas);
        $this->assign('result',$result);
        $this->assign('record',$record);
        $this->assign('xiaofei',$xiaofei);
        
        return $this->fetch();
    }
    
    /**
     * 我的订单 state=5,lock_id=xxx
     */
    public function my_list(){
        date_default_timezone_set('PRC');
        //$adminid = session('adminid');
        //$user = db('k_user')->where('uid',$adminid)->find();
        
        $this->deal_lock(url('my_list'));
        $this->deal_patch(url('my_list'));
        
        $query = db('vc_order')->where('state',5)->where('lock_id',session('adminname'));
        
        $keywords = input('keywords');
        if(!empty($keywords)){
            $query->where(function($query2) use($keywords){
                $query2->where('order_id',$keywords)
                ->whereOr('user_name',$keywords);
            });
        }

        $order_state = input('order_state');
        if(is_numeric($order_state) ){
            $query->where('order_state',$order_state);
        }
        
        $state = input('state');
        if(is_numeric($state) ){
            $query->where('state',$state);
        }
        
        $pay_type = input('pay_type');
        if($pay_type){
            $query->where('pay_type',$pay_type);
        }
        
        $pay_api = input('pay_api');
        if($pay_api){
            $query->where('pay_api',$pay_api);
        }

        $start_time = input('start_time');
        $end_time = input('end_time');  
        if($start_time||$end_time){
            if($start_time&&$end_time){
                $stime = strtotime($start_time);
                $etime = strtotime($end_time);
                if($stime > $etime){//开始时间大于结束时间时,结束时间当作无效参数
                    $query->where('order_time','>=',$stime);
                }else{
                    $query->where('order_time','between',[$stime,$etime]);
                }                                
            }elseif($start_time){
                $stime = strtotime($start_time);
                $query->where('order_time','>=',$stime);
            }else{
                $etime = strtotime($end_time);
                $query->where('order_time','<=',$etime);
            }
        }

        $this->assign('keywords',$keywords);
        $this->assign('order_state',$order_state);
        $this->assign('state',$state);
        $this->assign('pay_type',$pay_type);
        $this->assign('pay_api',$pay_api);
        $this->assign('start_time',$start_time);
        $this->assign('end_time',$end_time);
        
        $options = $query->getOptions();        
        $datas = $query->order('id desc')->paginate();
        $record = $query->options($options)->count();
        $xiaofei = $query->options($options)->sum('order_money');
        $datas->extra(['总记录'=>$record,'总金额'=>$xiaofei]);
        
        if($keywords){
            $datas->appends('keywords',$keywords);
        }
        //if($order_state){
            $datas->appends('order_state',$order_state);
        //}
        //if($state){
            $datas->appends('state',$state);
        //}
        if($pay_type){
            $datas->appends('pay_type',$pay_type);
        }
        if($pay_api){
            $datas->appends('pay_api',$pay_api);
        }
        if($start_time){
            $datas->appends('start_time',$start_time);
        }
        if($end_time){
            $datas->appends('end_time',$end_time);
        }        
        
        $result = [];
        foreach ($datas as $k=>$v){
            $result[$k]['id'] = $v['id'];
            $result[$k]['order_id'] = $v['order_id'];
            $result[$k]['user_name'] = $v['user_name'];
            $result[$k]['order_money'] = $v['order_money'];
            $result[$k]['order_time'] = $v['order_time'];
            $result[$k]['sys_time'] = $v['sys_time'];
            $result[$k]['order_state'] = $v['order_state'];
            $result[$k]['state'] = $v['state'];
            $result[$k]['order_desc'] = $v['order_desc'];
            $result[$k]['order_msg'] = $v['order_msg'];
            $result[$k]['pay_type'] = $v['pay_type'];
            $result[$k]['pay_order'] = $v['pay_order'];
            $result[$k]['pay_api'] = $v['pay_api'];
            $result[$k]['lock_id'] = $v['lock_id'];            
            $setconfig = db('vc_set_config')->where('code',$v['pay_type'])->find();
            $result[$k]['setid'] = $setconfig['set_id'];
            $result[$k]['name'] = $setconfig['name'];
        }
        
        $setcg = db('vc_set_config')->select();//所有通道
        $thirdcg = db('vc_thirdpay')->select();//所有第三方
        $this->assign('setcg',$setcg);
        $this->assign('thirdcg',$thirdcg);
        
        $tongji = '<li><a href="javascript:;">总金额：'.$xiaofei.'</a></li>';
        $this->assign('tongji',$tongji);
      
        $this->assign('datas',$datas);
        $this->assign('result',$result);
        $this->assign('record',$record);
        $this->assign('xiaofei',$xiaofei);
        
        return $this->fetch();                
    }
    
    /**
     * 订单查询     order_state=1,lock_id=xxx
     */
    public function order_list(){
        date_default_timezone_set('PRC');
        //$adminid = session('adminid');
        //$user = db('k_user')->where('uid',$adminid)->find();
        
        $this->deal_lock(url('my_list'));
        $this->deal_patch(url('my_list'));
        
        //$query = db('vc_order')->where('state',5)->where('lock_id',session('adminname'));//my_list的条件
        $query = db('vc_order')->where('order_state',1)->where('lock_id',session('adminname'));

        $keywords = input('keywords');
        if(!empty($keywords)){
            $query->where(function($query2) use($keywords){
                $query2->where('order_id',$keywords)
                ->whereOr('user_name',$keywords);
            });
        }
        
        $order_state = input('order_state');
        if(is_numeric($order_state) ){
            $query->where('order_state',$order_state);
        }
        
        $state = input('state');
        if(is_numeric($state) ){
            $query->where('state',$state);
        }
        
        $pay_type = input('pay_type');
        if($pay_type){
            $query->where('pay_type',$pay_type);
        }
        
        $pay_api = input('pay_api');
        if($pay_api){
            $query->where('pay_api',$pay_api);
        }
        
        $start_time = input('start_time');
        $end_time = input('end_time');
        if($start_time||$end_time){
            if($start_time&&$end_time){
                $stime = strtotime($start_time);
                $etime = strtotime($end_time);
                if($stime > $etime){//开始时间大于结束时间时,结束时间当作无效参数
                    $query->where('order_time','>=',$stime);
                }else{
                    $query->where('order_time','between',[$stime,$etime]);
                }
            }elseif($start_time){
                $stime = strtotime($start_time);
                $query->where('order_time','>=',$stime);
            }else{
                $etime = strtotime($end_time);
                $query->where('order_time','<=',$etime);
            }
        }
        
        $this->assign('keywords',$keywords);
        $this->assign('order_state',$order_state);
        $this->assign('state',$state);
        $this->assign('pay_type',$pay_type);
        $this->assign('pay_api',$pay_api);
        $this->assign('start_time',$start_time);
        $this->assign('end_time',$end_time);
        
        $options = $query->getOptions();
        $datas = $query->order('id desc')->paginate();
        $record = $query->options($options)->count();
        $xiaofei = $query->options($options)->sum('order_money');
        $datas->extra(['总记录'=>$record,'总金额'=>$xiaofei]);
        
        if($keywords){
            $datas->appends('keywords',$keywords);
        }
        //if($order_state){
            $datas->appends('order_state',$order_state);
        //}
        //if($state){
            $datas->appends('state',$state);
        //}
        if($pay_type){
            $datas->appends('pay_type',$pay_type);
        }
        if($pay_api){
            $datas->appends('pay_api',$pay_api);
        }
        if($start_time){
            $datas->appends('start_time',$start_time);
        }
        if($end_time){
            $datas->appends('end_time',$end_time);
        }
        
        $result = [];
        foreach ($datas as $k=>$v){
            $result[$k]['id'] = $v['id'];
            $result[$k]['order_id'] = $v['order_id'];
            $result[$k]['user_name'] = $v['user_name'];
            $result[$k]['order_money'] = $v['order_money'];
            $result[$k]['order_time'] = $v['order_time'];
            $result[$k]['sys_time'] = $v['sys_time'];
            $result[$k]['order_state'] = $v['order_state'];
            $result[$k]['state'] = $v['state'];
            $result[$k]['order_desc'] = $v['order_desc'];
            $result[$k]['order_msg'] = $v['order_msg'];
            $result[$k]['pay_type'] = $v['pay_type'];
            $result[$k]['pay_order'] = $v['pay_order'];
            $result[$k]['pay_api'] = $v['pay_api'];
            $result[$k]['lock_id'] = $v['lock_id'];
            $setconfig = db('vc_set_config')->where('code',$v['pay_type'])->find();
            $result[$k]['setid'] = $setconfig['set_id'];
            $result[$k]['name'] = $setconfig['name'];
        }
        
        $setcg = db('vc_set_config')->select();//所有通道
        $thirdcg = db('vc_thirdpay')->select();//所有第三方
        $this->assign('setcg',$setcg);
        $this->assign('thirdcg',$thirdcg);
        
        $tongji = '<li><a href="javascript:;">总金额：'.$xiaofei.'</a></li>';
        $this->assign('tongji',$tongji);
        
        $this->assign('datas',$datas);
        $this->assign('result',$result);
        $this->assign('record',$record);
        $this->assign('xiaofei',$xiaofei);
        
        return $this->fetch();
    }
    
    /**
     * 订单记录     order_state = 1
     */
    public function list_mgr(){
        date_default_timezone_set('PRC');
        //$adminid = session('adminid');
        //$user = db('k_user')->where('uid',$adminid)->find();
        
        $this->deal_lock(url('my_list'));
        $this->deal_patch(url('my_list'));
        
        $query = db('vc_order')->where('order_state',1);

        $keywords = input('keywords');
        if(!empty($keywords)){
            $query->where(function($query2) use($keywords){
                $query2->where('order_id',$keywords)
                ->whereOr('user_name',$keywords)
                ->whereOr('lock_id',$keywords)
                ->whereOr('order_desc','like','%'.$keywords.'%');                                                
            });
        }
        
        $order_state = input('order_state');
        if(is_numeric($order_state) ){
            $query->where('order_state',$order_state);
        }
        
        $state = input('state');
        if(is_numeric($state) ){
            $query->where('state',$state);
        }
        
        $pay_type = input('pay_type');
        if($pay_type){
            $query->where('pay_type',$pay_type);
        }
        
        $pay_api = input('pay_api');
        if($pay_api){
            $query->where('pay_api',$pay_api);
        }
        
        $start_time = input('start_time');
        $end_time = input('end_time');
        if($start_time||$end_time){
            if($start_time&&$end_time){
                $stime = strtotime($start_time);
                $etime = strtotime($end_time);
                if($stime > $etime){//开始时间大于结束时间时,结束时间当作无效参数
                    $query->where('order_time','>=',$stime);
                }else{
                    $query->where('order_time','between',[$stime,$etime]);
                }
            }elseif($start_time){
                $stime = strtotime($start_time);
                $query->where('order_time','>=',$stime);
            }else{
                $etime = strtotime($end_time);
                $query->where('order_time','<=',$etime);
            }
        }
        
        $this->assign('keywords',$keywords);
        $this->assign('order_state',$order_state);
        $this->assign('state',$state);
        $this->assign('pay_type',$pay_type);
        $this->assign('pay_api',$pay_api);
        $this->assign('start_time',$start_time);
        $this->assign('end_time',$end_time);
        
        $options = $query->getOptions();
        $datas = $query->order('id desc')->paginate();
        $record = $query->options($options)->count();
        $xiaofei = $query->options($options)->sum('order_money');
        $datas->extra(['总记录'=>$record,'总金额'=>$xiaofei]);
        
        $export_args = [];
        if($keywords){
            $datas->appends('keywords',$keywords);
        }
        //if($order_state){
            $datas->appends('order_state',$order_state);
            $export_args['order_state'] = $order_state;
        //}
        //if($state){
            $datas->appends('state',$state);
            $export_args['state'] = $state;
        //}
        if($pay_type){
            $datas->appends('pay_type',$pay_type);
        }
        if($pay_api){
            $datas->appends('pay_api',$pay_api);
        }
        if($start_time){
            $datas->appends('start_time',$start_time);
            $export_args['start_time'] = $start_time;
        }
        if($end_time){
            $datas->appends('end_time',$end_time);
            $export_args['end_time'] = $end_time;
        }
                        
        $result = [];
        foreach ($datas as $k=>$v){
            $result[$k]['id'] = $v['id'];
            $result[$k]['order_id'] = $v['order_id'];
            $result[$k]['user_name'] = $v['user_name'];
            $result[$k]['order_money'] = $v['order_money'];
            $result[$k]['order_time'] = $v['order_time'];
            $result[$k]['sys_time'] = $v['sys_time'];
            $result[$k]['order_state'] = $v['order_state'];
            $result[$k]['state'] = $v['state'];
            $result[$k]['order_desc'] = $v['order_desc'];
            $result[$k]['order_msg'] = $v['order_msg'];
            $result[$k]['pay_type'] = $v['pay_type'];
            $result[$k]['pay_order'] = $v['pay_order'];
            $result[$k]['pay_api'] = $v['pay_api'];
            $result[$k]['lock_id'] = $v['lock_id'];
            $setconfig = db('vc_set_config')->where('code',$v['pay_type'])->find();
            $result[$k]['setid'] = $setconfig['set_id'];
            $result[$k]['name'] = $setconfig['name'];
        }
        
        $setcg = db('vc_set_config')->select();//所有通道
        $thirdcg = db('vc_thirdpay')->select();//所有第三方
        $this->assign('setcg',$setcg);
        $this->assign('thirdcg',$thirdcg);
        
        $tongji = '<li><a href="javascript:;">总金额：'.$xiaofei.'</a></li>';
        $this->assign('tongji',$tongji);
        
        $this->assign('datas',$datas);
        $this->assign('result',$result);
        $this->assign('record',$record);
        $this->assign('xiaofei',$xiaofei);
        
        $export_args = http_build_query($export_args);
        $this->assign('export_args',$export_args);
       
        return $this->fetch();
    }
    
    /**
     * 订单管理    默认条件 order_state = 1
     */
    public function mgr_list(){
        date_default_timezone_set('PRC');
        //$adminid = session('adminid');
        //$user = db('k_user')->where('uid',$adminid)->find();
        
        $this->deal_lock(url('mgr_list'));
        $this->deal_patch(url('mgr_list'));
        $this->deal_delete(url('mgr_list'));
        
        $query = db('vc_order')->where('order_state',1);
        
        $keywords = input('keywords');
        if(!empty($keywords)){
            $query->where(function($query2) use($keywords){
                $query2->where('order_id',$keywords)
                ->whereOr('user_name',$keywords)
                ->whereOr('lock_id',$keywords)
                ->whereOr('order_desc','like','%'.$keywords.'%');
            });
        }
        
        $order_state = input('order_state');
        if(is_numeric($order_state) ){
            $query->where('order_state',$order_state);
        }
        
        $state = input('state');
        if(is_numeric($state) ){
            $query->where('state',$state);
        }
        
        $pay_type = input('pay_type');
        if($pay_type){
            $query->where('pay_type',$pay_type);
        }
        
        $pay_api = input('pay_api');
        if($pay_api){
            $query->where('pay_api',$pay_api);
        }
        
        $start_time = input('start_time');
        $end_time = input('end_time');
        if($start_time||$end_time){
            if($start_time&&$end_time){
                $stime = strtotime($start_time);
                $etime = strtotime($end_time);
                if($stime > $etime){//开始时间大于结束时间时,结束时间当作无效参数
                    $query->where('order_time','>=',$stime);
                }else{
                    $query->where('order_time','between',[$stime,$etime]);
                }
            }elseif($start_time){
                $stime = strtotime($start_time);
                $query->where('order_time','>=',$stime);
            }else{
                $etime = strtotime($end_time);
                $query->where('order_time','<=',$etime);
            }
        }
        
        $this->assign('keywords',$keywords);
        $this->assign('order_state',$order_state);
        $this->assign('state',$state);
        $this->assign('pay_type',$pay_type);
        $this->assign('pay_api',$pay_api);
        $this->assign('start_time',$start_time);
        $this->assign('end_time',$end_time);
        
        $options = $query->getOptions();
        $datas = $query->order('id desc')->paginate();
        $record = $query->options($options)->count();
        $xiaofei = $query->options($options)->sum('order_money');
        $datas->extra(['总记录'=>$record,'总金额'=>$xiaofei]);
        
        $export_args = [];
        if($keywords){
            $datas->appends('keywords',$keywords);
        }
        //if($order_state){
        $datas->appends('order_state',$order_state);
        $export_args['order_state'] = $order_state;
        //}
        //if($state){
        $datas->appends('state',$state);
        $export_args['state'] = $state;
        //}
        if($pay_type){
            $datas->appends('pay_type',$pay_type);
        }
        if($pay_api){
            $datas->appends('pay_api',$pay_api);
        }
        if($start_time){
            $datas->appends('start_time',$start_time);
            $export_args['start_time'] = $start_time;
        }
        if($end_time){
            $datas->appends('end_time',$end_time);
            $export_args['end_time'] = $end_time;
        }
        
        $result = [];
        foreach ($datas as $k=>$v){
            $result[$k]['id'] = $v['id'];
            $result[$k]['order_id'] = $v['order_id'];
            $result[$k]['user_name'] = $v['user_name'];
            $result[$k]['order_money'] = $v['order_money'];
            $result[$k]['order_time'] = $v['order_time'];
            $result[$k]['sys_time'] = $v['sys_time'];
            $result[$k]['order_state'] = $v['order_state'];
            $result[$k]['state'] = $v['state'];
            $result[$k]['order_desc'] = $v['order_desc'];
            $result[$k]['order_msg'] = $v['order_msg'];
            $result[$k]['pay_type'] = $v['pay_type'];
            $result[$k]['pay_order'] = $v['pay_order'];
            $result[$k]['pay_api'] = $v['pay_api'];
            $result[$k]['lock_id'] = $v['lock_id'];
            $setconfig = db('vc_set_config')->where('code',$v['pay_type'])->find();
            $result[$k]['setid'] = $setconfig['set_id'];
            $result[$k]['name'] = $setconfig['name'];
        }
        
        $setcg = db('vc_set_config')->select();//所有通道
        $thirdcg = db('vc_thirdpay')->select();//所有第三方
        $this->assign('setcg',$setcg);
        $this->assign('thirdcg',$thirdcg);
        
        $tongji = '<li><a href="javascript:;">总金额：'.$xiaofei.'</a></li>';
        $this->assign('tongji',$tongji);
        
        $this->assign('datas',$datas);
        $this->assign('result',$result);
        $this->assign('record',$record);
        $this->assign('xiaofei',$xiaofei);
        
        $export_args = http_build_query($export_args);
        $this->assign('export_args',$export_args);
        
        return $this->fetch();
    }

    /**
     * 全部订单
     */
    public function allorder_list(){
        date_default_timezone_set('PRC');
        //$adminid = session('adminid');
        //$user = db('k_user')->where('uid',$adminid)->find();

        $query = db('vc_order');
        
        $keywords = input('keywords');
        if(!empty($keywords)){
            $query->where(function($query2) use($keywords){
                $query2->where('order_id',$keywords)
                ->whereOr('user_name',$keywords)
                ->whereOr('lock_id',$keywords)
                ->whereOr('order_desc','like','%'.$keywords.'%');
            });
        }
        
        $order_state = input('order_state');
        if(is_numeric($order_state) ){
            $query->where('order_state',$order_state);
        }
        
        $state = input('state');
        if(is_numeric($state) ){
            $query->where('state',$state);
        }
        
        $pay_type = input('pay_type');
        if($pay_type){
            $query->where('pay_type',$pay_type);
        }
        
        $pay_api = input('pay_api');
        if($pay_api){
            $query->where('pay_api',$pay_api);
        }
        
        $start_time = input('start_time');
        $end_time = input('end_time');
        if($start_time||$end_time){
            if($start_time&&$end_time){
                $stime = strtotime($start_time);
                $etime = strtotime($end_time);
                if($stime > $etime){//开始时间大于结束时间时,结束时间当作无效参数
                    $query->where('order_time','>=',$stime);
                }else{
                    $query->where('order_time','between',[$stime,$etime]);
                }
            }elseif($start_time){
                $stime = strtotime($start_time);
                $query->where('order_time','>=',$stime);
            }else{
                $etime = strtotime($end_time);
                $query->where('order_time','<=',$etime);
            }
        }
        
        $this->assign('keywords',$keywords);
        $this->assign('order_state',$order_state);
        $this->assign('state',$state);
        $this->assign('pay_type',$pay_type);
        $this->assign('pay_api',$pay_api);
        $this->assign('start_time',$start_time);
        $this->assign('end_time',$end_time);
        
        $options = $query->getOptions();
        $datas = $query->order('id desc')->paginate();
        $record = $query->options($options)->count();
        $xiaofei = $query->options($options)->sum('order_money');
        $datas->extra(['总记录'=>$record,'总金额'=>$xiaofei]);
        
        $export_args = [];
        if($keywords){
            $datas->appends('keywords',$keywords);
        }
        //if($order_state){
        $datas->appends('order_state',$order_state);
        $export_args['order_state'] = $order_state;
        //}
        //if($state){
        $datas->appends('state',$state);
        $export_args['state'] = $state;
        //}
        if($pay_type){
            $datas->appends('pay_type',$pay_type);
        }
        if($pay_api){
            $datas->appends('pay_api',$pay_api);
        }
        if($start_time){
            $datas->appends('start_time',$start_time);
            $export_args['start_time'] = $start_time;
        }
        if($end_time){
            $datas->appends('end_time',$end_time);
            $export_args['end_time'] = $end_time;
        }
        
        $result = [];
        foreach ($datas as $k=>$v){
            $result[$k]['id'] = $v['id'];
            $result[$k]['order_id'] = $v['order_id'];
            $result[$k]['user_name'] = $v['user_name'];
            $result[$k]['order_money'] = $v['order_money'];
            $result[$k]['order_time'] = $v['order_time'];
            $result[$k]['sys_time'] = $v['sys_time'];
            $result[$k]['order_state'] = $v['order_state'];
            $result[$k]['state'] = $v['state'];
            $result[$k]['order_desc'] = $v['order_desc'];
            $result[$k]['order_msg'] = $v['order_msg'];
            $result[$k]['pay_type'] = $v['pay_type'];
            $result[$k]['pay_order'] = $v['pay_order'];
            $result[$k]['pay_api'] = $v['pay_api'];
            $result[$k]['lock_id'] = $v['lock_id'];
            $setconfig = db('vc_set_config')->where('code',$v['pay_type'])->find();
            $result[$k]['setid'] = $setconfig['set_id'];
            $result[$k]['name'] = $setconfig['name'];
        }
        
        $setcg = db('vc_set_config')->select();//所有通道
        $thirdcg = db('vc_thirdpay')->select();//所有第三方
        $this->assign('setcg',$setcg);
        $this->assign('thirdcg',$thirdcg);
        
        $tongji = '<li><a href="javascript:;">总金额：'.$xiaofei.'</a></li>';
        $this->assign('tongji',$tongji);
        
        $this->assign('datas',$datas);
        $this->assign('result',$result);
        $this->assign('record',$record);
        $this->assign('xiaofei',$xiaofei);
        
        $export_args = http_build_query($export_args);
        $this->assign('export_args',$export_args);
        
        return $this->fetch();
    }

    public function order_edit(){
        //$action = input('action');
        //$act = input('act');
        //$adminid = session('adminid');
        //$user = db('k_user')->where('uid',$adminid)->find();
        date_default_timezone_set('PRC');
        $id = input('id');
        $info = db('vc_order')->where('id',$id)->find();
        if(request()->isGet()){ 
            $this->assign('info',$info);
            //return $this->fetch();
            echo $this->fetch();
        }else{
            
            if($info['state'] != "3"){                
                if($info['state'] != "5"){
                    return ['stat'=>1,'msg'=>'当前订单未锁定,无法进行操作!'];
                }
                if(session('adminname') != $info['lock_id']){
                    return ['stat'=>2,'msg'=>'当前订单不是您的锁定订单,无法进行操作!'];
                }                
            }
            
            if($info['order_state'] == '0'){
                $order_state = input('order_state');
                
                if($order_state == '1'){
                    $msg = '操作员:【'.session('adminname').'】更新了订单,状态:支付成功,时间:'.date('Y-m-d H:i:s',time());
                    $order_desc = input('order_desc').'|';
                }else{
                    $order_desc = input('order_desc');
                }
                
                $UpdateArr = array(
                    'order_desc'=>$order_desc,
                    'state'=>input('state'),
                    'order_state'=>input('order_state'),
                    'order_msg'=>$msg
                );
            }
            db('vc_order')->where('id',$id)->update($UpdateArr);            
            return ['stat'=>0,'msg'=>'操作成功'];
        }
    }
    
    public function export(){
        date_default_timezone_set('PRC');
        $file_date = date('Ymd');
        
        $p = input('p',0);
        
        $this->assign('p',$p);
        echo $this->fetch();
        
        if(empty($p)){//首页           
            if(file_exists("./export/".$file_date.".xls")){
                unlink("./export/".$file_date.".xls");
            }
            file_put_contents("./export/".$file_date.".xls","");            
        }
        
        //$objReader = \PHPExcel_IOFactory::createReader('Excel5');
        if($p){
            $objPHPExcel = \PHPExcel_IOFactory::load("./export/".$file_date.".xls");
        }else{
            $objPHPExcel = \PHPExcel_IOFactory::load("./export/template.xls");
        }
        $objPHPExcel->setActiveSheetIndex(0); //设置第一张表为当前活动表
        $objPHPExcel->getActiveSheet()->freezePane('A2'); //设置第一行固定，不随滚动条滚动
        
        //首行作为标题,设为绿色
        $sharedStyle1 = new \PHPExcel_Style();
        $sharedStyle1->applyFromArray(
            array('fill' => array(
                'type'	=> \PHPExcel_Style_Fill::FILL_SOLID,
                'color'	=> array('argb' => 'FFCCFFCC')
            ),
                'borders' => array(
                    'bottom'=> array('style' => \PHPExcel_Style_Border::BORDER_THIN),
                    'right'	=> array('style' => \PHPExcel_Style_Border::BORDER_MEDIUM)
                )
            ));
        
        //设置单元格
        $sharedStyle2 = new \PHPExcel_Style();
        $sharedStyle2->applyFromArray(
            array('fill' => array(
                'type'	=> \PHPExcel_Style_Fill::FILL_SOLID,
                'color'	=> array('argb' => 'fff4f4f4')
            )
            ));
        
        if(empty($p)){//首页数据之前 添加 列号 和 列名
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            
            $objPHPExcel->getActiveSheet()->setTitle('All Lottery Info');
            
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1,'编号');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1,'订单编号');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 1,'千网订单号');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 1,'用户名');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 1,'订单金额');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 1,'订单时间');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 1,'订单状态');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 1,'处理状态');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 1,'备注');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, 1,'');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, 1,'');
        }
        
        $allrow = $objPHPExcel->getSheet(0)->getHighestRow();

        
        $query = db('vc_order');
        $export_args = [];
        
        $order_state = input('order_state');
        if(is_numeric($order_state) ){
            $query->where('order_state',$order_state);
            $export_args['order_state'] = $order_state;
        }
        
        $state = input('state');
        if(is_numeric($state) ){
            $query->where('state',$state);
            $export_args['order_state'] = $order_state;
        }

        $start_time = input('start_time');
        $end_time = input('end_time');
        if($start_time||$end_time){
            if($start_time&&$end_time){
                $stime = strtotime($start_time);
                $etime = strtotime($end_time);
                if($stime > $etime){//开始时间大于结束时间时,结束时间当作无效参数
                    $query->where('order_time','>=',$stime);
                    $export_args['start_time'] = $start_time;
                }else{
                    $query->where('order_time','between',[$stime,$etime]);
                    $export_args['start_time'] = $start_time;
                    $export_args['end_time'] = $end_time;
                }
            }elseif($start_time){
                $stime = strtotime($start_time);
                $query->where('order_time','>=',$stime);
                $export_args['start_time'] = $start_time;
            }else{
                $etime = strtotime($end_time);
                $query->where('order_time','<=',$etime);
                $export_args['end_time'] = $end_time;
            }
        }
        
        $options = $query->getOptions();
        $datas = $query->order('id desc')->limit($p,500)->select();
        $allnum = $query->options($options)->count();
        
        if($allnum == 0){
            echo '<script>document.getElementById("log").innerHTML="没有可以导出的数据";</script>'; //循环操作
            return;
        }

        //判断，当excel里的总行数大于等于数据表里的总行数时，出现下载地址，并退出程序
        if(($allrow > $allnum) && $allrow != 1 ){           
            echo '<script>document.getElementById("log").innerHTML="已经导出完成。<br>点击 <a href=\"/export/'.$file_date.'.xls\">这里</a> 下载;"</script>';
            return;
        }
        
        $num = $allrow;
        for($m = 0; $m < count($datas); $m ++){            
            $arr = $datas[$m];            
            $num++; //从总行数的下一行开始操作
            
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $num,$arr['id']);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('B'. $num,$arr['order_id'],\PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$num,$arr['pay_order'],\PHPExcel_Cell_DataType::TYPE_STRING);
            //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $num,$arr['pay_order']);
            //$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $num,$arr['user_name']);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$num,$arr['user_name'],\PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $num,$arr['order_money']);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $num,date('Y-m-d H:i:s',$arr['order_time']));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $num,$this->order_state($arr['order_state']));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $num,$this->deal_state($arr['state']));
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $num,$arr['order_desc'].$arr['order_msg']);
        }
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save ("./export/".$file_date.".xls"); //数据保存到到excel中
        
        //数据库记录数没有多页
        if($allnum <= 500){
            echo '<script>document.getElementById("log").innerHTML="已经导出完成。<br>点击 <a href=\"/export/'.$file_date.'.xls\">这里</a> 下载;"</script>';
            return;
        }
        
        echo '<script>window.location.href="' . url('export') . '?p=' . ($num-1) . '&' . http_build_query($export_args) . '";</script>'; //循环操作
        return;
    }

    private function order_state($state){
        static $states = [];
        $states[0] = '未支付';
        $states[1] = '支付成功';
        return $states[$state];
    }

    private function deal_state($state){
        static $states = [];
        $states[0] = '待处理';
        $states[1] = '已确认';
        $states[2] = '已取消';
        $states[3] = '待确认';
        $states[5] = '已锁定';
        return $states[$state];
    }
    
    /**
     * 系统管理之用户管理
     */
    public function sys_user(){
        date_default_timezone_set('PRC');
        $delete_ok = 0;
        $id = input('get.id/d');
        $action = input('action');
        if(!empty($id) && 'delete' == $action){
            $info = db('vc_sys')->where('id',$id)->find();
            if($info['sys_level'] == 1){
                return message("无法删除管理员帐号",url('sys_user'));
            }            
            db('vc_sys')->where('id',$id)->delete();
            $delete_ok = 1;
        }
        $this->assign('delete_ok',$delete_ok);
        
        $query = db('vc_sys')->where('sys_level',2);
        
        $keywords = input('keywords');
        if(!empty($keywords)){
            $query->where('sys_user','like','%'.$keywords.'%');
        }
                
        $options = $query->getOptions();
        $datas = $query->order('id desc')->paginate();        
        $datas->appends(request()->param());        
        $record = $query->options($options)->count();
        $datas->extra(['总记录'=>$record]);
        
        $this->assign('datas',$datas);
        $this->assign('record',$record);
        return $this->fetch();
    }

    public function sys_add(){
        date_default_timezone_set('PRC');
        if(request()->isGet()){
            return $this->fetch();
        }else{
            $username = trim(input('sys_user'));
                        
            $isExist = db('vc_sys')->where('sys_user',$username)->find();
            if($isExist){
                return ['stat'=>1];                
            }
            
            $data = ['sys_level'=>2,
                'sys_user'=>$username,
                'sys_password'=>trim(input('sys_password')),
                'nick_name'=>trim(input('nick_name')),
                'last_login'=>date('Y-m-d H:i:s'),];
            db('vc_sys')->insert($data);
                        
            return ['stat'=>0];
        }
    }
    
    public function sys_edit(){
        date_default_timezone_set('PRC');
        if(request()->isGet()){
            $id = input('id/d');
            
            $info = db('vc_sys')->where('id',$id)->find();
            if($info['sys_level'] == 1){
                return ;
            }     
            
            $this->assign('info', $info);
            return $this->fetch();
        }else{
            $id = input('id/d');
            
            $info = $info = db('vc_sys')->where('id',$id)->find();
            if($info['sys_level'] == 1){
                return ['stat'=>1];
            }
            
            $upArr = ['nick_name'=>trim(input('nick_name')),
                'sys_password'=>trim(input('sys_password')),];
            db('vc_sys')->where('id',$id)->update($upArr);

            return ['stat'=>0];
        }
    }
    
    /**
     * 清空订单
     */
    public function order_clear(){
        if(request()->isGet()){
            return $this->fetch();
        }else{            
            db('vc_order')->delete();
            return ['stat'=>0];
        }
    }

    /**
     * 登陆日志
     */
    public function log_list(){
        $datas = db('vc_log')->order('id desc')->paginate();        
        $record = db('vc_log')->count();
        $datas->extra(['总记录'=>$record]);
        $this->assign('datas',$datas);
        $this->assign('record',$record);
        return $this->fetch();
    }
    
    /**
     * 修改密码
     */
    public function password(){
        if(request()->isGet()){
            return $this->fetch();
        }else{
            //$adminid = session('adminid');
            //$user = db('k_user')->where('uid',$adminid)->find();
            
            $old_pass = input("old_pass");                    
            $new_pass = input("new_pass");
            $count = db('vc_sys')->where('sys_user',session('adminname'))->where('sys_password',$old_pass)->count();            
            if($count > 0){
                db('vc_sys')->where('sys_user',session('adminname'))->update(['sys_password'=>$new_pass]);                
                return ["stat"=>0];            
            }else{
                return ["stat"=>1];
            }
        }
    }

    
    public function login(){
        date_default_timezone_set('PRC');
        if(!config('pay_use_alone')) {
            $this->error('access deny!');
        }
        
        if(session('adminid')){
            //redirect(url('index'));
            $this->redirect(url('index'));
        }
        
        session(null);
        
        if(request()->isGet()){
            return $this->fetch();
        }else{
            $username = trim(input('user'));
            $password = trim(input('pw'));            
            $imgcode = input('imgcode');
            
            if(!captcha_check($imgcode)){
                return message("验证码错误",url('login'));
            }

            $r = db('vc_sys')->where('sys_user',$username)->where('sys_password',$password)->find();

            if($r){                
                //$_SESSION['card_admin'] = array('username'=>$username, 'level'=>$r['sys_level'], 'nickname'=>$r['nick_name']);
                session('adminid',$r['id']);
                session('adminname',$username);
                
                $update_data = ['last_login'=>date('Y-m-d H:i:s'),'last_ip'=>$this->get_client_ip()];                    
                db('vc_sys')->where('id',$r['id'])->update($update_data);
                $insert_data = ['user_name'=>$username,'login_time'=>date('Y-m-d H:i:s'),'login_ip'=>$this->get_client_ip()];
                db('vc_log')->insert($insert_data);

                return message("登录成功,即将进入管理界面",url('index'));
            }else{                
                return message("用户名或者密码错误",url('login'));
            }
        }
    }

    public function login_out(){
        if(!config('pay_use_alone')) {
            $this->error('access deny!');
        }
        session(null);
        return message("退出成功",url('login'));
    }
    
    // 获取客户端IP
    private function get_client_ip() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] AS $xip) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                    $ip = $xip;
                    break;
                }
            }
        }
        
        return $ip;
    }
}
