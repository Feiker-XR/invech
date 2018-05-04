<?php
// +----------------------------------------------------------------------
// | FileName: index.php
// +----------------------------------------------------------------------
// | CreateDate: 2017年11月6日
// +----------------------------------------------------------------------
// | Author: xiaoluo
// +----------------------------------------------------------------------

/**
 * 算法模型
 *　func(betData, kjData, betWeiShu)
 *
 * @params betData      投注号码
 * @params kjData       开奖号码
 * @params betWeiShu    投注位数，一般不用，在任选的时候用
 *
 * @return              返回中奖注数，如果不中奖，则返回0
 *
 * @throw               遇到不明的可以抛出，抛出等于忽略，手工处理
 * 时时彩
 */


// +----------------------------------------------------------------------
// | 多星玩法
// +----------------------------------------------------------------------

/**
 * 五星单式
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function dxwf5d($betData,$kjData) {
   return ds($betData, $kjData);
}

/**
 * 五星复式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function dxwf5f($betData,$kjData) {
    return fs($betData, $kjData);
}


/**
 * 五星-一帆风顺
 * 
 *  example
 *  bet:3,6
 *  win:2,3,4,5,7
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [中奖状态]
 */
function dxwf5yffs($betData,$kjData) {
    $winStatus = 0 ; 
    $betData   = array_filter(str_split($betData),function($v) use($kjData,&$winStatus) {
            if (strpos($kjData,$v) !== false ) {
                   ++$winStatus ; 
            }
    });
    
    return $winStatus;
}


/**
 * 五星-好事成双
 * 
 *  example
 *  bet:3,6
 *  win:2,3,3,5,7
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [中奖状态]
 */
function dxwf5hscs($betData,$kjData) {
    $winStatus = 0 ;
    $count     = 0 ;  
    $betData   = array_filter(str_split($betData),function($v) use($kjData,&$winStatus) {
          $count = 0 ; //统计中奖次数
           //将投注号与开奖号码对比
           array_filter(explode(',',$kjData),function($k) use($v,&$count) {
                if ($k == $v) {
                   ++$count ; 
                }
           });

           if ($count >= 2) {
                return ++$winStatus ; 
           }

    });
    
    return $winStatus;
}


/**
 * 五星-三星报喜
 * 
 *  example
 *  bet:3,6
 *  win:2,3,3,5,3
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [中奖状态]
 */
function dxwf5sxbx($betData,$kjData) {
    $winStatus = 0 ; 
    $betData   = array_filter(str_split($betData),function($v) use($kjData,&$winStatus) {
           $count = 0 ; //统计中奖次数
           //将投注号与开奖号码对比
           array_filter(explode(',',$kjData),function($k) use($v,&$count) {
                if ($k == $v) {
                  ++$count ; 
                }
           });

           if ($count >= 3) {
                return ++$winStatus ; 
           }

    });
    
    return $winStatus;
}


/**
 * 五星-四季发财
 * 
 *  example
 *  bet:3,6
 *  win:3,3,3,5,3
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [中奖状态]
 */
function dxwf5sjfc($betData,$kjData) {
    $winStatus = 0 ; 
    $betData   = array_filter(str_split($betData),function($v) use($kjData,&$winStatus) {
           //将投注号与开奖号码对比
           array_filter(explode(',',$kjData),function($k) use($v,&$count) {
                if ($k == $v) {
                  ++$count ; 
                }
           });

           if ($count >= 4) {
                return ++$winStatus ; 
           }

    });
    
    return $winStatus;
}


/**
 * 五星-组选120
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [中奖状态]
 */
function  ssczx120($betData, $kjData) {
    return z120($betData, $kjData) ;
}


/**
 * 五星-组选60
 *
 * example:
 * bet: '3,256'
 * win: '2,3,3,6,5'
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [中奖状态]
 */
function  ssczx60($betData, $kjData) {
    $winStatus = 0 ;  //中奖状态
    $count  = 0  ;
    $double = '' ; //重号
    $single  = [] ; //单号
    $bet = [] ;

    //筛选出中奖号中的单号和重号
    array_filter(explode(',',$kjData),function($v) use($kjData,&$double,&$single,&$count) {

        if (count(explode($v,$kjData))-1 == 2) {
            ++$count;
            $double = $v ;
        } else {
            $single[] = $v ;
        }
    }) ;
    $single = implode(',',$single) ; //将中奖单号由数组转为逗号分割字符串

    //有一个重号的时候
    if ($count == 2) {

         $number = explode(',',$betData) ; //分割投注号码,方便后面提取重号和单号

         //检索用户投注重号是否在开奖重号中
         if (strpos($number[0],$double) !== false) {
            //得到单号排列组合
             array_filter( permutation(str_split($number[1]),3), function($v) use(&$bet) {
                        $bet[] = implode(',',$v) ;   
               }) ;
            //检索是否单号中奖
            foreach ($bet as $v) {
                if ( strpos($v,$single) !== false ) {
                    ++$winStatus ; break ;
                }
            }

        }
    }
    return $winStatus ;
}



/**
 * 五星-组选30
 *
 * example:
 * bet: '32,6'
 * win: '2,2,3,3,6'
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [中奖状态]
 */
function  ssczx30($betData, $kjData) {
    $winStatus = 0 ;  //中奖状态
    $count     = 0  ;
    $double    = [] ; //重号
    $single    = '' ; //单号
    $bet       = [] ;

    //筛选出中奖号中的单号和重号
    array_filter(explode(',',$kjData),function($v) use($kjData,&$double,&$single,&$count) {
        if (count(explode($v,$kjData))-1 == 2) {
            ++$count;
            //避免重复判断
            if (!in_array($v,$double) ) {
                $double[] = $v ;
            }
        } else {
            $single = $v ;
        }
    }) ;
    $double = implode(',',$double); //将数组转成,号分割字符串

    //有两个重号的时候
    if ($count == 4) {
         $number = explode(',',$betData) ; //分割投注号码,方便后面提取重号和单号
         $number[0] =  str_replace($single,'',$number[0]) ; //如果重号中有单号则替换掉

         //检索用户投注单号是否中奖
         if (strpos($number[1],$single) !== false) {
            //检索重号是否中奖
             array_filter(permutation(str_split($number[0]),2), function($v) use(&$bet) {
                $bet[] = implode(',',$v);
             }) ;
             array_filter($bet,function($v) use(&$winStatus,$double) {
                    if (strpos($v,$double) !== false){
                        ++$winStatus ;
                    }
             }) ;

        }
    }

    return $winStatus ;
}



/**
 * 五星-组选20
 *
 * example:
 * bet: '2,36'
 * win: '2,3,3,3,6'
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [中奖状态]
 */
function  ssczx20($betData, $kjData) {
    $winStatus = 0  ; //中奖状态
    $count     = 0  ;
    $third     = '' ; //三重号
    $single    = [] ; //单号
    $bet       = [] ;

    //筛选出中奖号中的单号和重号
    array_filter(explode(',',$kjData),function($v) use($kjData,&$third,&$single,&$count) {
        if (count(explode($v,$kjData))-1 == 3) {
              ++$count;
              $third = $v ;
        } else {
              $single[] = $v;          
        }
    }) ;
    $single = implode(',',$single); //将数组转成,号分割字符串

    //符合一个三重号的时候
    if ($count == 3) {
         $number    = explode(',',$betData) ; //分割投注号码,方便后面提取重号和单号
         $number[1] = str_replace($third,'',$number[1]) ; //如果单号中含有重号则替换掉
       
         //检索三重号是否中奖
         if (strpos($number[0],$third) !== false) { 
                //得到单号排列数组
                 array_filter(permutation(str_split($number[1]),2), function($v) use(&$bet) { 
                    $bet[] = implode(',',$v);
                 }) ;
                  //检索单号是否中奖
                 array_filter($bet,function($v) use(&$winStatus,$single) {
                        if (strpos($v,$single) !== false) {
                            ++$winStatus ;
                        }
                 }) ;
        }
    }

    return $winStatus ;
}


/**
 * 五星-组选10
 *
 * example:
 * bet: '3,6'
 * win: '3,3,3,6,6'
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [中奖状态]
 */
