<?php

namespace app\home\controller;


/**
 *  开彩网功能性接口
 * User: Administrator
 * Date: 2018/4/3 0003
 * Time: 17:36
 */
class SystemController extends SystemLogicController
{
    /**
     * 轮播图地址接口
     */
    public function slideShow()
    {
        $res['code'] = 0;
        $res['data'] = [];
        $res['data'] = $this->getSlideShowData();//获取轮播图数据
        $this->resposeData($res) ;
    }


    /**
     *  提交用户反馈接口
     */
    public function feedBack()
    {
      $res = [];
      $res =  $this->feedBackLogic();
      $this->resposeData($res) ;
    }

    /**
     * 免责声明接口
     */
    public function liability()
    {
        $res= [];
        $res['code'] = 0;
        $res['url'] = 'http://www.900kcw.com/liability.html' ;
        $this->resposeData($res) ;
    }


    /**
     *  获取所有彩种
     */
    public function getLotteryList()
    {
        try {
            $res['code'] = 0 ;
            $res['data'][0] = $this->getHotList(); //热门彩
            $res['data'][1] = $this->getFrequencylist() ;//高频彩
            $res['data'][2] = $this->getAbroadList() ;//境外彩
            $res['data'][3] = $this->getOfficialList() ;//全国彩
            $res['msg']     = 'success' ;
        } catch (\Exception $e) {
          $res['code'] = 1 ;
          $res['data'] = [];
          $res['msg']  = 'error' ;
        }
        $this->resposeData($res) ;
    }

    /**
     * 获取新闻列表
     */
    public function newslist()
    {
        $res['code']  = 1  ; //0 为成功,其余都为失败状态
        $res['page']  = (isset($_REQUEST['page'])  && !empty($_REQUEST['page']))  ? $_REQUEST['page']  : 1 ; //当前第几页
        $res['limit'] = (isset($_REQUEST['limit']) && !empty($_REQUEST['limit'])) ? $_REQUEST['limit'] : 10 ; //每页多少条
        $res['totalPage'] = 1; //总页数
        $res['data']  = '' ; //数据
        $rss['msg']   = '' ; //提示信息

        try {
            $res['totalPage'] = target('Content')->countRecord($res['limit']) ;
            $res['data'] = $this->getNewsList($res['page'],$res['limit']) ;
            $res['msg']  = 'success' ;
            $res['code'] = 0 ;

        } catch (\Exception $e) {
            $res['msg'] = '网路延迟,请重试';
        }
        $this->resposeData($res) ;
    }

    /**
     * 获取新闻详情
     */
    public function newDetail()
    {
        $res['code']    = '' ;
        $res['content'] = '' ;
        $res['msg']     = '' ;
        try {
            $id             = (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) ? $_REQUEST['id'] : 0 ;//文章内容ID
            $res['content'] = $this->getNewContentById($id) ;
            $res['code']    = 0 ;
            $res['msg']     = 'success' ;
        } catch (\Exception $e){
            //错误处理
             $res['code'] = 1 ;
            if ( $e->getMessage() ==10001 ) {
                $res['msg'] = '文章ID不能为空' ;
            } elseif ($e->getMessage()==10002) {
                $res['msg'] = '抱歉,没有查询到对应的新闻资讯' ;
            } else {
                $res['msg'] = '网络延迟,请重试...' ;
            }
        }
        $this->resposeData($res) ;
    }

    /**
     *  获取客服联系方式
     */
    public  function contact()
    {
        $res['code'] = 1 ;
        $res['data'] = '' ;
        $res['msg']  = '';
        try  {
            $res['data'] = $this->getContact() ;//客服联系方式
            $res['code'] = 0 ;
            $res['msg'] ='success' ;
        } catch (\Exception $e) {
           $res['msg'] = $e->getMessage() ;
        }
        $this->resposeData($res) ;
    }


}