<?php
namespace app\duxcms\controller;
use app\admin\controller\AdminController;
/**
 * 后台用户
 */
class SitemapController extends AdminController {
    public function __construct()
    {
        parent::__construct();
        $this->rewrite();
        define('TPL_NAME', config('tpl_member'));

    }
    /**
     * 判断是否开启伪静态
     */
    protected function rewrite(){
        $file = CONFIG_PATH . 'performance.php';
        $data = load_config($file);
        $rewrite  = $data['REWRITE_ON']?true:false;
        $_SERVER["SCRIPT_NAME"] = 'index.php';
        if (!$rewrite){
            $this->error('请先开启伪静态');
        } else{
            config('REWRITE_ON',true);
           \framework\base\Route::parseUrl( config('REWRITE_RULE'), $rewrite ); 
        }
    }    
    /**
     * 当前模块参数
     */
    protected function _infoModule(){
        return array(
            'info'  => array(
                'name' => 'sitemap/站点地图',
                'description' => '生成sitemap站点地图文件',
                ),
            );
    } 
    /**
     * 生成sitemap文件
     */
    public function sitemap(){
        //检查sitemap问及是否存在
        $this->sitemap = ROOT_PATH . 'sitemap.xml';
        if (is_file($this->sitemap)) {
            $info=simplexml_load_file($this->sitemap);
            $info=get_object_vars($info->url);
            $text='sitemap.xml文件存在。上次生成时间：'.$info['lastmod'];
        }else{
             $text='还未生成sitemap.xml文件,请选择栏目并生成！';
        }
        if (IS_POST) {
            //接收ajax传回的选择项
        $categorys = request('post.sitemap');
        if(empty($categorys)){
                $this->error('至少选择一个栏目！');
            }
        //进行循环取值
        foreach ($categorys as $key => $value) {
            if ($value=='category') {
                $class_id = target('duxcms/Category')->loadList();
                foreach ($class_id as $key => $value) {
                    $sitemap[] = self::getPage($value['class_id'],$value);
                }
            }elseif ($value=='tag'){
                $tags = target('duxcms/Tags')->loadList(array(),5000);
                $tag = array();
                $i = 0;
                foreach ($tags as $key => $vo) {
                    $tag[$i]['app'] = 'tag标签';
                    $tag[$i]['title'] = $vo['name'];
                    $tag[$i]['curl'] = $vo['url'];
                    $list[$i]['time'] = $vo['time'];
                    $i++;
                }
                $sitemap[] = $tag;                
            }else{
                $content =  target('duxcms/Content')->loadList(array(),5000);
                $list = array();
                $i = 0;
                foreach ($content as $key => $vo) {
                    $list[$i]['app'] = '新闻';
                    $list[$i]['title'] = $vo['title'];
                    $list[$i]['curl'] = $vo['aurl'];
                    $list[$i]['time'] = $vo['time'];
                    $i++;
                }
                $sitemap[] = $list;
            }
        }
        //合并数组
        $urls = self::array2single(array_merge($sitemap)); 
        $config = target('admin/Config')->getInfo();
        $sitemap = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<?xml-stylesheet type=\"text/xsl\" href=\"/public/js/sitemap.xsl\"?>\r\n
                    <!-- generator=\"duxcms/2.1\" -->\r\n
                    <!-- sitemap-generator-url=\"http://www.arnebrachhold.de\" sitemap-generator-version=\"3.2.8\" -->\r\n
                    <urlset xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\" xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n";
        $sitemap .= "<url>\r\n"."<loc>".$config['site_url']."</loc>\r\n"."<priority>1</priority>\r\n<lastmod>".date('Y-m-d H:i:s')."</lastmod>\r\n<changefreq>daily</changefreq>\r\n</url>\r\n";
            foreach($urls as $k=>$v){
                $time = empty($v['time'])?date('Y-m-d H:i:s'):date('Y-m-d H:i:s',$v['time']);
                $sitemap .= "<url>\r\n"."<loc>".$v['curl']."</loc>\r\n"."<priority>0.9</priority>\r\n<lastmod>".$time."</lastmod>\r\n<changefreq>weekly</changefreq>\r\n</url>\r\n";
                $data[]= array('app'=>$v['app'], 'title' => $v['title'], 'curl'=>$v['curl']);
            }
            $sitemap .= '</urlset>';
        $file = fopen($this->sitemap,"w");
        fwrite($file,$sitemap);
        fclose($file);
        $this->success($data);
        }
        $this->assign('text',$text);
        $this->adminDisplay();
    }
    /**
     * 多维数值转换成二维数组
     */
    public function array2single($array) {
        $arr2=array();
        foreach($array as $value){
         foreach($value as $v) {
            $arr2[]=$v;
            }
        }
      unset($arr3,$value,$v);
      return $arr2;
    }
    public function getPage($class_id,$info)
    {
        $i = $info['i'];
        $html = array();
        if ($info['app'] == 'page') {
            $html[$i]['app'] = '单页面';
            $html[$i]['title'] = $info['name'];
            $html[$i]['curl'] = $info['curl'];
            $html[$i]['time'] = $info['time'];
            return $html;
        }else{
            $html[$i]['app'] = '新闻列表';
            $html[$i]['title'] = $info['name'];
            $html[$i]['curl'] = $info['curl'];       
            $html[$i]['time'] = $info['time'];
            return $html;            
        }  
        
    }
}
