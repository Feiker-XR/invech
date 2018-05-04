<?php exit;?>001550389546dfe9680e60bbda370f6957e3cb44b8d6s:5188:"a:2:{s:8:"template";s:5124:"<form method="post" class="form-x dux-form form-auto" id="form" action="<?php echo url();?>">
    <div class="panel dux-box  active">
        <div class="panel-head">
            <strong><?php echo $name;?>用户</strong>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="label">
                    <label>用户组</label>
                </div>
                <div class="field">
                    <select class="input" name="group_id">
                       <?php foreach ($groupList as $vo) { ?>
                        <?php if ($info['group_id'] == $vo['group_id']){ ?>
                        <option value="<?php echo $vo["group_id"];?>" selected>
                        <?php }else{ ?>
                        <option value="<?php echo $vo["group_id"];?>">
                        <?php } ?>
                        <?php echo $vo["name"];?></option>
                        <?php } ?>
                      </select>
                    <div class="input-note">请选择用户组</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>用户名/登录名</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="username" name="username" size="60" datatype="s" value="<?php echo $info["username"];?>">
                    <div class="input-note">用户登录帐号</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>昵称</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="nicename" name="nicename" size="60" datatype="s" value="<?php echo $info["nicename"];?>">
                    <div class="input-note">用户姓名或昵称</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>邮箱</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="email" name="email" size="60" datatype="e" value="<?php echo $info["email"];?>">
                    <div class="input-note">用于接受邮件通知</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>密码</label>
                </div>
                <div class="field">
                    <input type="password" class="input" id="password" name="password" size="60" >
                    <div class="input-note">请输入密码，不修改请留空</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>重复密码</label>
                </div>
                <div class="field">
                    <input type="password" class="input" id="password2" name="password2" size="60" >
                    <div class="input-note">重复刚才输入的密码</div>
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
                        <div class="input-note">禁用后该用户将无法登录</div>
                    </div>
            </div>
        </div>
        <div class="panel-foot">
            <div class="form-button">
                <div id="tips"></div>
                <input type="hidden" name="user_id" type="hidden" value="<?php echo $info["user_id"];?>">
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
</script>";s:12:"compile_time";i:1518853546;}";