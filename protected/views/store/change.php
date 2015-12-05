<?php
/* @var $this ArticleController */
/* @var $model Article */
/* @var $form CActiveForm */
/*$cates = ArticleCate::model()->treeData();
$cateOptions = Helper::treeOptions($cates,$model->cate_id);*/
?>
<div class="block-flat">
    <div class="content">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'article-form',
            'action'=>$model->isNewRecord?array('store/create'):array('store/change','id'=>$model->id),
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => 'form-horizontal group-border-dashed', 'style' => 'border-radius: 0px;', 'enctype' => "multipart/form-data"),
        )); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'name', array('class' => 'col-sm-2 control-label')); ?>
            <div class="col-sm-8">
                <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'name'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'realname', array('class' => 'col-sm-2 control-label')); ?>
            <div class="col-sm-8">
                <?php echo $form->textField($model, 'realname', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'realname'); ?>
            </div>
        </div>
        <?php if($is_manager):?>
            <div class="form-group">
                <?php echo $form->labelEx($model,'manager',array('class'=>'col-sm-2 control-label')); ?>
                <div class="col-sm-8">
                    <?php echo $form->dropDownList($model, 'manager',$managers,array('class'=>'select2 select-simple','empty'=>'请选择店铺管理员'));?>
                    <?php echo $form->error($model,'manager'); ?>
                </div>
            </div>
        <?php endif;?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'address', array('class' => 'col-sm-2 control-label')); ?>
            <div class="col-sm-8">
                <?php echo $form->textField($model, 'address', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'address'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'tel', array('class' => 'col-sm-2 control-label')); ?>
            <div class="col-sm-8">
                <?php echo $form->textField($model, 'tel', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'tel'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'mobile', array('class' => 'col-sm-2 control-label')); ?>
            <div class="col-sm-8">
                <?php echo $form->textField($model, 'mobile', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'mobile'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'identity', array('class' => 'col-sm-2 control-label')); ?>
            <div class="col-sm-8">
                <?php echo $form->textField($model, 'identity', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'identity'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'banktype', array('class' => 'col-sm-2 control-label')); ?>
            <div class="col-sm-8">
                <?php echo $form->dropDownList($model, 'banktype', Yii::app()->params['banklist'], array('class' => 'select2 select-simple', 'empty' => '请选择银行类型')); ?>
                <?php echo $form->error($model, 'banktype'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'bankcode', array('class' => 'col-sm-2 control-label')); ?>
            <div class="col-sm-8">
                <?php echo $form->textField($model, 'bankcode', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'bankcode'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'introduction', array('class' => 'col-sm-2 control-label')); ?>
            <div class="col-sm-8">
                <?php echo $form->textArea($model, 'introduction', array('class' => 'form-control', 'width' => '300px', 'height' => '200px')); ?>
                <?php echo $form->error($model, 'introduction'); ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">logo</label>
            <?php if ($model->image): ?>
                <div class="col-sm-6">
                    <?php echo CHtml::image(Yii::app()->baseUrl . '/upload/' . $model->image, 'logo', array('width' => 50, 'height' => 50)); ?>
                    <input id="fileImage" type="file" size="60" name="image" multiple/>
                </div>
            <?php else: ?>
                <div class="col-sm-6">
                    <input id="fileImage" type="file" size="60" name="image" multiple/>
                </div>
            <?php endif; ?>

            <?php echo $form->error($model, 'image'); ?>
        </div>

        <div class="form-group">
            <?php if ($model->bussiness_license): ?>
                <label class="col-sm-2 control-label">营业执照正面</label>
                <div class="col-sm-3">
                    <?php echo CHtml::image(Yii::app()->baseUrl . '/upload/' . $bussiness_license[0], '营业执照', array('width' => 50, 'height' => 50)); ?>
                    <input id="fileImage" type="file" size="60" name="bussiness_license1" multiple/>
                </div>
                <label class="col-sm-2 control-label">营业执照反面</label>
                <div class="col-sm-3">
                    <?php echo CHtml::image(Yii::app()->baseUrl . '/upload/' . $bussiness_license[1], '营业执照', array('width' => 50, 'height' => 50)); ?>
                    <input id="fileImage" type="file" size="60" name="bussiness_license2" multiple/>
                </div>
            <?php else: ?>
                <label class="col-sm-2 control-label">营业执照正面</label>
                <div class="col-sm-3">
                    <input id="fileImage" type="file" size="60" name="bussiness_license1" multiple/>
                </div>
                <label class="col-sm-2 control-label">营业执照反面</label>
                <div class="col-sm-3">
                    <input id="fileImage" type="file" size="60" name="bussiness_license2" multiple/>
                </div>
            <?php endif; ?>
            <?php echo $form->error($model, 'bussiness_license'); ?>
        </div>
        <?php if ($images): ?>
            <?php foreach ($images as $key => $val): ?>
                <div class="form-group">

                    <label class="col-sm-2 control-label">介绍图片<?php if ($key) {
                            echo $key;
                        } ?></label>

                    <div class="col-sm-6">
                        <?php echo CHtml::image(Yii::app()->baseUrl . '/upload/' . $val, '介绍图片', array('width' => 50, 'height' => 50)); ?>
                        <input id="fileImage" type="file" size="30" name="upImage<?php if ($key) {
                            echo $key;
                        } ?>"/>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">介绍图片</label>

                <div class="col-sm-6">
                    <input id="fileImage" type="file" size="30" name="upImage"/>
                </div>
            </div>
        <?php endif; ?>
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
                <?php echo CHtml::submitButton($model->isNewRecord ? '添加' : '保存', array('class' => 'btn btn-primary', 'id' => 'btn-submit')); ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<script>
    $(function () {
        $('form').submit(function () {
            $('#btn-submit').attr('disabled', 'disabled');
            return true;
        });
        $('#addImage').click(function () {
            var j = $("input:file").length - 3;
            $('#addImage').before(" <div class='form-group'> <label class='col-sm-2 control-label'>介绍图片" + j + "</label><div class='col-sm-6'><input id='fileImage' type='file' size='30' name='upImage" + j + "'/></div> </div>");
            j++;
        })
    });
</script>