<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */
/*$cates = ArticleCate::model()->treeData();
$cateOptions = Helper::treeOptions($cates,$model->cate_id);*/
?>
<div class="block-flat">
    <div class="content">
        <table class="table table-bordered">
            <div class="form-group">
                <?php if(Yii::app()->user->hasFlash('create')):?>
                    <div class="alert in fade alert-success">
                        <a href="#" class="close" data-dismiss="alert"></a>
                        <strong>Well done!</strong><?php echo Yii::app()->user->getFlash('create');?>
                    </div>
                <?php endif;?>
            </div>
        </table>
    </div>
    <div class="content">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'article-form',
            'action'=>$model->isNewRecord?array('card/addCardType'):array('card/changeCardType','id'=>$model->type_id),
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array('class'=>'form-horizontal group-border-dashed','style'=>'border-radius: 0px;','enctype'=>"multipart/form-data"),
        )); ?>
        <div class="form-group">
            <?php echo $form->labelEx($model,'type_name',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-6">
                <?php echo $form->textField($model, 'type_name',array('class'=>'form-control'));?>
                <?php echo $form->error($model,'type_name'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'type_style',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-3">
                <?php echo $form->dropDownList($model, 'type_style',['A'=>'A类','B'=>'B类','C'=>'C类','D'=>'D类','E'=>'E类','F'=>'F类'],array('class'=>'select2 select-simple','empty'=>'请选择卡类型'));?>
                <?php echo $form->error($model,'type_style'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'type_mark',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-3">
                <?php echo $form->dropDownList($model, 'type_mark',['0'=>'普通卡','1'=>'体验卡'],array('class'=>'select2 select-simple','empty'=>'请选择卡用途'));?>
                <?php echo $form->error($model,'type_mark'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'type_desc',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-6">
                <?php echo $form->textArea($model, 'type_desc',array('class'=>'form-control','width'=>'300px','height'=>'200px'));?>
                <?php echo $form->error($model,'type_desc'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'type_num',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-1">
                <?php echo $form->textField($model, 'type_num',array('class'=>'form-control'));?>
                <?php echo $form->error($model,'type_num'); ?>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?php echo CHtml::submitButton($model->isNewRecord?'添加':'保存',array('class'=>'btn btn-primary','id'=>'btn-submit')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<script>
    $(function(){
        $('form').submit(function(){
            $('#btn-submit').attr('disabled','disabled');
            return true;
        });
    });
</script>
