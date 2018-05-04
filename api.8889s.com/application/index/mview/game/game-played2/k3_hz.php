<input type="hidden" name="playedGroup" value="<?= $this->groupId ?>" />
<input type="hidden" name="playedId" value="<?= $this->played ?>" />
<input type="hidden" name="type" value="<?= $this->type ?>" />

<div class="pp pp11" action="tz11x5Select" length="1"style="width:100%" >
	<div class="relative">
		<div class="title" ><div class="wei" style="float:left;">号码</div></div>
	<ul class="nList" style="display:inline;float:left;">
	<input type="button" value="3" class="code" />
	<input type="button" value="4" class="code" />
	<input type="button" value="5" class="code" />
	<input type="button" value="6" class="code" />
	<input type="button" value="7" class="code" />
	<input type="button" value="8" class="code" />
	<input type="button" value="9" class="code" />
	<input type="button" value="10" class="code" />
    <input type="button" value="11" class="code" />
    <input type="button" value="12" class="code" />
    <input type="button" value="13" class="code" />
	<input type="button" value="14" class="code" />
	<input type="button" value="15" class="code" />
	<input type="button" value="16" class="code" />
	<input type="button" value="17" class="code" />
	<input type="button" value="18" class="code" />
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