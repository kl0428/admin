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
            'action'=>$model->isNewRecord?array('message/create'):array('message/change','id'=>$model->id),
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array('class'=>'form-horizontal group-border-dashed','style'=>'border-radius: 0px;','enctype'=>"multipart/form-data"),
        )); ?>





        <div class="form-group">
            <?php echo $form->labelEx($model,'flag',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-3">
                <?php echo $form->dropDownList($model, 'flag',['0'=>'所有','1'=>'联盟','2'=>'用户'],array('class'=>'select2 select-simple','empty'=>'请选择卡类型'));?>
                <?php echo $form->error($model,'flag'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'to_user',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-3">
                <?php echo $form->textField($model, 'to_user',array('class'=>'form-control'));?>
                <?php echo $form->error($model,'to_user'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'content',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-3">
                <?php echo $form->textArea($model, 'content',array('class'=>'form-control'));?>
                <?php echo $form->error($model,'content'); ?>
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
