<?php
namespace app\duxcms\controller;
use app\admin\controller\AdminController;
/**
 * 站点统计
 */

class AdminStatisticsController extends AdminController {
    /**
     * 当前模块参数
     */
    protected function _infoModule(){
        return array(
            'info'  => array(
                'name' => '站点统计',
                'description' => '网站综合统计信息',
                ),
            'menu' => array(
                    array(
                        'name' => '访问统计',
                        'url' => url('index'),
                        'icon' => 'list',
                    ),
                    array(
                        'name' => '蜘蛛统计',
                        'url' => url('spider'),
                        'icon' => 'list',
                    ),
                    array(
                        'name' => '蜘蛛详细数据',
                        'url' => url('SpiderInfo'),
                        'icon' => 'list',
                    ),
                ),
            );
    }
    /**
     * 访问统计
     */
    public function index(){
        $breadCrumb = array('访问统计'=>url());
        $this->assign('breadCrumb',$breadCrumb);
        $this->assign('jsonArray1',target('TotalVisitor')->getJson(7,'day','m-d'));
        $this->assign('jsonArray2',target('TotalVisitor')->getJson(30,'day','m-d'));
        $this->assign('jsonArray3',target('TotalVisitor')->getJson(12,'month','Y-m'));
        $this->adminDisplay();
    }
    /**
     * 蜘蛛统计
     */
    public function spider(){
        $breadCrumb = array('蜘蛛统计'=>url());
        $this->assign('breadCrumb',$breadCrumb);
        $this->assign('jsonArray1',target('TotalSpider')->getJson(7,'day','m-d'));
        $this->assign('jsonArray2',target('TotalSpider')->getJson(30,'day','m-d'));
        $this->assign('jsonArray3',target('TotalSpider')->getJson(12,'month','Y-m'));
        $this->adminDisplay();
    }

    /**
     * 蜘蛛详细数据
     */
    public function SpiderInfo(){
            $time1 = request('request.time1');
            $time2 = request('request.time2');
            $boot = request('request.boot');

            if (empty($time1)) $time1 = date('Y/m/d');
            if (empty($time2)) $time2 = date('Y/m/d');
            if (empty($boot)) $boot = 'all';
            if (is_numeric($time1)) $time1 = date('Y/m/d',$time1);
            if (is_numeric($time2)) $time2 = date('Y/m/d',$time2);

            $pageinfo = array();
            $pageinfo['time1'] = strtotime(date('Y/m/d',strtotime($time1)));
            $pageinfo['time2'] = strtotime(date('Y/m/d',strtotime($time2)));
            $pageinfo['boot'] = $boot;

            $info = array();
            $info['time1'] = $time1;
            $info['time2'] = $time2;
            $info['boot'] = $boot;

            $time2 = strtotime('+1 day',strtotime($time2));

            $where = array();
            if ($boot == 'all') {
                $where[] = "time >= ".$pageinfo['time1']." AND time < ".$time2."";
            }else{
                $where[] = "time >= ".$pageinfo['time1']." AND time < ".$time2." AND boot='".$boot."'";
            }
            //查询数据
            $list = target('duxcms/TotalSpiderInfo')->page(20)->loadList($where,$limit);
            $count = target('duxcms/TotalSpiderInfo')->countList($where,$limit);
            $baidu = target('duxcms/TotalSpiderInfo')->getBaidu('http://www.baidu.com/s?wd=site:');
            $this->pager = target('duxcms/TotalSpiderInfo')->pager;
            
            $breadCrumb = array('蜘蛛详细数据'=>url());
            $this->assign('breadCrumb',$breadCrumb);
            $this->assign('page',$this->getPageShow(array(),$pageinfo));
            $this->assign('info',$info);
            $this->assign('count',$count);
            $this->assign('baidu',$baidu);
            $this->assign('list',$list);
            $this->adminDisplay();
    }





}

