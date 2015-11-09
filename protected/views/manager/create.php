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
            <?php if($model->isNewRecord){?> 新增 <?php } else {?> 修改 <?php }?>
        </h3 >
    </div >
    <!-- 添加员工标题 end -->
    <!-- 添加员工标题 表单 start-->
    <div class="content">
        <div id="debt-info" class="form-block">
            <?php $form = $this->beginWidget ( 'CActiveForm', array (
                'id' => 'staff-info-form',
                'action' => $model->isNewRecord?array('manager/create'):array('manager/update','id'=>$model->id),
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array (
                    'class' => 'form-horizontal group-border-dashed',
                    'style' => 'border-radius: 0px;',
                ),
            ) );
            ?>
            <?php /*echo $form->errorSummary($model)*/ ?>
            <div class="debt-info-form" >
                <div class="form-group">
                    <?php echo $form->label($model,'name',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-4">
                        <?php echo $form->textField($model,'name',['class'=>'form-control','maxlength'=>16])?>
                    </div>
                    <?php echo $form->error($model,'name');?>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model,'password',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-4" >
                        <?php echo $form->textField($model,'password',['class'=>'form-control','min'=>6,'maxlength'=>16]);?>
                    </div >
                    <?php echo $form->error($model,'password');?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model,'mobile',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-2" >
                        <?php echo $form->textField($model,'mobile',['class'=>'form-control','empty'=>'输入人员号码']);?>
                    </div >
                    <?php echo $form->error($model,'mobile');?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model,'email',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-2" >
                        <?php echo $form->textField($model,'email',['class'=>'form-control','empty'=>'输入人员邮箱']);?>
                    </div >
                    <?php echo $form->error($model,'email');?>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model,'authority',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-2" >
                        <?php  echo $form->dropDownList($model,'authority',['0'=>'普通','1'=>'管理员','2'=>'超级管理员'],['class'=>'select2 slect-simple']);?>
                    </div >
                    <?php echo $form->error($model,'authority');?>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model,'is_quit',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-2" >
                        <?php echo $form->dropDownList($model,'is_quit',['0'=>'加入','1'=>'退出'],['class'=>'select2 slect-simple','data-min'=>1,'maxlength'=>3,'data-max'=>3]);?>
                    </div >
                    <?php echo $form->error($model,'is_quit');?>
                </div>



               <!-- <div class="form-group" >
                    <?php /*echo $form->label($model,'entry_time',['class'=>'col-sm-4 control-label'])*/?>
                    <div class="col-sm-2" >
                        <div class="input-group date datetime col-md-12 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd" >
                            <?php /*echo $form->textField($model,'entry_time',['class'=>'form-control','size'=>16,'placeholder'=>'入职时间','readonly'=>'readonly'])*/?>
                            <span class="input-group-addon btn btn-primary" ><span class="glyphicon glyphicon-th" ></span ></span >
                        </div >
                    </div >
                    <?php /*echo $form->error($model,'entry_time');*/?>
                </div >-->
                <div class="form-group" >
                    <div class="col-sm-offset-5" >
                        <div class="col-sm-3">
                            <button class="btn btn-primary debts-info-submit submitBtn" type="submit" ><?php echo "确认"?></button >
                        </div >
                        <div class="col-sm-6">
                            <button class="btn btn-primary debts-info-submit submitBtn" type="reset"  onclick="window.history.go(-1);window.location.reload();"><?php echo "返回"?></button >
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