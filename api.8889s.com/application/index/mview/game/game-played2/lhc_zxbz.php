<input type="hidden" name="playedGroup" value="<?=$this->groupId?>" />
<input type="hidden" name="playedId" value="<?=$this->played?>" />
<input type="hidden" name="type" value="<?=$this->type?>" />
<style type="text/css">
	.lotteryView_lhc4 .lhcBox4 dl dd.active span:first-child{
		background-color: #F13131 !important;
		color: #fff !important;
		border-color: #F13131 !important;
	}
	.lotteryView_lhc4 .lhcBox4 dl dd.active span.num{
		color: #A9A9A9 !important;
	}
	.lotteryView_lhc5 .lhcBox5 dl dd.active span:first-child{
		background-color: #F13131 !important;
		color: #fff !important;
		border-color: #F13131 !important;
	}
</style>
<div class="dGameStatus lotteryView_lhc4">
        
                <div class="Contentbox" id="Contentbox_0">
        <div class="specialtr lhcBox4" >
		
		<table>
            <tbody>
		<dl class="clearfix">
			<dt>
		<span>类型</span><span style="width:76px;margin-left:16px;">赔率</span><span style="width:28px;margin-left:-6px;">金额</span>
			</dt>
		<dd>
		<span id="RteNOHIT5" class="sGameStatusItem">五不中</span><span class="num" style="margin-left:12px;" data-id="RteNOHIT5"><?=$this->getLHCRte('RteNOHIT5',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input id="RteNOHIT5" type="radio" value="NOHIT5" name="txtGameItem" rel="5" pri="<?=$this->getLHCRte('RteNOHIT5',$this->played)?>" maxlen="500" class="inputnoborder"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">六不中</span><span class="num" style="margin-left:12px;" data-id="RteNOHIT6"><?=$this->getLHCRte('RteNOHIT6',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input type="radio" value="NOHIT6" name="txtGameItem" rel="6" pri="<?=$this->getLHCRte('RteNOHIT6',$this->played)?>" maxlen="450" class="inputnoborder"></span>
		</dd>
		</dl>
			<dl>
		<dt>
		<span>类型</span><span style="width:76px;margin-left:16px;">赔率</span><span style="width:28px;margin-left:-6px;">金额</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">七不中</span><span class="num" style="margin-left:12px;" data-id="RteNOHIT7"><?=$this->getLHCRte('RteNOHIT7',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input type="radio" value="NOHIT7" name="txtGameItem" rel="7" pri="<?=$this->getLHCRte('RteNOHIT7',$this->played)?>" maxlen="420" class="inputnoborder"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">八不中</span><span class="num" style="margin-left:12px;" data-id="RteNOHIT8"><?=$this->getLHCRte('RteNOHIT8',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input type="radio" value="NOHIT8" name="txtGameItem" rel="8" pri="<?=$this->getLHCRte('RteNOHIT8',$this->played)?>" maxlen="400" class="inputnoborder"></span>
		</dd>
			</dl>
			<dl>
		<dt>
		<span>类型</span><span style="width:76px;margin-left:16px;">赔率</span><span style="width:28px;margin-left:-6px;">金额</span>
			</dt>
		<dd>
		<span id="LOTTOTBSOED" class="sGameStatusItem">九不中</span><span class="num" style="margin-left:12px;" data-id="RteNOHIT9"><?=$this->getLHCRte('RteNOHIT9',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input type="radio" value="NOHIT9" name="txtGameItem" rel="9" pri="<?=$this->getLHCRte('RteNOHIT9',$this->played)?>" maxlen="220" class="inputnoborder"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">十不中</span><span class="num" style="margin-left:12px;" data-id="RteNOHIT10"><?=$this->getLHCRte('RteNOHIT10',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input type="radio" value="NOHIT10" name="txtGameItem" rel="10" pri="<?=$this->getLHCRte('RteNOHIT10',$this->played)?>" maxlen="200" class="inputnoborder"></span>
		</dd>
			</dl>
			<dl>
		<dt>
		<span>类型</span><span style="width:76px;margin-left:30px;">赔率</span><span style="width:28px;margin-left:-5px;">金额</span>
			</dt>
		<dd>
		<span id="LOTTOTBSOEO" class="sGameStatusItem">十一不中</span><span class="num" style="margin-left:12px;" data-id="RteNOHIT11"><?=$this->getLHCRte('RteNOHIT11',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input type="radio" value="NOHIT11" name="txtGameItem" rel="11" pri="<?=$this->getLHCRte('RteNOHIT11',$this->played)?>" maxlen="180" class="inputnoborder"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">十二不中</span><span class="num" style="margin-left:12px;"><?=$this->getLHCRte('RteNOHIT12',$this->played)?></span>
		<span class="input" style="margin-left:-3px;"><input type="radio" value="NOHIT12" name="txtGameItem" rel="12" pri="<?=$this->getLHCRte('RteNOHIT12',$this->played)?>" maxlen="150" class="inputnoborder"></span>
		</dd>
			</dl>
			</tbody></table>
		</div>

		        <span class="sTitle"><span id="sItemTitle"></span><span class="sNote" id="sExplain"></span></span>
			<div class="specialtable lotteryView_lhc5">
                <div class="Contentbox" id="Contentbox_0">
        <div class="lhcBox5">
		<dl class="clearfix">
			<dt>
		<span>号码</span><span></span><span style="margin-left:8px;">选择</span>
			</dt>
		<dd>
		<span class="red">01</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="01" id="checkbox_01" class="inputnoborder" acno="01"></span>
		</dd>
		<dd>
		<span class="red">02</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="02" id="checkbox_02" class="inputnoborder" acno="02"></span>
		</dd><dd>
		<span class="blue">03</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="03" id="checkbox_03" class="inputnoborder" acno="03"></span>
		</dd><dd>
		<span class="blue">04</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="04" id="checkbox_04" class="inputnoborder" acno="04"></span>
		</dd><dd>
		<span class="green">05</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="05" id="checkbox_05" class="inputnoborder" acno="05"></span>
		</dd><dd>
		<span class="green">06</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="06" id="checkbox_06" class="inputnoborder" acno="06"></span>
		</dd><dd>
		<span class="red">07</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="07" id="checkbox_07" class="inputnoborder" acno="07"></span>
		</dd><dd>
		<span class="red">08</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="08" id="checkbox_08" class="inputnoborder" acno="08"></span>
		</dd><dd>
		<span class="blue">09</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="09" id="checkbox_09" class="inputnoborder" acno="09"></span>
		</dd><dd>
		<span class="blue">10</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="10" id="checkbox_10" class="inputnoborder" acno="10"></span>
		</dd></dl>
		<dl class="clearfix">
			<dt>
		<span>号码</span><span></span><span style="margin-left:8px;">选择</span>
			</dt>
		<dd>
		<span class="green">11</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="11" id="checkbox_11" class="inputnoborder" acno="11"></span>
		</dd><dd>
		<span class="red">12</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="12" id="checkbox_12" class="inputnoborder" acno="12"></span>
		</dd><dd>
		<span class="red">13</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="13" id="checkbox_13" class="inputnoborder" acno="13"></span>
		</dd><dd>
		<span class="blue">14</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="14" id="checkbox_14" class="inputnoborder" acno="14"></span>
		</dd><dd>
		<span class="blue">15</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="15" id="checkbox_15" class="inputnoborder" acno="15"></span>
		</dd><dd>
		<span class="green">16</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="16" id="checkbox_16" class="inputnoborder" acno="16"></span>
		</dd><dd>
		<span class="green">17</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="17" id="checkbox_17" class="inputnoborder" acno="17"></span>
		</dd><dd>
		<span class="red">18</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="18" id="checkbox_18" class="inputnoborder" acno="18"></span>
		</dd><dd>
		<span class="red">19</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="19" id="checkbox_19" class="inputnoborder" acno="19"></span>
		</dd><dd>
		<span class="blue">20</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="20" id="checkbox_20" class="inputnoborder" acno="20"></span>
		</dd></dl>
		<dl class="clearfix">
			<dt>
		<span>号码</span><span></span><span style="margin-left:8px;">选择</span>
			</dt>
		<dd>
		<span class="green">21</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="21" id="checkbox_21" class="inputnoborder" acno="21"></span>
		</dd><dd>
		<span class="green">22</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="22" id="checkbox_22" class="inputnoborder" acno="22"></span>
		</dd><dd>
		<span class="red">23</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="23" id="checkbox_23" class="inputnoborder" acno="23"></span>
		</dd><dd>
		<span class="red">24</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="24" id="checkbox_24" class="inputnoborder" acno="24"></span>
		</dd><dd>
		<span class="blue">25</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="25" id="checkbox_25" class="inputnoborder" acno="25"></span>
		</dd><dd>
		<span class="blue">26</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="26" id="checkbox_26" class="inputnoborder" acno="26"></span>
		</dd><dd>
		<span class="green">27</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="27" id="checkbox_27" class="inputnoborder" acno="27"></span>
		</dd><dd>
		<span class="green">28</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="28" id="checkbox_28" class="inputnoborder" acno="28"></span>
		</dd><dd>
		<span class="red">29</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="29" id="checkbox_29" class="inputnoborder" acno="29"></span>
		</dd><dd>
		<span class="red">30</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="30" id="checkbox_30" class="inputnoborder" acno="30"></span>
		</dd></dl>
		<dl class="clearfix">
			<dt>
		<span>号码</span><span></span><span style="margin-left:8px;">选择</span>
			</dt>
		<dd>
		<span class="blue">31</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="31" id="checkbox_31" class="inputnoborder" acno="31"></span>
		</dd><dd>
		<span class="green">32</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="32" id="checkbox_32" class="inputnoborder" acno="32"></span>
		</dd><dd>
		<span class="green">33</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="33" id="checkbox_33" class="inputnoborder" acno="33"></span>
		</dd><dd>
		<span class="red">34</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="34" id="checkbox_34" class="inputnoborder" acno="34"></span>
		</dd><dd>
		<span class="red">35</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="35" id="checkbox_35" class="inputnoborder" acno="35"></span>
		</dd><dd>
		<span class="blue">36</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="36" id="checkbox_36" class="inputnoborder" acno="36"></span>
		</dd><dd>
		<span class="blue">37</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="37" id="checkbox_37" class="inputnoborder" acno="37"></span>
		</dd><dd>
		<span class="green">38</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="38" id="checkbox_38" class="inputnoborder" acno="38"></span>
		</dd><dd>
		<span class="green">39</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="39" id="checkbox_39" class="inputnoborder" acno="39"></span>
		</dd><dd>
		<span class="red">40</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="40" id="checkbox_40" class="inputnoborder" acno="40"></span>
		</dd></dl>
		<dl class="clearfix">
			<dt>
		<span>号码</span><span></span><span style="margin-left:8px;">选择</span>
			</dt>
		<dd>
		<span class="blue">41</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="41" id="checkbox_41" class="inputnoborder" acno="41"></span>
		</dd><dd>
		<span class="blue">42</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="42" id="checkbox_42" class="inputnoborder" acno="42"></span>
		</dd><dd>
		<span class="green">43</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="43" id="checkbox_43" class="inputnoborder" acno="43"></span>
		</dd><dd>
		<span class="green">44</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="44" id="checkbox_44" class="inputnoborder" acno="44"></span>
		</dd><dd>
		<span class="red">45</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="45" id="checkbox_45" class="inputnoborder" acno="45"></span>
		</dd><dd>
		<span class="red">46</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="46" id="checkbox_46" class="inputnoborder" acno="46"></span>
		</dd><dd>
		<span class="blue">47</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="47" id="checkbox_47" class="inputnoborder" acno="47"></span>
		</dd><dd>
		<span class="blue">48</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="48" id="checkbox_48" class="inputnoborder" acno="48"></span>
		</dd>
		<dd>
		<span class="green">49</span>
		<span class="input"><input style="margin-left:20px;" type="checkbox" value="49" id="checkbox_49" class="inputnoborder" acno="49"></span>
		</dd><dd>
		</dd>
		</dl>
		 </div>    </div>
            </div>

		<table class="betnum1">
                <tbody><tr>
                  
                </tr>
                <tr>
                    <td>
                        <div readonly="" multiple="" id="mulCollocation" name="mulCollocation"></div>
                    </td>
                </tr>
            </tbody>
			</table>
	
		

    
		   </div>    </div>
            </div>
		
	    <div id="dResult">
		
        <input type="hidden" id="txtRate" value="0">
        	<div class="anniu-wrapper num-table">
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