
//}}}

//{{{ 相关算法集
/**
 * 笛卡尔乘积算法
 *
 * @params 一个可变参数，原则上每个都是数组，但如果数组只有一个值是直接用这个值
 *
 * useage:
 * console.log(DescartesAlgorithm(2, [4,5], [6,0],[7,8,9]));
 */
function DescartesAlgorithm(){
	var i,j,a=[],b=[],c=[];
	if(arguments.length==1){
		if(!$.isArray(arguments[0])){
			return [arguments[0]];
		}else{
			return arguments[0];
		}
	}
	
	if(arguments.length>2){
		for(i=0;i<arguments.length-1;i++) a[i]=arguments[i];
		b=arguments[i];
		
		return arguments.callee(arguments.callee.apply(null, a), b);
	}

	if($.isArray(arguments[0])){
		a=arguments[0];
	}else{
		a=[arguments[0]];
	}
	if($.isArray(arguments[1])){
		b=arguments[1];
	}else{
		b=[arguments[1]];
	}

	for(i=0; i<a.length; i++){
		for(j=0; j<b.length; j++){
			if($.isArray(a[i])){
				c.push(a[i].concat(b[j]));
			}else{
				c.push([a[i],b[j]]);
			}
		}
	}
	
	return c;
}

/**
 * 组合算法
 *
 * @params Array arr		备选数组
 * @params Int num
 *
 * @return Array			组合
 *
 * useage:  combine([1,2,3,4,5,6,7,8,9], 3);
 */
function combine(arr, num) {
	var r = [];
	(function f(t, a, n) {
		if (n == 0) return r.push(t);
		for (var i = 0, l = a.length; i <= l - n; i++) {
			f(t.concat(a[i]), a.slice(i + 1), n - 1);
		}
	})([], arr, num);
	return r;
}

/**
 * 排列算法
 */
function permutation(arr, num){
	var r=[];
	(function f(t,a,n){
		if (n==0) return r.push(t);
		for (var i=0,l=a.length; i<l; i++){
			f(t.concat(a[i]), a.slice(0,i).concat(a.slice(i+1)), n-1);
		}
	})([],arr,num);
	return r;
}

//}}}

//{{{ 抢庄玩法相关函数
function gameLoadZnzPage(type){
	$('.game-left.img-bj').load('/Index.php/index/znz/'+type);
}

//}}}

//{{{ 计算注数算法集
	
/**
 * 全选号码
 *
 * @params			没有参数，函数的this指向$('#num-select')
 * @return			要求返回一个对象{actionData:"1,23,4,5,6",actionNum:2}
 * @throw			遇到不正常时请抛出，系统会自动处理
 */
function tzAllSelect(){
	var code=[], len=1,codeLen=parseInt(this.attr('length')), delimiter=this.attr('delimiter')||"";
	
	
	//console.log(this.has('.checked'));
	if(this.has('.checked').length!=codeLen) throw('请选'+codeLen+'位数字');
	
	this.each(function(i){
		console.log(i);
		var $code=$('a.code.checked', this);
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
		}else{
			len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.innerHTML);
			});
			code[i]=code[i].join(delimiter);
            console.log("run here");
		}
	});
	
	return {actionData:code.join(','), actionNum:len};
}

/**
 * 排列组选2  除去对子和豹子
 */
function tzDesAlgorSelect(){
	var code=[], len=1,codeLen=parseInt(this.attr('length')), delimiter=this.attr('delimiter')||"";
	
	
	//throw(this.has('.checked')[0]);
	if(this.has('.checked').length!=codeLen) throw('请选'+codeLen+'位数字');
	
	this.each(function(i){
		//console.log(i);
		var $code=$('a.code.checked', this);
		
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
		}else{
			//len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.innerHTML);
			});
			code[i]=code[i].join(delimiter);
			
		}
	});
	code=code.join(',');
	//console.log(code);
	// 笛卡尔乘取得所投的号码
	len=DescartesAlgorithm.apply(null, code.split(",").map(function(v){return v.split(delimiter)}))
	
	// 把号码由数组变成字符串，以便比较
	.map(function(v){ return v.join(','); })
	
	// 过滤掉对子和豹子的号码
	.filter(function(v){ return (!isRepeat(v.split(","))) })  //v.match(/^(\\d)\\1{"+(codeLen-1)+"}/)
	
	// 返回中奖号码的总数
	.length;
	
	return {actionData:code, actionNum:len};
	
}


