<?php exit;?>0015497156739275f606f1faea9f082a87e9efc2d412s:3380:"a:2:{s:8:"template";s:3316:"<form method="post" class="form-x dux-form form-auto" id="form" action="<?php echo url('tv');?>">
    <div class="panel dux-box  active">
        <div class="panel-head">
            <strong>手机版设置</strong>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="label">
                    <label for="sitename">开启开奖调用</label>
                </div>
                <div class="field">
                        <div class="button-group button-group-small radio">
                            <?php if ($info['tv_status']){ ?>
                            <label class="button active"><input name="tv_status" value="1" checked="checked" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="tv_status" value="1" type="radio">
                            <?php } ?>
                            <span class="icon icon-check"></span> 开启</label>
                            <?php if (!$info['tv_status']){ ?>
                            <label class="button active"><input name="tv_status" checked="checked" value="0" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="tv_status" value="0" type="radio">
                            <?php } ?>
                            <span class="icon icon-times"></span> 关闭</label>
                        </div>
                    </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label for="sitename">开奖调用模板</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="tv_tpl" name="tv_tpl" size="40" value="<?php echo $info["tv_tpl"];?>">
                    <select class="input js-assign" target="#tv_tpl">
                       <option value="">请选择</option>
                       <?php foreach ($themesList as $vo) { ?>
                        <option value="<?php echo $vo["file"];?>"><?php echo $vo["name"];?></option>
                        <?php } ?>
                      </select>                    
                    <div class="input-note">开奖调用所使用的主题</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label for="sitename">绑定域名</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="tv_domain" name="tv_domain" size="60" value="<?php echo $info["tv_domain"];?>">
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
</script>";s:12:"compile_time";i:1518179673;}";