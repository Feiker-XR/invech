<?php exit;?>001549715738c08105ed579272b1f68e07cc864c91b7s:2679:"a:2:{s:8:"template";s:2615:"<form method="post" class="form-x dux-form form-auto" id="form" action="<?php echo url();?>">
    <div class="panel dux-box  active">
        <div class="panel-head">
            <strong><?php echo $name;?>用户组</strong>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="label">
                    <label>用户组名称</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="name" name="name" size="60" datatype="s" value="<?php echo $info["name"];?>">
                    <div class="input-note">用户组标识名称</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>用户状态</label>
                </div>
                <div class="field">
                        <div class="button-group button-group-small radio">
                           <?php if(!isset($info['status'])) $info['status'] = 1; ?>
                            <?php if ($info['status']){ ?>
                            <label class="button active"><input name="status" value="1" checked="checked" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="status" value="1" type="radio">
                            <?php } ?>
                            <span class="icon icon-check"></span> 正常</label>
                            <?php if (!$info['status']){ ?>
                            <label class="button active"><input name="status" checked="checked" value="0" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="status" value="0" type="radio">
                            <?php } ?>
                            <span class="icon icon-times"></span> 禁用</label>
                        </div>
                        <div class="input-note">禁用后改组用户将无法登录</div>
                    </div>
            </div>
        </div>
        <div class="panel-foot">
            <div class="form-button">
                <div id="tips"></div>
                <input type="hidden" name="group_id" type="hidden" value="<?php echo $info["group_id"];?>">
                <button class="button bg-main" type="submit">保存</button>
                <button class="button bg" type="reset">重置</button>
            </div>
        </div>
    </div>
</form>
<script>
    Do.ready('base', function () {
        $('#form').duxForm();
    });
</script>";s:12:"compile_time";i:1518179738;}";