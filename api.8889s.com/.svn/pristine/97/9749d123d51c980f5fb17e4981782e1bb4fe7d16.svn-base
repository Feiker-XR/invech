<?php
include('config.php');
unset($mysqlis);
$mysqlis = new MySQLi(DB_HOST,DB_USER,DB_PWD,DB_SPORT);
$mysqlis->query("set names utf8");

//if (!get_magic_quotes_gpc()) {
!empty($_POST)     && Add_S_S($_POST);
!empty($_GET)     && Add_S_S($_GET);
!empty($_COOKIE) && Add_S_S($_COOKIE);
//    !empty($_SESSION) && Add_S_S($_SESSION);
//}
!empty($_FILES) && Add_S_S($_FILES);

function Add_S_S(&$array){
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            if (!is_array($value)) {
                $value= 		@addslashes($value);
                $array[$key] = @htmlspecialchars($value,ENT_QUOTES);

            } else {
                Add_S_S($array[$key]);
            }
        }
    }
}