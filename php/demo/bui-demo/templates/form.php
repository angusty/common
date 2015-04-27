<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>form 例子</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/page-min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container">
        <form action="" id="J_Form" class="from-horizontal">
            <div id="newdemo" class="bui-form-group">
                <label for="maxs">必填最大值且最大值不能超过100: </label>
                <input type="text" name="maxs" data-rules="{required:true,max:100, min:20}" id="maxs"/>
            </div>
            <div>
                <input type="text" data-rules="{required:true, max: 2}" data-tip="{text: '请填写内容!', iconCls: 'icon-ok'}"/>
            </div>
            <div>
                <input type="submit" text="提交"/>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="../assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../assets/js/bui-min.js"></script>
    <script type="text/javascript" src="../assets/js/config-min.js"></script>
    <script type="text/javascript">
        BUI.use('common/page');    //页面链接跳转

        BUI.use('form', function(Form) {
            var form = new Form.Form({
                srcNode: '#J_Form',

            });
            form.render();
        });
    </script>
</body>
</html>
