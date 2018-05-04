<?php
namespace app\home\controller;
use app\base\controller\BaseController;


/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/3 0003
 * Time: 18:17
 */
class SystemLogicController extends  BaseController
{

    /**
     *  组合轮播图数据
     * @return array
     */
    protected  function getSlideShowData()
    {
        $res = [] ;
        $res[0]['img'] = 'http://www.900kcw.com/upload/2018-03-20/6c3235d5fe4f6e913e095c823d47ab17.png' ;
//        $res[0]['url'] = 'https://itunes.apple.com/us/app/900w/id1362412301?l=zh&ls=1&mt=8' ;
        $res[0]['url'] = '' ;
        $res[1]['img'] = 'http://www.900kcw.com/upload/2018-03-24/479c9a741ab6d28e0e2fcfd7b8b9daa9.png' ;
//        $res[1]['url'] = 'http://m.api.dd788799.com' ;
        $res[1]['url'] = '' ;
        $res[2]['img'] = 'http://www.900kcw.com/upload/2018-03-24/479c9a741ab6d28e0e2fcfd7b8b9daa9.png' ;
//        $res[2]['url'] = 'http://m.api.dd788799.com' ;
        $res[2]['url'] = '' ;
        return $res ;
    }

    /**
     *  获取新闻列表
     */
    protected  function getNewsList($page=1,$limit=10)
    {
       try {
           $where['class_id'] = 528 ;
           $begin = ($page-1) * $limit ;
           $limitString = "{$begin},{$limit}" ;
           $data = target('Content')->loadList($where,$limitString) ;

           //格式化数据
           if (empty($data)) {
               throw new \Exception(10001) ;
           }
           foreach ($data as $key=>$val) {
               $data[$key]['time'] = date('Y-m-d H:i:s',$val['time'] ) ;
           }

            return $data ;
       } catch (\Exception $e) {
           throw new \Exception($e->getMessage()) ;
       }
    }

