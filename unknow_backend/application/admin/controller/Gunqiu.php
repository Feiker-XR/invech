<?php
namespace app\admin\controller;
use app\admin\Login;
use think\Cache;

class gunqiu extends Login{
    
    public function ft(){        
        /*
        //这个缓存是5秒超时,超时和取不到返回false
        $zqgq = Cache::get('zqgq');
        if(false === $zqgq){
            //include CACHE_PATH.'zqgq.php';
            $zqgq = [];
        }      
        */
        //5秒超时,取不到返回空数组                  
        $zqgq = Cache::get('zqgq',[]);
        $gq_un = Cache::get('zqgq_un');
        if(!$gq_un){
            include(CACHE_PATH.'zqgq_un.php');
        }
        $this->assign('gq_un',$gq_un);
        $this->assign('zqgq',$zqgq);
        return $this->fetch();
    }
    
    public function hideft(){
        $gq_un = Cache::get('zqgq_un');
        
        if(false === $gq_un ||count($gq_un) == 0){
            include CACHE_PATH.'zqgq_un.php';
        }        
        $this->assign('gq_un',$gq_un);
        return $this->fetch();
    }
    
    public function dohideft(){
        //include CACHE_PATH.'zqgq.php';
        //include CACHE_PATH.'zqgq_un.php';
        $zqgq = Cache::get('zqgq');
        if(false === $zqgq){
            include CACHE_PATH.'zqgq.php';
        }        
        $gq_un = Cache::get('zqgq_un');
        if(false === $gq_un){
            include CACHE_PATH.'`.php';
        }

        $param = $this->request->param();
        $matchid = $param['matchid'] ?? '';
        $op = $param['op'] ?? '';
        if($matchid){
            $dis = new \app\logic\gqdisplay('zq');
            $matches = $this->getMatchContent($zqgq, array($matchid));
            switch ($op){
                case 'add':
                    $ret = $dis->add($matches);
                    //$gq_un =  array_merge($gq_un,$matches);
                    if(isset($matches[$matchid])){
                        $gq_un[$matchid] = $matches[$matchid];
                    }
                    $ret = Cache::set('zqgq_un',$gq_un);                    
                    if($ret){
                        echo '<script>alert("成功");history.go(-1);</script>';
                        exit();
                    }else{
                        echo '<script>alert("失败");history.go(-1);</script>';
                        exit();
                    }
                    break;
                case 'delete':
                    $ret = $dis->delete($matchid);                    
                    if(isset($gq_un[$matchid])){
                        unset($gq_un[$matchid]);   
                    }
                    $ret = Cache::set('zqgq_un',$gq_un);
                    if($ret){
                        echo '<script>alert("成功");history.go(-1);</script>';
                        exit();
                    }else{
                        echo '<script>alert("失败");history.go(-1);</script>';
                        exit();
                    }
                    break;
                default:
                    $this->error('缺少参数!');
            }
        }else{
            $this->error('赛事ID不能为空!');
        }
        
    }
    
    public function bk(){        
        $lqgq = Cache::get('lqgq');
        if(false === $lqgq){
            include CACHE_PATH.'lqgq.php';
        }                   
        $this->assign('lqgq',$lqgq);
        return $this->fetch('bk');
    }
    
    
    public function hidebk(){        
        $gq_un = Cache::get('lqgq_un');
        if(false === $gq_un){
            include CACHE_PATH.'lqgq_un.php';
        }            
        $this->assign('gq_un',$gq_un);
        return $this->fetch();
    }
    
    public function dohidebk(){
        //include CACHE_PATH.'lqgq.php';
        //include CACHE_PATH.'lqgq_un.php';
        $lqgq = Cache::get('lqgq');
        if(false === $lqgq){
            include CACHE_PATH.'lqgq.php';
        }         
        $gq_un = Cache::get('lqgq_un');
        if(false === $gq_un){
            include CACHE_PATH.'lqgq_un.php';
        } 
        $param = $this->request->param();
        $matchid = $param['matchid'] ?? '';
        $op = $param['op'] ?? '';
        if($matchid){
            $dis = new \app\logic\gqdisplay('lq');
            $matches = $this->getMatchContent($lqgq, array($matchid));
            switch ($op){
                case 'add':
                    $dis->add($matches);
                    //$gq_un =  array_merge($gq_un,$matches);
                    if(isset($matches[$matchid])){
                        $gq_un[$matchid] = $matches[$matchid];
                    }                    
                    $ret = Cache::set('zqgq_un',$gq_un);                 
                    if($ret){
                        echo '<script>alert("成功");history.go(-1);</script>';
                        exit();
                    }else{
                        echo '<script>alert("失败");history.go(-1);</script>';
                        exit();
                    }
                    break;
                case 'delete':
                    $ret = $dis->delete($matchid);
                    if(isset($gq_un[$matchid])){
                        unset($gq_un[$matchid]);   
                    }                    
                    $ret = Cache::set('zqgq_un',$gq_un);                    
                    if($ret){
                        echo '<script>alert("成功");history.go(-1);</script>';
                        exit();
                    }else{
                        echo '<script>alert("失败");history.go(-1);</script>';
                        exit();
                    }
                    break;
                default:
                    $this->error('缺少参数!');
            }
        }else{
            $this->error('赛事ID不能为空!');
        }
    }
    
    private function getMatchContent($zqgq,$matchids){
        $matches = array();
        foreach($zqgq as $k => $v){
            if(in_array($v['Match_ID'], $matchids)){
                $matches[$v['Match_ID']] = $v;
            }
        }
        return $matches;
    }
}
