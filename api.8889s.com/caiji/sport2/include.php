<?php
$cookie_path = dirname(__FILE__) . "/cache/cookies.txt";
$db_path = dirname(__FILE__).'/../db/';
include ($db_path.'mysqli.php');
$class_path = dirname(__FILE__).'/../../common/';
if(file_exists($class_path."pub_library.php")){
    include_once($class_path."pub_library.php");
}
if(file_exists($class_path.'curl_http.php')){
    //include_once($class_path."curl_http.php");
}
if(file_exists($class_path.'http.class.php')){
    include_once($class_path."http.class.php");
}
if(file_exists($class_path."function.php")){
    include_once($class_path."function.php");
}
include_once(dirname(__FILE__)."/db.php");