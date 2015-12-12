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
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('store_id'); ?>
                        ：<span><?php echo $model->store->name; ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('sale_price'); ?>
                        ：<span><?php echo $model->sale_price; ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('sale_time'); ?>
                        ：<span><?php echo $model->sale_time; ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('esale_time'); ?>
                        ：<span><?php echo $model->sale_time; ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('is_check'); ?>
                        ：<span><?php if($model->is_check == 1){echo "通过";}elseif($model->is_check == 0){echo "未审核";}elseif($model->is_check == 2){echo "失败";}else{echo "删除";}; ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('start_time'); ?>
                        ：<span><?php echo $model->start_time; ?></span></div>
                    <div class="col-sm-4 col-xs-12"><?php echo $model->getAttributeLabel('end_time'); ?>
                        ：<span><?php echo $model->start_time; ?></span></div>


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

        <div class="panel panel-primary">
            <div class="panel-heading">
                店铺描述
            </div>
            <div class="panel-body">
                <h4>名称</h4>

                <p>
                    <?php echo $model->store->name; ?>
                </p>
                <h4>法人</h4>

                <p>
                    <?php echo $model->store->realname; ?>
                </p>
                <h4>地址</h4>

                <p>
                    <?php echo $model->store->address; ?>
                </p>
                <h4>固话</h4>

                <p>
                    <?php echo $model->store->tel; ?>
                </p>
                <h4>手机</h4>

                <p>
                    <?php echo $model->store->mobile; ?>
                </p>
                <h4>介绍</h4>
                <p>
                    <?php echo $model->store->introduction; ?>
                </p>
            </div>
        </div>

        <?php if ($time_area): ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    课程时间分配
                </div>
                <?php foreach ($time_area as $key => $val): ?>
                    <div class="panel-body">

<!--                        <p>-->
<!--                            开始时间:--><?php //echo $val['start'];?><!-----><?php //echo $val['end']?><!-- 人数:--><?php //echo $val['num'];?>
<!--                        </p>-->
                        <div class="col-sm-4 col-xs-12">&nbsp;&nbsp;时间段<?php echo $key+1;?>&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $val['start'];?>&nbsp;--&nbsp;<?php echo $val['end']?> &nbsp;&nbsp;人数:&nbsp;&nbsp;<?php echo $val['num'];?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
