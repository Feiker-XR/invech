<input type="hidden" name="playedGroup" value="<?= $this->groupId ?>" />
<input type="hidden" name="playedId" value="<?= $this->played ?>" />
<input type="hidden" name="type" value="<?= $this->type ?>" />
<?php
$wfName = $this->getValue("select name from {$this->prename}played where id={$this->played}");
?>
<div class="pp" action="tzAllSelect" length="1" random="sscRandom" style="width:100%">
    <div class="title"><div class="wei" style="float:left;"><?= $wfName ?></div></div>
	
	<input type="button" value="大" class="code" />
	<input type="button" value="小" class="code" />
    <div class="clear"></div><div class="title"><div class="wei" style="float:left;"><?= $wfName ?></div></div>
	
	<input type="button" value="单" class="code" />
	<input type="button" value="双" class="code" />

</div>
<?php
$maxPl = $this->getPl($this->type, $this->played);
?>
<script type="text/javascript">
$(function(){
	gameSetPl(<?= json_encode($maxPl) ?>,false,<?= $this->user['fanDianBdw'] ?>);
})
</script>