/**
 * 5星组选60
 */
function tz5xzx60Select(){
	var code=[], len=0,codeLen=this.attr('length'), delimiter=this.attr('delimiter')||"";
	
	
	//throw(this.has('.checked')[0]);
	
	
	this.each(function(i){
		//console.log(i);
		var $code=$('a.code.checked', this);
		
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
		}else{
			//len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.innerHTML);
			});
			code[i]=code[i].join(delimiter);
			
		}
	});
	code=code.join(',');
	if(code.split(",")[0].length<codeLen.split(',')[0] || code.split(",")[1].length<codeLen.split(",")[1]) throw('二重号至少'+codeLen.split(",")[0]+'位数字，单号至少'+codeLen.split(",")[1]+'位数字');
	
	//计算注数
	code.split(",")[0].split("").filter(function(v){
		len += combine(code.split(",")[1].replace(v,""),3).length
	});
	
	return {actionData:code, actionNum:len};
	
}



/**
 * 5星组选30
 */
function tz5xzx30Select(){
	var code=[], len=0,codeLen=this.attr('length'), delimiter=this.attr('delimiter')||"";
	
	
	//throw(this.has('.checked')[0]);
	
	
	this.each(function(i){
		//console.log(i);
		var $code=$('a.code.checked', this);
		
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
		}else{
			//len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.innerHTML);
			});
			code[i]=code[i].join(delimiter);
			
		}
	});
	code=code.join(',');
	if(code.split(",")[0].length<codeLen.split(',')[0] || code.split(",")[1].length<codeLen.split(",")[1]) throw('二重号至少'+codeLen.split(",")[0]+'位数字，单号至少'+codeLen.split(",")[1]+'位数字');
	
	//计算注数
	code.split(",")[1].split("").filter(function(v){
		len += combine(code.split(",")[0].replace(v,""),2).length
	});
	
	return {actionData:code, actionNum:len};
	
}

/**
 * 5星组选20
 */
function tz5xzx20Select(){
	var code=[], len=0,codeLen=this.attr('length'), delimiter=this.attr('delimiter')||"";
	
	
	//throw(this.has('.checked')[0]);
	
	
	this.each(function(i){
		//console.log(i);
		var $code=$('a.code.checked', this);
		
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
		}else{
			//len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.innerHTML);
			});
			code[i]=code[i].join(delimiter);
			
		}
	});
	code=code.join(',');
	if(code.split(",")[0].length<codeLen.split(',')[0] || code.split(",")[1].length<codeLen.split(",")[1]) throw('三重号至少'+codeLen.split(",")[0]+'位数字，单号至少'+codeLen.split(",")[1]+'位数字');
	
	//计算注数
	code.split(",")[0].split("").filter(function(v){
		len += combine(code.split(",")[1].replace(v,""),2).length
	});
	
	return {actionData:code, actionNum:len};
	
}

/**
 * 5星组选10
 */
function tz5xzx10Select(){
	var code=[], len=0,codeLen=this.attr('length'), delimiter=this.attr('delimiter')||"";
	
	
	//throw(this.has('.checked')[0]);
	
	
	this.each(function(i){
		//console.log(i);
		var $code=$('a.code.checked', this);
		
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
		}else{
			//len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.innerHTML);
			});
			code[i]=code[i].join(delimiter);
			
		}
	});
	code=code.join(',');
	if(code.split(",")[0].length<codeLen.split(',')[0] || code.split(",")[1].length<codeLen.split(",")[1]) throw('三重号至少'+codeLen.split(",")[0]+'位数字，二重号至少'+codeLen.split(",")[1]+'位数字');
	
	//计算注数
	code.split(",")[0].split("").filter(function(v){
		len += combine(code.split(",")[1].replace(v,""),1).length
	});
	
	return {actionData:code, actionNum:len};
	
}


