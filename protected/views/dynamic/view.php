
    <div class="cl-mcont">
    <!--<div class="row wizard-row">-->
            <div class="form-group pull-right">
                <a class="btn btn-info" href="javascript:history.go(-1);location.reload();">返回</a>
            </div>
       <!-- </div>-->
    </div>

<div class="cl-mcont">
    <div class="row wizard-row">

        <div class="panel panel-primary">
            <div class="panel-heading">
                信息描述
            </div>
            <div class="panel-body">
                <h4><?php echo $model->getAttributeLabel('dy_content') ?></h4>

                <p>
                    <?php echo $model->dy_content ? $model->dy_content : '无' ?>
                </p>
            </div>
        </div>


        <?php if ($images): ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    动态图集
                </div>
                <?php foreach ($images as $key => $val): ?>
                    <div class="panel-body">
                        <h4>图<?php echo $key + 1; ?></h4>

                        <p>
                            <?php echo $images ? CHtml::image(Yii::app()->baseUrl . '/upload/' . $val, '动态图集', array('width' => 300, 'height' => 300)) : '无' ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
