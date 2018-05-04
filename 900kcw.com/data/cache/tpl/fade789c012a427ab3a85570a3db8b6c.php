<?php exit;?>001549368177d448e6c384aa56bae4279c58f3380c49s:11433:"a:2:{s:8:"template";s:11368:"<form method="post" class="form-x dux-form form-auto" id="form" action="<?php echo url('upload');?>">
    <div class="panel dux-box  active">
        <div class="panel-head">
            <strong>上传设置</strong>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="label">
                    <label for="sitename">最大文件大小</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="UPLOAD_SIZE" name="UPLOAD_SIZE" size="60" datatype="n" value="<?php echo $info['UPLOAD_SIZE'];?>">
                    <div class="input-note">单位：M，该设置为程序限制，最大上传具体为服务器限制</div>
                </div>
            </div>
            <!-- <div class="form-group">
                <div class="label">
                    <label for="sitename">上传文件格式</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="UPLOAD_EXTS" name="UPLOAD_EXTS" size="60"  datatype="*" value="<?php echo $info['UPLOAD_EXTS'];?>">
                    <div class="input-note">用英文逗号分割，部分格式如无法上传请检查服务器</div>
                </div>
            </div> -->
            <div class="form-group">
                <div class="label">
                    <label for="sitename">缩图开关</label>
                </div>
                <div class="field">
                        <div class="button-group button-group-small radio">
                            <?php if ($info['THUMB_STATUS']){ ?>
                            <label class="button active"><input name="THUMB_STATUS" value="1" checked="checked" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="THUMB_STATUS" value="1" type="radio">
                            <?php } ?>
                            <span class="icon icon-check"></span> 开启</label>
                            <?php if (!$info['THUMB_STATUS']){ ?>
                            <label class="button active"><input name="THUMB_STATUS" checked="checked" value="0" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="THUMB_STATUS" value="0" type="radio">
                            <?php } ?>
                            <span class="icon icon-times"></span> 关闭</label>
                        </div>
                        <div class="input-note">开启后缩略图设置才会生效</div>
                    </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label for="sitename">水印开关</label>
                </div>
                <div class="field">
                        <div class="button-group button-group-small radio">
                            <?php if ($info['WATER_STATUS']){ ?>
                            <label class="button active"><input name="WATER_STATUS" value="1" checked="checked" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="WATER_STATUS" value="1" type="radio">
                            <?php } ?>
                            <span class="icon icon-check"></span> 开启</label>
                            <?php if (!$info['WATER_STATUS']){ ?>
                            <label class="button active"><input name="WATER_STATUS" checked="checked" value="0" type="radio">
                            <?php }else{ ?>
                            <label class="button"><input name="WATER_STATUS" value="0" type="radio">
                            <?php } ?>
                            <span class="icon icon-times"></span> 关闭</label>
                        </div>
                        <div class="input-note">开启后水印设置才会生效</div>
                    </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label for="sitename">缩图方式</label>
                </div>
                <div class="field">
                        <select class="input" name="THUMB_TYPE" id="THUMB_TYPE">
                            <?php if ($info['THUMB_TYPE'] == 1){ ?>
                            <option value="1" selected>
                            <?php }else{ ?>
                            <option value="1">
                            <?php } ?>
                            等比例缩放</option>
                            <?php if ($info['THUMB_TYPE'] == 2){ ?>
                            <option value="2" selected>
                            <?php }else{ ?>
                            <option value="2">
                            <?php } ?>
                            缩放后填充</option>
                            <?php if ($info['THUMB_TYPE'] == 3){ ?>
                            <option value="3" selected>
                            <?php }else{ ?>
                            <option value="3">
                            <?php } ?>
                            居中裁剪</option>
                            <?php if ($info['THUMB_TYPE'] == 4){ ?>
                            <option value="4" selected>
                            <?php }else{ ?>
                            <option value="4">
                            <?php } ?>
                            左上角裁剪</option>
                            <?php if ($info['THUMB_TYPE'] == 5){ ?>
                            <option value="5" selected>
                            <?php }else{ ?>
                            <option value="5">
                            <?php } ?>
                            右下角裁剪</option>
                            <?php if ($info['THUMB_TYPE'] == 6){ ?>
                            <option value="6" selected>
                            <?php }else{ ?>
                            <option value="6">
                            <?php } ?>
                            固定尺寸缩放</option>
                          </select>
                        <div class="input-note">选择开启缩图后有效</div>
                    </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label for="sitename">缩放宽度</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="THUMB_WIDTH" name="THUMB_WIDTH" size="60" datatype="n" value="<?php echo $info['THUMB_WIDTH'];?>">
                    <div class="input-note">单位：像素</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label for="sitename">缩放高度</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="THUMB_HEIGHT" name="THUMB_HEIGHT" size="60" datatype="n" value="<?php echo $info['THUMB_HEIGHT'];?>">
                    <div class="input-note">单位：像素</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label for="sitename">水印图片</label>
                </div>
                <div class="field">
                    <input type="text" class="input" id="WATER_IMAGE" name="WATER_IMAGE" size="60" datatype="*" value="<?php echo $info['WATER_IMAGE'];?>">
                    <div class="input-note">位于public/watermark下的图片文件</div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label for="sitename">水印位置</label>
                </div>
                <div class="field">
                        <select class="input" name="WATER_POSITION" id="WATER_POSITION">
                            <?php if ($info['WATER_POSITION'] == 1){ ?>
                            <option value="1" selected>
                            <?php }else{ ?>
                            <option value="1">
                            <?php } ?>
                            左上角水印</option>
                            <?php if ($info['WATER_POSITION'] == 2){ ?>
                            <option value="2" selected>
                            <?php }else{ ?>
                            <option value="2">
                            <?php } ?>
                            上居中水印</option>
                            <?php if ($info['WATER_POSITION'] == 3){ ?>
                            <option value="3" selected>
                            <?php }else{ ?>
                            <option value="3">
                            <?php } ?>
                            右上角水印</option>
                            <?php if ($info['WATER_POSITION'] == 4){ ?>
                            <option value="4" selected>
                            <?php }else{ ?>
                            <option value="4">
                            <?php } ?>
                            左居中水印</option>
                            <?php if ($info['WATER_POSITION'] == 5){ ?>
                            <option value="5" selected>
                            <?php }else{ ?>
                            <option value="5">
                            <?php } ?>
                            居中水印</option>
                            <?php if ($info['WATER_POSITION'] == 6){ ?>
                            <option value="6" selected>
                            <?php }else{ ?>
                            <option value="6">
                            <?php } ?>
                            右居中水印</option>
                            <?php if ($info['WATER_POSITION'] == 7){ ?>
                            <option value="7" selected>
                            <?php }else{ ?>
                            <option value="7">
                            <?php } ?>
                            左下角水印</option>
                            <?php if ($info['WATER_POSITION'] == 8){ ?>
                            <option value="8" selected>
                            <?php }else{ ?>
                            <option value="8">
                            <?php } ?>
                            下居中水印</option>
                            <?php if ($info['WATER_POSITION'] == 9){ ?>
                            <option value="9" selected>
                            <?php }else{ ?>
                            <option value="9">
                            <?php } ?>
                            右下角水印</option>
                          </select>
                        <div class="input-note">选择开启缩图后有效</div>
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
</script>";s:12:"compile_time";i:1517832177;}";