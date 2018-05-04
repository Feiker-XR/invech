<?php exit;?>00154971548260a61c2e291305d7050c930879c05b44s:1633:"a:2:{s:8:"template";s:1569:"<form method="post">
    <div class="panel dux-box">
        <div class="table-responsive">
            <table id="table" class="table table-hover ">
                <tbody>
                    <tr>
                        <th width="100">编号</th>
                        <th width="*">名称</th>
                        <th width="*">标识</th>
                        <th width="*">类型</th>
                        <th width="100">操作</th>
                    </tr>
                    <?php foreach ($list as $vo) { ?>
                    <tr>
                        <td><?php echo $vo["fragment_id"];?></td>
                        <td><?php echo $vo["name"];?></td>
                        <td><?php echo $vo["label"];?></td>
                        <td><?php echo $vo["type"];?></td>
                        <td>
                            <a class="button bg-blue button-small icon-pencil" href="<?php echo url('edit',array('fragment_id'=>$vo['fragment_id']));?>" title="修改"></a>
                            <a class="button bg-red button-small icon-trash-o js-del" href="javascript:;" data="<?php echo $vo["fragment_id"];?>" title="删除"></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="panel-foot table-foot clearfix"><?php echo $page;?></div>
    </div>
</form>
<script>
    Do.ready('base', function () {
        $('#table').duxTable({
            deleteUrl: "<?php echo url('del');?>"
        });
    });
</script>";s:12:"compile_time";i:1518179482;}";