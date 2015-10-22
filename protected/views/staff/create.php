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
            新增
        </h3 >
    </div >
    <!-- 添加员工标题 end -->
    <!-- 添加员工标题 表单 start-->
    <div class="content">
        <div id="debt-info" class="form-block">
            <?php $form = $this->beginWidget ( 'CActiveForm', array (
                'id' => 'debts-info-form',
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
                    <label class="col-sm-4 control-label" >姓名</label >
                    <div class="col-sm-4">
                        <?php echo CHtml::textField('serial_number','',['class'=>'form-control inputSerialNumber','maxlength'=>16,'placeholder'=>'请输入员工姓名'])?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" >登录名</label >
                    <div class="col-sm-4" >
                        <?php echo CHtml::textField('serial_number','',['class'=>'form-control inputSerialNumber','maxlength'=>16,'placeholder'=>'请输入员工登录名'])?>
                    </div >
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" >登录密码</label >

                    <div class="col-sm-4" >
                        <?php echo CHtml::textField('amount',0,['class'=>'form-control inputAmount','min'=>4,'maxlength'=>16,'placeholder'=>'请输入登录密码'])?>
                    </div >
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" >所属部门</label >

                    <div class="col-sm-4" >
                        <?php echo CHtml::dropDownList('interest_from',0,['0'=>'总裁办','1'=>'技术网络部','2'=>'人事部'],['class'=>'select2 select-simple inputInterestForm'])?>
                    </div >
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" >上级领导</label >

                    <div class="col-sm-4" >
                        <?php echo CHtml::dropDownList('interest_from',0,['0'=>'张珊','1'=>'李四','2'=>'王五'],['class'=>'select2 select-simple inputInterestForm'])?>
                    </div >
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" >考核方式</label >

                    <div class="col-sm-4" >
                        <?php echo CHtml::dropDownList('interest_from',0,['0'=>'月度','1'=>'季度'],['class'=>'select2 select-simple inputInterestForm'])?>
                    </div >
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" >自评权重</label >
                    <div class="col-sm-4" >
                        <?php echo CHtml::textField('annualized_rate',0,['class'=>'form-control inputRate','data-min'=>1,'maxlength'=>2,'data-max'=>3,'placeholder'=>'请输入合同利率'])?>
                    </div >
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" >考核权重</label >
                    <div class="col-sm-2" >
                        <?php echo CHtml::textField('annualized_rate',0,['class'=>'form-control inputRate','data-min'=>1,'maxlength'=>2,'data-max'=>3,'placeholder'=>'请输入合同利率'])?>
                    </div >
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" >员工编号</label >

                    <div class="col-sm-3" >
                        <?php echo CHtml::textField('fee_rate','',['class'=>'form-control inputFee','data-min'=>0,'maxlength'=>8,'data-max'=>100,'placeholder'=>'请输入手续费'])?>
                    </div >

                </div >

                <div class="form-group">
                    <label class="col-sm-4 control-label" >等级</label >

                    <div class="col-sm-3" >
                        <?php echo CHtml::textField('fee_rate','',['class'=>'form-control inputFee','data-min'=>0,'maxlength'=>5,'data-max'=>100,'placeholder'=>'请输入手续费'])?>
                    </div >

                </div >


                <div class="form-group" >
                    <label class="col-sm-4 control-label" >入职时间</label >

                    <div class="col-sm-2" >
                        <div class="input-group date datetime col-md-12 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd" >
                            <?php echo CHtml::textField('start_time','',['class'=>'form-control inputStartDate','size'=>16,'placeholder'=>'开始时间','readonly'=>'readonly'])?>
                            <span class="input-group-addon btn btn-primary" ><span class="glyphicon glyphicon-th" ></span ></span >
                        </div >
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