function  ssczx10($betData, $kjData) {
    $winStatus = 0  ; //中奖状态
    $count3    = 0  ;
    $count2    = 0  ;
    $double    = '' ; //二重号
    $third     = '' ; //三重号
    $bet       = [] ;

    //筛选出中奖号中的单号和重号
    array_filter(explode(',',$kjData),function($v) use($kjData,&$double,&$third,&$count3,&$count2) {
        if (count(explode($v,$kjData))-1 == 3) { //三重号处理
              ++$count3 ;
              $third = $v ;
        }
        if (count(explode($v,$kjData))-1 == 2) { //二重号处理
              ++$count2 ;
              $double = $v ;
        }

    }) ;

    //符合一个三重号的时候
    if ($count3==3 && $count2==2) {
         $number    = explode(',',$betData) ; //分割投注号码,方便后面提取重号和单号
         //检索三重号是否中奖
         if (strpos($number[0],$third) !== false) { 
               //检索二重号是否中奖
               if (strpos($number[1],$double) !== false) { 
                    ++$winStatus ;
                }
        }
    }

    return $winStatus ;
}


/**
 * 五星-组选5
 *
 * example:
 * bet: '3,6'
 * win: '3,3,3,3,6'
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [中奖状态]
 */
function  ssczx5($betData, $kjData) {
    $winStatus = 0  ; //中奖状态
    $count     = 0  ;
    $four      = '' ; //四重号
    $single    = '' ; //单号
    $bet       = [] ;

    //筛选出中奖号中的单号和重号
    array_filter(explode(',',$kjData),function($v) use($kjData,&$single,&$four,&$count) {
        if (count(explode($v,$kjData))-1 == 4) { //四重号处理
              ++$count ;
              $four = $v ;
        } else {
            $single = $v ;
        }
    }) ;

    //符合一个四重号
    if ($count==4) {
         $number = explode(',',$betData) ; //分割投注号码,方便后面提取重号和单号

         //检索四重号是否中奖
         if (strpos($number[0],$four) !== false) {
               //检索单号是否中奖
               if (strpos($number[1],$single) !== false) { 
                    ++$winStatus ;
                }
        }
    }

    return $winStatus ;
}


/**
 * 任四组24
 *
 * example:
 * bet    = '43657892' ; //投注号码,四个号码为一注
   KjData = '3,4,5,6,2' ; //开奖号码
   w      = 30 ;          //用户所选位数
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @param  [type] $w       [用户选择位数 16万位 8:千位 4:百位 2:十位 1:个位]
 * @return [type]          [description]
 */
function ssczx4_24($betData,$kjData,$w) {
    $winStatus = 0 ;
    $kjData = explode(',',$kjData);
    $weishu = [16,8,4,2,1] ;
    $kj     = [] ;
    $bet    = [] ;

    foreach ($weishu as $key=>$val) {
        if ( ($w&$val)==0 ) unset($kjData[$key]) ;
    }
    $kjData = implode(',',$kjData) ;
   
     array_filter(permutation(explode(',',$kjData),4), function ($v) use(&$kj) {
        $kj[] = implode(',',$v) ;
    });

     array_filter(combin(str_split($betData),4), function ($v) use(&$bet) {
         $bet[] = implode(',',$v) ; 
     }) ;
    
    //对比是否中奖
    foreach ($bet as $betNumber) {
        foreach ($kj as $kjNumber) {
            if (strpos($kjNumber,$betNumber) !== false) {
                ++$winStatus; break ;
            }
        }
    }

    return$winStatus ;
}


/**
 * 任四组12
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @param  [type] $w       [用户选择位数 16万位 8:千位 4:百位 2:十位 1:个位]
 * @return [type]          [description]
 */
function ssczx4_12($betData,$kjData,$w) {
    $winStatus = 0 ;
    $kjData = explode(',',$kjData);
    $weishu = [16,8,4,2,1] ;
    $kj     = [] ;
    $bet    = [] ;

    foreach ($weishu as $key=>$val) {
        if ( ($w&$val)==0 ) unset($kjData[$key]) ;
    }
    $kjData = implode(',',$kjData) ;
   
    $count  = 0  ;
    $second = '' ; //重号
    $third  = '' ; //单号

    array_filter(explode(',',$kjData), function($v) use(&$count,&$second,&$third) {
        if (count(explode($v,$kjData))-1 == 2) { //出现两次字符串
            ++$count ;
            $second  = $v ;
        } else {
            $third[] = $v ;
        }
    });
    $third = implode(',',$third) ; //数组转成,分割字符串

    //符合一个四重号
    if ($count==2) {
         $number    = explode(',',$betData) ; //分割投注号码,方便后面提取重号和单号
         $number[1] = str_replace($second,'',$number[1]) ; //如果单号中含有重号则替换掉
         
         //检索重号是否中奖
         if (strpos($number[0],$second) !== false) {
               array_filter(permutation($number[1],2), function($v) {
                    $bet[] = implode(',',$v) ;
               });

             foreach ($bet as $val) {
                if (strpos($third,$val) !== false) {
                    ++$winStatus ;
                }
             }
         }
    }

    return$winStatus ;
}


/**
 * 任四组6
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @param  [type] $w       [用户选择位数 16万位 8:千位 4:百位 2:十位 1:个位]
 * @return [type]          [description]
 */
function ssczx4_6($betData,$kjData,$w) {
    $winStatus = 0 ;
    $kjData = explode(',',$kjData);
    $weishu = [16,8,4,2,1] ;
    $bet    = [] ;

    foreach ($weishu as $key=>$val) {
        if ( ($w&$val)==0 ) unset($kjData[$key]) ;
    }
    $kjData = implode(',',$kjData) ;
   
    $count  = 0  ;
    $second = '' ; //重号

    array_filter(explode(',',$kjData), function($v) use(&$count,&$second) {
        if (count(explode($v,$kjData))-1 == 2) { //出现两次字符串
            ++$count ;
           if (strpos($second,$v) === false ) {
                $second[] =  $v ;
           }
        }
    });
    $second = implode(',',$second) ; //数组转成,分割字符串

    //符合重号
    if ($count==4) {
        //得到投注号码排列组合
         array_filter(permutation($betData,2), function($v) use(&$bet){
                $bet[] = implode(',',$bet) ; 
         });
        //对比判断是否中奖
         foreach($bet as $v) {
            if (strpos($second,$v) !== false) {
                 ++$winStatus ;
            }
         }
    }
    
    return$winStatus ;
}


/**
 * 任四组4
 *
 * example:
 * $bet    = '81,6523' ; 
 * $KjData = '1,8,8,8,6' ;
 * $w      = 15 ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @param  [type] $w       [用户选择位数 16万位 8:千位 4:百位 2:十位 1:个位]
 * @return [type]          [description]
 */
function ssczx4_4($betData,$kjData,$w) {
    $winStatus = 0 ;
    $kjData = explode(',',$kjData);
    $weishu = [16,8,4,2,1] ;
    $bet    = [] ;

    foreach ($weishu as $key=>$val) {
        if ( ($w&$val)==0 ) unset($kjData[$key]) ;
    }
    $kjData = implode(',',$kjData) ;
   
    $count  = 0  ;
    $sing   = '' ; //单号
    $third  = '' ; //三重号

    //检索开奖数据中的三重号和单号
    array_filter(explode(',',$kjData), function($v) use(&$count,&$sing,&$third,$kjData) {
        if (count(explode($v,$kjData))-1 == 3) { //选出三重号
            ++$count ;
            $third = $v;
        } else {
            $sing[] = $v;
        }
    });
    $sing = implode(',',$sing) ; //数组转成,分割字符串

    //开奖号码有三重号
    if ( $count == 3 ) {
        $number = explode(',',$betData) ; //分割投注号码,方便后面提取三重号和单号

        //检查三重号是否中奖
        if (strpos($number[0],$third) !== false) {
             //得到投注单号排列组合
             array_filter(permutation(str_split($number[1]),1), function($v) use(&$bet) {
                    $bet[] = implode(',',$v) ; 
             });
             //对比单号是否中奖
             foreach($bet as $v) {
                if ( strpos($sing,$v) !== false ) {
                     ++$winStatus ; break ;
                }
             }
        }
    }
    
    return$winStatus ;
}


/**
 * 前4复式
 *
 * example:
 * $betData = '12,34,56,78' ;
 * $KjData  = '1,3,5,8,0'   ;
 * @param  [type] $betDat [投注数据]
 * @param  [type] $kjData [开奖数据]
 * @return [type]         [description]
 */
