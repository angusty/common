<!DOCTYPE HTML>
<html>
    <head>
        <title> 艺乐东方管理后台 </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/bui-min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/main.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="header">
        <div class="dl-title"><span class="">艺乐东方管理后台</span></div>
        <div class="dl-log">欢迎您，<span class="dl-log-user">XXX</span>
            <a href="###" title="退出系统" class="dl-log-quit">[退出]</a>
        </div>
        </div>

        <div class="content">
        <div class="dl-main-nav">
        <ul id="J_Nav"  class="nav-list ks-clear">
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">测试memu</div></li>
        </ul>
        </div>
        <ul id="J_NavContent" class="dl-tab-conten"></ul>
        </div>
        <!-- <script type="text/javascript" src="../assets/js/jquery-1.11.2.min.js"></script> -->
        <script type="text/javascript" src="../assets/js/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/bui-min.js"></script>
        <script type="text/javascript" src="../assets/js/config-min.js"></script>
        <script>
        BUI.use('common/main',function() {
            //模块菜单
            var config =
            [{
                id: 'three_menu',       //模块编号
                collapsed: false,       //左侧菜单是否收缩，默认false 不收缩
                homePage: 'mytest1',    //默认打开的主页
                menu: [{                //二级菜单
                    text: '测试一',
                    items: [
                        //closeable: true ,     是否可以关闭标签 默认true 可以
                        {id: 'mytest1', 'text':'显示php配置信息',  closeable: true ,  href: 'show_phpinfo.php'},
                        {id: 'mytest2', 'text': '显示服务器信息', href: 'show_server.php'}
                    ]
                },
                {
                    text: '测试二',
                    items: [
                        {id: 'mytest3', text: '显示当前ip', href: 'show_ip.php'},
                        {id: 'mytest4', text: '显示一个htmldemo', href: 'htmldemo.php'},
                        {id: 'mytest5', text: '表单demo', href: 'form.php'},
                        {id: 'mytest6', text: '表单分组', href: 'form_group.php'},
                        {id: 'mytest7', text: '远程调用', href: 'remote.php'},
                        {id: 'mytest8', text: '表单分组', href: 'form_group_two.php'},
                        {id: 'mytest9', text: '表单分组3', href: 'form_group_three.php'},
                        {id: 'mytest10', text: '表单分组4', href: 'form_group_four.php'},
                        {id: 'mytest11', text: '表单联动', href: 'form_play.php'}
                    ]
                },
                {
                    text: '测试三',
                    items:[
                    {id: 'mytest3_1', text: '可编辑表格', href: 'table.php'},
                    {id: 'mytest3_2', text: '弹出框表格', href: 'tableDialog.php'}
                    ]
                },
                {
                    text: '搜索测试',
                    items:[
                    {id: 'mytest3_3', text: '搜索', href: 'search.php'}
                    ]
                }]
            }];

            //初始化主页菜单
            new PageUtil.MainPage({
            modulesConfig : config
            });
        });

        </script>
    </body>
</html>


