<input type="hidden" name="playedGroup" value="<?= $this->groupId ?>" />
<input type="hidden" name="playedId" value="<?= $this->played ?>" />
<input type="hidden" name="type" value="<?= $this->type ?>" />
<div class="pp" action="ssc_z3_r6" length="3" random="combineRandom" >
	<div id="wei-shu" length="3" type='z3_r6_zuhetouzhu' >
		<label><input type="checkbox" name="ss"  value="16" />万</label>
		<label><input type="checkbox" name="ss" value="8" />千</label>
		<label><input type="checkbox" name="ss" value="4" />百</label>
		<label><input type="checkbox" name="ss" value="2" />十</label>
		<label><input type="checkbox" name="ss"  value="1" />个</label>
        <div style=" line-height:200%;display:none; width:15%" onclick="ckall()"></div>
	</div>
	<div class="action-wrapper">
			<input type="button" value="清1" class="action none" />
	    <input type="button" value="双" class="action even" />
	    <input type="button" value="单" class="action odd" />
	    <input type="button" value="小" class="action small" />
	    <input type="button" value="大" class="action large" />
	    <input type="button" value="全" class="action all" />
		</div>
	<div class="relative">
		<div class="title"><div class="wei" style="float:left;">选择</div></div>
		<ul class="nList" style="display:inline;float:left;">
		<input type="button" value="0" class="code min s" />
		<input type="button" value="1" class="code min d" />
		<input type="button" value="2" class="code min s" />
		<input type="button" value="3" class="code min d" />
		<input type="button" value="4" class="code min s" />
		<input type="button" value="5" class="code max d" />
		<input type="button" value="6" class="code max s" />
		<input type="button" value="7" class="code max d" />
		<input type="button" value="8" class="code max s" />
		<input type="button" value="9" class="code max d" />
		</ul>
	</div>
</div>
<?php
$maxPl = $this->getPl($this->type, $this->played);
?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?= json_encode($maxPl) ?>);
})
</script>
<script type="text/javascript">  
   var m=$("input:checkbox:checked").length;
   $("#select").html(m);
   $("#num").html(Combination(m, 3));
   $("input:checkbox").click(function(){
       var m=$("input:checkbox:checked").length;
       $("#select").html(m); 
       $("#num").html(Combination(m, 3));
   });
 function Combination(c, b) {
    b = parseInt(b);
    c = parseInt(c);
    if (b < 0 || c < 0) {
        return false
    }
    if (b == 0 || c == 0) {
        return 1
    }
    if (b > c) {
        return 0
    }
    if (b > c / 2) {
        b = c - b
    }
    var a = 0;
    for (i = c; i >= (c - b + 1) ; i--) {
        a += Math.log(i)
    }
    for (i = b; i >= 1; i--) {
        a -= Math.log(i)
    }
    a = Math.exp(a);
    return Math.round(a)
}

function ckall(){
	$('#wei-shu :checkbox').attr('checked', true);
	var m=$("input:checkbox:checked").length;
	$("#select").html(m); 
	$("#num").html(Combination(m, 3));
}
</script>