function dxwfQ4f($betData,$kjData) {
   $kjData = removeFromList($kjData,',',5) ; 
   return fs($betData, $kjData); 
}


/**
 * 前4单式
 *
 * example:
 * $betData = '1,3,5,8' ;
 * $KjData  = '1,3,5,8,0'   ;
 * @param  [type] $betDat [投注数据]
 * @param  [type] $kjData [开奖数据]
 * @return [type]         [description]
 */
function dxwfQ4d($betData,$kjData) {
   $kjData = removeFromList($kjData,',',5) ; 
   return ds($betData, $kjData); 
}


/**
 * 后4复式
 *
 * example:
 * $betData = '12,34,56,78' ;
 * $KjData  = '0,1,3,5,8'   ;
 * @param  [type] $betDat [投注数据]
 * @param  [type] $kjData [开奖数据]
 * @return [type]         [description]
 */
function dxwfH4f($betData,$kjData) {
   $kjData = removeFromList($kjData,',',1) ; 
   return fs($betData, $kjData); 
}


/**
 * 后4单式
 *
 * example:
 * $betData = '1,3,5,8' ;
 * $KjData  = '0,1,3,5,8' ;
 * @param  [type] $betDat [投注数据]
 * @param  [type] $kjData [开奖数据]
 * @return [type]         [description]
 */
function dxwfH4d($betData,$kjData) {
   $kjData = removeFromList($kjData,',',1) ; 
   return fs($betData, $kjData); 
}


/**
 * 任选4复式
 *
 * example:
 * $betData = '01,23,-,56,78';
 * $KjData  = '0,2,3,5,8' ;
 * @param  [type] $betDat [投注数据]
 * @param  [type] $kjData [开奖数据]
 * @return [type]         [description]
 */
function dxwfR4f($betData,$kjData) {
   $tmpArr = explode(',' , $betData) ;
   $index  = array_search('-',$tmpArr) ; 
   $kjData = replaceList($kjData,'-',$index);

   return fs($betData,$kjData) ;
}


/**
 * 任选4单式
 *
 * example:
 * $betData = '1,3,5,8' ;
 * $KjData  = '0,1,3,5,8' ;
 * @param  [type] $betDat [投注数据]
 * @param  [type] $kjData [开奖数据]
 * @return [type]         [description]
 */
function dxwfR4d($betData,$kjData) {
    // var w=bet.substr(0,9).split(',').indexOf('-')+1;
    $tmpArr = substr($betData,0,9) ;
    $tmpArr = explode(',' , $tmpArr) ;
    $index  = array_search('-',$tmpArr) ; 
    $kjData = replaceList($kjData,'-',$index);
    return ds($betData, $kjData);
}


// +----------------------------------------------------------------------
// |  三星组选
// +----------------------------------------------------------------------

/**
 *  前三复式
 *  example:
 *  $betData = '124,032,568';
 *  $kjData  = '2,3,5,7,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxwfQ3f ($betData,$kjData) {
    $kjData = removeFromList($kjData,',',4,5) ; 
    return fs($betData,$kjData) ;
}


/**
 *  前三单式
 *  example:
 *  $betData = '2,3,5';
 *  $kjData  = '2,3,5,7,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxwfQ3d ($betData,$kjData) {
    $kjData = removeFromList($kjData,',',4,5) ; 
    return ds($betData,$kjData) ;
}


/**
 *  后三复式
 *  example:
 *  $betData = '124,032,568';
 *  $kjData  = '2,3,5,7,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxwfH3f ($betData,$kjData) {
    $kjData = removeFromList($kjData,',',4,5) ; 
    return fs($betData,$kjData) ;
}

/**
 *  后三单式
 *  example:
 *  $betData = '2,3,5';
 *  $kjData  = '2,3,5,7,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxwfH3d ($betData,$kjData) {
    $kjData = removeFromList($kjData,',',4,5) ; 
    return fs($betData,$kjData) ;
}


/**
 *  任选三复式
 *  example:
 *  $betData = '21,31,51,71,-' ;
 *  $kjData  = '2,3,5,7,9'  ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxwfR3f ($betData,$kjData) {
    $tmpArr = explode(',' , $betData) ;
    $index  = array_search('-',$tmpArr) ; 
    $kjData = replaceList($kjData,'-',$index);
    return fs($betData,$kjData) ;
}

/**
 *  任选三单式
 *  example:
 *  $betData = '21,31,51,71,-' ;
 *  $kjData  = '2,3,5,7,9'  ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxwfR3d ($betData,$kjData) {
    $tmpArr = explode(',' , $betData) ;
    $index  = array_search('-',$tmpArr) ; 
    $kjData = replaceList($kjData,'-',$index);
    return fs($betData,$kjData) ;
}



/**
 *   前三组三
 * $betData = '139';
 * $kjData  = '1,3,3,5,6' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxzxQ3z3($betData,$kjData) {
    $kjData = substr($kjData,0,5) ;
    return z3($betData , $kjData);
}

/**
 * 前三组六
 * $betData = '234510';
 * $kjData  = '7,3,5,8,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxzxQ3z6($betData, $kjData) {
    $kjData = substr($kjData,0,5) ;
    return z6($betData, $kjData) ;
}


/**
 * 前三混合组选
 * TODO::源文件缺失这个方法的代码,待补充
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxzxQ3h($betData, $kjData){

}


/**
 * 后三组三
 * $betData = '89';
 * $kjData  = '7,3,8,8,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxzxH3z3($betData, $kjData) {
    $kjData = substr($kjData,4,9) ;
    return z3($betData, $kjData) ;
}

/**
 * 后三组六
 * $betData = '589';
 * $kjData  = '7,3,5,8,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxzxH3z6($betData, $kjData) {
    $kjData = substr($kjData,4,9) ;
    return z6($betData, $kjData) ;
}

/**
 * 后三混合组选
 * TODO::源文件缺失这个方法的代码,待补充
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxzxH3h($betData, $kjData){

}

/**
 * 任三组三
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @param  [type] $w       [description]
 * @return [type]          [description]
 */
function sxzxR3z3($betData,$kjData,$w) {
    $winStatus = 0 ;
    $kjData = explode(',',$kjData);
    $weishu = [16,8,4,2,1] ;

    foreach ($weishu as $key=>$val) {
        if ( ($w&$val)==0 ) unset($kjData[$key]) ;
    }
    $kjData = implode(',',$kjData) ;

    return z3($betData,$kjData);
}


/**
 * 任三组六
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @param  [type] $w       [description]
 * @return [type]          [description]
 */
function sxzxR3z6($betData,$kjData,$w) {
    $winStatus = 0 ;
    $kjData = explode(',',$kjData);
    $weishu = [16,8,4,2,1] ;

    foreach ($weishu as $key=>$val) {
        if ( ($w&$val)==0 ) unset($kjData[$key]) ;
    }
    $kjData = implode(',',$kjData) ;

    return z6($betData,$kjData);
}

/**
 * 任三混合组
 * TODO::源文件缺失这个方法的代码,待补充
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function sxzxR3h($betData, $kjData){

}


// +----------------------------------------------------------------------
// |   二星直选
// +----------------------------------------------------------------------

/**
 * 前二复式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function rxwfQ2f($betData,$kjData) {
    $kjData = substr($kjData,0,3);
    return fs($betData,$kjData) ;
}

/**
 * 前二单式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function rxwfQ2d($betData,$kjData) {
    $kjData = substr($kjData,0,3);
    return ds($betData,$kjData) ;
}

/**
 * 后二复式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function rxwfH2f($betData,$kjData) {
    $kjData = substr($kjData,0,3);
    return ds($betData,$kjData) ;
}

/**
 * 后二单式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function rxwfH2d($betData,$kjData) {
    $kjData = substr($kjData,0,3);
    return ds($betData,$kjData) ;
}

/**
 * 任选二复式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function rxwfR2f($betData,$kjData) {
   return sxwfR3f($betData,$kjData) ;
}

/**
 * 任选二单式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function rxwfR2d($betData,$kjData) {
    return sxwfR3d($betData,$kjData) ;
}


// +----------------------------------------------------------------------
// |   二星组选
// +----------------------------------------------------------------------


/**
 * 前二组复式
 * $betData = '23';
 * $kjData  = '2,3,5,8,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function rxzxQ2f($betData,$kjData) {
    $kjData = substr($kjData,0,3);
    return z2f($betData,$kjData) ;
}

/**
 * 前二组单式
 * $betData = '23';
 * $kjData  = '2,3,5,8,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function rxzxQ2d($betData,$kjData) {
    $kjData = substr($kjData,0,3);
    return z2d($betData,$kjData) ;
}

/**
 * 后二组复式
 * $betData = '89';
 * $kjData  = '2,3,5,8,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function rxzxH2f($betData,$kjData) {
    $kjData = substr($kjData,6,9);
    return z2f($betData,$kjData) ;
}

/**
 * 后二组单式
 * $betData = '89';
 * $kjData  = '2,3,5,8,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function rxzxH2d($betData,$kjData) {
    $kjData = substr($kjData,6,9);
    return z2d($betData,$kjData) ;
}

/**
 * 任选二组选复式 ###
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @param  [type] $w       [description]
 * @return [type]          [description]
 */
