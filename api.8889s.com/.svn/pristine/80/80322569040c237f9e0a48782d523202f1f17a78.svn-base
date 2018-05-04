<?php
namespace app\logic;
class gqdisplay {
    
    /**
     * 
     * @var 缓存文件
     */
    private $cache_file = '';
    
    /**
     * 必须传入是足球(zq)还是篮球(lq)
     * @param string $type
     */
    public function __construct($type){
        $base = CACHE_PATH;
        if($type == 'zq'){
            $this->cache_file = $base.'zqgq_un.php';
        }else{
            $this->cache_file = $base.'lqgq_un.php';
        }
    }
    
    public function delete($match_Id){
        include $this->cache_file;
        if(isset($gq_un[$match_Id])){
            unset($gq_un[$match_Id]);
            return $this->write($gq_un);
        }else{
            return true;
        }
    }
    
    /**
     * 添加单个滚球数据
     * @param array $matches
     */
    public function add($match){
        include $this->cache_file;
        foreach ($match as $k => $v){
            $gq_un[$k] = $v;
        }
        return $this->write($gq_un);
    }
    
    /**
     * 添加多个滚球
     * @param array $matches
     * 参数matches数组必须是二维数组,第一维键必须是比赛id
     */
    public function add_Matches($matches){
        include $this->cache_file;
        $gq_un =  array_merge($gq_un,$matches);
        return $this->write($gq_un);
        
    }
    
    /**
     * 检查比赛是否加入了缓存文件
     * @param string $match_Id 比赛的ID
     */
    public function check($match_Id){
        include $this->cache_file;
        if(isset($gq_un[$match_Id])){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * 将隐藏的比赛信息写入缓存文件
     * @param array $matches
     */
    public function write($matches){
        $content = "<?php\r\n";
        $content .= "\$gq_un=array();\r\n";
        foreach ($matches as $k=>$v){
            foreach ($v as $key =>$value){
                $content .= "\t\$gq_un['{$k}']['{$key}']='{$value}';\r\n";
            }
        }
        try{
            $result = file_put_contents($this->cache_file, $content);
            if($result === false){
                return false;
            }else{
                return true;
            }
        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }
    
}