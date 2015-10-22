<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-10-15
 * Time: 上午10:06
 */
?>
<div class="page-head">
    <h2>建表</h2>
    <ol class="breadcrumb">
        <li><a href="/">控制面板</a></li>
        <!-- <li><a href="/table/index">建表</a></li>-->
        <li class="active">详情</li>
    </ol>
</div>
<div class="block-flat">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>编号</th>
                <th>姓名</th>
                <th>部门</th>
                <th>考核期间</th>
                <th>考核状态</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>赵晴</td>
                <td>技术网络部</td>
                <td>2015-09</td>
                <td>建表</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="block-flat">
    <table class="well">
        <tbody class="no-border-x no-border-y">
        <tr>
            <td>
                <?php echo CHtml::link('复制', array("table/create"), array('class' => 'btn btn-info pull-right')); ?>
                &nbsp;&nbsp;
                <?php echo CHtml::link('新增项目', array("table/create"), array('class' => 'btn btn-info pull-right')); ?>
                &nbsp;&nbsp;
            </td>
        </tr>
        </tbody>
    </table>

    <div class="content">
        <table class="table table-bordered">
        </table>
    </div>
    <div class="content">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>编号</th>
                <th>考核项目</th>
                <th>考核要点</th>
                <th>评分标准</th>
                <th>权重</th>
                <th>目标额</th>
                <th>完成额</th>
                <th>完成比例</th>
                <th>自评</th>
                <th>考核</th>
                <th>会签建议</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>忠诚度</td>
                <td>忠诚</td>
                <td></td>
                <td>0.05</td>
                <td>100%</td>
                <td>100%</td>
                <td>1:1</td>
                <td>100</td>
                <td>99</td>
                <td>优秀</td>
                <td class="button-column">
                    <a class="btn  btn-primary btn-xs J_BtnEdit" title="修改" href="javascript:;" data-toggle="modal" data-target="#myModal">修改</a>
                    <a class="btn  btn-primary btn-xs J_BtnDelete" title="删除" href="javascript:;">删除</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>积极性</td>
                <td>积极</td>
                <td></td>
                <td>0.05</td>
                <td>100%</td>
                <td>100%</td>
                <td>1:1</td>
                <td>100</td>
                <td>99</td>
                <td>优秀</td>
                <td class="button-column">
                    <a class="btn  btn-primary btn-xs J_BtnEdit" title="修改" href="javascript:;" data-toggle="modal" data-target="#myModal">修改</a>
                    <a class="btn  btn-primary btn-xs J_BtnDelete" title="删除" href="javascript:;">删除</a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>学习与培养</td>
                <td>学习</td>
                <td></td>
                <td>0.05</td>
                <td>100%</td>
                <td>100%</td>
                <td>1:1</td>
                <td>100</td>
                <td>99</td>
                <td>优秀</td>
                <td class="button-column">
                    <a class="btn  btn-primary btn-xs J_BtnEdit" title="修改" href="javascript:;" data-toggle="modal" data-target="#myModal">修改</a>
                    <a class="btn  btn-primary btn-xs J_BtnDelete" title="删除" href="javascript:;">删除</a>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>沟通协作</td>
                <td>沟通</td>
                <td></td>
                <td>0.5</td>
                <td>100%</td>
                <td>100%</td>
                <td>1:1</td>
                <td>100</td>
                <td>99</td>
                <td>优秀</td>
                <td class="button-column">
                    <a class="btn  btn-primary btn-xs J_BtnEdit" title="修改" href="javascript:;" data-toggle="modal" data-target="#myModal">修改</a>
                    <a class="btn  btn-primary btn-xs J_BtnDelete" title="删除" href="javascript:;">删除</a>
                </td>
            </tr>

            </tbody>
        </table>

        <div style="text-align: center">
            <?php $this->renderPartial('_input_table') ?>
        </div>
    </div>
</div>




<button class="btn btn-primary btn-lg" data-toggle="modal"
        data-target="#mod-error">
    开始演示模态框
</button>

<button class="btn btn-primary btn-lg" data-toggle="modal"
        data-target="#mod-success">
    开始演示模态框2
</button>


<div class="modal fade" id="mod-error" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle danger"><i class="fa fa-times"></i></div>
                    <h4>Oh god!</h4>

                    <p>数据出错!</p><span>页面将在3秒后自动刷新...</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal -->
<div class="modal fade" id="mod-success" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="i-circle success"><i class="fa fa-check"></i></div>
                    <h4>Awesome!</h4>

                    <p>Changes has been saved successfully!</p><span>页面将在3秒后自动刷新...</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">关闭</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- 按钮触发模态框 -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
    开始演示模态框
</button>

<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header navbar">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    修改项目
                </h4>
            </div>
            <div id="debt-info" class="form-block">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'table-info-form',
                    'action' => array('table/update'),//:array('debts/update','id'=>$model->id),
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false,
                    'htmlOptions' => array(
                        'class' => 'form-horizontal group-border-dashed',
                        'style' => 'border-radius: 0px;',
                        'request_url' => $this->createUrl('table/update'),
                    ),
                ));
                ?>
            <div class="modal-body">

                    <div class="debt-info-form">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">考核项目</label>

                            <div class="col-sm-8">
                                <?php echo CHtml::textField('item_name', '', ['class' => 'form-control inputSerialNumber', 'maxlength' => 16, 'placeholder' => '请输入考核项目']) ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">考核要点</label>

                            <div class="col-sm-8">
                                <?php echo CHtml::textArea('key_points', '', ['class' => 'form-control inputFee', 'data-min' => 0, 'maxlength' => 500, 'data-max' => 500, 'placeholder' => '请输入考核要点']) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">评分标准</label>

                            <div class="col-sm-8">
                                <?php echo CHtml::textArea('standard', '', ['class' => 'form-control inputFee', 'data-min' => 0, 'maxlength' => 500, 'data-max' => 500, 'placeholder' => '请输入评分标准']) ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">权重</label>

                            <div class="col-sm-3">
                                <?php echo CHtml::textField('weight', '', ['class' => 'form-control inputFee', 'data-min' => 0, 'maxlength' => 8, 'data-max' => 100, 'placeholder' => '请输入权重']) ?>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">目标额</label>

                            <div class="col-sm-3">
                                <?php echo CHtml::textField('target', '', ['class' => 'form-control inputFee', 'data-min' => 0, 'maxlength' => 8, 'data-max' => 100, 'placeholder' => '请输入目标额']) ?>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">关闭
                    </button>
                    <button type="button" class="btn btn-primary">
                        提交更改
                    </button>
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <script>
        /* $(function () {
         $('#myModal').modal({
         keyboard: true
         })

         });*/


    </script>

