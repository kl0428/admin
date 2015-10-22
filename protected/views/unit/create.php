<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-10-19
 * Time: 下午2:41
 */
?>
<!-- 员工管理 添加新员工 start-->
<div class="block-flat" >
    <!-- 添加员工标题  start-->
    <div class="header" >
        <h3>
            新增部门
        </h3 >
    </div >
    <!-- 添加员工标题 end -->
    <!-- 添加员工标题 表单 start-->
    <div class="content">
        <div id="debt-info" class="form-block">
            <?php $form = $this->beginWidget ( 'CActiveForm', array (
                'id' => 'table-info-form',
                'action' => array('staff/create'),//:array('debts/update','id'=>$model->id),
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>false,
                'htmlOptions' => array (
                    'class' => 'form-horizontal group-border-dashed',
                    'style' => 'border-radius: 0px;',
                    'request_url'=>$this->createUrl('staff/update'),
                ),
            ) );
            ?>
            <div class="debt-info-form" >
                <div class="form-group">
                    <label class="col-sm-4 control-label" >部门名称</label >
                    <div class="col-sm-4">
                        <?php echo CHtml::textField('serial_number','',['class'=>'form-control inputSerialNumber','maxlength'=>16,'placeholder'=>'请输入员工姓名'])?>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-4 control-label" >上级部门</label >

                    <div class="col-sm-4" >
                        <?php echo CHtml::dropDownList('interest_from',0,['0'=>'总裁办','1'=>'技术网络部','2'=>'人事部'],['class'=>'select2 select-simple inputInterestForm'])?>
                    </div >
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" >部门主管</label >

                    <div class="col-sm-4" >
                        <?php echo CHtml::dropDownList('interest_from',0,['0'=>'张珊','1'=>'李四','2'=>'王五'],['class'=>'select2 select-simple inputInterestForm'])?>
                    </div >
                </div>


                <div class="form-group">
                    <label class="col-sm-4 control-label" >部门编号</label >

                    <div class="col-sm-3" >
                        <?php echo CHtml::textField('fee_rate','',['class'=>'form-control inputFee','data-min'=>0,'maxlength'=>8,'data-max'=>100,'placeholder'=>'请输入部门编号'])?>
                    </div >

                </div >


                <div class="form-group" >
                    <div class="col-sm-offset-5" >
                        <div class="col-sm-3">
                            <button class="btn btn-primary debts-info-submit submitBtn" type="button" ><?php echo "确认"?></button >
                        </div >
                        <div class="col-sm-6">
                            <button class="btn btn-primary debts-info-submit submitBtn" type="button" ><?php echo "取消"?></button >
                        </div >
                    </div>
                </div >
            </div >

            <?php $this->endWidget(); ?>
        </div>
    </div>
    <!-- 添加员工标题 表单 end -->
</div>
<!-- 员工管理 添加新员工 end-->