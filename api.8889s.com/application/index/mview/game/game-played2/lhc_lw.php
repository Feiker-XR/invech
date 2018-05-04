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

	<div class="dGameStatus hklhc lotteryView_sxtw" action="tzlhcSelect" length="1">
		<div class="Contentbox" id="Contentbox_0">
		
			<div class="sxtwBox" >
		
		<div class="dGameStatus hklhc lotteryView_lhc1" action="tzlhcSelect" length="1">
                <div class="Contentbox" id="Contentbox_0">
        <div class="lhcBox1" >
		<dl>
			<dt>
		<span style="margin-left:13px;">类别</span><span style="margin-left:13px;">赔率</span><span style="margin-left:14px;">选择</span>
			</dt>
			<dd>
				<span class="sGameStatusItem">二尾碰</span><span class="num" style="margin-left:12px;" data-id="RteSNSD2"><?=$this->getLHCRte('RteSNSD2',$this->played)?></span>
				<span class="input" style="margin-left:-3px;"><input id="RteSNSD2" style="margin-left:28px;" type="radio" value="SNSD2" name="txtGameItem" rel="2" pri="<?=$this->getLHCRte('RteSNSD2',$this->played)?>" class="inputnoborder"></span>
			</dd>
			<dd>
				<span class="sGameStatusItem">三尾碰</span><span class="num" style="margin-left:12px;" data-id="RteSNSD3"><?=$this->getLHCRte('RteSNSD3',$this->played)?></span>
				<span class="input" style="margin-left:-3px;"><input id="RteSNSD3" style="margin-left:28px;" type="radio" value="SNSD3" name="txtGameItem" rel="3" pri="<?=$this->getLHCRte('RteSNSD3',$this->played)?>" class="inputnoborder"></span>
			</dd>
			<dd>
				<span id="LOTTOTBSOED" class="sGameStatusItem">四尾碰</span><span class="num" style="margin-left:12px;" data-id="RteSNSD4"><?=$this->getLHCRte('RteSNSD4',$this->played)?></span>
				<span class="input" style="margin-left:-3px;"><input id="RteSNSD4" style="margin-left:28px;" type="radio" value="SNSD4" name="txtGameItem" rel="4" pri="<?=$this->getLHCRte('RteSNSD4',$this->played)?>" class="inputnoborder"></span>
			</dd>
			<dd>
				<span id="LOTTOTBSOEO" class="sGameStatusItem">五尾碰</span><span class="num" style="margin-left:12px;" data-id="RteSNSD5"><?=$this->getLHCRte('RteSNSD5',$this->played)?></span>
				<span class="input" style="margin-left:-3px;"><input id="RteSNSD5" style="margin-left:28px;" type="radio" value="SNSD5" name="txtGameItem" rel="5" pri="<?=$this->getLHCRte('RteSNSD5',$this->played)?>" class="inputnoborder"></span>
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
			  
			  
			  
		<dl>
			<dt>
		<span>尾数</span><span style="margin-left:80px;">号码</span><span style="margin-left:90px;">&nbsp;</span><span>选择</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">0尾</span><span style="margin-left: 30px;" class="blue">10</span><span class="green">20</span><span class="green">30</span><span class="red">40</span><span style="margin-left:60px;" class="num"></span>
		<span class="input"><input type="checkbox" value="0" id="SD0" name="txtSD"  acno="0尾" class="inputnoborder"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">1尾</span><span style="margin-left: 30px;" class="red">01</span><span class="blue">11</span><span class="green">21</span><span class="green">31</span><span class="green">41</span><span style="margin-left:27px;" class="num"></span>
		<span class="input"><input type="checkbox" value="1" id="SD1" name="txtSD" acno="1尾" class="inputnoborder"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">2尾</span><span style="margin-left: 30px;" class="red">02</span><span class="red">12</span><span class="blue">22</span><span class="green">32</span><span class="green">42</span><span style="margin-left:27px;" class="num"></span>
		<span class="input"><input type="checkbox" value="2" id="SD2" name="txtSD" acno="2尾" class="inputnoborder"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">3尾</span><span style="margin-left: 30px;" class="green">03</span><span class="red">13</span><span class="red">23</span><span class="blue">33</span><span class="green">43</span><span style="margin-left:27px;" class="num"></span>
		<span class="input"><input type="checkbox" value="3" id="SD3" name="txtSD" acno="3尾" class="inputnoborder"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">4尾</span><span style="margin-left: 30px;" class="green">04</span><span class="green">14</span><span class="red">24</span><span class="blue">34</span><span class="green">44</span><span style="margin-left:27px;" class="num"></span>
		<span class="input"><input type="checkbox" value="4" id="SD4" name="txtSD" acno="4尾" class="inputnoborder"></span>
		</dd>
		</dl>
		<dl>
			<dt>
		<span>尾数</span><span style="margin-left:80px;">号码</span><span style="margin-left:90px;">&nbsp;</span><span>选择</span>
			</dt>
		<dd>
		<span class="sGameStatusItem">5尾</span><span style="margin-left: 30px;" class="blue">05</span><span class="blue">15</span><span class="green">25</span><span class="green">35</span><span class="green">45</span><span style="margin-left:27px;" class="num"></span>
		<span class="input"><input type="checkbox" value="5" id="SD5" name="txtSD" acno="5尾" class="inputnoborder"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">6尾</span><span style="margin-left: 30px;" class="red">06</span><span class="blue">16</span><span class="blue">26</span><span class="green">36</span><span class="green">46</span><span style="margin-left:27px;" class="num"></span>
		<span class="input"><input type="checkbox" value="6" id="SD6" name="txtSD" acno="6尾" class="inputnoborder"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">7尾</span><span style="margin-left: 30px;" class="red">07</span><span class="blue">17</span><span class="blue">27</span><span class="green">37</span><span class="green">47</span><span style="margin-left:27px;" class="num"></span>
		<span class="input"><input type="checkbox" value="7" id="SD7" name="txtSD" acno="7尾" class="inputnoborder"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">8尾</span><span style="margin-left: 30px;" class="red">08</span><span class="red">18</span><span class="blue">28</span><span class="blue">38</span><span class="blue">48</span><span style="margin-left:27px;" class="num"></span>
		<span class="input"><input type="checkbox" value="8" id="SD8" name="txtSD" acno="8尾" class="inputnoborder"></span>
		</dd>
		<dd>
		<span class="sGameStatusItem">9尾</span><span style="margin-left: 30px;" class="green">09</span><span class="red">19</span><span class="red">29</span><span class="blue">39</span><span class="blue">49</span><span style="margin-left:27px;" class="num"></span>
		<span class="input"><input type="checkbox" value="9" id="SD9" name="txtSD" acno="9尾" class="inputnoborder"></span>
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
   <span>元</span><span id="sTotalCredit">0</span><span>总金额共</span>
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