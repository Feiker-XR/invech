<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">    
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>走地数据采集页面</title>
 <style type="text/css">
<!--
body,td,th {
    font-size: 12px;
}
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
-->
</style></head>
<script type="text/javascript" language="javascript">
var lqgq=0; //篮球滚球采集标识0
var once=1; //第几次进入此页面
</script>
<body>
     <iframe src="lqgq2.php" name="lqgqFrame" id="lqgqFrame" title="lqgqFrame" frameborder=0 width="100%" scrolling=no height=30 ></iframe>
<script type="text/javascript" language="javascript">

function check(){
    if(once > 1){ //不是第一次进入此页面
        if(lqgq != 1){ //篮球滚球页面可能已卡死，需要重新刷新
            window.lqgqFrame.location.href="lqgq2.php";
        }
    }
    once = 2; //已经执行过一次了，不是第一次进入这个页面
    lqgq = 0;
}

setInterval("check()",3000); //自动验证页面是否卡死时间，1秒=1000
</script>
</body>
</html>