/**
 * 5星组选5
 */
function tz5xzx5Select(){
	var code=[], len=0,codeLen=this.attr('length'), delimiter=this.attr('delimiter')||"";
	
	
	//throw(this.has('.checked')[0]);
	
	
	this.each(function(i){
		//console.log(i);
		var $code=$('a.code.checked', this);
		
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
		}else{
			//len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.innerHTML);
			});
			code[i]=code[i].join(delimiter);
			
		}
	});
	code=code.join(',');
	if(code.split(",")[0].length<codeLen.split(',')[0] || code.split(",")[1].length<codeLen.split(",")[1]) throw('四重号至少'+codeLen.split(",")[0]+'位数字，单号至少'+codeLen.split(",")[1]+'位数字');
	
	//计算注数
	code.split(",")[0].split("").filter(function(v){
		len += combine(code.split(",")[1].replace(v,""),1).length
	});
	
	return {actionData:code, actionNum:len};
	
}


//是否有重复值
  function isRepeat(arr){  
      
         var hash = {};  
      
         for(var i in arr) {  
      
             if(hash[arr[i]])  
      
                  return true;  
      
             hash[arr[i]] = true;  
      
         }  
      
         return false;  
      
    }  

/**
 * 大小单双选号
 *
 * @params			没有参数，函数的this指向$('#num-select')
 * @return			要求返回一个对象{actionData:"1,23,4,5,6",actionNum:2}
 * @throw			遇到不正常时请抛出，系统会自动处理
 */
function tzDXDS(){
	var code=[], len=1,codeLen=2;
	
	
	//console.log(this.has('.checked'));
	if(this.has('.checked').length!=codeLen) throw('请选'+codeLen+'位数字');
	
	this.each(function(i){
		//console.log(i);
		var $code=$('a.code.checked', this);
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
		}else{
			len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.innerHTML);
			});
			code[i]=code[i].join("");
			
		}
	});
	
	return {actionData:code.join(','), actionNum:len};
}

/**
 * 五星定位胆选号
 *
 * @params			没有参数，函数的this指向$('#num-select')
 * @return			要求返回一个对象{actionData:"1,23,4,5,6",actionNum:2}
 * @throw			遇到不正常时请抛出，系统会自动处理
 */
function tz5xDwei(){
	var code=[], len=0, delimiter=this.attr('delimiter')||"";
	
	
	//console.log(this.has('.checked'));
	//if(this.has('.checked').length!=codeLen) throw('请选'+codeLen+'位数字');
	
	this.each(function(i){
		//console.log(i);
		var $code=$('a.code.checked', this);
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
		}else{
			len+=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.innerHTML);
			});
			code[i]=code[i].join(delimiter);
			
		}
	});
	
	if(!len) throw('至少选一个号码');
	
	return {actionData:code.join(','), actionNum:len};
}

/**
 * 不定胆选号
 *
 * @params			没有参数，函数的this指向$('#num-select')
 * @return			要求返回一个对象{actionData:"1,23,4,5,6",actionNum:2}
 * @throw			遇到不正常时请抛出，系统会自动处理
 */
function tz5xBDwei(){
	var code="", len=0, $code=$('a.code.checked', this);
	len=$code.length;
	if(!len) throw('至少选一个号码');
	
	$code.each(function(){
		code+=this.innerHTML;
	});
	//console.log(code);
	return {actionData:code, actionNum:len};
}

/**
 * 时时彩录入式投注
 * 这种方式投注时可共享DOM和length属性
 */
