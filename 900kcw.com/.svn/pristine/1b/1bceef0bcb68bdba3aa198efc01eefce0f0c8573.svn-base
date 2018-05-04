<?php exit;?>001549374579858c54b535bb0152599ea5d1337fe3dbs:1171:"a:2:{s:8:"template";s:1107:"<form method="post">
    <div class="panel dux-box">
       <div class="table-responsive">
        <table id="table" class="table table-hover ">
            <tbody>
                <tr>
                    <th width="*">用户</th>
                    <th width="*">时间</th>
                    <th width="*">IP</th>
                    <th width="*">模块</th>
                    <th width="*">详情</th>
                </tr>
                <?php foreach ($list as $vo) { ?>
                <tr>
                  <td><?php echo $vo["username"];?></td>
                  <td><?php echo date('y-m-d H:i',$vo['time']);?></td>
                  <td><?php echo $vo["ip"];?></td>
                  <td><?php echo $vo["app"];?></td>
                  <td> <?php echo $vo["content"];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <div class="panel-foot table-foot clearfix"><?php echo $page;?></div>
    </div>
</form>
<script>
Do.ready('base',function() {
	$('#table').duxTable({
		deleteUrl: "<?php echo url();?>"
	});
});
</script>";s:12:"compile_time";i:1517838579;}";