    /**
     *  根据ID获取新闻详情
     */
    protected  function getNewContentById($id=0)
    {
        try {
            $data = '' ;
            if (!$id) { throw new \Exception(10001) ; }
            $data = target('ContentArticle')->getContentById($id);
            if ( empty($data) ) {
                throw new \Exception(10002) ;
            }

            $data = ($data['content']) ;
            return  $data ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }


    /**
     *  用户反馈逻辑处理
     * @throws \Exception
     */
    protected  function  feedBackLogic()
    {
        $res['code'] = 0 ;
        $res['msg']  = '' ;
       try {
           if (!isset($_REQUEST['nickname']) || empty($_REQUEST['nickname'])) {
               throw new \Exception(10001) ;
           }
           if (!isset($_REQUEST['contact']) || empty($_REQUEST['contact'])) {
               throw new \Exception(10002) ;
           }
           if (!isset($_REQUEST['content']) || empty($_REQUEST['content'])) {
               throw new \Exception(10003) ;
           }
           $contact_type = isset( $_REQUEST['contact_type']) ?  $_REQUEST['contact_type'] : 1  ; //联系方式类型

           $data= [
               'nickname'     => $_REQUEST['nickname'],
               'contact_type' => $contact_type ,
               'contact'      => $_REQUEST['contact'],
               'content'      => $_REQUEST['content'],
               'type'         => 2, //1:PC端  2:移动端
           ];
           if (! target('Feedback')->addData($data)){
               throw new \Exception(10004) ;
           }
           $res['msg']  = 'success' ;

       } catch (\Exception $e){
            if ($e->getMessage() ==10001) {
                $res['code'] = 10001 ;
                $res['msg'] = '昵称不能为空...';
            } elseif($e->getMessage() ==10002){
                $res['code'] = 10002 ;
                $res['msg'] = '联系方式不能为空...';
            } elseif($e->getMessage() ==10003){
                $res['code'] = 10003 ;
                $res['msg'] = '内容不能为空...';
            } elseif($e->getMessage() ==10004){
                $res['code'] = 10004 ;
                $res['msg'] = '反馈提交失败,请重试...';
            } else{
                $res['code'] = 10005 ;
                $res['msg'] = '网络错误,请重试';
            }
       }
        return $res ;
    }

    /**
     *  返回客服联系方式
     * @return mixed
     */
    protected  function getContact()
    {
        $res[0] = '10086123' ; //QQ
        $res[1] = '10086123' ; //微信
        $res[2] = '10086123' ; //SKYPE
        $res[3] = '10086123' ; //邮箱
        return $res ;
    }

    //热门彩数组
    protected  function getHotList()
    {
        $res = [
            ['name'=>'北京赛车PK10','code'=>10001],
            ['name'=>'900PK10','code'=> 11001],
            ['name'=>'极速赛车','code'=>10037],
            ['name'=>'重庆时时彩','code'=> 10002],
            ['name'=>'900时时彩','code'=> 11002],
            ['name'=>'极速时时彩','code'=>10036],
            ['name'=>'天津时时彩','code'=> 10003],
            ['name'=>'新疆时时彩','code'=> 10004],
            ['name'=>'十一运夺金','code'=> 10008],
            ['name'=>'广东快乐十分','code'=> 10005],
            ['name'=>'幸运农场','code'=> 10009],
            ['name'=>'广西快乐十分','code'=> 10038],
            ['name'=>'PC蛋蛋幸运28','code'=> 10046],
        ] ;
        return $res ;
    }

    //高频彩种数组
    protected  function getFrequencylist()
    {
        $res = [
            ['name'=>'广东11选5','code'=>  10006],
            ['name'=>'上海11选5','code'=>  10018],
            ['name'=>'安徽11选5','code'=>  10017],
            ['name'=>'江西11选5','code'=>  10015],
            ['name'=>'吉林11选5','code'=>  10023],
            ['name'=>'广西11选5','code'=>  10022],
            ['name'=>'湖北11选5','code'=>  10020],
            ['name'=>'辽宁11选5','code'=>  10019],
            ['name'=>'江苏11选5','code'=>  10016],
            ['name'=>'浙江11选5','code'=>  10025],
            ['name'=>'内蒙古11选5','code'=> 10024],
            ['name'=>'天津快乐十分','code'=> 10034],
            ['name'=>'江苏快3','code'=>  10007],
            ['name'=>'吉林快3','code'=>  10027],
            ['name'=>'河北快3','code'=>  10028],
            ['name'=>'安徽快3','code'=>  10030],
            ['name'=>'内蒙古快3','code'=>  10029],
            ['name'=>'福建快3','code'=>  10031],
            ['name'=>'湖北快3','code'=>  10032],
            ['name'=>'北京快3','code'=>  10033],
            ['name'=>'广西快3','code'=>   10026],
            ['name'=>'北京快8','code'=>  10014],
        ] ;
        return $res ;
    }

    //境外彩数组
    protected  function getAbroadList()
    {
        $res = [
            ['name'=>'澳洲幸运5','code'=> 10010],
            ['name'=>'澳洲幸运8','code'=>  10011],
            ['name'=>'澳洲幸运10','code'=> 10012],
            ['name'=>'澳洲幸运20','code'=>  10013],
            ['name'=>'台湾宾果','code'=>  10047],
        ] ;
        return $res ;
    }

    //全国彩数组
    protected  function getOfficialList()
    {
        $res = [
            ['name'=>'福彩双色球','code'=> 10039],
            ['name'=>'福彩3D',    'code'=> 10041],
            ['name'=>'福彩七乐彩','code'=> 10042],
            ['name'=>'超级大乐透','code'=> 10040],
            ['name'=>'体彩排列3', 'code'=> 10043],
            ['name'=>'体彩排列5', 'code'=> 10044],
            ['name'=>'体彩七星彩','code'=> 10045],
        ] ;
        return $res ;
    }


    /**
     * 返回数据
     * @param $res
     */
    protected  function resposeData($res)
    {
        $res = json_encode($res) ;
        echo $res ;die;
    }

}