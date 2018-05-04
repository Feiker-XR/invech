<?php
namespace app\live;
class ptGame {
    public static $_BASEURL = 'https://kioskpublicapi.grandmandarin88.com';
    public static $_SSLCERT = APP_PATH.'/pt/WIN88.pem';
    public static $_SSLKEY = APP_PATH.'/pt/WIN88.key';
    public static $entity_key = 'e74e711fb4060466949dad6dbc537faa725afb36099c14f30c54c30b96418332f7e699c4d45332330bfc4427df349e3a2b18291f154c55123bd5982d980955ec';
    public static $_PREFIX = 'JP';
    public static $_KIOSKNAME = 'JP';
    public static $_ADMINNAME = 'JPADMIN';
    
    
    /**
     * 发送请求
     * @param string $url
     * @return array
     */
    public static function sendRequest($url){
        $header   = array();
        $header[] = 'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $header[] = "Cache-Control: max-age=0";
        $header[] = "Connection: keep-alive";
        $header[] = "Keep-Alive:timeout=5, max=100";
        $header[] = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.3";
        $header[] = "Accept-Language:es-ES,es;q=0.8";
        $header[] = "Pragma: ";
        $header[] = "X_ENTITY_KEY: " . self::$entity_key;
        $tuCurl = curl_init();
        curl_setopt($tuCurl, CURLOPT_URL, $url);
        curl_setopt($tuCurl, CURLOPT_PORT , 443);
        curl_setopt($tuCurl, CURLOPT_VERBOSE, 0);
        curl_setopt($tuCurl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($tuCurl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($tuCurl, CURLOPT_SSLVERSION,4);
        curl_setopt($tuCurl, CURLOPT_SSLCERT, self::$_SSLCERT);
        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($tuCurl, CURLOPT_SSLKEY, self::$_SSLKEY);
        
        $exec = curl_exec($tuCurl);
        if(curl_error($tuCurl)){
            var_dump(curl_error($tuCurl));
        }
        
        curl_close($tuCurl);
        $data = json_decode($exec, TRUE);
        return $data;
    }
}