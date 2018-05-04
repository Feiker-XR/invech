<?php exit;?>001549715495e5283261ebad2b7629138058ea2426d4s:2145:"a:2:{s:8:"template";s:2081:"<div class="panel dux-box">
    <div class="table-responsive">
        <table id="table" class="table table-hover ">
            <tbody>
                <tr>
                    <th width="60">选择</th>
                    <th width="100">编号</th>
                    <th width="*">名称</th>
                    <th width="*">点击量</th>
                    <th width="*">引用数</th>
                </tr>
                <?php foreach ($list as $vo) { ?>
                <tr>
                    <td>
                        <input type="checkbox" name="id[]" value="<?php echo $vo["tag_id"];?>" />
                    </td>
                    <td><?php echo $vo["tag_id"];?></td>
                    <td><a href="<?php echo $vo["url"];?>" target="_blank"><?php echo $vo["name"];?></a>
                    </td>
                    <td><?php echo $vo["click"];?></td>
                    <td><?php echo $vo["quote"];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="panel-foot table-foot clearfix">
        <div class="float-left">
            <div class="form-inline">
                <div class="form-group">
                    <div class="field">
                        <select class="input" id="selectAction">
                            <option value="1">删除</option>
                        </select>
                    </div>
                </div>
                <div class="form-button">
                    <a class="button bg-blue button-small" id="selectAll" type="button">全选</a>
                    <a class="button bg-blue button-small" id="selectSubmit" type="submit">执行</a>
                </div>

            </div>
            <br>
        </div>
        <div class="float-right">
            <?php echo $page;?>
        </div>
    </div>
</div>
<script>
    Do.ready('base', function () {
        $('#table').duxTable({
            deleteUrl: "<?php echo url('del');?>",
            actionUrl: "<?php echo url('batchAction');?>",
        });
    });
</script>";s:12:"compile_time";i:1518179495;}";