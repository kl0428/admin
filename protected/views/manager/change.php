<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-10-19
 * Time: 下午2:41
 */
?>
<!-- 部门管理 添加新部门 start-->
<div class="block-flat" >
    <!-- 添加部门标题  start-->
    <div class="header" >
        <h3>
            修改资料
        </h3 >
    </div >
    <!-- 添加部门标题 end -->
    <!-- 添加部门标题 表单 start-->
    <div class="content">
        <div id="debt-info" class="form-block">
            <?php $form = $this->beginWidget ( 'CActiveForm', array (
                'id' => 'change-info-form',
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>true,
                'clientOptions' =>array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array (
                    'class' => 'form-horizontal group-border-dashed',
                    'style' => 'border-radius: 0px;',
                ),
            ) );
            ?>
            <div class="debt-info-form" >
                <div class="form-group">
                    <?php echo $form->label($model,'name',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-3">
                        <?php echo $form->textField($model,'name',['class'=>'form-control','maxlength'=>32,'value'=>$info,'readonly'=>'readonly']);?>
                    </div>
                    <?php echo $form->error($model,'name');?>
                </div>


                <div class="form-group">
                    <?php echo $form->label($model,'old_pwd',['class'=>'col-sm-4 control-label']);?>

                    <div class="col-sm-3" >
                        <?php echo $form->passwordField($model,'old_pwd',['class'=>'form-control','maxlength'=>32]);?>
                    </div >
                    <?php echo $form->error($model,'old_pwd');?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model,'new_pwd',['class'=>'col-sm-4 control-label']);?>

                    <div class="col-sm-3" >
                        <?php echo $form->textField($model,'new_pwd',['class'=>'form-control','maxlength'=>32]);?>
                    </div >
                    <?php echo $form->error($model,'new_pwd');?>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model,'sure_pwd',['class'=>'col-sm-4 control-label']);?>

                    <div class="col-sm-3" >
                        <?php echo $form->textField($model,'sure_pwd',['class'=>'form-control','data-min'=>0,'maxlength'=>32,'data-mxa'=>32])?>
                    </div >
                    <?php echo $form->error($model,'sure_pwd');?>

                </div >


                <div class="form-group" >
                    <div class="col-sm-offset-5" >
                        <div class="col-sm-3">
                            <button class="btn btn-primary  submitBtn" type="submit" ><?php echo "确认"?></button >
                        </div >
                        <div class="col-sm-6">
                            <button class="btn btn-primary " type="reset" onclick="window.history.go(-1);window.location.reload();"><?php echo "取消"?></button >
                        </div >
                    </div>
                </div >
            </div >

            <?php $this->endWidget(); ?>
        </div>
    </div>
    <!-- 添加被考核人标题 表单 end -->
</div>
<!-- 部门管理 添加新部门 end-->