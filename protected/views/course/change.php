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
            'action'=>$model->isNewRecord?array('course/create'):array('course/change','id'=>$model->id),
            'enableAjaxValidation'=>false,
            'enableClientValidation' =>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
            'htmlOptions'=>array('class'=>'form-horizontal group-border-dashed','style'=>'border-radius: 0px;','enctype'=>"multipart/form-data"),
        )); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model,'name',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-8">
                <?php echo $form->textField($model, 'name',array('class'=>'form-control'));?>
                <?php echo $form->error($model,'name'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'store_id',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-3">
                <?php echo $form->dropDownList($model, 'store_id',$stores,array('class'=>'select2 select-simple','empty'=>'请选择所属店铺'));?>
                <?php echo $form->error($model,'store_id'); ?>
            </div>
            <?php echo $form->labelEx($model,'sale_price',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-3">
                <?php echo $form->textField($model, 'sale_price',array('class'=>'form-control','width'=>'300px','height'=>'200px'));?>
                <?php echo $form->error($model,'sale_price'); ?>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label" >开售时间</label >
            <div class="col-sm-2" >
                <div class="input-group date datetime col-md-12 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd" >
                    <?php echo $form->textField($model,'sale_time',['class'=>'form-control inputStartDate','size'=>16,'placeholder'=>'开始时间','readonly'=>'readonly'])?>
                    <span class="input-group-addon btn btn-primary" ><span class="glyphicon glyphicon-th" ></span ></span >
                </div >
            </div >
            <label class="col-sm-1 control-label" >至</label >

            <div class="col-sm-2" >
                <div class="input-group date datetime col-md-12 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd" >
                    <?php echo $form->textField($model,'esale_time',['class'=>'form-control inputEndDate','size'=>16,'placeholder'=>'结束时间','readonly'=>'readonly'])?>
                    <span class="input-group-addon btn btn-primary" ><span class="glyphicon glyphicon-th" ></span ></span >
                </div >
            </div >
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" >有效时间</label >

            <div class="col-sm-2" >
                <div class="input-group date datetime col-md-12 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd" >
                    <?php echo $form->textField($model,'start_time',['class'=>'form-control inputStartDate','size'=>16,'placeholder'=>'开始时间','readonly'=>'readonly'])?>
                    <span class="input-group-addon btn btn-primary" ><span class="glyphicon glyphicon-th" ></span ></span >
                </div >
            </div >
            <label class="col-sm-1 control-label" >至</label >

            <div class="col-sm-2" >
                <div class="input-group date datetime col-md-12 col-xs-7" data-min-view="2" data-date-format="yyyy-mm-dd" >
                    <?php echo $form->textField($model,'end_time',['class'=>'form-control inputEndDate','size'=>16,'placeholder'=>'结束时间','readonly'=>'readonly'])?>
                    <span class="input-group-addon btn btn-primary" ><span class="glyphicon glyphicon-th" ></span ></span >
                </div >
            </div >

        </div>


        <div class="form-group">
            <?php echo $form->labelEx($model,'introduction',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-8">
                <?php echo $form->textArea($model, 'introduction',array('class'=>'form-control','width'=>'300px','height'=>'200px'));?>
                <?php echo $form->error($model,'introduction'); ?>
            </div>
        </div>

        <?php if($time_area):?>
            <?php foreach($time_area as $key=>$val):?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">课程时间段</label>
                    <div class="col-sm-1">
                        <input type="text" name="Course[time_area][<?=$key?>][start]" class="form-control timeArea" value="<?=$val['start']?>">
                    </div>
                    <label class="col-sm-1 control-label" style="text-align: center" >到</label >
                    <div class="col-sm-1">
                        <input type="text" name="Course[time_area][<?=$key?>][end]" class="form-control timeArea" value="<?=$val['end']?>">
                    </div>
                    <label class="col-sm-1 control-label" >数量</label >
                    <div class="col-sm-1">
                        <input type="text" name="Course[time_area][<?=$key?>][num]" class="form-control timeArea" value="<?=$val['num']?>">
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>

        <!--<div class="form-group">
            <label class="col-sm-2 control-label">课程时间段</label>
            <div class="col-sm-1">
                <input type="text" name="Course[time_area][0][start]" class="form-control timeArea">
            </div>
            <label class="col-sm-1 control-label" style="text-align: center" >到</label >
            <div class="col-sm-1">
                <input type="text" name="Course[time_area][0][end]" class="form-control timeArea">
            </div>
            <label class="col-sm-1 control-label" >数量</label >
            <div class="col-sm-1">
                <input type="text" name="Course[time_area][0][num]" class="form-control timeArea">
            </div>
            <?php /*echo $form->error($model,'time_area'); */?>
        </div>-->

        <div class="form-group" id="add">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-8">
                <input class='btn btn-primary pull-right' type="button" value="+添加时间段">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?php echo CHtml::submitButton($model->isNewRecord?'添加':'保存',array('class'=>'btn btn-primary','id'=>'btn-submit')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <!--  --><?php /*var_dump($model->getErrors());*/?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<script>
    $(function(){
        /* $('form').submit(function(){
         $('#btn-submit').attr('disabled','disabled');
         return true;
         });*/
        $('#add').click(function()
        {
            var j = $(".timeArea").length/3;
            $('#add').before(" <div class='form-group'>"
                +"<label class='col-sm-2 control-label'>课程时间段"+j+"</label>"
                +"<div class='col-sm-1'>"
                +"<input type='text' name='Course[time_area]["+j+"][start]' class='form-control timeArea'>"
                +"</div>"
                +"<label class='col-sm-1 control-label' style='text-align: center' >到</label >"
                +"<div class='col-sm-1'>"
                +"<input type='text' name='Course[time_area]["+j+"][end]' class='form-control timeArea'>"
                +"</div>"
                +"<label class='col-sm-1 control-label' >数量</label >"
                +"<div class='col-sm-1'>"
                +"<input type='text' name='Course[time_area]["+j+"][num]' class='form-control timeArea'>"
                +"</div>"
                +"</div>"
            );
            j++;
        })
    });
</script>
