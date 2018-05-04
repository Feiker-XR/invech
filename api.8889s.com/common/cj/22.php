<?php
$url = "http://www.hg008.com/app/member/FT_browse/body_var.php?uid=7e8cce233839261df675ra1&rtype=r&langx=zh-tw&mtype=3&delay=&league_id=&showtype=";
$user_agent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36';
$curl = curl_init(); //开启curl
curl_setopt($curl, CURLOPT_URL, $url); //设置请求地址
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  //是否输出 1 or true 是不输出 0  or false输出
curl_setopt($curl,CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)"); 
curl_setopt($curl,CURLOPT_REFERER,"http://www.hg008.com/app/member/FT_browse/index.php?rtype=r&uid=7e8cce233839261df675ra1&langx=zh-tw&mtype=4&showtype=&league_id=");
//curl_setopt($curl,CURLOPT_COOKIE,"username_cookie=qjyj123; PHPSESSID=lavsfi1gimn2pb3bs4r4fqi8j5; visid_incap_850101=+EyFf4ZuQoyjfmZTexa296f7mVcAAAAAQUIPAAAAAAAMgqA5U1iXOKonwUmeQTiV; incap_ses_434_850101=B4X5f2kHZSs9QJRTyOAFBo9cmlcAAAAAnrj/OgfhtmQqjxw9A1tJfw==; safedog-flow-item=31B969D3612AEC6687CED0D5D3353CED; _gat_UA-56284225-1=1; _ga=GA1.2.1543329215.1469709219");
curl_setopt($curl, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest"));
$data = curl_exec($curl);
if($data){
	file_put_contents(dirname(__FILE__)."/ct.txt",$data);
	echo '采集成功';
}else{
	echo '采集失败';
}