function rxzxR2f($betData, $kjData, $w) {
    $kjData = explode(',',$kjData);
    $weishu = [16,8,4,2,1] ;

    foreach ($weishu as $key=>$val) {
        if ( ($w&$val)==0 ) unset($kjData[$key]) ;
    }
    $kjData = implode(',',$kjData) ;

    return z2f($betData, $kjData);
}

/**
 * 任选二组选单式 ###
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @param  [type] $w       [description]
 * @return [type]          [description]
 */
function rxzxR2d($betData, $kjData, $w) {
    $winStatus = 0 ;
    $kjData = explode(',',$kjData);
    $weishu = [16,8,4,2,1] ;

    foreach ($weishu as $key=>$val) {
        if ( ($w&$val)==0 ) unset($kjData[$key]) ;
    }
    $kjData = implode(',',$kjData) ;

    array_filter(explode('|',$betData), function($b) use(&$bet,$w) {
        $b = explode(',',$b) ;
        $weishu = [16,8,4,2,1] ;
        foreach ($weishu as $key=>$val) {
            if ( ($w&$val)==0 ) unset($b[$key]) ;
        }
        $bet[] = implode(',',$b) ;
    });
    $betData = implode('|',$bet);
   
    return z2f($betData, $kjData);
}


/**
 *  五星定位胆
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function dwd5x($betData,$kjData) {
    $winStatus = 0 ;
    $kjData    = explode(',',$kjData) ; 
    $betData   = explode(',',$betData) ; 
    $count     = 0 ;

    foreach ( $betData as $key=>$val ) {
        if (strlen($val) > 1) {
            $val = str_split($val) ;
            foreach ($val as $v) {
                if ( $v==$kjData[$key] ) ++$count;
            }

        } else {
            if ( $val==$kjData[$key] ) ++$count;
        }
    }

    return $count ;
}

/**
 * 十星定位胆##
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function dwd10x($betData,$kjData) {
    $winStatus = 0 ;
    $kjData    = explode(',',$kjData) ; 
    $betData   = explode(',',$betData) ; 
    $count     = 0 ;

    foreach ( $betData as $key=>$val ) {
        if (strlen($val) > 2) {
            $val = str_split($val) ;
            foreach ($val as $v) {
                if ( $v==$kjData[$key] ) ++$count;
            }

        } else {
            if ( $val==$kjData[$key] ) ++$count;
        }
    }

    return $count ;
}

/**
 * 后三不定胆##
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function bddH3($betData,$kjData) {
    $kjData = substr($kjData,4,7) ;
    
    $bet = array_filter(str_split($betData), function($v) use($kjData) {
            if ( strpos($kjData,$v)!==false ) {
                return true;
            } else {
                return false ;
            }
    });
    return count($bet) ;
}

/**
 * 前三不定胆 ###
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function bddQ3($betData,$kjData) {
    $kjData = substr($kjData,0,5) ;
    
    $bet = array_filter(str_split($betData), function($v) use($kjData) {
            if ( strpos($kjData,$v)!==false ) {
                return true;
            } else {
                return false ;
            }
    });

    return count($bet) ;
}

/**
 * 中三不定胆 ###
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function bddZ3($betData,$kjData) {
    $kjData = substr($kjData,2,5) ;
    
    $bet = array_filter(str_split($betData), function($v) use($kjData) {
            if ( strpos($kjData,$v)!==false ) {
                return true;
            } else {
                return false ;
            }
    });

    return count($bet) ;
}


/**
 * 任选三不定胆 ###
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function bddR3($betData,$kjData,$w) {
    $kjData = explode(',',$kjData);
    $weishu = [16,8,4,2,1] ;
    foreach ($weishu as $key=>$v) {
        if ( ($w&$v)==0 ) unset($kjData[$key]) ;
    }
    $kjData = implode(',',$kjData) ;

    $bet = array_filter(str_split($betData), function($v) use($kjData) {
        if ( strpos($kjData,$v)!==false ) {
            return true;
        } else {
            return false ;
        }
    });
    // bet=bet.split('').filter(function(v){
    //     return kj.indexOf(v)!=-1;
    // });
    
    return count($bet) ;
}

/**
 * 前三二码  二码不定位 ###
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function bdwQ32($betData, $kjData){

    $kj = substr($kjData,0,5);
    $bet2 = '';
    $betData = explode(' ',$betData) ;
    for($i=0,$l=count($betData); $i<$l; $i++) {
        if ( strpos($kjData,$betData[$i]!==false) ) {
            $bet2 .= $betData[$i];
        }
    }

    return count( combin( str_split($bet2),2 ) );
}


/**
 * 后三二码 ###
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function bdwH32($betData, $kjData) {

    $kj = substr($kjData,4,5);
    $bet2 = '';
    $betData = explode(' ',$betData) ;
    for($i=0,$l=count($betData); $i<$l; $i++) {
        if ( strpos($kjData,$betData[$i]!==false) ) {
            $bet2 .= $betData[$i];
        }
    }

    return count( combin( str_split($bet2),2 ) );
}


// +----------------------------------------------------------------------
// |   大 小 单 双
// +----------------------------------------------------------------------

/**
 * 前二大小单双
 * $betData = '大,单';
 * $kjData  = '5,3,5,7,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function dsQ2($betData,$kjData) {
    $kjData = substr($kjData,0,3) ;
    return dxds($betData,$kjData) ;
}

/**
 * 后二大小单双
 * $betData = '大,单';
 * $kjData  = '5,3,5,7,9' ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function dsH2($betData,$kjData) {
    $kjData = substr($kjData,6,8) ;
    return dxds($betData,$kjData) ;
}

/**
 * 任选二大小单双
 * $betData = '大,单,-,-,-';
 * $kjData  = '6,1,5,7,9' ;
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function dsR2($betData, $kjData) {
    $kjData  = explode(',',$kjData)  ;
    $betData = explode(',',$betData) ;
    foreach ($betData as $key=>$val) {
        if ( $val=='-' ) {
            unset($kjData[$key]) ;
        }
    }
    $betData = implode(',',$betData) ;
    $kjData  = implode(',',$kjData) ;

    return dxds($betData, $kjData);
}


// +----------------------------------------------------------------------
// |   时时彩结束
// +----------------------------------------------------------------------



// +----------------------------------------------------------------------
// |    福彩3D
// +----------------------------------------------------------------------

/**
 * 三星直选－复式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dFs($betData,$kjData) {
    return fs($betData,$kjData);
}

/**
 * 三星直选－单式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dDs($betData,$kjData) {
    return ds($betData,$kjData);
}

/**
 * 三星组选－组三
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dZ3($betData,$kjData) {
    return z3($betData,$kjData);
}

/**
 * 三星组选－组六
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dZ6($betData,$kjData) {
    return z6($betData,$kjData);
}


/**
 * 二星直选－前二单式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dQ2d($betData,$kjData) {
    return rxwfQ2d($betData,$kjData);
}

/**
 * 二星直选－前二复式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dQ2f($betData,$kjData) {
    return rxwfQ2f($betData,$kjData);
}

/**
 * 二星直选－后二单式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dH2d($betData,$kjData) {
    $kjData = substr($kjData,2,5) ;
    return ds($betData,$kjData);
}

/**
 * 二星直选－后二复式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dH2f($betData,$kjData) {
    $kjData = substr($kjData,2,5) ;
    return fs($betData,$kjData);
}

/**
 * 二星组选－前二组选单式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dZQ2d($betData,$kjData) {
    return rxzxQ2d($betData,$kjData);
}

/**
 * 二星组选－前二组选复式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dZQ2f($betData,$kjData) {
    return rxzxQ2f($betData,$kjData);
}

/**
 * 二星组选－后二组选单式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dZH2d($betData,$kjData) {
    $kjData = substr($kjData,2,5) ;
    return z2d($betData,$kjData);
}

/**
 * 二星组选－后二组选复式
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dZH2f($betData,$kjData) {
    $kjData = substr($kjData,2,5) ;
    return z2f($betData,$kjData);
}



/**
 * 三星定位胆
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3d3xdw($betData,$kjData) {
    return dwd5x($betData,$kjData);
}

/**
 * 不定胆
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dbdd($betData,$kjData) {
    return bddQ3($betData,$kjData);
}

/**
 * 后二大小单双
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function fc3dH2dxds($betData,$kjData) {
    $kjData = substr($kjData,2,5) ;
    return dxds($betData,$kjData);
}

/**
 * 任选二大小单双###
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @param  [type] $w       [description]
 * @return [type]          [description]
 */
