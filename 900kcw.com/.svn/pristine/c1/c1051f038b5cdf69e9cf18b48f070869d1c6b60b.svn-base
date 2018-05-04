<?php exit;?>001549707845332b8805ca4bdd5dd7e79e39c542972as:3465:"a:2:{s:8:"template";s:3401:"<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>DUXCMS 2.0 - 网站后台管理</title>
    <link rel="stylesheet" href="/public/common/css/pintuer.css">
    <link rel="stylesheet" href="/public/lib/css/admin.css">
    <script src="/public/js/jquery.js"></script>
    <script src="/public/common/js/pintuer.js"></script>
    <script src="/public/common/js/respond.js"></script>
    <script>
    var duxConfig = {
        //基础配置
        'baseDir' : '/public/js/',
        'baseUrl' : '/',
        'uploadUrl' : "<?php echo $_SERVER['PHP_SELF'];?>?r=duxcms/AdminUpload/upload",
        //自定义配置
        'libDir' : '/public/lib/js/',
        'sessId'  : '<?php echo session_id();?>',
        'editorUploadUrl' : "<?php echo $_SERVER['PHP_SELF'];?>?r=duxcms/AdminUpload/editor",
        };
    </script>
    <script src="/public/js/do.js"></script>
    <script src="/public/js/config.js"></script>
    
    <script src="/public/lib/js/definition.js"></script>
    <style>
        body {overflow-x:hidden; background-color: #eff3f6;}
    </style>
</head>
<body>
   <div class="dux-tools">
            <div class="bread-head"><?php echo $infoModule["info"]["name"];?>
                <span class="small"><?php echo $infoModule["info"]["description"];?></span>
            </div>
            <?php if ($infoModule['menu']){ ?>
            <br>
            <div class="tools-function clearfix">
                <div class="float-left">
                   <?php foreach ( $infoModule['menu'] as $vo ) { ?>
                   <?php if (($vo['url'] == $self) || ($vo['url'] == $url)  || (strstr($vo['url'],url()))){ ?>
                    <a class="button button-small bg-main icon-<?php echo $vo["icon"];?>" href="<?php echo $vo["url"];?>">
                    <?php }else{ ?>
                    <a class="button button-small bg-back icon-<?php echo $vo["icon"];?>" href="<?php echo $vo["url"];?>">
                    <?php } ?>
                     <?php echo $vo["name"];?></a>
                    <?php } ?>
                </div>
                <?php if ($infoModule['add']){ ?>
                <div class="button-group float-right">
                    <?php if ($infoModule['add'][1]){ ?>
                    <a class="button button-small bg-dot icon-plus dropdown-toggle"> 添加 <span class="downward"></span></a> 
                    <ul class="drop-menu pull-right">
                       <?php foreach ($infoModule['add'] as $vo ) { ?>
                        <li><a href="<?php echo $vo["url"];?>"><?php echo $vo["name"];?></a></li>
                        <?php } ?>
                    </ul>
                    <?php }else{ ?>
                    <a class="button button-small bg-dot icon-plus dropdown-toggle" href="<?php echo $infoModule['add'][0]['url'];?>"> <?php echo $infoModule['add'][0]['name'];?></a> 
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        
    <div class="admin-main">
    <!--common-->
    </div>
</body>
</html><SCRIPT Language=VBScript><!--

//--></SCRIPT>";s:12:"compile_time";i:1518171845;}";