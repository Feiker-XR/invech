//官方玩法返回 {actionData:'12,34,56', actionNum:8}; 混合玩法返回数组(后台已经处理混合,这里不需要了);
//快钱玩法返回 [{actionData:'万位-大',actionNum:1,mode:10,plid:1,bonusProp:1.98}]

var pls;//玩法的所有赔率
var plg;//当前赔率组

template.defaults.imports.dateFormat = function(date, format){/*[code..]*/};
template.defaults.imports.timestamp = function(value){return value * 1000};
template.defaults.imports.number = function(value){
	if(/^[1-9][0-9]?$/.test(value) && value<10){
		return '0' + value;
	}else{
		return value;
	}
};

function my_debug(){
	var a = 1;
	b = a + 1;
}

//一个玩法下有多种子玩法(或者说是赔率组),

//一个号码=一注,每个号码有自己的赔率; 
//UI每注一个input
function pick_dw(){
	var codes = [];
	$(".table-common input").each(function() {
        var inputMoney = $(this).val();
        if (typeof inputMoney != 'undefined' && inputMoney != '') {
        	var code = {
        		actionData:$(this).data('name'),
        		actionNum:1,
        		mode:inputMoney,
        		plid:$(this).data('plid'),
        		bonusProp:$(this).data('pl')
        	};
        	codes.push(code);
        }	
	});
	
	return codes;	
}

//N个(固定)数字为一注,注单赔率固定
//UI每注一组复选框和一个input
function pick_combin_ds(){
	var code=[], 
		len=1,
		codeLen=parseInt(this.attr('length')), 
		delimiter=this.attr('delimiter')||"";
	// console.log(this);
	if(this.has('input:checkbox:checked').length!=codeLen) throw('请选'+codeLen+'位数字');
	
	var inputMoney = $('#inputMoney').val();
	if (typeof inputMoney == 'undefined' || inputMoney == '') {
		throw('请输入投注金额');
	}

	this.each(function(i){
		var $code=$('input:checkbox:checked', this);
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
			console.log(code)
		}else{
			//len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.value);
			});
			//code[i]=code[i].join(delimiter);			
		}
	});

	var descar = DescartesAlgorithm.apply(null, code)
	// 过滤掉对子和豹子的号码
	.filter(function(v){ return (!isRepeat(v)) });

	var codes = [];	
	var plid = plg.pls[0].id;
	var bonusProp = plg.pls[0].pl;	
	var actionData;
	$.each( descar, function(i,v){
		actionData = plg.name + '-' + v.join(',');
		codes.push({actionData:actionData, actionNum:1,mode:inputMoney,plid:plid,bonusProp:bonusProp});
	});

	return codes;
}

//固定长度
function pick_combin_fs(){
	var code=[], 
		len=1,
		codeLen=parseInt(this.attr('length')), 
		delimiter=this.attr('delimiter')||"";
	// console.log(this);
	if(this.has('input:checkbox:checked').length!=codeLen) throw('请选'+codeLen+'位数字');
	
	var inputMoney = $('#inputMoney').val();
	if (typeof inputMoney == 'undefined' || inputMoney == '') {
		throw('请输入投注金额');
	}

	this.each(function(i){
		var $code=$('input:checkbox:checked', this);
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
			console.log(code)
		}else{
			len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.value);
			});
			code[i]=code[i].join(delimiter);
			
		}
	});
	
	//var pl = $('#pl');
	//var plid = pl.data('plid');
	//var bonusProp = $('#pl').text();
	var plid = plg.pls[0].id;
	var bonusProp = plg.pls[0].pl;
	var actionData = plg.name + '-' + code.join(',');
	return {actionData:actionData, actionNum:len,mode:inputMoney,plid:plid,bonusProp:bonusProp};
}

//pick_combine_fs是直选复式,pick_combine是组合
function pick_combine(){
	var code=[];

	var inputMoney = $('#inputMoney').val();
	if (typeof inputMoney == 'undefined' || inputMoney == '') {
		throw('请输入投注金额');
	}

	var pl = plg.pls[0]
	var $code = $('input:checkbox:checked', this);
	if($code.length<pl.value){
		throw('请至少选'+ pl.value +'位数字');
	}

	$code.each(function(){
		code.push(this.value);
	});
	
	var len = combine(code, pl.value).length;
	var plid = pl.id;
	var bonusProp = pl.pl;
	var actionData = plg.name + '-' + code.join(',');

	return {actionData:actionData, actionNum:len,mode:inputMoney,plid:plid,bonusProp:bonusProp};
}

