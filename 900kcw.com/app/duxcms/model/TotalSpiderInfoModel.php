<?php
namespace app\duxcms\model;
use app\base\model\BaseModel;
/**
 * 蜘蛛统计操作
 */
class TotalSpiderInfoModel extends BaseModel {
    /**
     * 获取列表
     * @return array 列表
     */
    public function loadList($where,$limit){
        return  $this->where($where)->limit($limit)->order('time desc')->select();
    }
    /**
     * 获取统计
     * @return int 数量
     */
    public function countList($where){
        return  $this->where($where)->count();
    }
    /**
     * 判断蜘蛛爬行
     */
    public function addData(){
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($agent, 'Googlebot') !== false){
            $boot = 'google';
        }
        if (strpos($agent, 'Baiduspider') !== false){
            $boot ='baidu';
        }
        if (strpos($agent, 'bingbot') !== false){
            $boot ='bing';
        }
        if (strpos($agent, 'Slurp') !== false){
            $boot ='yahoo';
        }
        if (strpos($agent, 'Sosospider') !== false){
            $boot ='soso';
        }
        if (strpos($agent, 'Sogou Web Sprider') !== false){
            $boot ='sogou';
        }
        if (strpos($agent, 'YodaoBot') !== false){
            $boot ='yodao';
        }
        if (strpos($agent, 'Yisouspider') !== false){
            $boot ='shenma';
        }
        if (strpos($agent, '360spider') !== false){
            $boot ='360';
        }
        if(empty($boot)){
            return ;
        }
        //当天时间
        $time = strtotime(date('Y-m-d H:i:s'));
        $data = array();
        $data['time'] = $time;
        $data['url'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $data['boot'] = $boot;
        $this->add($data);
    }
    /**
     * 生成蜘蛛访问报表
     * @param int $num 数量
     * @param int $type 类型
     * @return array 信息
     */
    public function getData( $boot = 'baidu', $date1, $date2){
        $date2 = strtotime('+1 day',strtotime($date2));
        $where = array();
        if ($boot == 'all') {
            $where[] = "time >= ".strtotime($date1)." AND time < ".$date2."";
        }else{
            $where[] = "time >= ".strtotime($date1)." AND time < ".$date2." AND boot='".$boot."'";
        }
        $pageList = $this->where($where)->order('time desc')->select();
        $list=array();
        if(!empty($pageList)){
            $i = 0;
            foreach ($pageList as $key=>$value) {
                $list[$key]=$value;
                $list[$key]['i'] = $i++;
            }
        }
        return $list;
    }
    /**
     * 获取百度收录条数
     * @param string $url site链接
     * @return array 信息
     */
    public function getBaidu($url){
         $site = config('site_url');
         if (preg_match('/(http:\/\/)|(https:\/\/)/i', $site)) {
            $site = preg_replace('/(http:\/\/)|(https:\/\/)/i', '', $site);
         }
         $url = $url.$site;
         $ch = curl_init();
         curl_setopt($ch,CURLOPT_URL,$url);
         curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
         curl_setopt($ch,CURLOPT_TIMEOUT,10);
         curl_setopt($ch,CURLOPT_HEADER,0);
         $output = curl_exec($ch);
         if($output === FALSE ){
         echo "CURL Error:".curl_error($ch);
         }
         curl_close($ch);
        preg_match("/(.*)约(\d)个(.*)/", $output, $all);
        $list = array('num' => $all[2],'url' => $url);
        return $list;
    }
}