function fc3dR2dxds($betData, $kjData, $w) {
    $kjData = explode(',',$kjData);
    $weishu = [4,2,1] ;

    foreach ($weishu as $key=>$val) {
        if ( ($w&$val)==0 ) unset($kjData[$key]) ;
    }
    $kjData = implode(',',$kjData) ;

    return dxds($betData,$kjData);
}


// +----------------------------------------------------------------------
// |   十一选五玩法
// +----------------------------------------------------------------------

/**
 * 任选一###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5R1($betData,$kjData) {

    $data = array_filter(explode(' ',$betData), function($v) use($kjData){
        if (strpos($kjData,$v)!==false) {
            return true ;
        } else {
            return false ;
        }
    }) ;
   
   return count($data) ;
}

/**
 * 任选二
 * $betData = '02 03' ;
 * $kjData  = '02,03,04,07,05'   ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5R2($betData,$kjData) {
   return rx($betData, $kjData, 2);
}

/**
 * 任选三###
 * $betData = '02 01 04' ;
 * $kjData  = '02,03,04,07,05'   ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5R3($betData,$kjData) {
   return rx($betData, $kjData, 3);
}

/**
 * 任选四###
 * $betData = '02 01 04 05' ;
 * $kjData  = '02,03,04,07,05'   ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5R4($betData,$kjData) {
   return rx($betData, $kjData, 4);
}

/**
 * 任选五###
 * $betData = '02 01 04 05 06' ;
 * $kjData  = '02,03,04,07,05'   ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5R5($betData,$kjData) {
   return rx($betData, $kjData, 5);
}

/**
 * 任选六###
 * $betData = '02 01 04 05 06 07' ;
 * $kjData  = '02,03,04,07,05'   ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5R6($betData,$kjData) {
   return rx($betData, $kjData, 6);
}

/**
 * 任选七###
 * $betData = '02 01 04 05 06 07 03' ;
 * $kjData  = '02,03,04,07,05'   ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5R7($betData,$kjData) {
   return rx($betData, $kjData, 7);
}

/**
 * 任选八###
 * $betData = '02 01 04 05 06 07 08 03' ;
 * $kjData  = '02,03,04,07,05'   ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5R8($betData,$kjData) {
   return rx($betData, $kjData, 8);
}

/**
 * 任选九###
 * $betData = '02 01 04 05 06 07 08 09 03' ;
 * $kjData  = '02,03,04,07,05'   ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5R9($betData,$kjData) {
   return rx($betData, $kjData, 9);
}

/**
 * 任选十###
 * $betData = '02 01 04 05 06 07 08 09 03 10' ;
 * $kjData  = '02,03,04,07,05'   ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5R10($betData,$kjData) {
   return rx($betData, $kjData, 10);
}


/**
 *  前一直选
 * $betData = '01' ;
 * $kjData  = '01,03,02,04,06'   ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5Q1($betData,$kjData){
    return qs($betData, $kjData, 1);
}

/**
 *  前二直选
 * $betData = '01 02,03 04' ;
 * $kjData  = '01,03,02,04,06'   ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5Q2($betData,$kjData){
    return qs($betData, $kjData, 2);
}

/**
 *  前二组选
 * $betData = '01 02,03 04' ;
 * $kjData  = '01,03,02,04,06'   ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5Q2z($betData,$kjData){
    $kjData = substr($kjData,0,5) ;
    return zx($betData, $kjData);
}

/**
 * 前三直选###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5Q3($betData, $kjData) {
    return qs($betData, $kjData, 3) ;
}

/**
 * 前三组选
 * $betData = '(01) 03 05 07 06' ;
 * $Data  =  '01,03,05,07,08';
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5Q3z($betData, $kjData) {
    $kjData = substr($kjData,0,8) ;
    return zx($betData, $kjData) ;
}

/**
 * 前四组选###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function gd11x5Q4z($betData, $kjData) {
    $kjData = substr($kjData,0,11) ;
    return zx($betData, $kjData) ;
}


// +----------------------------------------------------------------------
// |   快乐十分玩法
// +----------------------------------------------------------------------

/**
 * 任选一 选一数投 
 * $betData = '01 02 03 04'        ;
 * $kjData  = '01,05,06,07,08'     ;
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function klsfR1B($betData, $kjData) {
    $kj = substr($kjData,0,2) ; 
    $result = array_filter(explode(' ',$betData), function($v) use($kj) {
        if ( strpos($kj,$v)!==false ) {
            return true; 
        } else {
            return false ;
        }
    }) ;

    return count($result) ;
}

/**
 * 任选一 选一红投 ###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function klsfR1R($betData, $kjData) {
    $kj = substr($kjData,0,2) ; 
    $result = array_filter(explode(' ',$betData), function($v) use($kj) {
        if ( strpos($kj,$v)!==false ) {
            return true; 
        } else {
            return false ;
        }
    }) ;

    return count($result) ;
}

/**
 * klsfR2 ###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function klsfR2($betData, $kjData) {
    return rx($betData, $kjData, 2);
}

/**
 * klsfR3 ###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function klsfR3($betData, $kjData) {
    return rx($betData, $kjData, 3);
}

/**
 * klsfR4 ###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function klsfR4($betData, $kjData) {
    return rx($betData, $kjData, 4);
}

/**
 * klsfR5 ###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function klsfR5($betData, $kjData) {
    return rx($betData, $kjData, 5);
}

/**
 * 前二直选 ###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function klsfQ2($betData, $kjData) {
    return qs($betData, $kjData, 2);
}

/**
 * 前二组选 ###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function klsfQ2z($betData, $kjData) {
    $kjData = substr($kjData,0,5) ;
    return zx($betData, $kjData, 2);
}

/**
 * 前三直选 ###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function klsfQ3($betData, $kjData) {
    return qs($betData, $kjData, 3);
}

/**
 * 前三组选 ###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function klsfQ3z($betData, $kjData) {
    $kjData = substr($kjData,0,8) ;
    return zx($betData, $kjData, 2);
}


// +----------------------------------------------------------------------
// |   北京PK10玩法 1至10位开奖
// +----------------------------------------------------------------------

/**
 * 冠军
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function kjq1($betData, $kjData) {
    return qs($betData,$kjData, 1);
}

/**
 * 冠亚军
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function kjq2($betData, $kjData) {
    return qs($betData,$kjData, 2);
}

/**
 * 前三
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function kjq3($betData, $kjData) {
    return qs($betData,$kjData, 3);
}

/**
 * 冠亚季选一
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function pk10r123($betData, $kjData) {
    $kjData = substr($kjData,0,8);
    return rx($betData, $kjData, 1);
}

/**
 * 冠亚总和
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function pk10gy2($betData, $kjData) {
    $kjData  = explode(',',$kjData) ;
    $betData = explode(' ',$betData) ;
    $val     = intval($kjData[0]) + intval($kjData[1]) ;
    $count   = 0 ;
    $l=count($betData) ;
    for ( $i=0; $i<$l; $i++ ) {
        if ( intval($betData[$i]) == $val ) {
            ++$count ;
        }
    }

    return $count ; 
}

/**
 * 冠亚组合
 * $betData = '1-7 1-8 1-9 1-10 2-3';
 * $kjData  = '1,7,10,7,8'     ;
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function pk10gyzh($betData, $kjData) {
    $kjData   = explode(',',$kjData) ;
    $val1 = intval($kjData[0]) ;
    $val2 = intval($kjData[1]) ;
    $str1 = $val1.'-'.$val2 ;
    $str2 = $val2.'-'.$val1 ;
    $betData = explode(' ',$betData) ;
    $count   = 0 ;
    $l = count($betData) ;

    for ($i=0; $i<$l; $i++) {
        if ($betData[$i]==$str1 || $betData[$i]==$str2) {
            ++$count ;
        }
    }

    return $count ; 
}

/**
 *  龙虎
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function pk10lh1($betData, $kjData) {
    return pk10lh($betData, $kjData, 1) ;
}

/**
 *  pk10lh2
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function pk10lh2($betData, $kjData) {
    return pk10lh($betData, $kjData, 2) ;
}

/**
 *  pk10lh3
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function pk10lh3($betData, $kjData) {
    return pk10lh($betData, $kjData, 3) ;
}

/**
 *  pk10lh4
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function pk10lh4($betData, $kjData) {
    return pk10lh($betData, $kjData, 4) ;
}

/**
 *  pk10lh5
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function pk10lh5($betData, $kjData) {
    return pk10lh($betData, $kjData, 5) ;
}


/**
 * [pk10lh12 description]
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function pk10lh12($betData, $kjData) {
    $kjData  = explode(',',$kjData) ;
    $total   = count($kjData)-1 ;
    $val1    = intval($kjData[0])+intval($kjData[1]) ;
    $val2    = intval($kjData[$total])+intval($kjData[$total-1]) ;
    $betData = str_split($betData) ;
    $count   = 0 ;
    $l       = count($betData) ;

    for ($i=0; $i<$l; $i++) {
         if ($betData[$i]=='龙') {
            if ($val1>$val2) ++$count ;
         } elseif($betData[$i]=='虎') {
            if ($val1 <$val2) ++$count;
         }
    }

    return $count ;
}

/**
 * [pk10lh123 description]
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function pk10lh123($betData, $kjData) {
    $kjData  = explode(',',$kjData) ;
    $total   = count($kjData)-1 ;
    $val1    = intval($kjData[0])+intval($kjData[1])+intval($kjData[2]) ;
    $val2    = intval($kjData[$total])+intval($kjData[$total-1])+intval($kjData[$total-2]) ;
    $betData = str_split($betData) ;
    $count   = 0 ;
    $l       = count($betData) ;

    for ($i=0; $i<$l; $i++) {
         if ($betData[$i]=='龙') {
            if ($val1>$val2) ++$count ;
         } elseif($betData[$i]=='虎') {
            if ($val1 <$val2) ++$count;
         }
    }
    
    return $count ;
}

/**
 * 前二组选
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function kjzx2($betData, $kjData) {
    $kjData = substr($kjData,0,5) ;
    return zx($betData, $kjData);
}

/**
 * 前三组选
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function kjzx3($betData, $kjData) {
    $kjData = substr($kjData,0,8) ;
    return zx($betData, $kjData);
}


/**
 * 北京快乐8
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function k8R1($betData, $kjData){
    $kjData = explode('|',$kjData);
    return rx($betData, $kjData[0], 1);
}

/**
 * k8R2
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function k8R2($betData, $kjData){
    $kjData = explode('|',$kjData);
    return rx($betData, $kjData[0], 2);
}

/**
 * k8R3
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function k8R3($betData, $kjData){
    $kjData = explode('|',$kjData);
    return rx($betData, $kjData[0], 3);
}

/**
 * k8R4
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function k8R4($betData, $kjData){
    $kjData = explode('|',$kjData);
    return rx($betData, $kjData[0], 4);
}

/**
 * k8R5
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function k8R5($betData, $kjData){
    $kjData = explode('|',$kjData);
    return rx($betData, $kjData[0], 5);
}

/**
 * k8R6
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function k8R6($betData, $kjData){
    $kjData = explode('|',$kjData);
    return rx($betData, $kjData[0], 6);
}

/**
 * k8R7
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function k8R7($betData, $kjData){
    $kjData = explode('|',$kjData);
    return rx($betData, $kjData[0], 7);
}


// +----------------------------------------------------------------------
// |  快3 - 万金娱乐平台
// +----------------------------------------------------------------------

/**
 * 和值###
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function k3hz($betData, $kjData) {
    $kjData  = explode(',',$kjData) ;
    $val     = intval($kjData[0])+intval($kjData[1])+intval($kjData[2]) ;
    $betData = explode(' ',$betData) ;
    $count   = 0 ;
    $l       = count($betData) ;

    for ( $i=0; $i<$l; $i++) {
        if ( intval($betData[$i])==$val ) {++$count ;}
    }
    return $count ;
}

/**
 * 三同号通选###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function k33tx($betData,$kjData) {
    $kjData = str_replace(',','',$kjData);
    $count  = 0 ;
    if ( strpos($betData,$kjData)!==false ) ++$count;

    return $count ;
}

/**
 * 三连号通选###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function k33ltx($betData,$kjData) {
    return k33tx($betData,$kjData) ;
}

/**
 * 三同号单选###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function k33dx($betData,$kjData) {
    $winStatus = 0;
    $betData = str_replace('*','',$betData);
    $betData = explode(',',$betData);
    $kjData  = explode(',',$kjData);
    $kj      = [] ;

    $kj[] = $kjData[0].$kjData[1] ;
    $kj[] = $kjData[2] ;

    foreach ($kj as $key=>$kjNumber) {
        if ( strpos($betData[$key],$kjNumber)!==false ) {
            ++$winStatus ;break ;
        }
    }

    return $winStatus;
}

/**
 * 三不同号 ###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function k33x($betData,$kjData) {
    return zx($betData,$kjData);
}

/**
 * 二不同号 ###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function k32x($betData,$kjData) {
    return k33x($betData,$kjData);
}

/**
 * 二同号复选 ###
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function k32fx($betData,$kjData) {
    return k33dx($betData,$kjData);
}

/**
 * 二同号单选
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @return [type]          [description]
 */