function tzSscInput(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],
	str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	
	codes=codes.map(function(code){
		return code.split("").join(',')
	});
	
	return {actionData:codes.join('|'), actionNum:codes.length}
}

/**
 * 11选5录入式投注
 * 这种方式投注时可共享DOM和length属性
 */
function tz11x5Input(){
	var codeLen=parseInt(this.attr('length'))*2,
	codes=[],
	ncode,
	str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	
	
	codes=codes.map(function(code){
		code=code.split("");
		ncode="";
		c="";
		code.forEach(function(v,i){
			if(i % 2==0 && ncode){	
				 ncode+=","+v;
				 c="";
			}else{ 
				 ncode+=v;
				 c+=v;
			}
			if(parseInt(c)>11 || parseInt(c)<1)
				throw('输入的数字应在01-11之间');
		});
		
		return ncode;
	});
	
	return {actionData:codes.join('|'), actionNum:codes.length}
}

	
//{{{ 游戏相关函数
/**
 * 快速选择唯一选择
 */
function uniqueSelect(parent){
	var $this=$(this),$unique=parent.closest('.unique'),
	fun=function(i,c){
		return $('a.code.checked[value='+this.innerHTML+']').length?'':'checked';
	};
	
	
	if($this.is('.all')){
		// 全－全部选中
		$('a.code',parent).addClass(fun);
	}else if($this.is('.large')){
		// 大－选中5到9
		$('a.code.max',parent).addClass(fun);
		$('a.code.min',parent).removeClass('checked');
	}else if($this.is('.small')){
		// 小－选中0到4
		$('a.code.min',parent).addClass(fun);
		$('a.code.max',parent).removeClass('checked');
	}else if($this.is('.odd')){
		// 单－选中单数
		$('a.code.d',parent).addClass(fun);
		$('a.code.s',parent).removeClass('checked');
	}else if($this.is('.even')){
		// 双－选中双数
		$('a.code.s',parent).addClass(fun);
		$('a.code.d',parent).removeClass('checked');
	}else if($this.is('.none')){
		// 清－全不选
		$('a.code',parent).removeClass('checked');
	}
}

/**
 * 时时彩录入式组选投注
 * 这种方式投注时可共享DOM和length属性
 */
function tzSscZuInput(){
	var codeLen=parseInt(this.attr('length')),
	codes=[];
	$('#textarea-code',this).val().split(/[\r\n]/).forEach(function(str){
		if(str.length && str.length % codeLen == 0){
			if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
			codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
		}else{
			throw('输入号码不正确');
		}
	});
	
	codes.forEach(function(code){
		if((new RegExp("^(\\d)\\1{"+(codeLen-1)+"}$")).test(code)) throw('组选不能为豹子');
	});
	
	codes=codes.map(function(code){
		return code.split("").join(',')
	});

	return {actionData:codes.join('|'), actionNum:codes.length}
}

/**
 * 时时彩录入式选位数投注
 * 这种方式投注时可共享DOM和length属性
 */
function tzSscWeiInput(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],weiShu=[],
	str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	
	if($('#wei-shu :checked',this).length!=codeLen) throw('请选'+codeLen+'位数');
	$('#wei-shu :checkbox',this).each(function(i){
		if(!this.checked) weiShu.push(i);
	});

	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	
	
	codes=codes.map(function(code){
		code=code.split("");
		
		weiShu.forEach(function(v,i){
			code.splice(v, 0, '-');
		});
		
		return code.join(',');
	});

	return {actionData:codes.join('|'), actionNum:codes.length}
}

/**
 * 11选5录入式选位数投注
 * 这种方式投注时可共享DOM和length属性
 */
