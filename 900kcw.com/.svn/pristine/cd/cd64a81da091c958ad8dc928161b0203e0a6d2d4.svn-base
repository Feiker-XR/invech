<?php exit;?>001549707845699913592393065825c8a0da516c1cacs:5351:"a:2:{s:8:"template";s:5287:"<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>网站后台管理</title>
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
    body,html{overflow: hidden;}
    </style>
</head>
<body>
    <div class="dux-head clearfix">
   
        <div class="dux-nav">
            <ul class="nav  nav-navicon nav-inline admin-nav" id="nav">
            </ul>
            <ul class="nav  nav-navicon nav-menu nav-inline admin-nav nav-tool">
               <li> <a href="/" target="_blank" class="icon-home"></a></li>
                <li> <a href="<?php echo url('admin/AdminUser/edit',array('user_id'=>$loginUserInfo['user_id']));?>" target="dux-iframe" class="icon-user"></a></li>
                <li> <a href="<?php echo url('admin/Login/logout');?>" class="dux-logout bg-red icon-power-off"></a></li>
            </ul>
        </div>
    </div>
    <div class="dux-sidebar">
        <ul class="nav  nav-navicon admin-menu">
            <div class="nav-head" id="nav-head"></div>
            <div id="menu">
                <li><a href="<?php echo $vo["url"];?>" class="icon-<?php echo $vo["icon"];?>"> <?php echo $vo["name"];?></a></li>
            </div>
        </ul>
        <ul id="tree" class="ztree load">
    
        </ul>
    </div>    
    <div class="dux-admin">
            <iframe id="dux-iframe" name="dux-iframe" class="dux-iframe" src="" frameborder="0"></iframe>
    </div>
</body>   
<script>
    //生成主菜单
    var data = <?php echo $menuList;?>;
    var topNav = '';
    for(var i in data){
        if(data[i]['menu'] != ''){
            topNav += '<li><a href="javascript:;" data="'+i+'" url="" class="icon-'+data[i].icon+'"> '+data[i].name+'</a></li>';
        }
    }
    $('#nav').html(topNav);
    //绑定导航连接
    $('#nav').on('click','a',function(){
        $('#nav-head').text($(this).text());
        var n = $(this).attr('data');
        var menu = data[n]['menu'];
        var app = data[n]['app'];
        var menuHtml =  '';
        if (app == 'cate') {
             var url = "<?php echo url('article/AdminContent/index');?>";
             $('.dux-iframe').attr('src',url);
            Do.ready('ztree', function () {
                var zTree;
                var setting = {
                    view: {
                        showLine: true,
                        selectedMulti: false
                    },
                    data: {
                        simpleData: {
                            enable: true,
                            idKey: "cid",
                            pIdKey: "pid",
                            rootPId: ""
                        }
                    },
                    callback: {
                        onClick: onClick
                    }
                };
                var zNodes = [
                <?php echo $cateList;?>
                ];

                function onClick(e,treeId, treeNode) {
                    var zTree = $.fn.zTree.getZTreeObj("tree");
                    if(treeNode.url==null){
                    zTree.expandNode(treeNode);
                    }
                    
                }
                $(document).ready(function() {
                    var t = $("#tree");
                    t = $.fn.zTree.init(t, setting, zNodes);
                });               

            }); 
        }else{
            if(menu != ''){
                for(var i in menu){
                    menuHtml += '<li><a href="javascript:;" url="'+menu[i].url+'" class="icon-'+menu[i].icon+'"> '+menu[i].name+'</a></li>';
                }
            }
            $('#tree').empty();
        }
        $('#menu').html(menuHtml);
        //设置样式
        $('#nav li').removeClass('active');
        $(this).parent('li').addClass('active');
        //打开菜单
        $('#menu a:first').click();
    });
    //绑定菜单连接
    $('#menu').on('click','a',function(){
        var url = $(this).attr('url');
        $('.dux-iframe').attr('src',url);
        //设置样式
        $('#menu li').removeClass('active');
        $(this).parent('li').addClass('active');
    });
    $('#nav a:first').click();
</script>
</html>";s:12:"compile_time";i:1518171845;}";