function k32dx($betData, $kjData) {
    $betData = explode(' ',$betData) ;
    $kjData  = str_replace(',','',$kjData) ;
    $count   = 0 ;
    $l = count($betData) ;

    for ($i=0; $i<$l; $i++) {
        if ( strpos($betData[$i],$kjData)!==false ) ++$count ;
    }
    return $count ;
}







// +----------------------------------------------------------------------
// |   常用算法
// +----------------------------------------------------------------------

/**
 * 组合算法
 * @param array $a
 * @param int $m
 * @return array|array[]|unknown[][]
 */
function combin($a, $m) {
    $r = array();
    
    $n = count($a);
    if ($m <= 0 || $m > $n) {
        return $r;
    }
    
    for ($i=0; $i<$n; $i++) {
        $t = array($a[$i]);
        if ($m == 1) {
            $r[] = $t;
        } else {
            $b = array_slice($a, $i+1);
            $c = combin($b, $m-1);
            foreach ($c as $v) {
                $r[] = array_merge($t, $v);
            }
        }
    }
    
    return $r;
}

/**
 * 排列算法
 * @param array $a
 * @param int $m
 * @return array|array[]|unknown[]
 */
function permutation($a, $m) {
    $r = array();
    
    $n = count($a);
    if ($m <= 0 || $m > $n) {
        return $r;
    }
    
    for ($i=0; $i<$n; $i++) {
        $b = $a;
        $t = array_splice($b, $i, 1);
        if ($m == 1) {
            $r[] = $t;
        } else {
            $c = permutation($b, $m-1);
            foreach ($c as $v) {
                $r[] = array_merge($t, $v);
            }
        }
    }
    return $r;
}

/**
 * 求$n的阶乘
 * @param int $n
 * @return number
 */
function factorial($n) {
    return array_product(range(1, $n));
}

/**
 * $n的$m排列数
 * @param int $n
 * @param int $m
 * @return number
 */
function A($n, $m) {
    return factorial($n)/factorial($n-$m);
}

/**
 * $n的$m组合数
 * @param int $n
 * @param int $m
 * @return number
 */
function C($n, $m) {
    return A($n, $m)/factorial($m);
} 

/**
 * 单式算法
 * @param string $bet 投注列表：1,5,2,9|3,2,4,6
 * @param string $data 开奖所需的那几位号码：4,5,3,6
 * @return 返回中奖注数
 */
function ds($bet,$data){
    $bets = explode('|',$bet);
    $counter = 0;
    array_filter($bets,function($i) use ($data,&$counter){
        if ($i == $data) {
            $counter++;
        }
    });
    return $counter;
}