//X个数字为一组=一注,赔率随所选数字个数变化;
//UI每注一组复选框和一个input
function pick_combin_one(){

}

function ssc_kq_z3(){
	
	var code=[],codeLen=parseInt(this.attr('min-len'));

	var $code=$('input:checkbox:checked', this);
	if($code.length<codeLen){
		throw('请至少选'+codeLen+'位数字');
	}

	$code.each(function(){
		code.push(this.value);
	});
	
	var index = code.length - 5;

	var plid = plg.pls[index].id;
	var bonusProp = plg.pls[index].pl;
	var actionData = plg.name + '-' + code.join(',');

	$('#pl').text(bonusProp);

	var inputMoney = $('#inputMoney').val();
	if (typeof inputMoney == 'undefined' || inputMoney == '') {
		throw('请输入投注金额');
	}

	return {actionData:actionData, actionNum:1,mode:inputMoney,plid:plid,bonusProp:bonusProp};
}

function ssc_kq_z6(){
	
	var code=[];
	var min_len = parseInt(this.attr('min-len'));
	var max_len = parseInt(this.attr('max-len'));

	var $code=$('input:checkbox:checked', this);
	if($code.length<min_len || $code.length>max_len){
		throw('请选'+min_len+'-'+max_len+'位数字');
	}

	$code.each(function(){
		code.push(this.value);
	});
	
	var index = code.length - 4;

	var plid = plg.pls[index].id;
	var bonusProp = plg.pls[index].pl;
	var actionData = plg.name + '-' + code.join(',');

	$('#pl').text(bonusProp);

	var inputMoney = $('#inputMoney').val();
	if (typeof inputMoney == 'undefined' || inputMoney == '') {
		throw('请输入投注金额');
	}

	return {actionData:actionData, actionNum:1,mode:inputMoney,plid:plid,bonusProp:bonusProp};
}


var six_nums = [
					[1,11,21,31,41],
					[2,12,22,32,42],
					[3,13,23,33,43],
					[4,14,24,34,44],
					[5,15,25,35,45],
					[6,16,26,36,46],
					[7,17,27,37,47],
					[8,18,28,38,48],
					[9,19,29,39,49],
					[10,20,30,40]
				];

function six_dw(){
	return pick_dw();
}

function six_zm(){
	return pick_dw();
}

<<<<<<< .mine
function six_lm(){
	return pick_combine();
}
||||||| .r1210
=======
function six_qbz(){
    return pick_dw();
}
>>>>>>> .r1243

//将一组赔率根据指定长度分行,一行一个数组
//数组每N个分为一小组
function group(array,sub_len){

    var index = 0;
    var newArray = [];

    while(index < array.length) {
        newArray.push(array.slice(index, index += sub_len));
    }

    return newArray;
}

function group2(array,sub_len){
		
    var index = 0;
    var newArray = [];

    while(index < array.length) {
        newArray.push(array.slice(index, index += sub_len));
        sub_len--;
    }

    return newArray;
<<<<<<< .mine
}

function group_six_sz(array){
    var newArray = [[],[],[],[],[],[],[],[],[],[]];
    for(var i=0;i<array.length;i++){
    	var ys = (i+1)%10;
    	if(0==ys){
    		ys = 10;
    	}
    	newArray[ys-1].push(array[i]);
    }
    return newArray;
}

function group_six_sm(array){
    var newArray = [[],[],[]];
    for(var i=0;i<10;i++){
    	if(i%2 == 0){
    		newArray[0].push(array[i]);
    	}else{
    		newArray[1].push(array[i]);
    	}
    }
    for(var i=10;i<array.length;i++){
    	newArray[2].push(array[i]);
    }    
    return newArray;
||||||| .r1210
=======
}

function group_six_sm(array,sub_len){
        
    var index = 0;
    var newArray = [];

    while(index < array.length) {
        newArray.push(array.slice(index, index += sub_len));
        sub_len--;
    }

    return newArray;
}

function group_six_sz(array,sub_len){
        
    var index = 0;
    var newArray = [];

    while(index < array.length) {
        newArray.push(array.slice(index, index += sub_len));
        sub_len--;
    }

    return newArray;
>>>>>>> .r1243
}