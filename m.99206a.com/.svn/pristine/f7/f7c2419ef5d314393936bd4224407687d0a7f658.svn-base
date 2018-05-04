<?php
namespace app\pay\bqpay;
/**
 * Description of Util
 *
 * @author Administrator
 */
class Util {    
    /**
     * 获取验签值
     */
    public static function GetMd5str($Parm,$Key){
        $prestr = self::CreateLinkstring(self::ArgSort($Parm));     	//把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $mysgin = strtoupper(md5($prestr."&". strtoupper(md5($Key))));			    //把最终的字符串签名，获得签名结果
        return $mysgin; 
    }
    /**对数组排序
	*$array 排序前的数组
	*return 排序后的数组
    */
    public static function ArgSort($array) 
    {   ksort($array);
        reset($array);
        return $array;
    }
    
    
    /**
    *把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
	*$array 需要拼接的数组
	*return 拼接完成以后的字符串
    */
    public static function CreateLinkstring($array) 
    {
        $arg  = "";
        while (list ($key, $val) = each ($array)){            
            if($val !=''){
                $arg.=$key."=".$val."&";
            }            
        }
        $arg = substr($arg,0,count($arg)-2);		     //去掉最后一个&字符
        return $arg;
    }
    
    
    
}
