<?php exit;?>001549003921bbe6a15569e6a02c603d36ad6e7f04a5s:4164:"a:2:{s:8:"template";s:4100:"<form method="post" class="form-x dux-form form-auto" id="form" action="<?php echo url('tpl');?>">
    <div class="panel dux-box  active">
        <div class="panel-head">
            <strong>模板设置</strong>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="label">
                    <label for="sitename">站点模板</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="tpl_name" name="tpl_name" size="40" value="<?php echo $info["tpl_name"];?>">
                    <select class="input js-assign" target="#tpl_name">
                        <option value="">请选择</option>
                        <?php foreach ($themesList as $vo) { ?>
                        <option value="<?php echo $vo["file"];?>"><?php echo $vo["name"];?></option>
                        <?php } ?>
                    </select>
                    <div class="input-note">当前站点所使用的主题</div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="label">
                    <label for="sitename">首页模板</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="tpl_index" name="tpl_index" size="40" value="<?php echo $info["tpl_index"];?>">
                    <select class="input js-assign" target="#tpl_index">
                        <option value="">请选择</option>
                        <?php foreach ($tplList as $vo) { ?>
                        <option value="<?php echo $vo["name"];?>"><?php echo $vo["file"];?></option>
                        <?php } ?>
                    </select>
                    <div class="input-note">当前站点所使用的首页模板，无需后缀名</div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="label">
                    <label for="sitename">Tag模板</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="tpl_tags" name="tpl_tags" size="40" value="<?php echo $info["tpl_tags"];?>">
                    <select class="input js-assign" target="#tpl_tags">
                        <option value="">请选择</option>
                        <?php foreach ($tplList as $vo) { ?>
                        <option value="<?php echo $vo["name"];?>"><?php echo $vo["file"];?></option>
                        <?php } ?>
                    </select>
                    <div class="input-note">TAG基础模板名，请根据访问提示修改模板名，无需后缀名</div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="label">
                    <label for="sitename">搜索模板</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="tpl_search" name="tpl_search" size="40" value="<?php echo $info["tpl_search"];?>">
                    <select class="input js-assign" target="#tpl_search">
                        <option value="">请选择</option>
                        <?php foreach ($tplList as $vo) { ?>
                        <option value="<?php echo $vo["name"];?>"><?php echo $vo["file"];?></option>
                        <?php } ?>
                    </select>
                    <div class="input-note">搜索列表的基础模板名，请根据访问提示修改模板名，无需后缀名</div>
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
</script>";s:12:"compile_time";i:1517467921;}";