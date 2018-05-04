<?php
namespace app\common\model;
use think\Model;
class AdminRule extends Base{
    protected $table ='gygy_admin_rule';
    protected $pk = 'id';
    protected $field = ['id','name','pid','c','a'];
        //----------------后台------------------
    public static function getList(){
        $params = request()->param();
        $query  =   self::order('id');
        $data   =   $query->paginate(10);
        return $data;
    }

    public static function getTreeData($type='tree',$name='name',$child='id',$parent='pid'){
        // 判断是否需要排序
        $query = self::order('id');
        $data = $query->select();
        $data =  $data->toArray();
        // 获取树形或者结构数据
        if($type=='tree'){
            $data= self::tree($data,$name,$child,$parent);
       }else if($type="level"){
            $data= self::channelLevel($data,0,'&nbsp;',$child);
       }
        return $data;
    }

    /**
     * 获得树状数据
     * @param $data 数据
     * @param $title 字段名
     * @param string $fieldPri 主键id
     * @param string $fieldPid 父id
     * @return array
     */
    static public function tree($data, $title, $fieldPri = 'id', $fieldPid = 'pid'){
        if (!is_array($data) || empty($data))
            return array();
        $arr = self::channelList($data, 0, '', $fieldPri, $fieldPid);
        foreach ($arr as $k => $v) {
            $str = "";
            if($v['_level'] > 2) {
              for ($i = 1; $i < $v['_level'] - 1; $i++) {
                  $str .= "&emsp;│";
              }
            }
            if($v['_level'] != 1) {
              $t = $title ? $v[$title] : "";
              if (isset($arr[$k + 1]) && $arr[$k + 1]['_level'] >= $arr[$k]['_level']) {
                  $arr[$k]['_name'] = $str . "&emsp;├─ " . $v['_html'] . $t;
              } else {
                  $arr[$k]['_name'] = $str . "&emsp;└─ " . $v['_html'] . $t;
              }
            }else {
              $arr[$k]['_name'] = $v[$title];
            }
        }
        //设置主键为$fieldPri
        $data = array();
        foreach ($arr as $d) {
            $data[$d[$fieldPri]] = $d;
        }
        return $data;
    }

      /**
     * 返回多层栏目
     * @param $data 操作的数组
     * @param int $pid 一级PID的值
     * @param string $html 栏目名称前缀
     * @param string $fieldPri 唯一键名，如果是表则是表的主键
     * @param string $fieldPid 父ID键名
     * @param int $level 不需要传参数（执行时调用）
     * @return array
     */
    static public function channelLevel($data, $pid = 0, $html = "&nbsp;", $fieldPri = 'id', $fieldPid = 'pid', $level = 1){
        if (empty($data)) {
            return array();
        }
        $arr = array();
        foreach ($data as $v) {
            if ($v[$fieldPid] == $pid) {
                $arr[$v[$fieldPri]] = $v;
                $arr[$v[$fieldPri]]['_level'] = $level;
                $arr[$v[$fieldPri]]['_html'] = str_repeat($html, $level - 1);
                $arr[$v[$fieldPri]]["_data"] = self::channelLevel($data, $v[$fieldPri], $html, $fieldPri, $fieldPid, $level + 1);
            }
        }
        return $arr;
    }

      /**
     * 获得所有子栏目
     * @param $data 栏目数据
     * @param int $pid 操作的栏目
     * @param string $html 栏目名前字符
     * @param string $fieldPri 表主键
     * @param string $fieldPid 父id
     * @param int $level 等级
     * @return array
     */
    static public function channelList($data, $pid = 0, $html = "&nbsp;", $fieldPri = 'id', $fieldPid = 'pid', $level = 1){
        $data = self::_channelList($data, $pid, $html, $fieldPri, $fieldPid, $level);
        if (empty($data))
            return $data;
        foreach ($data as $n => $m) {
            if ($m['_level'] == 1)
                continue;
            $data[$n]['_first'] = false;
            $data[$n]['_end'] = false;
            if (!isset($data[$n - 1]) || $data[$n - 1]['_level'] != $m['_level']) {
                $data[$n]['_first'] = true;
            }
            if (isset($data[$n + 1]) && $data[$n]['_level'] > $data[$n + 1]['_level']) {
                $data[$n]['_end'] = true;
            }
        }
        //更新key为栏目主键
        $category=array();
        foreach($data as $d){
            $category[$d[$fieldPri]]=$d;
        }
        return $category;
    }


      //只供channelList方法使用
    static private function _channelList($data, $pid = 0, $html = "&nbsp;", $fieldPri = 'id', $fieldPid = 'pid', $level = 1){
        if (empty($data))
            return array();
        $arr = array();
        foreach ($data as $v) {
            $id = $v[$fieldPri];
            if ($v[$fieldPid] == $pid) {
                $v['_level'] = $level;
                $v['_html'] = str_repeat($html, $level - 1);
                array_push($arr, $v);
                $tmp = self::_channelList($data, $id, $html, $fieldPri, $fieldPid, $level + 1);
                $arr = array_merge($arr, $tmp);
            }
        }
        return $arr;
    }
}
