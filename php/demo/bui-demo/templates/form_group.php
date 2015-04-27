<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>表单分组</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/page-min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form id="J_Form1" class="well">
        <div id="group" class="bui-form-group">
            <label>起始日期</label>
            <input type="text" name="start" class="calendar"/>
            <label>-</label>
            <input type="text" name="end" class="calendar" />
        </div>
    </form>
    <script type="text/javascript" src="../assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../assets/js/bui-min.js"></script>
    <script type="text/javascript" src="../assets/js/config-min.js"></script>
    <script type="text/javascript">
    BUI.use('form', function(Form) {
        var form1 = new Form.Form({
            srcNode: '#J_Form1',
            validators: {
                '#group': function(record) {
                    if (record.start>record.end) {
                        return '结束日期必须大于起始日期';
                    }
                }
            }
        });
        form1.render();
    });


    </script>
</body>
</html>
