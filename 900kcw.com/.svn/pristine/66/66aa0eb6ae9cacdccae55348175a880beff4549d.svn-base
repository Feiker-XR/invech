<?php exit;?>00154971566394d824ad31339a103d19dd27c8613b15s:5690:"a:2:{s:8:"template";s:5626:"<form method="post" class="form-x dux-form form-auto" id="form" action="<?php echo url('performance');?>">
    <div class="panel dux-box  active">
        <div class="panel-head">
            <strong>性能设置</strong>
        </div>
        <div class="panel-body">
           <div class="form-group">
                <div class="label">
                    <label>网站模式</label>
                </div>
                <div class="field">
                        <div class="button-group button-group-small radio">
                            <?php if ($info['DEBUG']){ ?>
                            <label class="button active"><input name="DEBUG" value="true" checked="checked" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="DEBUG" value="true" type="radio">
                            <?php } ?>
                            <span class="icon icon-check"></span> 调试模式</label>
                            <?php if (!$info['DEBUG']){ ?>
                            <label class="button active"><input name="DEBUG" checked="checked" value="false" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="DEBUG" value="false" type="radio">
                            <?php } ?>
                            <span class="icon icon-times"></span> 上线模式</label>
                        </div>
                        <div class="input-note">调整为上线模式后所有错误页面将统一处理为404</div>
                    </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label for="sitename">伪静态开关</label>
                </div>
                <div class="field">
                   <div class="button-group button-group-small radio">
                            <?php if ($info['REWRITE_ON']){ ?>
                            <label class="button active"><input name="REWRITE_ON" value="true" checked="checked" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="REWRITE_ON" value="true" type="radio">
                            <?php } ?>
                            <span class="icon icon-check"></span> 开启</label>
                            <?php if (!$info['REWRITE_ON']){ ?>
                            <label class="button active"><input name="REWRITE_ON" checked="checked" value="false" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="REWRITE_ON" value="false" type="radio">
                            <?php } ?>
                            <span class="icon icon-times"></span> 关闭</label>
                        </div>
                <div class="input-note">请查看 <a href="#" class="text-main" target="_blank">【URL规则】</a> 说明</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>日志记录</label>
                </div>
                <div class="field">
                        <div class="button-group button-group-small radio">
                            <?php if ($info['LOG_ON']){ ?>
                            <label class="button active"><input name="LOG_ON" value="true" checked="checked" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="LOG_ON" value="true" type="radio">
                            <?php } ?>
                            <span class="icon icon-check"></span> 开启</label>
                            <?php if (!$info['LOG_ON']){ ?>
                            <label class="button active"><input name="LOG_ON" checked="checked" value="false" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="LOG_ON" value="false" type="radio">
                            <?php } ?>
                            <span class="icon icon-times"></span> 关闭</label>
                        </div>
                        <div class="input-note">记录网站出错日志</div>
                    </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>加密KEY</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="SAFE_KEY" name="SAFE_KEY" size="60" datatype="s" value="<?php echo $info["SAFE_KEY"];?>">
                    <div class="input-note">用户外部通讯的加密基准</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>COOKIE前缀</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="SAFE_KEY" name="COOKIE_PREFIX" size="60" datatype="s" value="<?php echo $info["COOKIE_PREFIX"];?>">
                    <div class="input-note">避免多个站点冲突</div>
                </div>
            </div>
        </div>
        <div class="panel-foot">
            <div class="form-button">
                <div id="tips"></div>
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
</script>";s:12:"compile_time";i:1518179663;}";