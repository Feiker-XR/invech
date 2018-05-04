<?php exit;?>0015497157346fa4f13cc1caaae775865afddc3f2eb6s:1686:"a:2:{s:8:"template";s:1622:"<div class="panel dux-box">
    
    <div class="table-responsive">
        <table id="table" class="table table-hover ">
            <tbody>
                <tr>
                    <th width="80">编号</th>
                    <th width="*">名称</th>
                    <th width="*">状态</th>
                    <th width="130">操作</th>
                </tr>
                <?php foreach ($list as $vo) { ?>
                <tr>
                    <td><?php echo $vo["group_id"];?></td>
                      <td><?php echo $vo["name"];?></td>
                    <td>
                       <?php if ($vo['status']){ ?>
                       <span class="tag bg-green">正常</span>
                       <?php }else{ ?>
                       <span class="tag bg-red">禁用</span>
                       <?php } ?>
                    </td>
                    <td>
                        <a class="button bg-blue button-small icon-pencil" href="<?php echo url('edit',array('group_id'=>$vo['group_id']));?>" title="修改"></a>
                        <a class="button bg-blue button-small icon-key" href="<?php echo url('purview',array('group_id'=>$vo['group_id']));?>" title="权限"></a>
                        <a class="button bg-red button-small icon-trash-o js-del" href="javascript:;" data="<?php echo $vo["group_id"];?>" title="删除"></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
Do.ready('base',function() {
	$('#table').duxTable({
		deleteUrl: "<?php echo url('del');?>"
	});
});
</script>";s:12:"compile_time";i:1518179734;}";