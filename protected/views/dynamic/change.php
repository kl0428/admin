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
            'action'=>$model->isNewRecord?array('dynamic/create'):array('dynamic/change','id'=>$model->dy_id),
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array('class'=>'form-horizontal group-border-dashed','style'=>'border-radius: 0px;','enctype'=>"multipart/form-data"),
        )); ?>

        <div class="form-group">
            <label class="col-sm-2 control-label">店铺</label>
            <div class="col-sm-3">
                <?php echo $form->dropDownList($model, 'dy_user',$stores,array('class'=>'select2 select-simple','empty'=>'请选择所属店铺'));?>
                <?php echo $form->error($model,'dy_user'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'dy_content',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-8">
                <?php echo $form->textArea($model, 'dy_content',array('class'=>'form-control','width'=>'300px','height'=>'200px'));?>
                <?php echo $form->error($model,'dy_content'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'dy_num',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-1">
                <?php echo $form->textField($model, 'dy_num',array('class'=>'form-control','width'=>'300px','height'=>'200px'));?>
                <?php echo $form->error($model,'dy_num'); ?>
            </div>
            <div class="col-sm-3 pull-left">
                排序从大到小:最大-127:最小-0
            </div>
        </div>

        <?php if($images):?>
            <?php foreach($images as $key=>$val):?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">介绍图片<?=$key?></label>
                    <div class="col-sm-6">
                        <?php echo CHtml::image($val, '图集', array('width' => 50, 'height' => 50)); ?>
                        <input id="fileImage" type="file" size="30" name="upImage"/>
                    </div>
                </div>
            <?php endforeach;?>
        <?php else:?>
            <div class="form-group">
                <label class="col-sm-2 control-label">介绍图片</label>
                <div class="col-sm-6">
                    <input id="fileImage" type="file" size="30" name="upImage"/>
                </div>
            </div>
        <?php endif;?>
        <div class="form-group" id="addImage">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-8">
                <input class='btn btn-primary pull-right' type="button" value="+添加介绍图片">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-8">
                <div id="preview" class="upload_preview"></div>
                <button type="button" id="fileSubmit" style="display:none;">确认上传</button>
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
        $('#addImage').click(function()
        {
            var j = $("input:file").length;
            $('#addImage').before(" <div class='form-group'> <label class='col-sm-2 control-label'>介绍图片"+j+"</label><div class='col-sm-6'><input id='fileImage' type='file' size='30' name='upImage"+j+"'/></div> </div>");
            j++;
        })
    });
</script>
