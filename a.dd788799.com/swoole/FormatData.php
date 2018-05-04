<?php
// +----------------------------------------------------------------------
// | describe=>  开奖数据处理类
// +----------------------------------------------------------------------
// | CreateDate=> 2017年12月7日
// +----------------------------------------------------------------------
// | Author=>
// +----------------------------------------------------------------------


class FormatData
{

    /*
     * 数据普通处理
     */
    public function normally($data)
    {
        try {
            $data = json_decode($data,true) ; //普通处理
            return $data ;
        } catch (\Exception $e) {
            throw new  \Exception($e->getMessage()) ;
        }
    }

    /**
     *  格式化北京快乐8开奖数据
     *  源格式为 1,2,3,4,5+10  格式化后格式 1,2,3,4,5|10
     *  @param $data
     */
    public  function formatBjkl8($data)
    {
        try {
            $result = [] ;
            if ( !empty($data) ) {
                $data = json_decode($data,true) ;
                /*
                $result = isset($data['data']) ? $data['data'] : [] ;
                if ( !empty($result) ) {
                    foreach ( $result as $key=>$val ) {
                        $result[$key]['opencode'] = str_replace('+','|',$val['opencode']) ;
                    }
                }
                */
                $result = $data;
                foreach ( $result as $key=>$val ) {
                    $result[$key]['number'] = str_replace('+','|',$val['number']) ;
                }                
            }
            return $result ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

    /**
     * 开彩网 数据格式化
     * @param $data
     * @return array
     * @throws Exception
     */
    public  function formatOpencai($data)
    {
        try{
            $result = [] ;
            if (!empty($data)) {
                $data = json_decode($data,true) ;
                //$result = isset($data['data']) ? $data['data'] : [] ;
                $result = $data;
            }
            return $result ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

//广东11选  52018050279  2018-5-02 22:10:00
//广东江西11选5,都是低于100期,不需要补零
    /**
     * 广东11选5 数据格式化 对期号进行补零
     * @param $data
     * @return array
     * @throws Exception
     */
    public  function  gd11x5($data)
    {
        try{
            $result = [] ;
            if ( !empty($data) ) {
                $data   = json_decode($data,true) ;
                /*
                $result = isset($data['data']) ? $data['data'] : [] ;
                //期号补零 与数据库中的存储格式保持一致
                if ( !empty($result) ) {
                    foreach ($result as $key=>$val) {
                        $expect = substr($val['expect'],8,3);
                        $expect = ($expect<100) ? '0'.$expect : $expect ;
                        $result[$key]['expect'] = date('Ymd').$expect  ;
                    }
                }
                */
                $result = $data;
                foreach ($result as $key=>$val) {
                    $period = substr($val['period'],8,3);
                    $period = ($period<100) ? '0'.$period : $period ;
                    $result[$key]['period'] = date('Ymd').$period  ;
                }                
            }
            return $result ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

    /**
     *
     * 江西11选5 数据格式化 对期号进行补零
     * @param $data
     * @return array
     * @throws Exception
     */
    public  function  jx11x5($data)
    {
        try {
            $result = [] ;
            if ( !empty($data) ) {
                $data   = json_decode($data,true) ;
                /*
                $result = isset($data['data']) ? $data['data'] : [] ;
                //期号补零 与数据库中的存储格式保持一致
                if ( !empty($result) ) {
                    foreach ($result as $key=>$val) {
                        $expect = substr($val['expect'],8,3);
                        $expect = ($expect<100) ? '0'.$expect : $expect ;
                        $result[$key]['expect'] = date('Ymd').$expect  ;
                    }
                }
                */
                $result = $data;
                foreach ($result as $key=>$val) {
                    $period = substr($val['period'],8,3);
                    $period = ($period<100) ? '0'.$period : $period ;
                    $result[$key]['period'] = date('Ymd').$period  ;
                }            
            }
            return $result ;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage()) ;
        }
    }

}