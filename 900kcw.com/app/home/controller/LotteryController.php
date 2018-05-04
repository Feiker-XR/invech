<?php
namespace app\home\controller;

/**
 *  开采网,开奖号码数据接口
 */
class LotteryController extends LotteryLogicController
{
    /**
     * 北京赛车pk10
     */
    public function pk10($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10001 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : ''  ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/pks/getLotteryPksInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/bjpk10' ;

            $prefix= 'pk10' ; //key前缀
            $key   = $prefix.'_lottery';
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatBjpk10($data) ;
                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
           return $this->responseData($data,$model); //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  900pk拾 -- 自营彩种
     */
    public function pk10_900($model='')
    {
        try{
            $mem          = $this->create_link() ;
            $new_request  = isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : 0 ; //当前开奖期号
            $game_id      = 164 ; //彩种ID
            $rows         = 5 ; //获取多少行数据
            $url          = 'https://990cp.com/eapi/game_number/'.$game_id.'/'.$rows ;
            $prefix       = 'pk10_900' ; //key前缀
            $key          = $prefix.'_lottery';
            $issue        =  60 * 5 ;
            $data         = $mem->get($key) ;
            $isNextLottery= $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery )
            {
                $data = $this->getSelfData($lottery_num,$url,self::GAMEID_PK10_900) ; //获取自营彩种开奖数据
                $data = $this->formatJbpk10($data) ; //填充900PK拾数据
                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     * 极速赛车
     */
    public function jssc($model='')
    {
        try{
            $mem          = $this->create_link() ;
            $new_request  = isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号

            $game_id      = 124 ; //彩种ID
            $rows         = 5 ; //获取多少行数据
            $url          = 'https://990cp.com/eapi/game_number/'.$game_id.'/'.$rows ;
            $prefix       = 'jssc' ; //key前缀
            $key          = $prefix.'_lottery';
            $issue        = 1  ;
            $data         = $mem->get($key) ;
            $isNextLottery= $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            $data = $this->getSelfData($lottery_num,$url,self::GAMEID_JSSC) ; //获取自营彩种开奖数据
            $data = $this->formatJssc($data) ; //填充极速赛车数据
            $mem->set($key,$data,0,$issue) ;
            //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
            $this->cleanCache($prefix) ;
            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
//            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery || $lottery_num)
//            {
//                $data = $this->getSelfData($lottery_num,$url,self::GAMEID_JSSC) ; //获取自营彩种开奖数据
//                $data = $this->formatJssc($data) ; //填充极速赛车数据
//                $mem->set($key,$data,0,$issue) ;
//                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
//                $this->cleanCache($prefix) ;
//            } else {
//                $this->formatTime($data) ;
//            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  重庆时时彩
     */
    public function cqssc($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10002 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : 0 ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/CQShiCai/getBaseCQShiCai.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/cqssc';

            $prefix= 'cqssc' ; //key前缀
            $key   = $prefix.'_lottery';
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url);
                $data = $this->formatCqssc($data) ;
                $mem->set($key,$data,0,$issue);
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix);
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  900时时彩
     */
    public function ssc_900($model='')
    {
        try{
            $mem          = $this->create_link() ;
            $new_request  = isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : 0 ; //当前开奖期号

            $game_id      = self::GAMEID_SSC_900 ; //彩种ID
            $rows         = 5 ; //获取多少行数据
            $url          = 'https://990cp.com/eapi/game_number/'.$game_id.'/'.$rows ;
            $prefix       = 'ssc900' ; //key前缀
            $key          = $prefix.'_lottery';
            $issue        = 60 * 5   ;

            $data         = $mem->get($key) ;
            $isNextLottery= $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery)
            {
                $data = $this->getSelfData($lottery_num,$url,self::GAMEID_SSC_900) ; //获取自营彩种开奖数据
                $data = $this->formatSsc900($data) ; //填充极速赛车数据
                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  极速时时彩
     */
    public function jsssc($model='')
    {
        try{
            $mem          = $this->create_link() ;
            $new_request  = isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : 0 ; //当前开奖期号

            $game_id      = self::GAMEID_SSC_JISU ; //彩种ID
            $rows         = 5 ; //获取多少行数据
            $url          = 'https://990cp.com/eapi/game_number/'.$game_id.'/'.$rows ;
            $prefix       = 'jsssc' ; //key前缀
            $key          = $prefix.'_lottery';
            $issue        = 1   ;

            $data         = $mem->get($key) ;
            $isNextLottery= $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            $data = $this->getSelfData($lottery_num,$url,self::GAMEID_SSC_JISU) ; //获取自营彩种开奖数据
            $data = $this->formatJsssc($data) ; //填充极速时时彩数据
            $mem->set($key,$data,0,$issue) ;
            //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
            $this->cleanCache($prefix) ;

            //暂时不使用缓存
            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
//            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
//            {
//                $data = $this->getSelfData($lottery_num,$url,self::GAMEID_SSC_JISU) ; //获取自营彩种开奖数据
//                $data = $this->formatJsssc($data) ; //填充极速时时彩数据
//                $mem->set($key,$data,0,$issue) ;
//                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
//                $this->cleanCache($prefix) ;
//            } else {
//                $this->formatTime($data) ;
//            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  天津时时彩
     */
    public function tjssc($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10003 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : 0 ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/CQShiCai/getBaseCQShiCai.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/tjssc'; //天津时时彩

            $prefix = 'tjssc' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatTjssc($data) ;
                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix);
            } else {
                return $this->responseData($data,$model); //返回数据; //返回数据
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     * 新疆时时彩
     */
    public function xjssc($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10004 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : 0 ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/CQShiCai/getBaseCQShiCai.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/xjssc ';

            $prefix = 'xjssc' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatXjssc($data) ;
                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  广东快乐十分
     */
    public function gdkl10f($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10005 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/klsf/getLotteryInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/gdklsf' ;

            $prefix = 'gdkl10f' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatGdkl10f($data) ; //格式化快乐十分数据(用于接自己接口时开启)
                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  广西快乐十分
     */
    public function gxkl10f($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10038 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/gxklsf/getLotteryInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/gxklsf';

            $prefix = 'gxkl10f' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 15 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatGxkl10f($data); //格式化数据
                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  十一运夺金
     */
    public function syydj($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10008 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/sd11x5' ;

            $prefix = 'syydj' ;
            $key   = $prefix.'_lottery' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url);
                $data = $this->formatSyydj($data);
                $mem->set($key,$data,0,$issue);
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  pc蛋蛋幸运28
     */
    public function pcddxy28($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['is sue'] : '' ;
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $url   = 'https://api.api68.com/LuckTwenty/getPcLucky28.do?issue='.$flag;

            $prefix = 'pcddxy28' ;
            $key   = $prefix.'_lottery' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery )
            {
                $data = $this->getThridData($lottery_num,$url);
                $mem->set($key,$data,0,$issue);
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  幸运农场
     */
    public function xync($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10009 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/klsf/getLotteryInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/cqklsf' ;

            $prefix = 'xync' ;
            $key   = $prefix.'_lottery' ;
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url);
                $data = $this->formatXync($data);
                $mem->set($key,$data,0,$issue);
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }

    /**
     *  广东11选5
     */
    public function gd11x5($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10006 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/gd11x5' ; //广东11选5

            $prefix = 'gd11x5' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatGd11x5($data);
                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *   上海11选5
     */
    public function sh11x5($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10018 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/sh11x5' ; //上海11选5

            $prefix = 'sh11x5' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatSh11x5($data);

                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *   安徽11选5
     */
    public function ah11x5($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10017 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/ah11x5' ; //安徽11选5

            $prefix = 'ah11x5' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatAh11x5($data);
                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *   江西11选5
     */
    public function jx11x5($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10015 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/ElevenFive/getElevenFiveInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/jx11x5' ;

            $prefix = 'jx11x5' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatJx11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }

    /**
     *   吉林11选5
     */
    public function jl11x5($model='')
    {
        try{
            $mem         = $this->create_link() ;
            $code        = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10023 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num  = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url         = 'https://k.leqq.cc/ElevenFive/getElevenFiveInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url         = 'http://data.8889s.com/index/apiplus/type/jl11x5' ;

            $prefix = 'jl11x5' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatJl11x5($data)   ;
                $mem->set($key,$data,0,$issue) ;
                $this->cleanCache($prefix) ;   //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *   广西11选5
     */
    public function gx11x5($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10022 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request = isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url         = 'https://k.leqq.cc/ElevenFive/getElevenFiveInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url         = 'http://data.8889s.com/index/apiplus/type/gx11x5' ;

            $prefix = 'gx11x5' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatGx11x5($data);
                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *   湖北11选5
     */
    public function hb11x5($model='')
    {
        try{
            $mem         = $this->create_link() ;
            $code        = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10020 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
//            $url         = 'https://k.leqq.cc/ElevenFive/getElevenFiveInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url         = 'http://data.8889s.com/index/apiplus/type/hub11x5' ;

            $prefix = 'hb11x5' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery  ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatHb11x5($data)  ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *   辽宁11选5
     */
    public function ln11x5($model='')
    {
        try{
            $mem         = $this->create_link() ;
            $code        = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10019 ;
            $flag        = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url         = 'https://k.leqq.cc/ElevenFive/getElevenFiveInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url         = 'http://data.8889s.com/index/apiplus/type/ln11x5' ;

            $prefix = 'ln11x5' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery  ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatLn11x5($data);
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *   江苏11选5
     */
    public function js11x5($model='')
    {
        try{
            $mem         = $this->create_link() ;
            $code        = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10016 ;
            $flag        = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url         = 'https://k.leqq.cc/ElevenFive/getElevenFiveInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url         = 'http://data.8889s.com/index/apiplus/type/js11x5' ;

            $prefix = 'js11x5' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery  ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatJs11x5($data);
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *   浙江11选5
     */
    public function zj11x5($model='')
    {
        try{
            $mem         = $this->create_link() ;
            $code        = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10025 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $url         = 'https://k.leqq.cc/ElevenFive/getElevenFiveInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url         = 'http://data.8889s.com/index/apiplus/type/zj11x5';

            $prefix = 'zj11x5' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery  ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatZj11x5($data) ;
                $mem->set($key,$data,0,$issue) ;
                //如果是请求新开奖数据,那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *   内蒙古11选5
     */
    public function nmg11x5($model='')
    {
        try{
            $mem         = $this->create_link() ;
            $code        = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10024 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url         = 'https://k.leqq.cc/ElevenFive/getElevenFiveInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url         = 'http://data.8889s.com/index/apiplus/type/nmg11x5' ;

            $prefix = 'nmg11x5' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num )
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatNmg11x5($data);
                $mem->set($key,$data,0,$issue) ;
                //那么清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *   天津快乐十分
     */
    public function tjkl10f($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10034 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url         = 'https://k.leqq.cc/klsf/getLotteryInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url         = 'http://data.8889s.com/index/apiplus/type/tjklsf' ;

            $prefix = 'tjkl0f' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num )
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatTjkl10f($data);
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  江苏快三
     */
    public function jsk3($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10007 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getBaseJSFastThree.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/jsk3' ;

            $prefix = 'jsk3' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num )
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatJsk3($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }

    /**
     *  吉林快3
     */
    public function jlk3($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10027 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getBaseJSFastThree.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/jlk3' ;

            $prefix = 'jlk3' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 9 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num )
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatJlk3($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  河北快3
     */
    public function hbk3($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10028 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getBaseJSFastThree.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/hebk3' ;

            $prefix = 'hbk3' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num )
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatHbk3($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }

    /**
     *  安徽快3
     */
    public function ahk3($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10030 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getBaseJSFastThree.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/ahk3' ;

            $prefix = 'ahk3' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num )
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatAhk3($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  内蒙古快3
     */
    public function nmgk3($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10029 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getBaseJSFastThree.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/nmgk3' ;

            $prefix = 'nmgk3' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num )
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatNmgk3($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }

    /**
     *  福建快3
     */
    public function fjk3($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10031 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getBaseJSFastThree.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/fjk3' ;

            $prefix = 'fjk3' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num )
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatFjk3($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  湖北快三
     */
    public function hubk3($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10032 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getBaseJSFastThree.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/hubk3' ;

            $prefix = 'hubk3' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num )
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatHubk3($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  北京快三
     */
    public function bjk3($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10033 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getBaseJSFastThree.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/bjk3' ;

            $prefix = 'bjk3' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num )
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatBjk3($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  广西快三
     */
    public function gxk3($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10026 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/lotteryJSFastThree/getBaseJSFastThree.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/gxk3' ;

            $prefix = 'gxk3' ;
            $key    = $prefix.'_lottery';
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num )
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatGxk3($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  北京快乐8
     */
    public function bjkl8($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10014 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/LuckTwenty/getBaseLuckTewnty.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/bjkl8' ;

            $prefix = 'bjkl8' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 10 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num )
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatBjkl8($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }

    /**
     *  澳洲幸运5
     */
    public function azxy5($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10010 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num   = !empty($_REQUEST['num']) ? $_REQUEST['num'] : '' ;
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $url   = 'https://api.api68.com/CQShiCai/getBaseCQShiCai.do?issue='.$flag.'&lotCode='.$code ;

            $prefix = 'azxy5' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 5 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery || $lottery_num)
            {
                $data = $this->getThridData($lottery_num,$url) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }

    /**
     *  澳洲幸运8
     */
    public function azxy8($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10011 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num   = !empty($_REQUEST['num']) ? $_REQUEST['num'] : '' ;
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $url   = 'https://api.api68.com/klsf/getLotteryInfo.do?issue='.$flag.'&lotCode='.$code ;

            $prefix = 'azxy8' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 5 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery || $lottery_num)
            {
                $data = $this->getThridData($lottery_num,$url) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  澳洲幸运10
     */
    public function azxy10($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10012 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num   = !empty($_REQUEST['num']) ? $_REQUEST['num'] : '' ;
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $url   = 'https://api.api68.com/pks/getLotteryPksInfo.do?issue='.$flag.'&lotCode='.$code ;

            $prefix = 'azxy10' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 5 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery || $lottery_num)
            {
                $data = $this->getThridData($lottery_num,$url) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  澳洲幸运20
     */
    public function azxy20($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10013 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num   = !empty($_REQUEST['num']) ? $_REQUEST['num'] : '' ;
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $url   = 'https://api.api68.com/LuckTwenty/getBaseLuckTewnty.do?issue='.$flag.'&lotCode='.$code ;

            $prefix = 'azxy20' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 5 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery || $lottery_num)
            {
                $data = $this->getThridData($lottery_num,$url) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  台湾宾果
     */
    public function twbg($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10047 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/LuckTwenty/getBaseLuckTewnty.php?issue='.$flag.'&lotCode='.$code ;
            $url = 'http://data.8889s.com/index/apiplus/type/twbingo' ;

            $prefix = 'twbg' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 5 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatTwbg($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据; //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  福彩双色球
     */
    public function fcssq($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10039 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//          $url   = 'https://k.leqq.cc/QuanGuoCai/getLotteryInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url  = 'http://data.8889s.com/index/apiplus/type/ssq' ;

            $prefix = 'fcssq' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 69 * 23 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatFcssq($data);
                $mem->set($key,$data,0,$issue) ;

                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return  $this->responseData($data,$model); //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  超级大乐透
     */
    public function cjdlt($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10040 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/QuanGuoCai/getLotteryInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/dlt' ;

            $prefix = 'ccdlt' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 60 * 23 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery || $lottery_num ) {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatCjdlt($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  福彩3D
     */
    public function fc3d($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10041 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/QuanGuoCai/getLotteryInfo1.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/fc3d' ;

            $prefix = 'fc3d' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 60 * 23 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery || $lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatFc3d($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  福彩七乐彩
     */
    public function fc7lc($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10042 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/QuanGuoCai/getLotteryInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/qlc' ;

            $prefix = 'fc7lc' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 60 * 23 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery || $lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatFc7lc($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  体彩排列3
     */
    public function tcpl3($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10043 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
//            $url   = 'https://k.leqq.cc/QuanGuoCai/getLotteryInfo1.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/pl3' ;

            $prefix = 'tcpl3' ;
            $key    = $prefix.'_lottery' ;
            $issue  =60 * 60 * 23 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data =$this->formatTcpl3($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  体彩排列5
     */
    public function tcpl5($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10044 ;
            $flag  = !empty($_REQUEST['issue']) ? $_REQUEST['issue'] : '' ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/QuanGuoCai/getLotteryInfo.php?issue='.$flag.'&lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/pl5' ;

            $prefix = 'tcpl5' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 60 * 23 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatTcpl5($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


    /**
     *  体彩七星彩
     */
    public function tcqxc($model='')
    {
        try{
            $mem   = $this->create_link() ;
            $code  = !empty($_REQUEST['code']) ? $_REQUEST['code'] : 10045 ;
            $lottery_num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '' ; //当前开奖期号
            $new_request =  isset($_REQUEST['lottery']) ? 1 : 0 ; //是否需要立即新请求数据
//            $url   = 'https://k.leqq.cc/QuanGuoCai/getLotteryInfo.php?lotCode='.$code ;
            $url   = 'http://data.8889s.com/index/apiplus/type/qxc' ;

            $prefix = 'tcqxc' ;
            $key    = $prefix.'_lottery' ;
            $issue  = 60 * 60 * 23 ;
            $data   = $mem->get($key) ;
            $isNextLottery = $this->isNewLottery($data) ; //判断是否到了下一期的开奖时间

            //通过数据,时间,参数判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data) || $new_request || $isNextLottery ||$lottery_num)
            {
                $data = $this->getPlatformData($lottery_num,$url) ;
                $data = $this->formatTcqxc($data) ;
                $mem->set($key,$data,0,$issue) ;
                //清除对应的缓存数据,保证数据的时效
                $this->cleanCache($prefix) ;
            } else {
                $this->formatTime($data) ;
            }
            return $this->responseData($data,$model); //返回数据

        } catch (\Exception $e) {
            echo '网络延迟' ; die;
        }
    }


/********************************  统计接口  ******************************************/

    /**
     * pk10---今日双面,号码统计
     *  包含澳洲幸运10
     */
    public function pk10_double_count()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;
//            $url = 'https://k.leqq.cc/pks/getPksDoubleCount.php?date=&lotCode='.$code ; //原请求地址
            $url   = 'https://api.api68.com/pks/getPksDoubleCount.do?date=&lotCode='.$code ;

            $prefix= 'pk10_double_count_'.$code ; //key前缀
            $key   = $prefix.'_lottery';
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;

            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_COUNT_CACHE || empty($data)){
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     * pk10---长龙提醒
     */
    public function pk10_long_dragon()
    {
        try{
            $mem   = $this->create_link() ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;
//          $url  = 'https://k.leqq.cc/pks/getPksLongDragonCount.php?date=&lotCode='.$code ; //原请求地址
            $url  = 'https://api.api68.com/pks/getPksLongDragonCount.do?date=&lotCode='.$code ;

            $key   = 'pk10_long_dragon_'.$code ; //key前缀
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;

            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_COUNT_CACHE || empty($data)){
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


  /**
   *  时时彩--今日双面号码统计
   * 包含澳洲幸运5
   */
    public function ssc_double_count()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10002 ;
//          $url   = 'https://k.leqq.cc/CQShiCai/queryDoubleNumber.php?lotCode='.$code ; //原请求地址
            $url   = 'https://api.api68.com/CQShiCai/queryDoubleNumber.do?lotCode='.$code ;

            $key   = 'ssc_double_count_'.$code ; //key前缀
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;

            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_COUNT_CACHE || empty($data)){
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  时时彩--长龙提醒
     */
    public function ssc_long_dragon()
    {
        try{
            $mem   = $this->create_link() ;
            $code  = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10002 ;
//          $url   = 'https://k.leqq.cc/CQShiCai/getShiCaiDailyDragonCount.php?lotCode='.$code ; //原请求地址
            $url   = 'https://api.api68.com/CQShiCai/getShiCaiDailyDragonCount.do?lotCode='.$code ;

            $key   = 'ssc_long_dragon_'.$code ; //key前缀
            $issue = 60 * 5 ;
            $data  = $mem->get($key) ;

            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_COUNT_CACHE || empty($data)){
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  11选5--今日双面号码统计
     *   包含11运夺金
     */
    public function syx5_double_count()
    {
        try{
            $mem   = $this->create_link() ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10008 ;
//          $url  = 'https://k.leqq.cc/ElevenFive/queryDoubleNumber.php?lotCode='.$code ; //原请求地址
            $url  = 'https://api.api68.com/ElevenFive/queryDoubleNumber.do?lotCode='.$code ;

            $key   = 'syx5_double_count_'.$code ; //key前缀
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;

            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_COUNT_CACHE || empty($data)){
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  11选5--长龙提醒
     *   包含11运夺金
     */
    public function syx5_long_dragon()
    {
        try{
            $mem   = $this->create_link() ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10008 ;
//          $url  = 'https://k.leqq.cc/ElevenFive/getElevenFiveDailyDragon.php?lotCode='.$code ; //原请求地址
            $url  = 'https://api.api68.com/ElevenFive/getElevenFiveDailyDragon.do?lotCode='.$code ;

            $key   = 'syx5_long_dragon_'.$code ; //key前缀
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;
            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_COUNT_CACHE || empty($data)){
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }



    /**
     *  快乐十分--今日双面号码统计
     *  包含幸运农场,澳洲幸运8
     */
    public function klsf_double_count()
    {
        try{
            $mem   = $this->create_link() ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10005 ;
//          $url  = 'https://k.leqq.cc/klsf/getKlsfDoubleCount.php?lotCode='.$code ; //原请求地址
            $url  = 'https://api.api68.com/klsf/getKlsfDoubleCount.do?lotCode='.$code ;

            $key   = 'klsf_double_count_'.$code ; //key前缀
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;
            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_COUNT_CACHE || empty($data)){
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  快乐十分--长龙提醒
     *  包含幸运农场
     */
    public function klsf_long_dragon()
    {
        try{
            $mem   = $this->create_link() ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10005 ;
//          $url  = 'https://k.leqq.cc/klsf/getKlsfLongDragonCount.php?lotCode='.$code ; //原请求地址
            $url  = 'https://api.api68.com/klsf/getKlsfLongDragonCount.do?lotCode='.$code ;

            $key   = 'klsf_long_dragon_'.$code ; //key前缀
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;
            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_COUNT_CACHE || empty($data)){
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  快乐十分--今日双面号码统计
     *  广西,天津
     */
    public function gxklsf_double_count()
    {
        try{
            $mem   = $this->create_link() ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10038 ;
//          $url  = 'https://k.leqq.cc/gxklsf/getKlsfDoubleCount.php?lotCode='.$code ; //原请求地址
            $url  = 'https://api.api68.com/gxklsf/getKlsfDoubleCount.do?lotCode='.$code ;

            $key   = 'gxklsf_double_count_'.$code ; //key前缀
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;
            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_COUNT_CACHE || empty($data)){
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  广西快乐十分--长龙提醒
     */
    public function gxklsf_long_dragon()
    {
        try{
            $mem   = $this->create_link() ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10038 ;
//          $url  = 'https://k.leqq.cc/gxklsf/getKlsfLongDragonCount.php?lotCode='.$code ; //原请求地址
            $url  = 'https://api.api68.com/gxklsf/getKlsfLongDragonCount.do?lotCode='.$code ;

            $key   = 'gxklsf_long_dragon_'.$code ; //key前缀
            $issue = 60 * 10 ;
            $data  = $mem->get($key) ;
            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_COUNT_CACHE || empty($data)){
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }
            $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }

    /**
     *  彩票数据列表 (热门彩)
     */
    public function get_lottery_list($model='')
    {
        try{
//            $mem   = $this->create_link() ;
//            $url  = 'http://api.api68.com/lottery/getLotteryListByHot.do' ;
//            $key   = 'get_lottery_list' ; //key前缀
//            $issue = 1 ;
//            $data  = $this->getData($url) ;
//            $data  = $this->formatLottery_list($data) ;
            $res['errorCode'] = 0 ;
            $res['message']   = '操作成功' ;
            $res['result']['businessCode'] = 0 ;
            $res['result']['message'] = '操作成功' ;
            $res['result']['data']    = $this->getHotData();

            $res = json_encode($res) ;
            return $this->responseData($res,$model) ; //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  彩票数据列表种类 (移动端和PC简约版使用)

     */
    public function get_lottery_list_category()
    {
        try{
            $category      = isset($_REQUEST['category'])      ? $_REQUEST['category']      : 1 ;
            $isContainsHot = isset($_REQUEST['isContainsHot']) ? $_REQUEST['isContainsHot'] : 0 ;
            $codes         = ( isset($_REQUEST['codes']) && !empty($_REQUEST['codes'])) ? $_REQUEST['codes']    :  '' ; // 需要返回彩种数组的code

            if (!empty($codes)) {
                //自定义返回数据
                $data = $this->disposeCustomData($codes);//处理自定义数据
            } else {
                //获取指定种类的数据
//                $url  = 'https://api.api68.com/lottery/getLotteryListByCategory.do?category='.$category.'&isContainsHot='.$isContainsHot;
//                $data = $this->getData($url) ;
                $data = $this->getCategoryData();
            }

        } catch (\Exception $e){
            $data['errorCode'] = 1 ;
            $data['message'] = '网络延迟,请重试...' ;
        }
        return $this->responseData($data)   ; //返回数据
    }


    /**
     * pk10接口
     */
    public function lottery_pk10()
    {
        try{
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] : 10001 ;
            $flag = (isset($_REQUEST['issue']) && !empty($_REQUEST['issue'])) ? $_REQUEST['issue'] : '' ;
            $_REQUEST['num'] = ( isset($_REQUEST['num']) && !empty($_REQUEST['num']) ) ? bcsub($_REQUEST['num'] ,1,0) : '' ; //期号修改
//            $url  = 'https://api.api68.com/pks/getLotteryPksInfo.do?issue='.$flag.'&lotCode='.$code ;

            if ($code == 10037) {
                //极速赛车
                $data = $this->jssc(self::RESPONSE_MODEL_RETURN) ;
            } else {
                $data = $this->getLotteryDataByCode($code) ;
            }

           $this->responseData($data); //返回数据

        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  时时彩接口
     */
    public function lottery_ssc()
    {
        try{
            $mem  = $this->create_link() ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] :  10002 ;
            $flag = (isset($_REQUEST['issue']) && !empty($_REQUEST['issue'])) ? $_REQUEST['issue'] : '' ;
            $_REQUEST['num'] = ( isset($_REQUEST['num']) && !empty($_REQUEST['num']) ) ? bcsub($_REQUEST['num'] ,1,0) : '' ; //期号修改
//            $url  = 'https://api.api68.com/CQShiCai/getBaseCQShiCai.do?issue='.$flag.'&lotCode='.$code ;

            if ($code == 10036) {
                //极速时时彩
                $data = $this->jsssc(self::RESPONSE_MODEL_RETURN);
            } else {
                $data = $this->getLotteryDataByCode($code) ;
            }

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }

    /**
     *  时时彩列表接口
     */
    public function lottery_list_ssc()
    {
        try{
            $mem   = $this->create_link() ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] :  10002 ;

            $url  = 'https://api.api68.com/CQShiCai/getBaseCQShiCaiList.do?lotCode='.$code ;
            $key   = 'lottery_list_ssc_'.$code ; //key前缀
            $issue = 60 * 10;
            $data  = $mem->get($key) ;

            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_COUNT_CACHE || empty($data)) {
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  --快乐十分接口
     */
    public function lottery_klsf()
    {
        try{
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] :  10005 ;
            $flag = (isset($_REQUEST['issue']) && !empty($_REQUEST['issue'])) ? $_REQUEST['issue'] : '' ;
            $_REQUEST['num'] = ( isset($_REQUEST['num']) && !empty($_REQUEST['num']) ) ? bcsub($_REQUEST['num'] ,1,0) : '' ; //期号修改
//            $url  = 'https://api.api68.com/klsf/getLotteryInfo.do?issue='.$flag.'&lotCode='.$code ;
            $data  =  $this->getLotteryDataByCode($code) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  --快三接口
     */
    public function lottery_jsk3()
    {
        try{

            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] :  10007 ;
            $flag = (isset($_REQUEST['issue']) && !empty($_REQUEST['issue'])) ? $_REQUEST['issue'] : '' ;
            $_REQUEST['num'] = ( isset($_REQUEST['num']) && !empty($_REQUEST['num']) ) ? bcsub($_REQUEST['num'] ,1,0) : '' ; //期号修改
//            $url  = 'https://api.api68.com/lotteryJSFastThree/getBaseJSFastThree.do?issue='.$flag.'&lotCode='.$code ;
            $data   = $this->getLotteryDataByCode($code) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     *  11选5
     */
    public function lottery_11x5()
    {
        try{
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] :  10008 ;
            $flag = (isset($_REQUEST['issue']) && !empty($_REQUEST['issue'])) ? $_REQUEST['issue'] : '' ;
            $_REQUEST['num'] = ( isset($_REQUEST['num']) && !empty($_REQUEST['num']) ) ? bcsub($_REQUEST['num'] ,1,0) : '' ; //期号修改
            $url  = 'https://api.api68.com/ElevenFive/getElevenFiveInfo.do?issue='.$flag.'&lotCode='.$code ;

            $data = $this->getLotteryDataByCode($code) ;

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }
    /**
     *  11选5列表接口
     */
    public function lottery_list_11x5()
    {
        try{
            $mem   = $this->create_link() ;
            $code = (isset($_REQUEST['lotCode']) && !empty($_REQUEST['lotCode'])) ? $_REQUEST['lotCode'] :  10006 ;

            $url  = 'https://api.api68.com/ElevenFive/getElevenFiveList.do?lotCode='.$code ;
            $key   = 'lottery_list_11x5_'.$code ; //key前缀
            $issue = 60 * 10;
            $data  = $mem->get($key) ;

            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_COUNT_CACHE || empty($data)){
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
        }
    }


    /**
     * 移动端首页,加载图片接口
     */
    public function find_picture()
    {
        try{
            $mem      = $this->create_link() ;
            $sourceUrl= (isset($_REQUEST['sourceUrl']) && !empty($_REQUEST['sourceUrl'])) ? $_REQUEST['sourceUrl'] :  '900kcw' ;
            $type     = (isset($_REQUEST['type']) && !empty($_REQUEST['type'])) ? $_REQUEST['type'] : 1 ;
            $position = (isset($_REQUEST['position']) && !empty($_REQUEST['position'])) ? $_REQUEST['position'] :  0 ;
            $url      = 'https://api.api68.com/focusPicture/findPicture.do?type='.$type.'&position='.$position.'&sourceUrl='.$sourceUrl ;

            $key   = 'find_picture_'.$sourceUrl.$type.$position ; //key前缀
            $issue = 60 * 60 * 24;
            $data  = $mem->get($key) ;

            //判断直接取缓存数据还是重新请求数据
            if ( self::IS_CLOSE_CACHE || empty($data)) {
                $data = $this->getData($url) ;
                $mem->set($key,$data,0,$issue) ;
            }

           $this->responseData($data); //返回数据
        } catch (\Exception $e){
            echo '网络延迟' ; die;
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