function tz11x5WeiInput(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],weiShu=[],ncode,
	str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	
	if($('#wei-shu :checked',this).length!=codeLen) throw('请选'+codeLen+'位数');
	$('#wei-shu :checkbox',this).each(function(i){
		if(!this.checked) weiShu.push(i);
	});
	codeLen*=2;
	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	
		codes=codes.map(function(code){
		code=code.split("");
		ncode="";
		code.forEach(function(v,i){
			if(i % 2==0 && ncode){	
				 ncode+=","+v;
			}else{ 
				 ncode+=v;
			}
		});
		
		ncode=ncode.split(",");
		weiShu.forEach(function(v,i){
			ncode.splice(v, 0, '-');
		});
		
		return ncode;
	});
		

	return {actionData:codes.join('|'), actionNum:codes.length}
}

/**
 * 时时彩录入式组选位数投注
 * 这种方式投注时可共享DOM和length属性
 */
function tzSscZuWeiInput(){
	var codeLen=parseInt(this.attr('length')),
	codes=[],weiShu=[],
	str=$('#textarea-code',this).val().replace(/[^\d]/g,'');
	
	if($('#wei-shu :checked',this).length!=codeLen) throw('请选'+codeLen+'位数');
	$('#wei-shu :checkbox',this).each(function(i){
		if(!this.checked) weiShu.push(i);
	});
	

	if(str.length && str.length % codeLen == 0){
		if(/[^\d]/.test(str)) throw('投注有错，不能有数字以外的字符。');
		codes=codes.concat(str.match(new RegExp('\\d{'+codeLen+'}', 'g')));
	}else{
		throw('输入号码不正确');
	}
	
	
	codes.forEach(function(code){
		if((new RegExp("^(\\d)\\1{"+(codeLen-1)+"}$")).test(code)) throw('组选不能为豹子');
	});
	
	codes=codes.map(function(code){
		code=code.split("");
		
		weiShu.forEach(function(v,i){
			code.splice(v, 0, '-');
		});
		
		return code.join(',');
	});

	return {actionData:codes.join('|'), actionNum:codes.length};
}


/**
 * 组合组选
 */
function tzCombineSelect(){
	var codeLen=parseInt(this.attr('length')),
	codes='', $select=$('.checked'),len;
	
	if($select.length<codeLen) throw('请选'+codeLen+'位数');
	
	$select.each(function(){
		codes+=this.innerHTML;
	});
	
	len=combine(codes.split(""), codeLen).length;
	
	return {actionData:codes, actionNum:len};
}

/**
 * 任4-组选24
 */
function tzCombineSelect24(){
	var codeLen=parseInt(this.attr('length')),
	codes='', $select=$('.checked'),len;
	
	if($select.length<codeLen) throw('请选'+codeLen+'位数');
	
	$select.each(function(){
		codes+=this.innerHTML;
	});
	
	len=combine(codes.split(""), codeLen).length;
	
	return {actionData:codes, actionNum:len};
}


/**
 * 任4-组选12
 */
function tzCombineSelect12(){
	var code=[], len=0,codeLen=this.attr('length'), delimiter=this.attr('delimiter')||"";
	
	this.each(function(i){
		//console.log(i);
		var $code=$('a.code.checked', this);
		
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
		}else{
			//len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.innerHTML);
			});
			code[i]=code[i].join(delimiter);
			
		}
	});
	code=code.join(',');
	if(code.split(",")[0].length<codeLen.split(',')[0] || code.split(",")[1].length<codeLen.split(",")[1]) throw('二重号至少'+codeLen.split(",")[0]+'位数字，单号至少'+codeLen.split(",")[1]+'位数字');
	
	//计算注数
	code.split(",")[0].split("").filter(function(v){
		len += combine(code.split(",")[1].replace(v,""),2).length
	});
	
	return {actionData:code, actionNum:len};
}


/**
 * 任4-组选6
 */
