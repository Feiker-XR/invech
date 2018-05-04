<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<style type="text/css">
	.lotteryView_sxtw .sxtwBox dl dd.active{
		background-color: #F13131;
		border-color: #F13031;
	}
	.lotteryView_sxtw .sxtwBox dl dd.active span{
		color: #fff;
	}
</style>
<script>
function checkANM(idStr){
	$("#sxController dd input").attr("checked",false);
	
	if(idStr){
		$("input[name='txtBP']").attr("checked",false);
		switch(idStr){
			case "O":
				var len=$("input[name='txtBP']").length;
				for(var i=0; i<len; i++){
					if($("input[name='txtBP']:eq("+i+")").attr("oe")==idStr){
						$("input[name='txtBP']:eq("+i+")").attr("checked",true);
					}
				}
			break;	
			
			case "E":
				var len=$("input[name='txtBP']").length;
				for(var i=0; i<len; i++){
					if($("input[name='txtBP']:eq("+i+")").attr("oe")==idStr){
						$("input[name='txtBP']:eq("+i+")").attr("checked",true);
					}
				}
			break;	

			
			default:
				var sid=idStr.split(",");
				for(var i=0; i<sid.length; i++){
					$("#ANM"+sid[i]).attr("checked",true);
				}
			break;
			
		}
		
	}
	setCheck();
	lhcGameMsgAutoTip();
}
</script>




	<div class="dGameStatus hklhc lotteryView_sxtw" action="tzlhcSelect" length="1">
		<div class="Contentbox" id="Contentbox_0">
		<table class="sQuickmenu">
            <tbody><tr>
              <td>
                <p class="select-quick">快速选择</p>
                <a onclick="checkANM('01,02,03,04,05,06'); return false;" href="#">前肖</a>
                <a onclick="checkANM('07,08,09,10,11,12'); return false;" href="#">后肖</a>
                <a onclick="checkANM('02,04,05,07,09,12'); return false;" href="#">天肖</a>
                <a onclick="checkANM('01,03,06,08,10,11'); return false;" href="#">地肖</a>
                <a onclick="checkANM('01,03,04,05,06,09'); return false;" href="#">野兽</a>
                <a onclick="checkANM('02,07,08,10,11,12'); return false;" href="#">家禽</a>
                <a onclick="checkANM('O'); return false;" href="#">单</a>
                <a onclick="checkANM('E'); return false;" href="#">双</a>
              </td>
            </tr>
        </tbody></table>
			<div class="sxtwBox" >
		
		<div class="dGameStatus hklhc lotteryView_lhc1" action="tzlhcSelect" length="1">
                <div class="Contentbox" id="Contentbox_0">
        <div class="lhcBox1" >
		<dl id="pController">
			<dt>
				<span style="margin-left:13px;">类别</span><span style="margin-left:13px;">赔率</span><span style="margin-left:14px;">选择</span>
			</dt>
			<dd>
				<span class="sGameStatusItem">二肖碰</span><span class="num" style="margin-left:12px;" data-id="RteSNBP2"><?=$this->getLHCRte('RteSNBP2',$this->played)?></span>
				<span class="input" style="margin-left:-3px;"><input style="margin-left:28px;"  type="radio" value="SNBP2" name="txtGameItem" rel="2" pri="<?=$this->getLHCRte('RteSNBP2',$this->played)?>" class="inputnoborder"></span>
			</dd>
			<dd>
				<span class="sGameStatusItem">三肖碰</span><span class="num" style="margin-left:12px;" data-id="RteSNBP3"><?=$this->getLHCRte('RteSNBP3',$this->played)?></span>
				<span class="input" style="margin-left:-3px;"><input style="margin-left:28px;" type="radio" value="SNBP3" name="txtGameItem" rel="3" pri="<?=$this->getLHCRte('RteSNBP3',$this->played)?>" class="inputnoborder"></span>
			</dd>
			<dd>
				<span id="LOTTOTBSOED" class="sGameStatusItem">四肖碰</span><span class="num" style="margin-left:12px;" data-id="RteSNBP4"><?=$this->getLHCRte('RteSNBP4',$this->played)?></span>
				<span class="input" style="margin-left:-3px;"><input style="margin-left:28px;" type="radio" value="SNBP4" name="txtGameItem" rel="4" pri="<?=$this->getLHCRte('RteSNBP4',$this->played)?>" class="inputnoborder"></span>
			</dd>
			<dd>
				<span id="LOTTOTBSOEO" class="sGameStatusItem">五肖碰</span><span class="num" style="margin-left:12px;" data-id="RteSNBP5"><?=$this->getLHCRte('RteSNBP5',$this->played)?></span>
				<span class="input" style="margin-left:-3px;"><input style="margin-left:28px;" type="radio" value="SNBP5" name="txtGameItem" rel="5" pri="<?=$this->getLHCRte('RteSNBP5',$this->played)?>" class="inputnoborder"></span>
			</dd>
		</dl>
			<dl>
		<dt>
		<span style="margin-left:13px;">类别</span><span style="margin-left:13px;">赔率</span><span style="margin-left:14px;">选择</span>
			</dt>
		
			</dl>
			<dl>
		<dt>
		<span style="margin-left:13px;">类别</span><span style="margin-left:13px;">赔率</span><span style="margin-left:14px;">选择</span>
			</dt>
		
			</dl>
			<dl>
		<dt>
		<span style="margin-left:13px;">类别</span><span style="margin-left:13px;">赔率</span><span style="margin-left:14px;">选择</span>
			</dt>
		
			</dl>

    
		</div>
                 
         </div>
              </div>
			  
			  
			  
		<dl id="sxController">
			<dt>
		<span>生肖</span><span style="margin-left:50px;">号码</span><span style="margin-left:111px;">&nbsp;</span><span>选择</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">鼠</span><span style="margin-left: 30px;" class="blue">10</span><span class="green">22</span><span class="green">34</span><span class="red">46</span><span style="margin-left:60px;" class="num"></span>
		<span class="input"><input type="checkbox" oe="O" value="01" id="ANM01" name="txtBP" class="inputnoborder" acno="鼠"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">牛</span><span style="margin-left: 30px;" class="red">09</span><span class="blue">21</span><span class="green">33</span><span class="green">45</span><span style="margin-left:60px;" class="num"></span>
		<span class="input"><input type="checkbox" oe="E" value="02" id="ANM02" name="txtBP" class="inputnoborder" acno="牛"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">虎</span><span style="margin-left: 30px;" class="red">08</span><span class="red">20</span><span class="blue">32</span><span class="green">44</span><span style="margin-left:60px;" class="num"></span>
		<span class="input"><input type="checkbox" oe="O" value="03" id="ANM03" name="txtBP" class="inputnoborder" acno="虎"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">兔</span><span style="margin-left: 30px;" class="green">07</span><span class="red">19</span><span class="red">31</span><span class="blue">43</span><span style="margin-left:60px;" class="num"></span>
		<span class="input"><input type="checkbox" oe="E" value="04" id="ANM04" name="txtBP" class="inputnoborder" acno="兔"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">龙</span><span style="margin-left: 30px;" class="green">06</span><span class="green">18</span><span class="red">30</span><span class="blue">42</span><span style="margin-left:60px;" class="num"></span>
		<span class="input"><input type="checkbox" oe="O" value="05" id="ANM05" name="txtBP" class="inputnoborder" acno="龙"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">蛇</span><span style="margin-left: 30px;" class="blue">05</span><span class="green">17</span><span class="green">29</span><span class="red">41</span><span style="margin-left:60px;" class="num"></span>
		<span class="input"><input type="checkbox" oe="E" value="06" id="ANM06" name="txtBP" class="inputnoborder" acno="蛇"></span>
		</dd>
		</dl>
		<dl>
			<dt>
		<span>生肖</span><span style="margin-left:50px;">号码</span><span style="margin-left:111px;">&nbsp;</span><span>选择</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">马</span><span style="margin-left: 30px;" class="blue">04</span><span class="blue">16</span><span class="green">28</span><span class="green">40</span><span style="margin-left:60px;" class="num"></span>
		<span class="input"><input type="checkbox" oe="O" value="07" id="ANM07" name="txtBP" class="inputnoborder" acno="马"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">羊</span><span style="margin-left: 30px;" class="red">03</span><span class="blue">15</span><span class="blue">27</span><span class="green">39</span><span style="margin-left:60px;" class="num"></span>
		<span class="input"><input type="checkbox" oe="E" value="08" id="ANM08" name="txtBP" class="inputnoborder" acno="羊"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">鸡</span><span style="margin-left: 30px;" class="red">01</span><span class="red">13</span><span class="blue">25</span><span class="blue">37</span><span class="green">49</span><span style="margin-left:27px;" class="num"></span>
		<span class="input"><input type="checkbox" oe="O" value="09" id="ANM09" name="txtBP" class="inputnoborder" acno="鸡"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">猴</span><span style="margin-left: 30px;" class="red">02</span><span class="red">14</span><span class="blue">26</span><span class="blue">38</span><span style="margin-left:60px;" class="num"></span>
		<span class="input"><input type="checkbox" oe="E" value="10" id="ANM10" name="txtBP" class="inputnoborder" acno="猴"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">狗</span><span style="margin-left: 30px;" class="green">12</span><span class="red">24</span><span class="red">36</span><span class="blue">48</span><span style="margin-left:60px;" class="num"></span>
		<span class="input"><input type="checkbox" oe="O" value="11" id="ANM11" name="txtBP" class="inputnoborder" acno="狗"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">猪</span><span style="margin-left: 30px;" class="blue">11</span><span class="green">23</span><span class="red">35</span><span class="red">47</span><span style="margin-left:60px;" class="num"></span>
		<span class="input"><input type="checkbox" oe="E" value="12" id="ANM12" name="txtBP" class="inputnoborder" acno="猪"></span>
		</dd>
		</dl>
		   
			  </div>  
			  </div>
            </div>
			
	    <div id="dResult">
		
        <input type="hidden" id="txtRate" value="0">
      	<div class="anniu-wrapper">
      		<input type="button" value="重设" onclick="resetTotal();" class="anniu" name="重设"/>
        	<input type="button" value="确定" onclick="checkToSubmit();" class="anniu" name="确定"/>
      	</div>
      </div>	
        
            
   <div class="chooseMsg1">
   <span>元</span><span id="sTotalCredit" style="color: #CA1A1A;padding:0 5px;">0</span><span>总金额共</span>
        <input type="text" name="sTotalBeishu" id="sTotalBeishu" value="1" class="beishu" />
        <span>倍数</span>
    </div>
    <script>
    	$("table.sQuickmenu td a").click(function(){
    		$(this).addClass("checked").siblings().removeClass("checked");
    	})
    </script>
    
