<?php exit;?>001549377961b7e72f7ba9f8e79e043c60c942b1ab2es:3619:"a:2:{s:8:"template";s:3555:"<div class="panel dux-box">
    <div class="table-tools clearfix ">
        <div class="float-left">
            <form method="post" action="<?php echo url();?>">
                <div class="form-inline">
                    <div class="form-group">
                        <div class="field">
                            <input type="text" class="input" id="keyword" name="keyword" size="20" value="<?php echo $keyword;?>" placeholder="用户名/邮箱">
                        </div>
                    </div>
                    <div class="form-button">
                        <button class="button" type="submit">搜索</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="float-right">
            <form method="post" action="<?php echo url();?>">
                <div class="form-inline">
                    <div class="form-group">
                        <div class="field">
                            <select class="input" name="group_id">
                                <option value="0">=用户组=</option>
                                <?php foreach ($groupList as $vo) { ?>
                                <?php if ($groupId == $vo['group_id']){ ?>
                                <option value="<?php echo $vo["group_id"];?>" selected>
                                    <?php }else{ ?>
                                    <option value="<?php echo $vo["group_id"];?>">
                                        <?php } ?>
                                        <?php echo $vo["name"];?></option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-button">
                        <button class="button" type="submit">筛选</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table id="table" class="table table-hover ">
            <tbody>
                <tr>
                    <th width="80">编号</th>
                    <th width="*">用户名</th>
                    <th width="*">用户组</th>
                    <th width="*">状态</th>
                    <th width="100">操作</th>
                </tr>
                <?php foreach ($list as $vo) { ?>
                <tr>
                    <td><?php echo $vo["user_id"];?></td>
                    <td><?php echo $vo["username"];?></td>
                    <td><?php echo $vo["group_name"];?></td>
                    <td>
                       <?php if ($vo['status']){ ?>
                       <span class="tag bg-green">正常</span>
                       <?php }else{ ?>
                       <span class="tag bg-red">禁用</span>
                       <?php } ?>
                    </td>
                    <td>
                        <a class="button bg-blue button-small icon-pencil" href="<?php echo url('edit',array('user_id'=>$vo['user_id']));?>" title="修改"></a>
                        <a class="button bg-red button-small icon-trash-o js-del" href="javascript:;" data="<?php echo $vo["user_id"];?>" title="删除"></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="panel-foot table-foot clearfix"><?php echo $page;?></div>
</div>
<script>
Do.ready('base',function() {
	$('#table').duxTable({
		deleteUrl: "<?php echo url('del');?>"
	});
});
</script>";s:12:"compile_time";i:1517841961;}";