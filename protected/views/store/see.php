<div class="cl-mcont">
    <div class="row wizard-row">

        <!-- 债权基础信息 start -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                基本信息
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('name'); ?>
                        ：<span><?php echo $model->name ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('realname'); ?>
                        ：<span><?php echo $model->realname; ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('tel'); ?>
                        ：<span><?php echo $model->tel; ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('mobile'); ?>
                        ：<span><?php echo $model->mobile; ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('identity'); ?>
                        ：<span><?php echo $model->identity; ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('address'); ?>
                        ：<span><?php echo $model->address; ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('banktype'); ?>
                        ：<span><?php echo Yii::app()->params['banklist'][$model->banktype] ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('bankcode'); ?>
                        ：<span><?php echo $model->bankcode ?></span></div>
                </div>
            </div>

        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                信息描述
            </div>
            <div class="panel-body">
                <h4><?php echo $model->getAttributeLabel('introduction') ?></h4>

                <p>
                    <?php echo $model->introduction ? $model->introduction : '无' ?>
                </p>
            </div>
        </div>
        <?php if ($model->image): ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    logo
                </div>
                <div class="panel-body">
                    <h4><?php echo $model->getAttributeLabel('image') ?></h4>

                    <p>
                        <?php echo $model->image ? CHtml::image(Yii::app()->baseUrl . '/upload/' . $model->image, 'logo', array('width' => 100, 'height' => 100)) : '无' ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($bussiness_license): ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    营业执照
                </div>
                <?php foreach ($bussiness_license as $key => $val): ?>
                    <div class="panel-body">
                        <h4>营业执照<?php echo $key + 1; ?></h4>

                        <p>
                            <?php echo $bussiness_license ? CHtml::image(Yii::app()->baseUrl . '/upload/' . $val, '营业执照', array('width' => 300, 'height' => 300)) : '无' ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($images): ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    介绍图集
                </div>
                <?php foreach ($images as $key => $val): ?>
                    <div class="panel-body">
                        <h4>图<?php echo $key + 1; ?></h4>

                        <p>
                            <?php echo $images ? CHtml::image(Yii::app()->baseUrl . '/upload/' . $val, '介绍图集', array('width' => 300, 'height' => 300)) : '无' ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
