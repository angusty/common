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
<!-- <form action="" method="post" id="form">
    <div class="bui-form-group-select" data-url="data.json">
          <label>省市联动：</label>
          <select class="input-small" name="province" value="1">
                <option>请选择省</option>
          </select>
          <select class="input-small"  name="city" value="12"><option>请选择市</option></select>
          <select class="input-small"  name="county" value="121"><option>请选择县/区</option></select>
    </div>
</form> -->

<form action="" method="post" id="form">
    <div class="bui-form-group-select" id="city-group" data-type="name">
          <label>省市联动：</label>
          <select class="input-small" name="province" value="1">
                <option>请选择省</option>
          </select>
          <select class="input-small"  name="city" value="12"><option>请选择市</option></select>
          <select class="input-small"  name="county" value="121"><option>请选择县/区</option></select>
    </div>
</form>

<script type="text/javascript" src="../assets/js/jquery-1.11.2.min.js"></script>
<!-- <script type="text/javascript" src="../assets/js/jquery-1.8.1.min.js"></script> -->
<script type="text/javascript" src="../assets/js/bui-min.js"></script>
<script type="text/javascript" src="../assets/js/config-min.js"></script>
<script type="text/javascript">
    BUI.use('form', function(Form) {
        var form = new Form.Form({
            srcNode: '#form'
        });
        form.render();
    });

    var store = new BUI.Data.TreeStore({
    proxy: {
        url: 'data.json',
        dataType: 'json'
    }
    // url : 'data.json',
    // dataType: 'json'
    ,
    //数据映射
    map: {
        isleaf : 'leaf', //将数据中的isleaf字段映射成leaf字段
        id : 'text'
    }
    });
    console.log(store);
    new BUI.Form.Group.Select({
        srcNode: '#city-group',
        store: store
    });

</script>
</body>
</html>
