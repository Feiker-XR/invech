<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<style type="text/css">
	.lotteryView_lhc3 .lhcBox3 dl dd.active span:first-child{
		background-color: #F13131 !important;
		color: #fff !important;
		border-color: #F13131 !important;
	}
	.lotteryView_lhc3 .lhcBox3 dl dd.active span.num{
		color: #A9A9A9 !important;
	}
	.lhcBox dl dd.active span:first-child{
		background-color: #F13131 !important;
		color: #fff !important;
		border-color: #F13131 !important;
	}
</style>
<div class="dGameStatus hklhc lotteryView_lhc3" action="tzlhcSelect" length="1">
                <div class="Contentbox" id="Contentbox_0">
				
        <div class="lhcBox3" >
				
		<dl>
			<dt>
		<span>号码</span><span style="width:76px;">赔率</span><span style="width:28px;margin-left:-8px;">选择</span>
			</dt>
		<dd>
		<span  class="sGameStatusItem">四全中</span><span class="num" style="margin-left:-5px;margin-top: -3px;" data-id="RteLM4OF4"><?=$this->getLHCRte('RteLM4OF4',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input  id="RteLM4OF4" type="radio" value="LM4OF4" rel="4" pri="<?=$this->getLHCRte('RteLM4OF4',$this->played)?>" name="txtGameItem" class="inputnoborder"></span>
		</dd>
		</dl>
			<dl>
		<dt>
		<span>号码</span><span style="width:76px;">赔率</span><span style="width:28px;margin-left:-8px;">选择</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">三全中</span><span class="num" style="margin-left:-5px;margin-top:-3px;" data-id="RteLM3OF3"><?=$this->getLHCRte('RteLM3OF3',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input id="RteLM3OF3" type="radio" value="LM3OF3" rel="3" pri="<?=$this->getLHCRte('RteLM3OF3',$this->played)?>" name="txtGameItem" class="inputnoborder"></span>
		</dd>
			</dl>
			<dl>
		<dt>
		<span>号码</span><span style="width:76px;">赔率</span><span style="width:28px;margin-left:-8px;">选择</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">三中二</span><span class="num" style="margin-left:-6px;margin-top: -3px;" data-id="RteLM2OF31"><?=$this->getLHCRte('RteLM2OF31',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input id="RteLM2OF31" type="radio" value="LM2OF3" rel="3" pri="<?=$this->getLHCRte('RteLM2OF31',$this->played)?>" name="txtGameItem" class="inputnoborder"></span>
		</dd>
			</dl>
			<dl>
		<dt>
		<span>号码</span><span style="width:76px;">赔率</span><span style="width:28px;margin-left:-8px;">选择</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">二中二</span><span class="num" style="margin-left:-6px;margin-top:-3px;" data-id="RteLMSPOF21"><?=$this->getLHCRte('RteLMSPOF21',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input id="RteLMSPOF21" type="radio" value="LM2OF2" rel="2" pri="<?=$this->getLHCRte('RteLMSPOF21',$this->played)?>" name="txtGameItem" class="inputnoborder"></span>
		</dd>
			</dl>
			<dl>
		<dt>
		<span>号码</span><span style="width:76px;">赔率</span><span style="width:28px;margin-left:-8px;">选择</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">二中特</span><span class="num" style="margin-left:-6px;margin-top:-3px;" data-id="RteLM2OF2"><?=$this->getLHCRte('RteLM2OF2',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input id="RteLM2OF2" type="radio" value="LMSPOF2" rel="2" pri="<?=$this->getLHCRte('RteLM2OF2',$this->played)?>" name="txtGameItem" class="inputnoborder"></span>
		</dd>
			</dl>	
			<dl>
		<dt>
		<span>号码</span><span style="width:76px;">赔率</span><span style="width:28px;margin-left:-8px;">选择</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">特串</span><span class="num" style="margin-left:8px;margin-top:-3px;" data-id="RteLMSPOF"><?=$this->getLHCRte('RteLMSPOF',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input id="RteLMSPOF" type="radio" value="LMSPOF" name="txtGameItem" rel="1" pri="<?=$this->getLHCRte('RteLMSPOF',$this->played)?>" class="inputnoborder"></span>
		</dd>
			</dl>			
			</div></div></div>
    
		<div class="dGameStatus hklhc lotteryView_lhc" action="tzlhcSelect" length="1">
                <div class="Contentbox" id="Contentbox_0">
        <div class="lhcBox" >	  
		<dl>
			<dt>
		<span>号码</span><span>&nbsp;</span><span style="margin-left: -7px;">选择</span>
			</dt>
		<dd>
		<span class="red">01</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="1" id="checkbox_01" name="checkbox" class="inputnoborder" acno="01"></span>
		</dd>
		<dd>
		<span class="red">02</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="2" id="checkbox_02" name="checkbox" class="inputnoborder" acno="02"></span>
		</dd><dd>
		<span class="blue">03</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="3" id="checkbox_03" name="checkbox" class="inputnoborder" acno="03"></span>
		</dd><dd>
		<span class="blue">04</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="4" id="checkbox_04" name="checkbox" class="inputnoborder" acno="04"></span>
		</dd><dd>
		<span class="green">05</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="5" id="checkbox_05" name="checkbox" class="inputnoborder" acno="05"></span>
		</dd><dd>
		<span class="green">06</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="6" id="checkbox_06" name="checkbox" class="inputnoborder" acno="06"></span>
		</dd><dd>
		<span class="red">07</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="7" id="checkbox_07" name="checkbox" class="inputnoborder" acno="07"></span>
		</dd><dd>
		<span class="red">08</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="8" id="checkbox_08" name="checkbox" class="inputnoborder" acno="08"></span>
		</dd><dd>
		<span class="blue">09</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="9" id="checkbox_09" name="checkbox" class="inputnoborder" acno="09"></span>
		</dd><dd>
		<span class="blue">10</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="10" id="checkbox_10" name="checkbox" class="inputnoborder" acno="10"></span>
		</dd></dl>
		<dl>
			<dt>
		<span>号码</span><span>&nbsp;</span><span style="margin-left: -7px;">选择</span>
			</dt>
		<dd>
		<span class="green">11</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="11" id="checkbox_11" name="checkbox" class="inputnoborder" acno="11"></span>
		</dd><dd>
		<span class="red">12</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="12" id="checkbox_12" name="checkbox" class="inputnoborder" acno="12"></span>
		</dd><dd>
		<span class="red">13</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="13" id="checkbox_13" name="checkbox" class="inputnoborder" acno="13"></span>
		</dd><dd>
		<span class="blue">14</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="14" id="checkbox_14" name="checkbox" class="inputnoborder" acno="14"></span>
		</dd><dd>
		<span class="blue">15</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="15" id="checkbox_15" name="checkbox" class="inputnoborder" acno="15"></span>
		</dd><dd>
		<span class="green">16</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="16" id="checkbox_16" name="checkbox" class="inputnoborder" acno="16"></span>
		</dd><dd>
		<span class="green">17</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="17" id="checkbox_17" name="checkbox" class="inputnoborder" acno="17"></span>
		</dd><dd>
		<span class="red">18</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="18" id="checkbox_18" name="checkbox" class="inputnoborder" acno="18"></span>
		</dd><dd>
		<span class="red">19</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="19" id="checkbox_19" name="checkbox" class="inputnoborder" acno="19"></span>
		</dd><dd>
		<span class="blue">20</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="20" id="checkbox_20" name="checkbox" class="inputnoborder" acno="20"></span>
		</dd></dl>
		<dl>
			<dt>
		<span>号码</span><span>&nbsp;</span><span style="margin-left: -7px;">选择</span>
			</dt>
		<dd>
		<span class="green">21</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="21" id="checkbox_21" name="checkbox" class="inputnoborder" acno="21"></span>
		</dd><dd>
		<span class="green">22</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="22" id="checkbox_22" name="checkbox" class="inputnoborder" acno="22"></span>
		</dd><dd>
		<span class="red">23</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="23" id="checkbox_23" name="checkbox" class="inputnoborder" acno="23"></span>
		</dd><dd>
		<span class="red">24</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="24" id="checkbox_24" name="checkbox" class="inputnoborder" acno="24"></span>
		</dd><dd>
		<span class="blue">25</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="25" id="checkbox_25" name="checkbox" class="inputnoborder" acno="25"></span>
		</dd><dd>
		<span class="blue">26</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="26" id="checkbox_26" name="checkbox" class="inputnoborder" acno="26"></span>
		</dd><dd>
		<span class="green">27</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="27" id="checkbox_27" name="checkbox" class="inputnoborder" acno="27"></span>
		</dd><dd>
		<span class="green">28</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="28" id="checkbox_28" name="checkbox" class="inputnoborder" acno="28"></span>
		</dd><dd>
		<span class="red">29</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="29" id="checkbox_29" name="checkbox" class="inputnoborder" acno="29"></span>
		</dd><dd>
		<span class="red">30</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="30" id="checkbox_30" name="checkbox" class="inputnoborder" acno="30"></span>
		</dd></dl>
		<dl>
			<dt>
		<span>号码</span><span>&nbsp;</span><span style="margin-left: -7px;">选择</span>
			</dt>
		<dd>
		<span class="blue">31</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="31" id="checkbox_31" name="checkbox" class="inputnoborder" acno="31"></span>
		</dd><dd>
		<span class="green">32</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="32" id="checkbox_32" name="checkbox" class="inputnoborder" acno="32"></span>
		</dd><dd>
		<span class="green">33</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="33" id="checkbox_33" name="checkbox" class="inputnoborder" acno="33"></span>
		</dd><dd>
		<span class="red">34</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="34" id="checkbox_34" name="checkbox" class="inputnoborder" acno="34"></span>
		</dd><dd>
		<span class="red">35</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="35" id="checkbox_35" name="checkbox" class="inputnoborder" acno="35"></span>
		</dd><dd>
		<span class="blue">36</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="36" id="checkbox_36" name="checkbox" class="inputnoborder" acno="36"></span>
		</dd><dd>
		<span class="blue">37</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="37" id="checkbox_37" name="checkbox" class="inputnoborder" acno="37"></span>
		</dd><dd>
		<span class="green">38</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="38" id="checkbox_38" name="checkbox" class="inputnoborder" acno="38"></span>
		</dd><dd>
		<span class="green">39</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="39" id="checkbox_39" name="checkbox" class="inputnoborder" acno="39"></span>
		</dd><dd>
		<span class="red">40</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="40" id="checkbox_40" name="checkbox" class="inputnoborder" acno="40"></span>
		</dd></dl>
		<dl style="border-bottom: 1px solid #e0e0e0">
			<dt>
		<span>号码</span><span>&nbsp;</span><span style="margin-left: -7px;">选择</span>
			</dt>
		<dd>
		<span class="blue">41</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="41" id="checkbox_41" name="checkbox" class="inputnoborder" acno="41"></span>
		</dd><dd>
		<span class="blue">42</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="42" id="checkbox_42" name="checkbox" class="inputnoborder" acno="42"></span>
		</dd><dd>
		<span class="green">43</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="43" id="checkbox_43" name="checkbox" class="inputnoborder" acno="43"></span>
		</dd><dd>
		<span class="green">44</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="44" id="checkbox_44" name="checkbox" class="inputnoborder" acno="44"></span>
		</dd><dd>
		<span class="red">45</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="45" id="checkbox_45" name="checkbox" class="inputnoborder" acno="45"></span>
		</dd><dd>
		<span class="red">46</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="46" id="checkbox_46" name="checkbox" class="inputnoborder" acno="46"></span>
		</dd><dd>
		<span class="blue">47</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="47" id="checkbox_47" name="checkbox" class="inputnoborder" acno="47"></span>
		</dd><dd>
		<span class="blue">48</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="48" id="checkbox_48" name="checkbox" class="inputnoborder" acno="48"></span>
		</dd>
		<dd>
		<span class="green">49</span><span class="num"></span>
		<span class="input"><input type="checkbox" value="49" id="checkbox_49" name="checkbox" class="inputnoborder" acno="49"></span>
		</dd><dd>
		</dd>
		</dl>
		
		
    </div>    
		</div>
     </div>
		
	    <div id="dResult">
		
        <input type="hidden" id="txtRate" value="0">
        	<div class="anniu-wrapper">	
		        <input type="button" value="重设" onclick="resetTotal();" class="anniu" name="重设">
		        <input type="button" value="确定" onclick="checkToSubmit();" class="anniu" name="确定">
           </div> 
   <div class="chooseMsg1">
   <span>元</span><span id="sTotalCredit" style="padding:0 5px; color: #CA1A1A;">0</span><span>总金额共</span>
        <input type="text" name="sTotalBeishu" id="sTotalBeishu" value="1" class="beishu" />
        <span>倍数</span>
    </div>
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