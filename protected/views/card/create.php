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
            'action'=>$model->isNewRecord?array('card/createCard'):array('card/changeCard','id'=>$model->card_id),
            'enableAjaxValidation'=>false,
            'htmlOptions'=>array('class'=>'form-horizontal group-border-dashed','style'=>'border-radius: 0px;','enctype'=>"multipart/form-data"),
        )); ?>

        <div class="form-group">
            <label class="col-sm-2 control-label" >有效时间</label >

            <div class="col-sm-2" >
                <div class="input-group date datetime col-md-12 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd" >
                    <?php echo $form->textField($model,'start_time',['class'=>'form-control inputStartDate','size'=>16,'placeholder'=>'有效开始时间','readonly'=>'readonly'])?>
                    <span class="input-group-addon btn btn-primary" ><span class="glyphicon glyphicon-th" ></span ></span >
                </div >
            </div >
            <label class="col-sm-1 control-label" >至</label >

            <div class="col-sm-2" >
                <div class="input-group date datetime col-md-12 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd" >
                    <?php echo $form->textField($model,'end_time',['class'=>'form-control inputEndDate','size'=>16,'placeholder'=>'有效结束时间','readonly'=>'readonly'])?>
                    <span class="input-group-addon btn btn-primary" ><span class="glyphicon glyphicon-th" ></span ></span >
                </div >
            </div >

        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'total_num',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-1">
                <?php echo $form->textField($model, 'total_num',array('class'=>'form-control'));?>
                <?php echo $form->error($model,'total_num'); ?>
            </div>
            <?php echo $form->labelEx($model,'price',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-1">
                <?php echo $form->textField($model, 'price',array('class'=>'form-control'));?>
                <?php echo $form->error($model,'price'); ?>
            </div>
        </div>



        <div class="form-group">
            <?php echo $form->labelEx($model,'type_id',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-3">
                <?php echo $form->dropDownList($model, 'type_id',$getTypes,array('class'=>'select2 select-simple','empty'=>'请选择卡类型'));?>
                <?php echo $form->error($model,'type_id'); ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">数量</label>
            <div class="col-sm-1">
                <input type="text" name="num" class="form-control">
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
