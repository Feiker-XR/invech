<?
require ("config.inc.php");
$qi =intval($_REQUEST['qihao']);
$uid =intval($_REQUEST['uid']);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<link href="/style/agents/control_down.css" rel="stylesheet" type="text/css">
</head>
<body>
<?
$mysql = "select * from lottery_k_3d where qihao=".$qi;
$myresult = mysql_db_query($dbname,$mysql);
$mycou = mysql_num_rows($myresult);
$myrow = mysql_fetch_array($myresult);
if ($mycou==0){
	echo "当前期数开奖号码未录入！";
	exit;
	}
$bw = $myrow['hm1'];
$sw = $myrow['hm2'];
$gw = $myrow['hm3'];
$dxbsg = $bw.$sw.$gw;
$dxbs = $bw.$sw;
$dxbg = $bw.$gw;
$dxsg = $sw.$gw;
if ($bw==$sw || $bw==$gw || $sw==$gw){
	$z3z6="组三";
	}else{
	$z3z6="组六";
	}
$hmhz = $bw+$sw+$gw;
$sql = "select * from lottery_data where atype='3d' and mid='".$qi."' and bet_ok=0 order by ID asc";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)){
$wins=$row['money']*$row['odds']-$row['money'];
//开始结算单选
if ($row['btype']=="单选"){
	//开始判断注单分类是否为三位
	if ($row['ctype']=="三位"){
		//开始判断注单内容是否跟开奖号码一致，一致则中奖
		if ($row['content']==$dxbsg){
			//注单中奖，修改注单状态
			$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("单选三位注单中奖修改失败".$row['id']."");
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
			mysql_db_query($dbname,$msql) or die ("单选三位会员加奖失败".$row['username']."");
			}else{
			//注单未中奖，修改注单状态
			$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("单选三位注单未中奖修改失败".$row['id']."");
				}	
		}
	//开始判断注单分类是否为二位
	if ($row['ctype']=="二位"){
		//开始判断注单细分类是否为百十
		if ($row['dtype']=="百十"){
			//开始判断注单内容是否跟开奖号码一致,一致则中奖
			if ($row['content']==$dxbs){
				//如果中奖,修改注单状态
				$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
				mysql_db_query($dbname,$msql) or die ("单选二位百十注单中奖修改失败".$row['id']."");
				//注单中奖，给会员账户增加奖金
				$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
				mysql_db_query($dbname,$msql) or die ("单选二位百十会员加奖失败".$row['username']."");
				}else{
				//注单未中奖，修改注单状态
				$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
				mysql_db_query($dbname,$msql) or die ("单选二位百十注单未中奖修改失败".$row['id']."");
				}
			}
		//开始判断注单细分类是否为百个
		if ($row['dtype']=="百个"){
			if ($row['content']==$dxbg){
				//如果中奖,修改注单状态
				$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
				mysql_db_query($dbname,$msql) or die ("单选二位百个注单中奖修改失败".$row['id']."");
				//注单中奖，给会员账户增加奖金
				$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
				mysql_db_query($dbname,$msql) or die ("单选二位百个会员加奖失败".$row['username']."");
				}else{
				//注单未中奖，修改注单状态
				$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
				mysql_db_query($dbname,$msql) or die ("单选二位百个注单未中奖修改失败".$row['id']."");
				}
			}
		//开始判断注单细分类是否为十个
		if ($row['dtype']=="十个"){
			if ($row['content']==$dxsg){
				//如果中奖,修改注单状态
				$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
				mysql_db_query($dbname,$msql) or die ("单选二位十个注单中奖修改失败".$row['id']."");
				//注单中奖，给会员账户增加奖金
				$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
				mysql_db_query($dbname,$msql) or die ("单选二位十个会员加奖失败".$row['username']."");
				}else{
				//注单未中奖，修改注单状态
				$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
				mysql_db_query($dbname,$msql) or die ("单选二位十个注单未中奖修改失败".$row['id']."");
				}
			}
		}
	//开始判断注单分类是否为一位
	if ($row['ctype']=="一位"){
		//开始判断注单细分类是否为百十
		if ($row['dtype']=="百"){
			//开始判断注单内容是否跟开奖号码一致,一致则中奖
			if ($row['content']==$bw){
				//如果中奖,修改注单状态
				$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
				mysql_db_query($dbname,$msql) or die ("单选一位百注单中奖修改失败".$row['id']."");
				//注单中奖，给会员账户增加奖金
				$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
				mysql_db_query($dbname,$msql) or die ("单选一位百会员加奖失败".$row['username']."");
				}else{
				//注单未中奖，修改注单状态
				$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
				mysql_db_query($dbname,$msql) or die ("单选一位百注单未中奖修改失败".$row['id']."");
				}
			}
		//开始判断注单细分类是否为十
		if ($row['dtype']=="十"){
			if ($row['content']==$sw){
				//如果中奖,修改注单状态
				$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
				mysql_db_query($dbname,$msql) or die ("单选一位十注单中奖修改失败".$row['id']."");
				//注单中奖，给会员账户增加奖金
				$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
				mysql_db_query($dbname,$msql) or die ("单选一位十会员加奖失败".$row['username']."");
				}else{
				//注单未中奖，修改注单状态
				$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
				mysql_db_query($dbname,$msql) or die ("单选一位十注单未中奖修改失败".$row['id']."");
				}
			}
		//开始判断注单细分类是否为个
		if ($row['dtype']=="个"){
			if ($row['content']==$gw){
				//如果中奖,修改注单状态
				$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
				mysql_db_query($dbname,$msql) or die ("单选一位个注单中奖修改失败".$row['id']."");
				//注单中奖，给会员账户增加奖金
				$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
				mysql_db_query($dbname,$msql) or die ("单选一位个会员加奖失败".$row['username']."");
				}else{
				//注单未中奖，修改注单状态
				$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
				mysql_db_query($dbname,$msql) or die ("单选一位个注单未中奖修改失败".$row['id']."");
				}
			}
		}
	}
//开始结算组一
if ($row['btype']=="组一"){
	if ($row['content']==$bw || $row['content']==$sw || $row['content']==$gw){
		//如果中奖,修改注单状态
		$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
		mysql_db_query($dbname,$msql) or die ("组一注单中奖修改失败".$row['id']."");
		//注单中奖，给会员账户增加奖金
		$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
		mysql_db_query($dbname,$msql) or die ("组一会员加奖失败".$row['username']."");
		}else{
		//注单未中奖，修改注单状态
		$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
		mysql_db_query($dbname,$msql) or die ("组一注单未中奖修改失败".$row['id']."");
		}
	}
//开始结算组二
if ($row['btype']=="组二"){
	$z2hm1=substr($row['content'],0,1);
	$z2hm2=substr($row['content'],1,1);
		//对子开始结算
		if ($row['content']==$bw.$sw || $row['content']==$bw.$gw || $row['content']==$sw.$gw || $row['content']==$sw.$bw || $row['content']==$bw.$gw || $row['content']==$gw.$sw || $row['content']==$gw.$bw){
		//如果中奖,修改注单状态
		$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
		mysql_db_query($dbname,$msql) or die ("组二注单中奖修改失败".$row['id']."");
		//注单中奖，给会员账户增加奖金
		$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
		mysql_db_query($dbname,$msql) or die ("组二会员加奖失败".$row['username']."");
		}else{
		//注单未中奖，修改注单状态
		$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
		mysql_db_query($dbname,$msql) or die ("组二注单未中奖修改失败".$row['id']."");
		}
	}
//开始结算组三
if ($row['btype']=="组三"){
	$z3hm1=substr($row['content'],0,1);
	$z3hm2=substr($row['content'],1,1);
	$z3hm3=substr($row['content'],2,1);
	//开始判断开奖号是组三还是组六
	if($z3z6=="组三"){
		//如果是组三，开始核对注单内容是否中奖
		if (($z3hm1==$bw || $z3hm1==$sw || $z3hm1==$gw) && ($z3hm2==$bw || $z3hm2==$sw || $z3hm2==$gw) && ($z3hm3==$bw || $z3hm3==$sw || $z3hm3==$gw)){
		//如果中奖,修改注单状态
		$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
		mysql_db_query($dbname,$msql) or die ("组三注单中奖修改失败".$row['id']."");
		//注单中奖，给会员账户增加奖金
		$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
		mysql_db_query($dbname,$msql) or die ("组三会员加奖失败".$row['username']."");
		}else{
		//注单未中奖，修改注单状态
		$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
		mysql_db_query($dbname,$msql) or die ("组三注单未中奖修改失败".$row['id']."");
		}
		}else{
		//如果不是组三，则开奖号码为组六，那么所有组三的注单都视为没有中奖
		//注单未中奖，修改注单状态
		$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
		mysql_db_query($dbname,$msql) or die ("组三注单未中奖修改失败".$row['id']."");
		}
	}
//开始结算组六
if ($row['btype']=="组六"){
	$z6hm1=substr($row['content'],0,1);
	$z6hm2=substr($row['content'],1,1);
	$z6hm3=substr($row['content'],2,1);
	//开始判断开奖号是组三还是组六
	if($z3z6=="组六"){
		//如果是组六，开始核对注单内容是否中奖
		if (($z6hm1==$bw || $z6hm1==$sw || $z6hm1==$gw) && ($z6hm2==$bw || $z6hm2==$sw || $z6hm2==$gw) && ($z6hm3==$bw || $z6hm3==$sw || $z6hm3==$gw)){
		//如果中奖,修改注单状态
		$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
		mysql_db_query($dbname,$msql) or die ("组六注单中奖修改失败".$row['id']."");
		//注单中奖，给会员账户增加奖金
		$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
		mysql_db_query($dbname,$msql) or die ("组六会员加奖失败".$row['username']."");
		}else{
		//注单未中奖，修改注单状态
		$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
		mysql_db_query($dbname,$msql) or die ("组六注单未中奖修改失败".$row['id']."");
		}
		}else{
		//如果不是组六，则开奖号码为组三，那么所有组六的注单都视为没有中奖
		//注单未中奖，修改注单状态
		$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
		mysql_db_query($dbname,$msql) or die ("组六注单未中奖修改失败".$row['id']."");
		}
	}
//结算跨度
if ($row['btype']=="跨度"){
	//取出开奖号码的最大号,最小号
	$zuida=0;
	$zuixiao=10;
	for ($i=1; $i<=3; $i++){
		if ($zuida<$myrow['hm'.$i.'']){
			$zuida=$myrow['hm'.$i.''];
			}
		if ($zuixiao>$myrow['hm'.$i.'']){
			$zuixiao=$myrow['hm'.$i.''];
			}
		}
	//利用最大号-最小号得出跨度值
	$kd=$zuida-$zuixiao;
	//开始核对注单内容是否中奖
	if ($row['content']==$kd){
		//如果中奖,修改注单状态
		$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
		mysql_db_query($dbname,$msql) or die ("跨度注单中奖修改失败".$row['id']."");
		//注单中奖，给会员账户增加奖金
		$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
		mysql_db_query($dbname,$msql) or die ("跨度会员加奖失败".$row['username']."");
		}else{
		//注单未中奖，修改注单状态
		$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
		mysql_db_query($dbname,$msql) or die ("跨度注单未中奖修改失败".$row['id']."");
		}
	}
//开始结算和值
if ($row['btype']=="和值"){
	//判断注单内容是否单选
	if($row['ctype']<28 && $row['dtype']=="单选"){
		if ($row['content']==$hmhz){
			//如果中奖,修改注单状态
			$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("和值单选注单中奖修改失败".$row['id']."");
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
			mysql_db_query($dbname,$msql) or die ("和值单选会员加奖失败".$row['username']."");
			}else{
			//注单未中奖，修改注单状态
			$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("和值单选注单未中奖修改失败".$row['id']."");
		}
	}
	//判断注单内容是否为区域
	if($row['dtype']=="区域"){
		$hzrr=explode(",",$row['content']);
		if ($hzrr[0]==$hmhz || $hzrr[1]==$hmhz || $hzrr[2]==$hmhz || $hzrr[3]==$hmhz){
			//如果中奖,修改注单状态
			$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("和值区域注单中奖修改失败".$row['id']."");
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
			mysql_db_query($dbname,$msql) or die ("和值区域会员加奖失败".$row['username']."");
			}else{
			//注单未中奖，修改注单状态
			$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("和值区域注单未中奖修改失败".$row['id']."");
		}
	}
	//判断注单内容是否为单双
	if($row['ctype']=="单" || $row['ctype']=="双"){
		if ($hmhz % 2==0){
			$hzds="双";
			}else{
			$hzds="单";
				}
		if ($row['content']==$hzds){
			//如果中奖,修改注单状态
			$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("和值单双注单中奖修改失败".$row['id']."");
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
			mysql_db_query($dbname,$msql) or die ("和值单双会员加奖失败".$row['username']."");
			}else{
			//注单未中奖，修改注单状态
			$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("和值单双注单未中奖修改失败".$row['id']."");
		}
	}
	//判断注单内容是否为大小
	if($row['ctype']=="大" || $row['ctype']=="小"){
		if ($hmhz>13){
			$hzdx="大";
			}else{
			$hzdx="小";
				}
		if ($row['content']==$hzdx){
			//如果中奖,修改注单状态
			$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("和值大小注单中奖修改失败".$row['id']."");
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
			mysql_db_query($dbname,$msql) or die ("和值大小会员加奖失败".$row['username']."");
			}else{
			//注单未中奖，修改注单状态
			$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("和值大小注单未中奖修改失败".$row['id']."");
		}
	}
	}
//开始结算百十个单双大小
if ($row['btype']=="单双大小"){
	//开始判断分类玩法是否为百位
	if($row['dtype']=="百位"){
		//判断注单内容是否为单双
	if($row['content']=="单" || $row['content']=="双"){
		if ($bw % 2==0){
			$bwds="双";
			}else{
			$bwds="单";
				}
		if ($row['content']==$bwds){
			//如果中奖,修改注单状态
			$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("百位单双注单中奖修改失败".$row['id']."");
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
			mysql_db_query($dbname,$msql) or die ("百位单双会员加奖失败".$row['username']."");
			}else{
			//注单未中奖，修改注单状态
			$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("百位单双注单未中奖修改失败".$row['id']."");
		}
	}
	//判断注单内容是否为大小
	if($row['content']=="大" || $row['content']=="小"){
		if ($bw>4){
			$bwdx="大";
			}else{
			$bwdx="小";
				}
		if ($row['content']==$bwdx){
			//如果中奖,修改注单状态
			$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("百位大小注单中奖修改失败".$row['id']."");
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
			mysql_db_query($dbname,$msql) or die ("百位大小会员加奖失败".$row['username']."");
			}else{
			//注单未中奖，修改注单状态
			$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("百位大小注单未中奖修改失败".$row['id']."");
		}
		}
		}
	//开始判断分类玩法是否为十位
	if($row['dtype']=="十位"){
		//判断注单内容是否为单双
	if($row['content']=="单" || $row['content']=="双"){
		if ($sw % 2==0){
			$swds="双";
			}else{
			$swds="单";
				}
		if ($row['content']==$swds){
			//如果中奖,修改注单状态
			$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("十位单双注单中奖修改失败".$row['id']."");
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
			mysql_db_query($dbname,$msql) or die ("十位单双会员加奖失败".$row['username']."");
			}else{
			//注单未中奖，修改注单状态
			$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("十位单双注单未中奖修改失败".$row['id']."");
		}
	}
	//判断注单内容是否为大小
	if($row['content']=="大" || $row['content']=="小"){
		if ($sw>4){
			$swdx="大";
			}else{
			$swdx="小";
				}
		if ($row['content']==$swdx){
			//如果中奖,修改注单状态
			$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("十位大小注单中奖修改失败".$row['id']."");
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
			mysql_db_query($dbname,$msql) or die ("十位大小会员加奖失败".$row['username']."");
			}else{
			//注单未中奖，修改注单状态
			$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("十位大小注单未中奖修改失败".$row['id']."");
		}
		}
		}
	//开始判断分类玩法是否为个位
	if($row['dtype']=="个位"){
		//判断注单内容是否为单双
	if($row['content']=="单" || $row['content']=="双"){
		if ($gw % 2==0){
			$gwds="双";
			}else{
			$gwds="单";
				}
		if ($row['content']==$gwds){
			//如果中奖,修改注单状态
			$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("个位单双注单中奖修改失败".$row['id']."");
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
			mysql_db_query($dbname,$msql) or die ("个位单双会员加奖失败".$row['username']."");
			}else{
			//注单未中奖，修改注单状态
			$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("个位单双注单未中奖修改失败".$row['id']."");
		}
	}
	//判断注单内容是否为大小
	if($row['content']=="大" || $row['content']=="小"){
		if ($gw>4){
			$gwdx="大";
			}else{
			$gwdx="小";
				}
		if ($row['content']==$gwdx){
			//如果中奖,修改注单状态
			$msql="update lottery_data set win='".$wins."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("个位大小注单中奖修改失败".$row['id']."");
			//注单中奖，给会员账户增加奖金
			$msql="update k_user set money=money+".$row['money']*$row['odds']." where username='".$row['username']."'";
			mysql_db_query($dbname,$msql) or die ("个位大小会员加奖失败".$row['username']."");
			}else{
			//注单未中奖，修改注单状态
			$msql="update lottery_data set win='-".$row['money']."',bet_ok=1 where id='".$row['id']."'";
			mysql_db_query($dbname,$msql) or die ("个位大小注单未中奖修改失败".$row['id']."");
		}
		}
		}
	}
//
}
$msql="update lottery_k_3d set ok=1 where qihao=".$qi;
mysql_db_query($dbname,$msql) or die ("修改期數狀態失敗");
?>
</body>
</html>