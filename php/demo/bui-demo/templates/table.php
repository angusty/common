<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>table 例子</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/page-min.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <form id="J_Form">
        <div id="grid">
        </div>
        <button id="btnSave" class="button button-primary">提交</button>
    </form>


    <script type="text/javascript" src="../assets/js/jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/bui-min.js"></script>
    <script type="text/javascript" src="../assets/js/config-min.js"></script>

    <script type="text/javascript">
        BUI.use(['bui/grid','bui/data','bui/form'],function (Grid,Data,Form) {
            var columns = [
                {title: '学校名称', dataIndex: 'school', editor:{xtype: 'text', rules:{required:true}}},
                {title: '入学日期', dataIndex: 'enter', editor:{xtype: 'date'}, renderer: Grid.Format.dateRenderer},
                {title: '毕业日期', dataIndex: 'outter', editor:{xtype: 'date', validator: function(value, obj){
                    if(obj.enter && value && obj.enter>value) {
                        return '毕业日期不能晚于入学日期';
                    }
                }}, renderer: Grid.Format.dateRenderer},
                {title: '备注', dataIndex: 'memo', width:200, editor:{xtype: 'text'}}
            ];

            //默认的数据
            var data = [//日期数据以数字格式提供，为了使传入传出数据格式一致，返回值为date.getTime()生成的数字
                {id:'1',school:'武汉第一初级中学',enter:936144000000,outter:993945600000,memo:'表现优异，多次评为三好学生'},
                {id:'2',school:'武汉第一高级中学',enter:999561600000,outter:1057017600000,memo:'表现优异，多次评为三好学生'}
            ],
            //数据缓冲类
           store = new Data.Store({
                data:data
              }),
            //单元格编辑插件
            editing = new Grid.Plugins.CellEditing(),
            //表格配置
            grid = new Grid.Grid({
                render: '#grid',
                columns: columns,
                width: 700,
                forceFit: true,
                store: store,
                plugins: [Grid.Plugins.CheckSelection, editing],
                tbar: {
                    items: [{
                        btnCls: 'button button-small',
                        text: '<li class="icon-plus" ></li>添加',
                        listeners: {
                            'click': addFunction
                        }
                    },
                    {
                        btnCls:'button button-small',
                        text: '<li class="icon-remove"></li>删除',
                        listeners: {
                            'click': delFunction
                        }
                    }]
                }
            });
            //var operator = '';
            grid.render();
            var store_add = new Data.Store();
            function addFunction(){
                var newData = {school:'默认学校'};
                store.add(newData);
                store_add.add(newData);
                //operator = 'add';
                //editing.edit(newData,'school'); //添加记录后，直接编辑
            }

            function delFunction() {
                var selections = grid.getSelection();
                store.remove(selections);
                // operator = 'delete';
            }
            var form = new Form.HForm({
                srcNode: '#J_Form'
            });
            form.render();

            //更新选项时触发
            grid.on('itemupdated', function (ev) {
                //var sender = $(ev.domTarget);
                console.log(ev.item);
            });

            //添加逻辑
            $('#btnSave').on('click', function() {
                if (editing.isValid()) {
                    //var result =newData;
                     // var result = store_add.getResult();
                     // result = BUI.JSON.stringify(result);
                    // console.log(result);
                    //var result = grid.getSelection();
                    // BUI.Message.Alert('ok');
                    var result = store_add.getResult();
                    result = BUI.JSON.stringify(result);
                    console.log(result);
                }

            });
        });

    </script>



</body>
</html>
