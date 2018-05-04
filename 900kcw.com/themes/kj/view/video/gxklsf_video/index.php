<?php 
$url ='http://kj.kai861.com/view/video/gxklsf_video/index.html?'.substr(strstr($_SERVER['REQUEST_URI'], '?'), 1);


echo yu($url);   //授权成功



function yu($url,$data = null){
    $user_agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36';
    $host = array("Host:dianying.2345.com ");
    $ref = 'http://dianying.2345.com/ ';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_REFERER, $ref);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}



 ?>