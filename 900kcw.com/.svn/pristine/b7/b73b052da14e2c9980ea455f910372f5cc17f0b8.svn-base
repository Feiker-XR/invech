<?php 


$url ='http://kj.kai861.com/view/klsf_list.html?'.$_SERVER["QUERY_STRING"];

header( 'Content-Type:text/html;charset=UTF-8 ');
 function curl_get_https($url){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding:gzip'));
            curl_setopt($ch, CURLOPT_ENCODING, "gzip");
            $res = curl_exec($ch);
            curl_close($ch) ;
            return $res;
         
        }

echo curl_get_https($url);

 ?>