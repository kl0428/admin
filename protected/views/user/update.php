<?php
/**
 * Created by PhpStorm.
 * User: gongxiaohong
 * Date: 15-11-23
 * Time: 上午10:13
 */
?>
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
                'action' => $model->isNewRecord?array('user/create'):array('user/update','id'=>$model->id),
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
                    <?php echo $form->label($model,'username',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-4">
                        <?php echo $form->textField($model,'username',['class'=>'form-control','maxlength'=>16])?>
                    </div>
                    <?php echo $form->error($model,'username');?>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model,'nickname',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-4" >
                        <?php echo  $form->textField($model,'nickname',['class'=>'form-control','maxlength'=>16]);?>
                    </div >
                    <?php echo $form->error($model,'nickname');?>
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
                    <div class="col-sm-4" >
                        <?php echo $form->textField($model,'mobile',['class'=>'form-control','min'=>6,'maxlength'=>11]);?>
                    </div >
                    <?php echo $form->error($model,'mobile');?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model,'email',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-4" >
                        <?php echo $form->textField($model,'email',['class'=>'form-control','min'=>6,'maxlength'=>32]);?>
                    </div >
                    <?php echo $form->error($model,'email');?>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model,'sex',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-2" >
                        <?php echo $form->dropDownList($model,'sex',['0'=>'女','1'=>'男'],['class'=>'select2 select-simple','empty'=>'请选择性别']);?>
                    </div >
                    <?php echo $form->error($model,'sex');?>
                </div>
                <div class="form-group">
                    <?php echo $form->label($model,'province',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-2" >
                        <?php echo $form->dropDownList($model,'province',$province,['class'=>'select2 select-simple','empty'=>'请选择省市','ajax'=>[
                            'url'=>Yii::app()->createUrl('/api/city'),
                            'data'=>array('code'=>'js:$(this).val()'),
                            'type'=>'post',
                            'success'=>'js:function(html){$("#city").empty();$("#city").html(html)}',
                        ],]);?>
                    </div >
                    <?php echo $form->error($model,'province');?>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model,'city',['class'=>'col-sm-4 control-label']);?>
                    <div class="col-sm-2" >
                        <?php  echo $form->dropDownList($model,'city',$model->province?YhmCity::model()->city($model->province):[],['class'=>'select2 slect-simple','id'=>'city','empty'=>'请依次选择省市']);?>
                    </div >
                    <?php echo $form->error($model,'city');?>
                </div>


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