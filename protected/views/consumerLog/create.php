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
                <?php if(Yii::app()->user->hasFlash('ConsumerLog')):?>
                    <div class="alert in fade alert-success">
                        <a href="#" class="close" data-dismiss="alert"></a>
                        <strong>Well done!</strong><?php echo Yii::app()->user->getFlash('ConsumerLog');?>
                    </div>
                <?php endif;?>
            </div>
        </table>
    </div>
    <div class="content">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'article-form',
            //'action'=>$model->isNewRecord?array('consumerLog/create'):array('consumerLog/change','id'=>$model->log_id),
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array('class'=>'form-horizontal group-border-dashed','style'=>'border-radius: 0px;','enctype'=>"multipart/form-data"),
        )); ?>

        <div class="form-group">
            <label class="col-sm-2 control-label">店铺</label>
            <div class="col-sm-3">
                <?php echo $form->dropDownList($model, 'store_id',$stores,array('class'=>'select2 select-simple','empty'=>'请选择所属店铺'));?>
                <?php echo $form->error($model,'store_id'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'flag',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-3">
                <?php echo $form->dropDownList($model, 'flag',['0'=>'体验卡','1'=>'通卡','2'=>'课程'],array('class'=>'select2 select-simple','empty'=>'请选择所属类型'));?>
                <?php echo $form->error($model,'flag'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'flag_content',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-3">
                <?php echo $form->textField($model, 'flag_content',array('class'=>'form-control'));?>
                <?php echo $form->error($model,'flag_content'); ?>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?php echo CHtml::submitButton('提交',array('class'=>'btn btn-primary','id'=>'btn-submit')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
