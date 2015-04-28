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

    <button id="btn1" class="button button-small">show</button>
    <button id="btn2" class="button button-small" >hidden</button><br /><br />

    <form id="J_Form">
        <input type="text" name="test" data-depends="{'#btn1:click':['show'],'#btn2:click':['hide']}" />
    </form>

    <script type="text/javascript" src="../assets/js/jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/bui-min.js"></script>
    <script type="text/javascript" src="../assets/js/config-min.js"></script>
    <script type="text/javascript">
        BUI.use('form', function(Form) {
            var form = new Form.Form({
                srcNode: '#J_Form'
            });
            form.render();
        });
    </script>
</body>
</html>
