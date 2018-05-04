<?php exit;?>00154971568130c6ca9365df71144ac51d6986df679as:3359:"a:2:{s:8:"template";s:3295:"<form method="post" class="form-x dux-form form-auto" id="form" action="<?php echo url('mobile');?>">
    <div class="panel dux-box  active">
        <div class="panel-head">
            <strong>手机版设置</strong>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="label">
                    <label for="sitename">开启手机版</label>
                </div>
                <div class="field">
                        <div class="button-group button-group-small radio">
                            <?php if ($info['mobile_status']){ ?>
                            <label class="button active"><input name="mobile_status" value="1" checked="checked" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="mobile_status" value="1" type="radio">
                            <?php } ?>
                            <span class="icon icon-check"></span> 开启</label>
                            <?php if (!$info['mobile_status']){ ?>
                            <label class="button active"><input name="mobile_status" checked="checked" value="0" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="mobile_status" value="0" type="radio">
                            <?php } ?>
                            <span class="icon icon-times"></span> 关闭</label>
                        </div>
                    </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label for="sitename">手机模板</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="mobile_tpl" name="mobile_tpl" size="40" value="<?php echo $info["mobile_tpl"];?>">
                    <select class="input js-assign" target="#mobile_tpl">
                       <option value="">请选择</option>
                       <?php foreach ($themesList as $vo) { ?>
                        <option value="<?php echo $vo["file"];?>"><?php echo $vo["name"];?></option>
                        <?php } ?>
                      </select>                    
                    <div class="input-note">手机版所使用的主题</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label for="sitename">绑定域名</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="mobile_domain" name="mobile_domain" size="60" value="<?php echo $info["mobile_domain"];?>">
                    <div class="input-note">绑定域名后可通过域名访问手机版，如：m.baidu.com</div>
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
</script>";s:12:"compile_time";i:1518179681;}";