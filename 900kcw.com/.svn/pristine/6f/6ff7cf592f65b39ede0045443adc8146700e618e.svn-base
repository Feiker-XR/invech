<?php
namespace app\home\controller;

/**
 *  开采网,历史记录数据接口
 */
class HistoryController extends HistoryLogicController
{
    /**
     * 北京赛车pk10
     */
    public function pk10()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10001 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/pks/getPksHistoryList.php?lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/bjpk10?count='.self::HISTORY_RECORD_NUM ;

            $key   = 'pk10_history' ;
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data) ) {
                $data = $this->getData($url);
                $data = $this->formatPk10($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }


    /**
     *  900PK拾
     */
    public function pk10_900()
    {
        try{
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $mem     = $this->create_link() ;
            $game_id = 164 ; //彩种ID
            $rows    = 100 ; //获取多少行数据
            $url     = 'https://990cp.com/eapi/game_number/'.$game_id.'/'.$rows ;

            $prefix = 'pk10_900' ; //key前缀
            $key    = $prefix.'_history';
            $issue  = 60 * 5 ;
            $data   = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data) ) {
                $data = $this->getData($url) ;
                $data = $this->formatPk10_900($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     *  极速赛车
     */
    public function jssc()
    {
        try{
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $mem     = $this->create_link() ;
            $game_id = 124 ; //彩种ID
            $rows    = 100 ; //获取多少行数据
            $url     = 'https://990cp.com/eapi/game_number/'.$game_id.'/'.$rows ;

            $prefix = 'jssc' ; //key前缀
            $key    = $prefix.'_history';
            $issue  = 75 ;
            $data   = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data) ) {
                $data = $this->getData($url) ;
                $data = $this->formatJssc($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     *  重庆时时彩
     */
    public function cqssc()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10002 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//          $url   = 'https://k.leqq.cc/CQShiCai/getBaseCQShiCaiList.php?lotCode='.$code ; //第三方接口
            $url   = 'http://data.8889s.com/index/apiplus/type/cqssc?count='.self::HISTORY_RECORD_NUM; //自己平台接口
            $key   = 'cqssc_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatSsc($data) ; //格式化时时彩数据
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }


    /**
     *  900时时彩
     */
    public function ssc_900()
    {
        try{
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $mem     = $this->create_link() ;
            $game_id = self::GAMEID_SSC_900 ; //彩种ID
            $rows    = 100 ; //获取多少行数据
            $url     = 'https://990cp.com/eapi/game_number/'.$game_id.'/'.$rows ;

            $prefix = 'ssc900' ; //key前缀
            $key    = $prefix.'_history';
            $issue  = 60 * 5 ;
            $data   = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data) ) {
                $data = $this->getData($url) ;
                $data = $this->formatSsc900($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     *  极速时时彩
     */
    public function jsssc()
    {
        try{
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $mem     = $this->create_link() ;
            $game_id = self::GAMEID_SSC_JISU ; //彩种ID
            $rows    = 100 ; //获取多少行数据
            $url     = 'https://990cp.com/eapi/game_number/'.$game_id.'/'.$rows ;

            $prefix = 'jsssc' ; //key前缀
            $key    = $prefix.'_history';
            $issue  = 75 ;
            $data   = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data) ) {
                $data = $this->getData($url) ;
                $data = $this->formatJsssc($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }


    /**
     *  天津时时彩
     */
    public function tjssc()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10003 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/CQShiCai/getBaseCQShiCaiList.php?lotCode='.$code ;
            $url   =  'http://data.8889s.com/index/apiplus/type/tjssc?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'tjssc_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatSsc($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }


    /**
     *  新疆时时彩
     */
    public function xjssc()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10004 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/CQShiCai/getBaseCQShiCaiList.php?lotCode='.$code ;
            $url   =  'http://data.8889s.com/index/apiplus/type/xjssc?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'tjssc_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatSsc($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }


    /**
     *  广东快乐十分
     */
    public function gdkl10f()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10005 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/klsf/getHistoryLotteryInfo.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/gdklsf?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'gdkl10f_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatGdkl10f($data) ; //格式化数据
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }


    /**
     *  广西快乐十分
     */
    public function gxkl10f()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10038 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/gxklsf/getHistoryLotteryInfo.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/gxklsf?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'gxkl10f_history' ;
            $issue = 60 * 15 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatGxkl10f($data);
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  天津快乐十分
     */
    public function tjkl10f()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10034 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $url   = 'https://k.leqq.cc/klsf/getHistoryLotteryInfo.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/tjklsf?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'tjkl10f_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatGdkl10f($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }


    /**
     *  幸运农场
     */
    public function xync()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10009 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/klsf/getHistoryLotteryInfo.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/cqklsf?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'xync_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;
            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatGdkl10f($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     * 11运夺金
     */
    public function syydj()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10008 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/sd11x5?count='.self::HISTORY_RECORD_NUM; //自己平台接口 ;
            $key   = 'syydj_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->format11x5($data);
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  PC蛋蛋幸运28
     */
    public function pcddxy28()
    {
        try{
            $date = (isset($_REQUEST['date']) && !empty($_REQUEST['date'])) ? $_REQUEST['date'] : '' ; //日期
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $mem   = $this->create_link() ;
            $url   = 'https://api.api68.com/LuckTwenty/getPcLucky28List.do?date='.$date  ;

            $key   = 'pcddxy28_history' ;
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }


    /**
     *  广东11选5
     */
    public function gd11x5()
    {
        try{
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10006 ;
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/gd11x5?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'gd11x5_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->format11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  上海11选5
     */
    public function sh11x5()
    {
        try{
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10018 ;
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/sh11x5?count='.self::HISTORY_RECORD_NUM ;

            $key   = 'sh11x5_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->format11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  安徽11选5
     */
    public function ah11x5()
    {
        try{
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10017 ;
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/ah11x5?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'ah11x5_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->format11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  广西11选5
     */
    public function jx11x5()
    {
        try{
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10015 ;
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/jx11x5?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'jx11x5_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->format11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  吉林11选5
     */
    public function jl11x5()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10023 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/jl11x5?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'jl11x5_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->format11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  广西11选5
     */
    public function gx11x5()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10022 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/gx11x5?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'gx11x5_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->format11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  湖北11选5
     */
    public function hb11x5()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10020 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/hub11x5?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'hb11x5_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->format11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  辽宁11选5
     */
    public function ln11x5()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10019 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/ln11x5?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'ln11x5_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->format11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  江苏11选5
     */
    public function js11x5()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10016 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/js11x5?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'js11x5_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->format11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  浙江11选5
     */
    public function zj11x5()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10025 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/zj11x5?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'zj11x5_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->format11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  内蒙古11选5
     */
    public function nmg11x5()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10024 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/nmg11x5?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'nmg11x5_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->format11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }


    /**
     *  江苏快三
     */
    public function jsk3()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10007 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getJSFastThreeList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/jsk3?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'jsk3_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url)   ;
                $data  = $this->formatK3($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  吉林快三
     */
    public function jlk3()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10027 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getJSFastThreeList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/jlk3?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'jlk3_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->formatK3($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  河北快三
     */
    public function hbk3()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10028 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getJSFastThreeList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/hebk3?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'hbk3_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request|| empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->formatK3($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  安徽快三
     */
    public function ahk3()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10030 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getJSFastThreeList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/ahk3?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'ahk3_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->formatK3($data);
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  内蒙古快三
     */
    public function nmgk3()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10029 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getJSFastThreeList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/nmgk3?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'nmgk3_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->formatK3($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  福建快三
     */
    public function fjk3()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10031 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getJSFastThreeList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/fjk3?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'fjk3_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->formatK3($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  湖北快三
     */
    public function hubeik3()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10032 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getJSFastThreeList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/hubk3?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'hubeik3_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->formatK3($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  北京快三
     */
    public function bjk3()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10033 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getJSFastThreeList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/bjk3?count='.self::HISTORY_RECORD_NUM ;

            $key   = 'bjk3_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->formatK3($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  广西快三
     */
    public function gxk3()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10026 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getJSFastThreeList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/gxk3?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'gxk3_history' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->formatK3($data);
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  北京快乐8
     */
    public function bjkl8()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10014 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/LuckTwenty/getBaseLuckTwentyList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/bjkl8?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'bjkl8_history' ;
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->formatKl8($data) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  澳洲幸运5
     */
    public function azxy5()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10010 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $url   = 'https://api.api68.com/CQShiCai/getBaseCQShiCaiList.do?lotCode='.$code ;
            $key   = 'azxy5_history' ;
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     *  澳洲幸运8
     */
    public function azxy8()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10011 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $url   = 'https://api.api68.com/klsf/getHistoryLotteryInfo.do?date=&lotCode='.$code ;
            $key   = 'azxy8_history' ;
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e) {
            echo '网络错误' ;die;
        }
    }

    /**
     * 澳洲幸运10
     */
    public function azxy10()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10012 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $url   = 'https://api.api68.com/pks/getPksHistoryList.do?lotCode='.$code ;
            $key   = 'azxy10_history' ;
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     * 澳洲幸运20
     */
    public function azxy20()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10013 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
            $url   = 'https://api.api68.com/LuckTwenty/getBaseLuckTwentyList.do?date=&lotCode='.$code ;
            $key   = 'azxy20_history' ;
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     * 台湾宾果
     */
    public function twbg()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10047 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/LuckTwenty/getBaseLuckTwentyList.php?date=&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/twbingo?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'twbg_history' ;
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url) ;
                $data = $this->formatKl8($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     *  福彩双色球
     */
    public function fcssq()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10039 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//          $url   = 'https://k.leqq.cc/QuanGuoCai/getHistoryLotteryInfo.php?lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/ssq?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'fcssq_history' ;
            $issue = 60 * 60 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatFcssq($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     *  福彩3D
     */
    public function fc3d()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10041 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/QuanGuoCai/getLotteryInfoList.php?lotCode='.$code ;
//            $url   = 'http://data.8889s.com/index/apiplus/type/fc3d?count='.self::HISTORY_RECORD_NUM ;
            $url   = 'https://api.api68.com/QuanGuoCai/getLotteryInfoList.do?lotCode='.$code ;
            $key   = 'fc3d_history' ;
            $issue = 60 * 60 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE  || $new_request || empty($data)) {
                $data = $this->getData($url);
//                $data = $this->formatFc3d($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     *  福彩七乐彩
     */
    public function fc7lc()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10042 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/QuanGuoCai/getHistoryLotteryInfo.php?lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/qlc?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'fc7lc_history' ;
            $issue = 60 * 60 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE  || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatFcssq($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     *  超级大乐透
     */
    public function cjdlt()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10040 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/QuanGuoCai/getHistoryLotteryInfo.php?lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/dlt?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'ccdlt_history' ;
            $issue = 60 * 60  ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatCjdlt($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     *   体彩排列3
     */
    public function tcpl3()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10043 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/QuanGuoCai/getLotteryInfoList.php?lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/pl3?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'tcpl3_history' ;
            $issue = 60 * 60  ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE  || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatTcpl3($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     *  体彩排列5
     */
    public function tcpl5()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10044 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/QuanGuoCai/getHistoryLotteryInfo.php?lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/pl5?count='.self::HISTORY_RECORD_NUM ;

            $key   = 'tcpl5_history' ;
            $issue = 60 * 60  ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatTcpl5($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     *  体彩七星彩
     */
    public function tcqxc()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10045 ;
            $new_request = (isset($_REQUEST['lottery']) && !empty($_REQUEST['lottery'])) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/QuanGuoCai/getHistoryLotteryInfo.php?lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/qxc?count='.self::HISTORY_RECORD_NUM ;
            $key   = 'tcqxc_history' ;
            $issue = 60 * 60 ;
            $data  = $mem->get($key) ;

            if ( self::IS_CLOSE_CACHE || $new_request || empty($data)) {
                $data = $this->getData($url);
                $data = $this->formatTcpl5($data) ;
                $mem->set($key,$data,0,$issue);
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络错误' ;die;
        }
    }

    /**
     * 析构函数 关闭memcache链接
     */
    public  function __destruct()
    {
        memcache_close($this->link) ;
    }

}