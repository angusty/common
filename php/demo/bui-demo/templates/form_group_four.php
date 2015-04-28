<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>表单分组</title>
        <link href="../assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/bui-min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/page-min.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <form action="" method="post" id="form">
        <div class="bui-form-group-select" data-type="name">
            <label>省市联动：</label>
            <select class="input-small" name="province" value="1">
            <option>请选择省</option>
            </select>
            <select class="input-small"  name="city" value="12"><option>请选择市</option></select>
            <select class="input-small"  name="county" value="121"><option>请选择县/区</option></select>
        </div>
    </form>

    <script type="text/javascript" src="../assets/js/jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/bui-min.js"></script>
    <script type="text/javascript" src="../assets/js/config-min.js"></script>
    <script type="text/javascript">

        var data = [{"id" : "1","text":"山东","children":[
              {"id":"11","text":"济南","leaf":false},
              {"id":"12","text":"淄博","leaf":false,"children":[
                {"id":"121","text":"高青","leaf":true}
              ]}
            ]}];

        BUI.Form.Group.Select.addType('name',{
            data: data
        });

        BUI.use('form', function(Form) {
            var form = new Form.Form({
                srcNode: '#form'
            });
            form.render();
        });

    </script>
</body>
</html>
