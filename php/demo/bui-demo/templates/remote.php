<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>remote远程调用</title>
    <link href="../assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/page-min.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <form action="" id="J_Form"  class="from-horizontal">
        <label>异步验证</label>
        <input type="text" name="demo" data-rules="{required: true}"/>
    </form>
    <div class="info">

    </div>

    <script type="text/javascript" src="../assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../assets/js/bui-min.js"></script>
    <script type="text/javascript" src="../assets/js/config-min.js"></script>
    <script type="text/javascript">
        BUI.use('form', function(Form) {
            var form = new Form.Form({
                srcNode: '#J_Form'
            });
            form.render();

            var field = form.getField('demo');
            field.set('remote', {
                method: 'POST',
                url: 'ajax.php',
                dataType: 'json',
                callback: function(data) {
                    var data = BUI.JSON.stringify(data);
                    console.log(data);
                }
                // callback: function(data) {
                //     console.log(data);
                // }
            });
        });

    </script>
</body>
</html>
