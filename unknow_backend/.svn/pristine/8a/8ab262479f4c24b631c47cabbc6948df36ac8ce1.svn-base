<?
session_start();
$services = array();
$services[0] = "api1.jieshuiwt.com";
$services[1] = "api2.jieshuiwt.com";

function get_service() {
	global $services;
	$arrcur = array();
	$arrcur[0] = $_SESSION["apiid"];
	if ($arrcur[0]) {
		$arrcur[1] = $services[$arrcur[0]];
	} else {
		$randno = rand(0,count($services)-1);
		$arrcur[0] = $randno;
		$arrcur[1] = $services[$randno];
		$_SESSION["apiid"] = $randno;
	}

	return $arrcur;
}

function fetch_nextservice($curid) {
	global $services;
	$curid = $curid+1;
	if ($curid >= count($services)) {
		$curid = 0;
	}
	$arrcur = array();
	$arrcur[0] = $curid;
	$arrcur[1] = $services[$curid];
	$_SESSION["apiid"] = $curid;

	return $arrcur;
}

$arrcur = array();
$arrcur = get_service();

$i = 0;
$data = "error";
while($i<count($services) && $data=="error"){
	$curl = &new Curl_HTTP_Client();
	$url = "http://$arrcur[1]/ok.php?_t=".time();
	$data = @$curl->fetch_url($url);
	
	if($data!="1"){
		$data = "error";
		$i++;
		$arrcur = fetch_nextservice($arrcur[0]);
	}
}
?>