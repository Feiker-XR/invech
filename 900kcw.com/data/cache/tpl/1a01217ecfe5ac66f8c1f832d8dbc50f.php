<?php exit;?>001549715577a27e089695594d7c2530a5d662936d28s:20414:"a:2:{s:8:"template";s:20349:"<form method="post" class="form-x dux-form form-auto" id="form" action="<?php echo url();?>">
    <div class="tab dux-tab">
        <div class="panel dux-box  active">
            <div class="panel-head">
                <div class="tab-head">
                    <strong><?php echo $name;?>文章</strong>
                    <ul class="tab-nav">
                        <li class="active"><a href="#tab-1">基本信息</a>
                        </li>
                        <li><a href="#tab-2">扩展信息</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-body">
                <div class="tab-panel active" id="tab-1">
                    <div class="form-group">
                        <div class="label">
                            <label>==文章栏目==</label>
                        </div>
                        <div class="field">
                            <select class="input" name="class_id" id="class_id">
                              <option value="0">请选择栏目</option>
                               <?php foreach ($categoryList as $vo) { ?>
                               <option value="<?php echo $vo["class_id"];?>" 
                               <?php if ($info['class_id'] == $vo['class_id']){ ?>
                               selected="selected"
                               <?php } ?>
                               <?php if ($vo['type'] == 0 || $vo['app'] != APP_NAME){ ?>
                               style="background-color:#CCC" disabled="disabled"
                               <?php } ?>
                               ><?php echo $vo["cname"];?></option>
                               <?php } ?>
                            </select>
                            <div class="input-note">当前文章的所属栏目</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>文章标题</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="title" name="title" size="60" datatype="*" value="<?php echo $info["title"];?>">
                            
                            <div class="input-note">文章标题请不要填写特殊字符</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label>形象图</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="image" name="image" size="38" value="<?php echo $info["image"];?>">
                            <a class="button bg-blue button-small  js-img-upload" data="image" id="image_upload" preview="image_preview" href="javascript:;" ><span class="icon-upload"> 上传</span></a>
                            <a class="button bg-blue button-small icon-picture-o" id="image_preview" href="javascript:;" > 预览</a>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label">
                            <label>文章内容</label>
                        </div>
                        <div class="field">
                            <textarea class="input js-editor" id="content" name="content" rows="20" ><?php echo html_out($info["content"]);?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label">
                            <label>内容功能</label>
                        </div>
                        <div class="field">
                              <label>
                              <?php if($default_config['ARTICLE_TOPIC']){ ?>
                              <input name="get_image" id="get_image" type="checkbox" value="1" checked>
                              <?php }else{ ?>
                              <input name="get_image" id="get_image" type="checkbox" value="1">
                              <?php } ?>
                              提取第 <input type="number" class="input" id="get_image_num" name="get_image_num" size="1" value="1"> 张图片作封面</label> 
                              <label>
                              <?php if($default_config['ARTICLE_DESCRIPTION']){ ?>
                              <input name="get_description" id="get_description" type="checkbox" value="1" checked>
                              <?php }else{ ?>
                              <input name="get_description" id="get_description" type="checkbox" value="1">
                              <?php } ?>
                              提取文章描述</label>
                           
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label">
                            <label>文章描述</label>
                        </div>
                        <div class="field">
                            <textarea class="input" id="description" name="description"  rows="3" cols="62" ><?php echo $info["description"];?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label">
                            <label>关键词/TAG</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="keywords" name="keywords" size="50" value="<?php echo $info["keywords"];?>">
                            <?php if(!isset($info['taglink'])){ $info['taglink'] = $default_config['ARTICLE_TAGLINK']; }; ?>
                            <select class="input" name="taglink" id="taglink">
                                <option  value="0"
                                <?php if ($info['taglink'] == '0'){ ?>
                                selected="selected"
                                <?php } ?>
                                >不链接TAG</option>
                                <option value="1"
                                <?php if ($info['taglink'] == '1'){ ?>
                                selected="selected"
                                <?php } ?>
                                >链接TAG</option>
                            </select>
                            <a class="button bg-blue " id="getKeyword" href="javascript:;" >提取</a>
                            <div class="input-note">选择链接TAG后将会为内容的关键词链接TAG列表</div>
                        </div>
                    </div>
                    <div id="expand"></div>
                    <div class="form-group">
                        <div class="label">
                            <label>文章状态</label>
                        </div>
                        <div class="field">
                               <?php if(!isset($info['status'])){ $info['status'] = 1; }; ?>
                                <div class="button-group radio">
                                    <?php if ($info['status']){ ?>
                                    <label class="button active"><input name="status" value="1" checked="checked" type="radio">
                                    <?php }else{ ?>
                                    <label class="button"><input name="status" value="1" type="radio">
                                    <?php } ?>
                                    <span class="icon icon-check"></span> 发布</label>
                                    <?php if (!$info['status']){ ?>
                                    <label class="button active"><input name="status" checked="checked" value="0" type="radio">
                                    <?php }else{ ?>
                                    <label class="button"><input name="status" value="0" type="radio">
                                    <?php } ?>
                                    <span class="icon icon-times"></span> 不发布</label>
                                </div>
                                <div class="input-note">隐藏后在调用栏目列表时不显示</div>
                            </div>
                    </div>
                </div>
                <div class="tab-panel" id="tab-2">
                    
                    <div class="form-group">
                        <div class="label">
                            <label>标题颜色</label>
                        </div>
                        <div class="field">
                           <select class="input" name="font_color" id="font_color">
                                <option value="0">==标题颜色==</option>
                                <option style="color: White;background-color: red;" value="red"
                                <?php if ($info['font_color'] == 'red'){ ?>
                                selected="selected"
                                <?php } ?>
                                >红色</option>
                                <option style="color: White;background-color: blue;" value="blue"
                                <?php if ($info['font_color'] == 'blue'){ ?>
                                selected="selected"
                                <?php } ?>
                                >蓝色</option>
                                <option style="color: White;background-color: green;" value="green"
                                <?php if ($info['font_color'] == 'green'){ ?>
                                selected="selected"
                                <?php } ?>
                                >绿色</option>
                                <option style="color: White;background-color: orange;" value="orange"
                                <?php if ($info['font_color'] == 'orange'){ ?>
                                selected="selected"
                                <?php } ?>
                                >橙色</option>
                                <option style="color: Black;background-color: White;" value="white"
                                <?php if ($info['font_color'] == 'white'){ ?>
                                selected="selected"
                                <?php } ?>
                                >白色</option>
                                <option style="color: White;background-color: Black;" value="black"
                                <?php if ($info['font_color'] == 'black'){ ?>
                                selected="selected"
                                <?php } ?>
                                >黑色</option>
                            </select>
                            
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label">
                            <label>文章格式</label>
                        </div>
                        <div class="field">
                            <div class="button-group checkbox">
                              <?php if ($info['font_bold'] == '1'){ ?>
                              <label class="button active"><input name="font_bold" value="1" type="checkbox" checked="checked"><span class="icon icon-check"></span> 加粗</label>
                              <?php }else{ ?>
                              <label class="button"><input name="font_bold" value="1" type="checkbox"><span class="icon icon-check"></span> 加粗</label>
                              <?php } ?>
                              <?php if ($info['font_bold'] == '1'){ ?>
                              <label class="button active"><input name="font_em" value="1" type="checkbox" checked="checked"><span class="icon icon-check"></span> 倾斜</label>
                              <?php }else{ ?>
                              <label class="button"><input name="font_em" value="1" type="checkbox"><span class="icon icon-check"></span> 倾斜</label>
                              <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label">
                            <label>推荐位置</label>
                        </div>
                        <div class="field">
                            <div class="button-group checkbox">
                            <?php $positionArray = explode(',',$info['position']);  ?>
                             <?php foreach ($positionList as $vo) { ?>
                              <?php if (in_array($vo['position_id'],$positionArray)){ ?>
                              <label class="button active"><input name="position[]" value="<?php echo $vo["position_id"];?>" type="checkbox" checked="checked"><span class="icon icon-check"></span> <?php echo $vo["name"];?></label>
                              <?php }else{ ?>
                              <label class="button"><input name="position[]" value="<?php echo $vo["position_id"];?>" type="checkbox"><span class="icon icon-check"></span> <?php echo $vo["name"];?></label>
                              <?php } ?>
                              <?php } ?>
                            </div>
                            <div class="input-note">将文章推荐到指定调用位置</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label">
                            <label>内容URL</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="urltitle" name="urltitle" size="60" value="<?php echo $info["urltitle"];?>">
                            <div class="input-note">设置URL规则后会生效</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label">
                            <label>跳转到</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="url" name="url" size="60" value="<?php echo $info["url"];?>">
                            <div class="input-note">设置后访问内容会跳转</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label">
                            <label>发布时间</label>
                        </div>
                        <div class="field">
                           <?php if (empty($info['time'])){ ?>
                            <input type="text" class="input js-time" id="time" name="time" size="60" value="<?php echo date('Y/m/d H:i');?>">
                            <?php }else{ ?>
                            <input type="text" class="input js-time" id="time" name="time" size="60" value="<?php echo date('Y/m/d H:i',$info['time']);?>">
                            <?php } ?>
                            <div class="input-note">请按照格式填写发布时间</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label">
                            <label>来源</label>
                        </div>
                        <div class="field">
                           <?php $copyfrom = explode(',', $default_config['ARTICLE_COPYFROM']); ?>
                            <input type="text" class="input" id="copyfrom" name="copyfrom" size="48" value="<?php echo default_data($info["copyfrom"],$copyfrom[0]);?>">
                            <select class="input js-assign" target="#copyfrom">
                                <?php foreach ($copyfrom as $vo) { ?>
                                <option value="<?php echo $vo;?>"><?php echo $vo;?></option>
                                <?php } ?>
                            </select>
                            <div class="input-note">当前内容来源</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label">
                            <label>访问量</label>
                        </div>
                        <div class="field">
                            <input type="number" class="input" id="views" name="views" size="60" value="<?php echo default_data($info["views"],0);?>">
                            <div class="input-note">文章点击次数</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="label">
                            <label>顺序</label>
                        </div>
                        <div class="field">
                            <input type="number" class="input" id="sequence" name="sequence" size="60" value="<?php echo default_data($info["sequence"],0);?>">
                            <div class="input-note">开启自定义排序有效</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="label">
                            <label for="sitename">内容模板</label>
                        </div>
                        <div class="field">
                            <input type="text" class="input" id="tpl" name="tpl" size="20" value="<?php echo $info["tpl"];?>">
                            <select class="input js-assign" target="#tpl">
                                <option value="">请选择</option>
                                <?php foreach ($tplList as $vo) { ?>
                                <option value="<?php echo $vo["name"];?>"><?php echo $vo["file"];?></option>
                                <?php } ?>
                            </select>
                            <div class="input-note">不设置将使用列表设置模板</div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="panel-foot">
                <div class="form-button">
                    <div id="tips"></div>
                    <input type="hidden" name="content_id" id="content_id" type="hidden" value="<?php echo $info["content_id"];?>">
                    <button class="button bg-main" type="submit">保存</button>
                    <button class="button bg" type="reset">重置</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
	//var content_editor = 'xxxx';
    Do.ready('base', function () {
        //表单综合处理
        $('#form').duxFormPage();
        //上传缩略图
        $('#upload').duxFileUpload({
            type: 'jpg,png,gif,bmp',
            complete: function (data) {
                $('#content_image').attr('src', data.url);
            }
        });
        //提取关键词
        $('#getKeyword').click(function () {
            $.post('<?php echo url("duxcms/ContentTools/getKerword");?>', {
                    title: $('#content').val(),
                    content: $('#description').val()
                },
                function (data) {
                    if (data.status) {
                        $('#keywords').val(data.info);
                    } else {
                        alert(data.info);
                    }
                }, 'json');
        });
		//动态获取扩展字段
		$('#class_id').change(function() {
			$('#expand').load('<?php echo url("duxcms/AdminExpand/getField");?>',{class_id:$(this).val(),content_id:$('#content_id').val()},function(){
				$('#expand').duxFormPage({form:false});
			});
		});
		$('#class_id').change();
		
    }); 
</script>";s:12:"compile_time";i:1518179577;}";