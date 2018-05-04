<?php exit;?>0015504826880a00b33946aff7ef85b2d3116e3e28f5s:5638:"a:2:{s:8:"template";s:5574:"<div class="panel dux-box">
   <div class="table-tools clearfix ">
        <div class="float-left">
            <form method="post" id="form" action="<?php echo url('duxcms/AdminStatistics/SpiderInfo');?>">
                <div class="form-inline">
                    <div class="form-group">
                        <div class="field">
                            <input type="text" class="input js-time" id="time" name="time1" data-format="Y/m/d" size="20" value="<?php echo $info["time1"];?>" placeholder="起始日期">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field">
                            <input type="text" class="input js-time" id="time" name="time2" size="20" value="<?php echo $info["time2"];?>" placeholder="结束日期">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field">
                           <select class="input" name="boot" id="boot">
                                <option value="all">==选择搜索引擎==</option>
                                <option value="baidu"  
                                <?php if ($info['boot'] == 'baidu'){ ?>
                                selected="selected"
                                <?php } ?>
                                >百度</option>
                                <option value="google" 
                                <?php if ($info['boot'] == 'google'){ ?>
                                selected="selected"
                                <?php } ?>
                                >谷歌</option>
                                <option value="bing" 
                                <?php if ($info['boot'] == 'bing'){ ?>
                                selected="selected"
                                <?php } ?>
                                >必应</option>
                                <option value="yahoo" 
                                <?php if ($info['boot'] == 'yahoo'){ ?>
                                selected="selected"
                                <?php } ?>
                                >雅虎</option>
                                <option value="soso" 
                                <?php if ($info['boot'] == 'soso'){ ?>
                                selected="selected"
                                <?php } ?>
                                >soso</option>
                                <option value="sogou" 
                                <?php if ($info['boot'] == 'sogou'){ ?>
                                selected="selected"
                                <?php } ?>
                                >搜狗</option>
                                <option value="yodao" 
                                <?php if ($info['boot'] == 'yodao'){ ?>
                                selected="selected"
                                <?php } ?>
                                >有道</option>
                                <option value="360" 
                                <?php if ($info['boot'] == '360'){ ?>
                                selected="selected"
                                <?php } ?>
                                >360</option>
                                <option value="shenma" 
                                <?php if ($info['boot'] == 'shenma'){ ?>
                                selected="selected"
                                <?php } ?>
                                >神马</option>
                            </select>
                            </div>
                        </div>
                    <div class="form-button">
                        <button class="button" type="submit">搜索</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table id="table" class="table table-hover ">
            <tbody>
                <tr>
                    <th width="100">编号</th>
                    <th width="*">引擎名称</th>
                    <th width="*">爬行网址</th>
                    <th width="*">爬行时间</th>
                </tr>
                <?php foreach ($list as $key=>$vo) { ?>
                <tr>
                    <td><?php echo $key+1;?></td>
                    <td><?php echo $vo["boot"];?></td>
                    <td><a href="<?php echo $vo["url"];?>" target="_blank"><?php echo $vo["url"];?></a></td>
                    <td><?php echo date('Y-m-d H:i:s',$vo['time']);?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="panel-foot table-foot clearfix">
        <div class="float-left">
            百度实时收录约为 <a href="<?php echo $baidu["url"];?>" target="_blank"><?php echo $baidu["num"];?></a> 条,  该时间段内总共有 <?php echo $count;?> 次蜘蛛来访！
        </div>
        <div class="float-right">
            <?php echo $page;?>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    Do.ready('base',function() {
        //时间选择
        if ($("#form").find(".js-time").length > 0) {
            $("#form").find('.js-time').duxTime();
        }

    });

</script>";s:12:"compile_time";i:1518946688;}";