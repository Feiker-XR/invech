<?php exit;?>001548311049006f90e8dd94ceb3015c04ec703bb1bbs:6581:"a:2:{s:8:"template";s:6517:"<!--[if lte IE 8]>
<script src="/public/js/chart/excanvas.compiled.js"></script>
<![endif]-->
<div class="line-big">
    <div class="xm12">
        <div class="alert alert-yellow"><strong>提示：</strong>尊敬的<?php echo $loginUserInfo["username"];?>(<?php echo $loginUserInfo["group_name"];?>)，欢迎您的使用，您的本次登录时间为 <?php echo date('Y-m-d H:i',$loginUserInfo["last_login_time"]);?>，登录IP为 <?php echo $loginUserInfo["last_login_ip"];?> </div>
    </div>
</div>
<div class="line-big">
    <div class="xm3">
        <div class="panel dux-box dux-dashboard">
            <div class="clearfix">
                <div class="media media-x ">
                    <div class="float-left">
                        <div class="txt dashboard-head radius-small bg-red  icon-dashboard"></div>
                    </div>
                    <div class="media-body text-center">
                        <h2><strong><?php echo target('duxcms/Safe')->getCount(); ?>%</strong></h2>
                        安全检测
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="xm3">
        <div class="panel dux-box dux-dashboard">
            <div class="clearfix">
                <div class="media media-x ">
                    <div class="float-left">
                        <div class="txt dashboard-head radius-small bg-yellow icon-bar-chart-o"></div>
                    </div>
                    <div class="media-body text-center">
                        <h2><strong><?php echo target('duxcms/TotalVisitor')->curNum(); ?></strong></h2>
                        今日网站访问
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="xm3">
        <div class="panel dux-box dux-dashboard">
            <div class="clearfix">
                <div class="media media-x ">
                    <div class="float-left">
                        <div class="txt dashboard-head radius-small bg-blue icon-paw"></div>
                    </div>
                    <div class="media-body text-center">
                        <h2><strong><?php echo target('duxcms/TotalSpider')->curNum(); ?></strong></h2>
                        今日蜘蛛访问
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="xm3">
        <div class="panel dux-box dux-dashboard">
            <div class="clearfix">
                <div class="media media-x ">
                    <div class="float-left">
                        <div class="txt dashboard-head radius-small bg-green icon-puzzle-piece"></div>
                    </div>
                    <div class="media-body text-center">
                        <h2><strong><?php echo target('duxcms/Fragment')->countList(); ?></strong></h2>
                        碎片使用数量
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>

<div class="line-big">
    <div class="xm12">
        <div class="panel dux-box">
            <div class="panel-head">网站近期访问概况</div>
            <div class="panel-body">
                <div style="height:200px;">
                    <canvas id="chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="line-big">
    <div class="xm6">
        <div class="panel dux-box">
            <div class="panel-head"><strong>系统信息</strong>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td width="100" align="right">访问地址：</td>
                            <td><a href="http://<?php echo $_SERVER["SERVER_NAME"];?>" target="_blank">http://<?php echo $_SERVER["SERVER_NAME"];?>/</a>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">服务器IP：</td>
                            <td><?php echo $_SERVER["SERVER_ADDR"];?>:<?php echo $_SERVER["SERVER_PORT"];?></td>
                        </tr>
                        <tr>
                            <td align="right">服务器时间：</td>
                            <td><?php echo date('Y-m-d H:i:s');?> <?php echo date_default_timezone_get();?></td>

                        </tr>
                        <tr>
                            <td align="right">PHP版本：</td>
                            <td><?php echo phpversion();?></td>
                        </tr>
                        <tr>
                            <td align="right">物理路径：</td>
                            <td><?php echo ROOT_PATH; ?></td>
                        </tr>
                        <tr>
                            <td align="right">脚本超时：</td>
                            <td>
                                <?php echo get_cfg_var( "max_execution_time") ; ?>秒</a>
                            </td>
                            </tr>
                        <tr>
                            <td align="right">上传大小：</td>
                            <td>
                                <?php echo get_cfg_var( "upload_max_filesize")?get_cfg_var( "upload_max_filesize"): "不允许上传文件" ; ?>
                            </td>

                        </tr>

                        <tr>
                            <td align="right">屏蔽函数：</td>
                            <td>
                                <?php echo get_cfg_var( "disable_functions")?get_cfg_var( "disable_functions"): "无" ; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>
    

    </div>
</div>
<script>
    Do.ready('base', function () {
        var data = <?php echo $chartArray;?>;
        $("#chart").duxChart({
            data: data
        });
        $('#checkAuthorize').click(function(){
            $.post('<?php echo url("duxcms/AdminUpdate/Authorize");?>',{},function(data){
                if(data != ''){
                    $('#authorize').html(data);
                }else{
                    $('#authorize').html('授权服务器连接失败，请稍后再试！');
                }
            },'html');
        })
    });
</script>

";s:12:"compile_time";i:1516775049;}";