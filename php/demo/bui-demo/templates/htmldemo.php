<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>html的demo</title>
</head>
<body>
    <div class="content">
        <div class="dl-main-nav">
            <ul id="J_Nav"  class="nav-list ks-clear">
                <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">第一个menu</div></li>
                <li class="nav-item"><div class="nav-item-inner nav-order">第二个menu</div></li>
                <li class="nav-item oo"><div class="nav-item-inner nav-supplier">我来测试</div></li>
            </ul>
        </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>

   </div>
   <script type="text/javascript">
        if (top.topManager) {
            top.topManager.openPage({
                id : 'mytest3',
                search: 'a=111&b=444',          //带参数过去 方便查询
                //href: 'main/test.html',       //页面链接地址
                title: '相对地址测试'         //标题
            });
        }
        // if (top.topManager) {
        //     top.topManager.closePage();  //关闭当前子页面
        // }

    </script>
</body>
</html>
