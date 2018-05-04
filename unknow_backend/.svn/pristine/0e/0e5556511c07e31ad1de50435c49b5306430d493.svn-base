<?php

//广东快乐10分开奖函数
function Klsf_Auto($num , $type){
	$zh = $num[0]+$num[1]+$num[2]+$num[3]+$num[4]+$num[5]+$num[6]+$num[7];
	if($type==1){
		return $zh;
	}
	if($type==2){
		if($zh>=85){
			return '总和大';
		}
		if($zh<=83){
			return '总和小';
		}
		if($zh==84){
			return '总和和';
		}
	}
	if($type==3){
		if($zh%2==0){
			return '总和双';
		}else{
			return '总和单';
		}
	}
	if($type==4){
		if($zh%10>=5){
			return '总和尾大';
		}else{
			return '总和尾小';
		}
	}
	if($type==5){
		if($num[0]>$num[7]){
			return '龙';
		}
		if($num[0]<$num[7]){
			return '虎';
		}
	}
}
//广东快乐10分单双
function Klsf_Ds($ball){
	if($ball%2==0){
		return '双';
	}else{
		return '单';
	}
}
//广东快乐10分大小
function Klsf_Dx($ball){
	if($ball>=11){
		return '大';
	}else{
		return '小';
	}
}
//广东快乐10分尾大小
function Klsf_Wdx($ball){
	if($ball%10>=5){
		return '尾大';
	}else{
		return '尾小';
	}
}
//广东快乐10分合单双
function Klsf_Hdx($ball){
	if(($ball%10+floor($ball/10))%2==0){
		return '合双';
	}else{
		return '合单';
	}
}
//广东快乐10分中发白
function Klsf_Zfb($ball){
	if($ball<=7){
		return '中';
	}else if($ball>=8 && $ball<=14){
		return '发';
	}else{
        return '白';
    }
}
//广东快乐10分东南西北
function Klsf_Dnxb($ball){
	if($ball%4==1){
		return '东';
    }else if($ball%4==2){
        return '南';
    }else if($ball%4==3){
        return '西';
	}else{
		return '北';
	}
}
?>