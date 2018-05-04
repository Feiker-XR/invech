<?php exit;?>00154971548525fe134add316792d5e8ec72597bf719s:1449:"a:2:{s:8:"template";s:1385:"<form method="post">
    <div class="panel dux-box">
        <div class="table-responsive">
            <table id="table" class="table table-hover ">
                <tbody>
                    <tr>
                        <th width="100">编号</th>
                        <th width="*">名称</th>
                        <th width="*">顺序</th>
                        <th width="100">操作</th>
                    </tr>
                    <?php foreach ($list as $vo) { ?>
                    <tr>
                        <td><?php echo $vo["position_id"];?></td>
                        <td><?php echo $vo["name"];?></td>
                        <td><?php echo $vo["sequence"];?></td>
                        <td>
                            <a class="button bg-blue button-small icon-pencil" href="<?php echo url('edit',array('position_id'=>$vo['position_id']));?>" title="修改"></a>
                            <a class="button bg-red button-small icon-trash-o js-del" href="javascript:;" data="<?php echo $vo["position_id"];?>" title="删除"></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</form>
<script>
    Do.ready('base', function () {
        $('#table').duxTable({
            deleteUrl: "<?php echo url('del');?>"
        });
    });
</script>";s:12:"compile_time";i:1518179485;}";