function tzCombineSelect6(){
	var code=[], len=0,codeLen=this.attr('length'), delimiter=this.attr('delimiter')||"";
	
	this.each(function(i){
		//console.log(i);
		var $code=$('a.code.checked', this);
		
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
		}else{
			//len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.innerHTML);
			});
			code[i]=code[i].join(delimiter);
			
		}
	});
	code=code.join(',');
	if(code.split(",")[0].length<codeLen.split(',')[0]) throw('二重号至少'+codeLen.split(",")[0]+'位数字');
	
	//计算注数	
	len += combine(code.split(",")[0],2).length;

	
	return {actionData:code, actionNum:len};
}


/**
 * 任4-组选4
 */
function tzCombineSelect4(){
	var code=[], len=0,codeLen=this.attr('length'), delimiter=this.attr('delimiter')||"";
	
	this.each(function(i){
		//console.log(i);
		var $code=$('a.code.checked', this);
		
		if($code.length==0){
			//throw('选择号码不正确');
			code[i]='-';
		}else{
			//len*=$code.length;
			code[i]=[];
			$code.each(function(){
				code[i].push(this.innerHTML);
			});
			code[i]=code[i].join(delimiter);
			
		}
	});
	code=code.join(',');
	if(code.split(",")[0].length<codeLen.split(',')[0] || code.split(",")[1].length<codeLen.split(",")[1]) throw('三重号至少'+codeLen.split(",")[0]+'位数字，单号至少'+codeLen.split(",")[1]+'位数字');
	
	//计算注数
	code.split(",")[0].split("").filter(function(v){
		len += combine(code.split(",")[1].replace(v,""),1).length
	});
	
	return {actionData:code, actionNum:len};
}


/**
 * 排列组选
 */
function tzPermutationSelect(){
	var codeLen=(this.attr('length')),
	codes='', $select=$('.checked'),len;
	
	if($select.length<codeLen) throw('请选'+codeLen+'位数');
	
	$select.each(function(){
		codes+=this.innerHTML;
	});
	
	len=permutation(codes.split(""), codeLen).length;
	
	return {actionData:codes, actionNum:len};
}


/**
 * 混合组选录入式投注
 */
function tzSscHhzxInput(){
	var codeList=$('#textarea-code').val(),		// 输入号码列表
	played=this.attr('played'),					// 玩法：前、后、任选
	z3=[],			// 分解出来的组三列表
	z6=[];			// 分解出来的组六列表
	
	var o={"前":[16,17],"后":[19,20],"任选":[22,23]};
	
	if(played=='任选' && $('#wei-shu :checked',this).length!=3) throw('请选3位数');
	
	
	codeList=codeList.replace(/[^\d]/gm,'');
	if(codeList.length==0) throw('请输入号码');
	if(codeList.length % 3) throw('输入号码不正确');
	
	codeList.replace(/[^\d]/gm,'').match(/\d{3}/g).forEach(function(code){
		var reg=/(\d)(.*)\1/;
		if(/(\d)\1{2}/.test(code)){
			throw('组选不能为豹子');
		}else if(reg.test(code)){
			// 组三
			//z3.push(code.replace(reg,'$1$2'));
			z3.push(code);
		}else{
			// 组六
			z6.push(code);
		}
	});
	
	if(z3.length && z6.length){
		return [{playedId:o[played][0], playedName:played+'三组三', actionData:z3.join(','), actionNum:z3.length, isZ6:false},
				{playedId:o[played][1], playedName:played+'三组六', actionData:z6.join(','), actionNum:z6.length, isZ6:true}];
	}else if(z3.length){
		return {playedId:o[played][0], playedName:played+'三组三', actionData:z3.join(','), actionNum:z3.length, isZ6:false};
	}else if(z6.length){
		return {playedId:o[played][1], playedName:played+'三组六', actionData:z6.join(','), actionNum:z6.length, isZ6:true};
	}
}

/**
 * 十一选五任选玩法投注
 */