/**
 * 常用复式算法
 *
 * @params bet      投注列表：123,45,2,59 (投注号码)
 * @params data     开奖所需的那几个：3,4,2,9(中奖号码)
 * @return          返回中奖注数
 */
function fs($bet,$data) {
    $bets = array();
    $winStatus = 0 ;  //中奖
    //1.将复选值分割
    array_filter(explode(',', $bet),function($item) use ($data,&$bets) {
        $bets[] = str_split($item);
    } ) ;

    //2.计算该复选值的笛卡尔积
    $descar = call_user_func_array('descartesAlgorithm', $bets) ;

    //3.对比是否为中奖号
    $winStatus = comparisonWin($descar,$data) ;

    return $winStatus;
}

/**
 * 根据笛卡尔积和中奖号码, 对比是否中奖
 * @param  [type] $descar    [复式投注笛卡尔积]
 * @param  [type] $WinNumber [中奖号码]
 * @return [type]            [description]
 */
function comparisonWin($descar,$WinNumber) {
      $count = 0 ; 
      foreach ( $descar as $val ) {
        $tmp = implode(',',$val) ;
        if ( $tmp == $WinNumber) {
            ++$count;
        }
      }
      return $count ;
}

/**
 * 笛卡尔乘积算法
 * useage:
 * (descartesAlgorithm(2, [4,5], [6,0],[7,8,9],...)); 
 * (descartesAlgorithm([2,3,4], [4,5], [6,0],[7,8,9],...));
 */
function descartesAlgorithm() {
    $data   = func_get_args();
    $result = array();

    //笛卡尔积X
    foreach($data[0] as $item) {
        $result[] =  is_array($item) ? $item :[$item];
    }

    //计算笛卡尔积
    $cnt   = count($data);
    for($i = 1; $i < $cnt; $i++) {
        $result = combineArray($result,$data[$i]);
    }

    return $result; 
}

/**
 * 两个数组的笛卡尔积
 *
 * @param unknown_type $arr1
 * @param unknown_type $arr2
 */
function combineArray($arr1,$arr2) {
    $result = array();
    foreach ($arr1 as $item1) {
        foreach ($arr2 as $item2) {
            $temp = $item1;
            $temp[] = $item2;
            $result[] = $temp;
        }
    }
    return $result;
}

/**
 * 组120
 *
 * @params bet      投注列表：'567894'
 * @params data     开奖所需的那几位号码：'2,3,4,5,6'
 *
 * @return          返回中奖注数
 */
function z120($betData, $kjData) {
    
    $winStatus = 0 ; 
    $bet = []; 

    //1.豹子不算中奖
    if (preg_match('/^(\d),\1,\1,\1,\1/',$kjData)) return $winStatus ;
    
    //2.对不同投注方式进行处理,转化成相同的数据结构
    if (strpos($betData,',') !==false) {
        // 录入式投注
        $bet = explode(',',$betData) ;
    } else {
        // 点击按钮投注
          array_filter( permutation(str_split($betData),5), function($v) use(&$bet) {
             $bet[] =  implode(',',$v) ; 
        }) ;
    }

    //3.然后对比投注号码和中奖号码,得出客户是否中奖
     foreach ($bet as $key=>$numberList) {
        if (strpos($kjData,$numberList) !== false) {
            ++$winStatus ;
            break;
        }
     }

    return $winStatus;
}


/**
 *  组三
 *
 *  @param betData  投注列表：135687或112,334
 *  @param kjData   开奖所需的那几位号码：4,5,3
 *  @return         返回中奖注数
 */
function z3($betData,$kjData) {
    $winStatus = 0 ;
    $bet = [] ; 
    $reg = '/(\d)\d?\1/' ;

    // 豹子不算中奖
    if (preg_match('/^(\d),\1,\1/',$kjData)) return $winStatus;
    
    if ( (strpos($betData,',')!==false ) || preg_match($reg,$betData) ) {
            //单选处理 
            $betData = explode(',',$betData);
            $kjData  = explode(',',$kjData);
            $kjData  = implode('',$kjData);
            $m       = [] ;
            preg_match($reg,$kjData,$m);
            if(!$m) return 0 ; //如果三位数没有相同,则不中奖
            $m = $m[1] ;
            $s = str_replace($m,'',$kjData) ; //不重复的位数

            $result = array_filter($betData,function($v) use($m,$s){

                if ( str_replace($m,'',$v) == $s) {
                    return true;
                } else {
                    return false ;
                }
            });
          
    } else {
        //得到投注组合号码
        array_filter(combin(str_split($betData),2),function($v) use(&$bet) {
                $bet[] = implode(',',$v) ;
        } );
        $kjData = explode(',',$kjData);

       $result = array_filter($bet,function($v) use($kjData) {
            foreach ($kjData as $data) {
                if (strpos($v,$data)===false) {
                    return false ;
                }
            }
            return true ;
        });
        
    }

    return count($result) ;

    //TODO::单选暂时还没有用到,所以保留未转换JS源码,便于日后调试
   // if(bet.indexOf(',')!=-1||reg.test(bet)){
        // // 单选处理
        // bet=bet.split(',');
        // data=data.split(',').join('');
        
        // var m=data.match(reg);
        // if(!m) return 0;        // 如果三位数没有相同，则不中奖
        // m=m[1];     // 重复位数
        // reg=new RegExp(m, 'g')
        // var s=data.replace(reg,''); // 不重复的位数
        
        // return bet.filter(function(v){
        //     //console.log('v:%s, s:%s', v, s);
        //     //console.log(reg);
        //     return v.replace(reg,'')==s;
        // }).length;
   // }else{
        // // 复选处理
        // bet=combine(bet.split(''),2).map(function(v){return v.join(',')});
        // data=data.split(',');
        // return bet.filter(function(v){
        //     var i=0;
        //     for(i in data){
        //         if(v.indexOf(data[i])==-1) return false;
        //     }
        //     return true;
        // })
        // .length;
  //  }
}

/**
 * 组二复式 
 * 
 * @param betData 投注列表：135687
 * @param kjData  开奖所需的那几位号码：87
 * @return          返回中奖注数
 */
function z2f($betData, $kjData) {
    $winStatus = 0 ; 
    $kjData1   = $kjData ;
    $kjData    = explode(',',$kjData); 
    $kjData = implode(',', array_reverse($kjData) )  ; //数组元素顺序颠倒

    array_filter(combin(str_split($betData),2), function($v) use(&$winStatus,$kjData,$kjData1) {
            $v = implode(',',$v) ; 
            if ( ($v == $kjData) || ($v==$kjData1) ) {
                ++$winStatus ;
            }
    });
    return $winStatus ;
}


/**
 * 组二单式
 *
 * @params betData 投注列表：1,3|5,6|8,7
 * @params kjData  开奖所需的那几位号码：4,5
 * @return          返回中奖注数
 */
function z2d($betData, $kjData){
    $winStatus = 0 ;
     $kjData1  = array_reverse($kjData) ;

     array_filter(explode('|',$betData), function($v) use(&$winStatus,$kjData,$kjData1) {
            if ( ($v==$kjData) || ($v==$kjData1) ) {
                ++$winStatus ;
            }
     });

    return $winStatus;
}


/**
 * 组六
 *
 * @params betData 投注列表：135687
 * @params kjData  开奖所需的那几位号码：4,5,3
 * @return         返回中奖注数
 */
function z6($betData, $kjData) {
    $winStatus = 0 ;
    $bet = [] ;
      // 豹子不算中奖
     if (preg_match('/^(\d),\1,\1/',$kjData)) return $winStatus;
    
        
        if ( strpos($betData,',')!==false ) {
                // 录入式投注
                $bet = explode(',',$betData);
        } else {
                // 点击按钮投注
                array_filter(combin(str_split($betData),3), function($v) use(&$bet) {
                    $bet[] = implode(',',$v) ;
                }) ;
        }

        array_filter($bet, function($v)  use($kjData,&$winStatus) {

             if (strpos($kjData,$v)!==false) {
               ++$winStatus;
            }
        });
      
      return $winStatus ;
}


/**
 * 大小单双
 *
 * @params bet      投注列表：大单,小单
 * @params data     开奖所需的那几位号码：4,5
 *
 * @return          返回中奖注数
 */