<script>

    $(".Contentbox dd").click(function(){
    	if($(this).find("input").attr("checked") == false || $(this).find("input").attr("checked") == undefined){
    		$(this).find("input").attr("checked",true);
    	}else{
    		$(this).find("input").attr("checked",false);
    	};
    	if($(this).find("input").attr("pri")){
    		resetPlayedPL($(this).find("input").attr("pri"));
    	}
    	setCheck();
    });
    
    
  /*  
    $("#pController input").click(function(){
    	$("#sxController dd input").attr("checked",false);
    })*/
    $(".Contentbox dd input").click(function(e){
    	e.stopPropagation();
    	resetPlayedPL($(this).attr("pri"));
    	 setCheck();
    })
    function setCheck(){

    	 var inputs = $('.Contentbox dd input');
    	 for(var i = 0;i<inputs.length;i++){
    		if($(inputs[i]).attr("checked") == undefined){
    			$(inputs[i]).parents("dd").removeClass("active");
    		}else{
    			if($(inputs[i]).attr("checked")==true || $(inputs[i]).prop("checked") == true){
	    			$(inputs[i]).parents("dd").addClass("active");
	    		}else{
	    			$(inputs[i]).parents("dd").removeClass("active");
	    		}
    		}
    		
    	}
    }
		
	
	
</script>