function tz11x5Select(){
	var code=[], len=1,codeLen=parseInt(this.attr('length')),sType=!!$('.dantuo :radio:checked').val();
	//console.log(this);
	
	if(sType){
		// 胆拖方式
		var $d=$(this).filter(':visible:first'),
		$t=$d.next(),
		dLen=$('.code.checked', $d).length;
		
		if(dLen==0){
			throw('至少选一位胆码');
		}else if(dLen>=codeLen){
			throw('最多只能选择'+(codeLen-1)+'个胆码');
		//}else if(dLen==1){
		//	$(':input:visible.code.checked').each(function(i,o){
		//		code[i]=o.value;
		//	});
		//	if(code.length<codeLen) throw('胆码和拖码至少选择'+codeLen+'位数');
		//	
		//	return {actionData:code.join(' '), actionNum:combine(code, codeLen).length};
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.innerHTML;
			});
			
			$('.code.checked', $t).each(function(i,o){
				tCode[i]=o.innerHTML;
			});
			
			len=combine(tCode, codeLen-dCode.length).length;
			return {actionData:'('+dCode.join(' ')+')'+tCode.join(' '), actionNum:len};
		}
	}else{
		// 普通方式
		$('a.code.checked').each(function(i,o){
			//console.log(i);
			code[i]=o.innerHTML;
		});
		if(code.length<codeLen) throw('至少选择'+codeLen+'位数');
		
		return {actionData:code.join(' '), actionNum:combine(code, codeLen).length};
	}
}

//}}}

/**
 * 快乐十分任选玩法投注
 */
function tzKLSFSelect(){
	var code=[], len=1,codeLen=parseInt(this.attr('length')),sType=!!$('.dantuo :radio:checked').val();
	//console.log(this);
	
	if(sType){
		// 胆拖方式
		var $d=$(this).filter(':visible:first'),
		$t=$d.next(),
		dLen=$('.code.checked', $d).length;
		
		if(dLen==0){
			throw('至少选一位胆码');
		}else if(dLen>=codeLen){
			throw('最多只能选择'+(codeLen-1)+'个胆码');
		//}else if(dLen==1){
		//	$(':input:visible.code.checked').each(function(i,o){
		//		code[i]=o.value;
		//	});
		//	if(code.length<codeLen) throw('胆码和拖码至少选择'+codeLen+'位数');
		//	
		//	return {actionData:code.join(' '), actionNum:combine(code, codeLen).length};
		}else{
			var dCode=[],tCode=[];
			$('.code.checked', $d).each(function(i,o){
				dCode[i]=o.innerHTML;
			});
			
			$('.code.checked', $t).each(function(i,o){
				tCode[i]=o.innerHTML;
			});
			
			len=combine(tCode, codeLen-dCode.length).length;
			return {actionData:'('+dCode.join(' ')+')'+tCode.join(' '), actionNum:len};
		}
	}else{
		// 普通方式
		$(':a:visible.code.checked').each(function(i,o){
			//console.log(i);
			code[i]=o.innerHTML;
		});
		if(code.length<codeLen) throw('至少选择'+codeLen+'位数');
		
		return {actionData:code.join(' '), actionNum:combine(code, codeLen).length};
	}
}

//}}}

//{{{随机投注函数集

/**
 * 时时彩随机投注函数
 * 
 * @params num		投机投几注，默认为1，可以设置为5，选几位数由HTML属性length得
 * @return			要求返回一个对象{actionData:"1,23,4,5,6",actionNum:2}
 *
 */
/*
function sscRandom(num){
	var i, j, code, codes=[], codeLen=parseInt(this.attr('length'));
	
	for(i=0; i<num; i++){
		
		code=[];
		for(j=0; j<codeLen; j++){
			code.push(Math.floor(Math.random()*10));
		}
		
		codes[i]=code;
	}
	
	return {actionData:codes.join('|'), actionNum:codes.length};
}
*/
//}}}

//随机数 GetRandomNum(1,6)
function GetRandomNum(Min,Max)
{   
	var Range = Max - Min;   
	var Rand = Math.random();   
	return(Min + Math.round(Rand * Range));   
}   
