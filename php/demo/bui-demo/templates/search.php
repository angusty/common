<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>search 例子</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/page-min.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="container">
        <form id="searchForm" class="form-horizontal">
            <div class="row">
                <div class="control-group span8">
                    <label class="control-label">学生编号：</label>
                    <div class="controls">
                        <input type="text" class="control-text" name="id">
                    </div>
                </div>
                <div class="control-group span8">
                    <label class="control-label">学生姓名：</label>
                    <div class="controls">
                        <input type="text" class="control-text" name="stuName">
                    </div>
                </div>
                <div class="control-group span8">
                    <label class="control-label">性别：</label>
                    <div class="controls" >
                        <select name="" id="" name="sex">
                            <option value="">男</option>
                            <option value="">女</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="control-group span9">
                    <label class="control-label">入学时间：</label>
                    <div class="controls">
                        <input type="text" class="calendar" name="startDate"><span> -
                        </span><input name="endDate" type="text" class="calendar">
                    </div>
                </div>
                <div class="span3 offset2">
                    <button  type="button" id="btnSearch" class="button button-primary">搜索</button>
                </div>
            </div>
        </form>

        <div class="search-grid-container">
            <div id="grid"></div>
        </div>
    </div>


    <script type="text/javascript" src="../assets/js/jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/bui-min.js"></script>
    <script type="text/javascript" src="../assets/js/config-min.js"></script>

    <script type="text/javascript">
      BUI.use(['common/search','common/page'],function (Search) {
        var enumObj = {"1":"男","0":"女"},
          columns = [
              {title:'学生编号',dataIndex:'id',width:80,renderer:function(v){
                return Search.createLink({
                  id : 'detail' + v,
                  title : '学生信息',
                  text : v,
                  href : 'form.php'
                });
              }},
              {title:'学生姓名',dataIndex:'name',width:100},
              {title:'生日',dataIndex:'birthday',width:100,renderer:BUI.Grid.Format.dateRenderer},
              {title:'学生性别',dataIndex:'sex',width:60,renderer:BUI.Grid.Format.enumRenderer(enumObj)},
              {title:'学生班级',dataIndex:'grade',width:100},
              {title:'学生家庭住址',dataIndex:'address',width:300},
              {title:'操作',dataIndex:'',width:200,renderer : function(value,obj){
                var editStr =  Search.createLink({ //链接使用 此方式
                    id : 'edit' + obj.id,
                    title : '编辑学生信息',
                    text : '编辑',
                    href : 'form.php'
                  }),
                  delStr = '<span class="grid-command btn-del" title="删除学生信息">删除</span>';//页面操作不需要使用Search.createLink
                return editStr + delStr;
              }}
            ],
            store = Search.createStore('student.json', {
                sortInfo: {
                    field: 'id',
                    direction: 'ASC'
                }
            }),
            gridCfg = Search.createGridCfg(columns, {
                tbar : {
                    items : [
                    {text : '<i class="icon-plus"></i>新建',btnCls : 'button button-small',handler:function(){alert('新建');}},
                    {text : '<i class="icon-edit"></i>编辑',btnCls : 'button button-small',handler:function(){alert('编辑');}},
                    {text : '<i class="icon-remove"></i>删除',btnCls : 'button button-small',handler : delFunction}
                    ]
                },
                plugins: [BUI.Grid.Plugins.CheckSelection]

            });
            var search = new Search({
                store: store,
                gridCfg: gridCfg
            }),
            grid = search.get('grid');
            function delFunction() {

            }
        });

</script>

</body>
</html>