function dxds($betData, $kjData) {
    $kjData = explode(',',$kjData) ;
    $bets   = [] ;
    $data   = [] ; 
    
    array_filter(explode(',', $betData),function($item) use (&$bets) {
        $bets[] = mbStrSplit($item);
    } ) ;

    $descar = call_user_func_array('descartesAlgorithm', $bets) ;
   
    $data = array_filter($descar, function ($v) use($kjData,&$data) {

            $o = [
                '大'=> '56789',
                '小'=> '01234',
                '单'=> '13579',
                '双'=> '02468',
            ];

            if ( ( strpos($o[$v[0]],$kjData[0])!==false ) && ( strpos($o[$v[1]],$kjData[1])!==false ) ) {
                return true ;
            } else {
                return false ;
            }
    });
   
    return count($data) ;
}


/**
 * 组选
 * $betData = '01 02 03 04'        ;
 * $kjData  = '02,01,03,04,05'     ;
 * @param  [type] $betData [description]
 * @param  [type] $kjData  [description]
 * @return [type]          [description]
 */
function zx($betData, $kjData) {
    $m   = '';
    $reg = '/^\(([\d ]+)\)([\d ]+)$/';
    $kjData = explode(',',$kjData) ; 

    if( preg_match($reg,$betData,$m)){
        // 胆拖投注
        $d =  explode(' ',$m[1]) ;
        //判断胆拖是否在开奖号中
        foreach ($d as $val) {
            if ( !in_array($val,$kjData)) { return 0 ;}
        }
     
        $result = array_filter( combin( explode(' ',$m[2]), count($kjData)-count($d) ), function($v) use($kjData) {
                $status = true ;
                //如果有一个不满足,则整个表达式为假
                foreach ($v as $key=>$number) {
                    if ( !in_array($number,$kjData) ){
                         $status = false ; break;
                    }
                }
                return $status ;
        } );
        //未转换前源码
        // var d=m[1].split(' ');
        // if(d.some(function(c){return kj.indexOf(c)==-1})) return 0;
        // return combine(m[2].split(' '), kj.length-d.length)
        // .filter(function(v){
        //     return v.every(function(c){
        //         return kj.indexOf(c)!=-1;
        //     });
        // }).length;

    } else {
        // 普通投注
         $result = array_filter( combin(explode(' ',$betData),count($kjData)), function($v) use($kjData) {
                $count = 0; 
                foreach ($v as $betNumber) {
                   if ( in_array($betNumber,$kjData) ) {
                        ++$count ;
                   }
                }
                
                if ($count==count($v)) return true ; 
         }) ;

    }
    return count($result);
}


/**
 * 常用前选算法
 *
 * @param betData  投注列表：01,02,03,04
 * @param kjData   开奖所需的那几个：04,05
 * @param weizhu   开奖前几位数
 * @return          返回中奖注数
 */
function qs($betData, $kjData, $weishu) {
    $count   = 0 ;
    $betData = explode(',',$betData) ; 
    $kjData  = substr($kjData,0,($weishu*3-1)) ;
    $kjData  = explode(',',$kjData);

     foreach ($kjData as $key=>$val) {
         if ( strpos($betData[$key],$val)!==false ) {
                ++$count ;
         }
     }

     //指定位数的投注号码均中奖,则返回真
     return ($count==count($kjData)) ? 1 : 0 ;
}



/**
 *   任选处理
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖号码]
 * @param  [type] $num     [description]
 * @return [type]          [description]
 */
function rx($betData,$kjData,$num) {
    $m   = '' ;
    $reg = '/^\(([\d ]+)\)([\d ]+)$/';
    $bet = [] ;
    $result = [] ;
    if (preg_match($reg,$betData,$m)) {
         // 胆拖投注
         $d = explode(' ',$m[1]) ;

         //胆拖是否中奖判断
         foreach ($d as $val) {
            if ( strpos($kjData,$val)===false ) { return 0 ;}
         }

         //判断其他号码是否中奖
         $result = array_filter( combin(explode(' ',$m[2]),$num-count($d)), function($v) use($kjData,$num,$d)  {
                $count = 0 ;

                if( $num<5 ) {
                    foreach ($v as $number) {
                        if ( strpos($kjData,$number)!==false) ++$count ; 
                    }

                    if ($count==count($v)) return true; //里面的每一个元素都通过返回真

                } else {
                    $v = array_merge($v,$d); //胆拖和投注号码合并
                    $kjData = explode(',',$kjData) ;
                    //判断
                    foreach ($kjData as $kjNumber) {
                        if ( in_array($kjNumber,$v) ) ++$count ;
                    }
                    if ($count==count($v)) return true; //里面的每一个元素都通过返回真

                }
                return false ;
         });
        //  var d=m[1].split(' ');
        
        // if(d.some(function(c){return kj.indexOf(c)==-1})) return 0;
        
        // return combine(m[2].split(' '), num-d.length)
        // .filter(function(v){
        //     if(num<5){
        //         return v.every(function(c){
        //             return kj.indexOf(c)!=-1;
        //         });
        //     }else{
        //         v=v.concat(d);
        //         return kj.split(',').every(function(c){
        //             return v.indexOf(c)!=-1;
        //         });
        //     }
        // }).length; 
         
    } else {
        // 普通投注
        $bet = [] ;

        $result = array_filter( combin(explode(' ',$betData),$num) , function($v) use($kjData,$num) {
                 $count  = 0 ;
                if ( $num<5 ) {
                    //一组数据中都在开奖号码中,即为中奖
                    foreach ($v as $number) {
                        if ( strpos($kjData,$number)!==false ) {
                            ++$count ; 
                        }
                    }
                     if ($count==count($v)) return true; //里面的每一个元素都通过返回真

                } else {
                      $kjData = explode(',',$kjData) ;
                      foreach ($kjData as $kjNumber) {
                          if ( in_array($kjNumber,$v) ) {
                             ++$count ;
                          }
                      }
                       if ($count==count($v)) return true; //里面的每一个元素都通过返回真
                }
                return false ;
        });
    }

    return count($result) ; 
}


/**
 * 龙虎处理
 * @param  [type] $betData [投注号码]
 * @param  [type] $kjData  [开奖]
 * @param  [type] $num     [description]
 * @return [type]          [description]
 */
function pk10lh($betData, $kjData, $num) {
    $kjData  = explode(',',$kjData)     ;
    $total   = count($kjData); // 统计一共几个开奖号
    $val1    = intval($kjData[$num-1])  ;  //大位
    $val2    = intval($kjData[$total-$num]) ; //小位
    $betData = mbStrSplit($betData) ;
    $count   = 0 ;
    $l       = count($betData) ;

    foreach ($betData as $betNumber) {
        if ($betNumber=='龙') {
            if ($val1>$val2) ++$count; 
        } elseif ($betNumber=='虎') {
            if ($val1 < $val2) ++$count;
        }
    }

    return $count;
}


/**
 *  截取指定位数值
 * @param  [type] $kjData   [开奖数据]
 * @param  [type] $symbol   [截取符号]
 * @param  [type] $position [截取位置]
 * @return [type]           [截取后的数据]
 */
function removeFromList($kjData,$symbol,$position) {
    $arguments = func_get_args() ;
    $count     = count($arguments) ;
    $kjData    = explode($symbol,$kjData) ;

    for ( $i=2; $i<$count; $i++ ) {
         unset($kjData[$arguments[$i]-1]) ;  //这里数组的开始索引是0 所以这里有-1操作
    }

    return implode(',',$kjData) ; //转成字符串返回
}


/**
 *  将数据指定位数替换成指定符号
 * @param  [type] $content [要替换的内容]
 * @param  [type] $index   [索引位置]
 * @param  string $s       [数据分割符号]
 * @return [type]          [替换后的数据]
 */
function replaceList($kjData,$content,$index,$s=',') {
    $kjData  = explode($s,$kjData);
    $kjData[$index] = $content ;
    return implode($s,$kjData) ;
}

/**
 * 截取中文字符串
 * @param  [type]  $string [description]
 * @param  integer $len    [description]
 * @return [type]          [description]
 */
function mbStrSplit ($string, $len=1) {
  $start = 0;
  $strlen = mb_strlen($string);
  while ($strlen) {
    $array[] = mb_substr($string,$start,$len,"utf8");
    $string = mb_substr($string, $len, $strlen,"utf8");
    $strlen = mb_strlen($string);
  }
  return $array;
}

