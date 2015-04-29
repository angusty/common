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

        <div id="content" class="hide">
            <form id="J_Form" class="form-horizontal">
                <div class="row">
                  <div class="control-group span8">
                    <label class="control-label"><s>*</s>学校名称：</label>
                    <div class="controls">
                      <input name="school" type="text" data-rules="{required:true}" class="input-normal control-text">
                    </div>
                  </div>
                  <div class="control-group span8">
                    <label class="control-label"><s>*</s>学生类型：</label>
                    <div class="controls">
                      <select  data-rules="{required:true}"  name="type" class="input-normal">
                        <option value="">请选择</option>
                        <option value="zou">走读</option>
                        <option value="zhu">住校</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="control-group span15 ">
                    <label class="control-label">在校日期：</label>
                    <div id="range" class="controls bui-form-group" data-rules="{dateRange : true}">
                      <input name="enter" class="calendar" type="text"><label>&nbsp;-&nbsp;</label><input name="outter" class="calendar" type="text">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="control-group span15">
                    <label class="control-label">备注：</label>
                    <div class="controls control-row4">
                      <textarea name="memo" class="input-large" type="text"></textarea>
                    </div>
                  </div>
                </div>
            </form>
        </div>

        <script type="text/javascript" src="../assets/js/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/bui-min.js"></script>
        <script type="text/javascript" src="../assets/js/config-min.js"></script>
        <script type="text/javascript">
            BUI.use(['bui/data', 'bui/form', 'bui/grid'], function(Data, Form, Grid) {
                //列定义
                var Grid = Grid,
                    Form = Form.Form,
                    Store = Data.Store;
                var columns = [
                    {title : '学校名称',dataIndex :'school'},
                    {title : '入学日期',dataIndex :'enter'},
                    {title : '毕业日期',dataIndex :'outter'},
                    {title : '备注',dataIndex :'memo',width:200},
                    {title : '操作',renderer : function(){
                        return '<span class="grid-command btn-edit">编辑</span>';
                    }}
                ],
                //插件初始化
                editing = new Grid.Plugins.DialogEditing({
                    contentId: 'content',         //弹出框显示内容的id
                    //triggerCls: 'btn-edit',        //点击表格时触发的css

                }),
                store = new Store({

                }),
                //表格初始化
                grid = new Grid.Grid({
                    render : '#grid',
                    columns : columns,
                    width : 700,
                    forceFit : true,
                    store : store,
                    plugins : [Grid.Plugins.CheckSelection,editing],
                    tbar:{
                      items : [{
                        btnCls : 'button button-small button-add',
                        text : '<i class="icon-plus"></i>添加',
                        listeners : {
                          'click' : addFunction
                        }
                      },
                      {
                        btnCls : 'button button-small button-delete',
                        text : '<i class="icon-remove"></i>删除',
                        listeners : {
                          'click' : delFunction
                        }
                      }]
                    }

                });

                grid.render();

                //确认编辑
                editing.on('accept', function(env, form) {
                    var data = env.record;
                    console.log(form);
                });

            function addFunction(){
                var newData = {type:'zou'};
                // console.log(newData);
                editing.add(newData);    //添加完毕后 在table中也添加
                //editing.edit(newData,'school'); //添加记录后，直接编辑
            }

            function delFunction() {
                var selections = grid.getSelection();
                store.remove(selections);
                // operator = 'delete';
            }

            });
        </script>
    </body>
</html>
