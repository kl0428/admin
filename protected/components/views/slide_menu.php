<?php //if($this->beginCache(Yii::app()->user->getId())):?>
<div class="cl-sidebar" data-position="right" data-step="1" data-intro="<strong>Fixed Sidebar</strong> <br/> It adjust to your needs." >
    <div class="cl-toggle"><i class="fa fa-bars"></i></div>
    <div class="cl-navblock">
        <div class="menu-space">
            <div class="content">
	            <?php
	                     $conName =  strtolower($this->controller->getId());
	                     $actName =  strtolower($this->controller->getAction()->getId());
	                     $tmp = strtolower($this->controller->route);
                         $info = Yii::app()->user->getState('info');
	            ?>
                <ul class="cl-vnavigation">
                    <?php if($info->authority >= 1):?>
                        <li><a href="#"><i class="fa fa-home"></i><span>卡管理</span></a>
                            <ul class="sub-menu">
                                <li class="<?php echo ($tmp=='card/card')?'active':'';?>">
                                    <?php echo CHtml::link("卡列表",array("/card/card"));?>
                                </li>
                                <li class="<?php echo ($tmp=='card/cardType')?'active':'';?>">
                                    <?php echo CHtml::link("卡类型",array("/card/cardType"));?>
                                </li>
                            </ul>
                        </li>
                    <?php endif;?>
                        <li><a href="#"><i class="fa fa-home"></i><span>消费统计</span></a>
                            <ul class="sub-menu">
                                <?php if($info->authority >= 1):?>
                                <li class="<?php echo ($tmp=='order/index')?'active':'';?>">
                                    <?php echo CHtml::link("订单",array("/order/index"));?>
                                </li>
                                <?php endif;?>
                                <li class="<?php echo ($tmp=='consumerLog/index')?'active':'';?>">
                                    <?php echo CHtml::link("消费",array("/consumerLog/index"));?>
                                </li>
                                <li class="<?php echo ($tmp=='consumerLog/create')?'active':'';?>">
                                    <?php echo CHtml::link("验证",array("/consumerLog/create"));?>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-home"></i><span>信息反馈</span></a>
                            <ul class="sub-menu">
                                <li class="<?php echo $tmp=='report/index'?'active':'';?>"><?php echo CHtml::link("举报反馈",array("/report/index"));?></li>
                            </ul>
                        </li>


                        <li><a href="#"><i class="fa fa-smile-o"></i><span>商铺</span></a>
                            <ul class="sub-menu">
                                <li class="<?php echo $tmp=='stroe/view'?'active':'';?>"><?php echo CHtml::link("商铺列表",array("/store/view"));?></li>
                                <li class="<?php echo $tmp=='course/index'?'active':'';?>"><?php echo CHtml::link("课程列表",array("/course/index"));?></li>
                                <li class="<?php echo $tmp=='dynamic/index'?'active':'';?>"><?php echo CHtml::link("店铺动态",array("/dynamic/index"));?></li>
                            </ul>
                        </li>


                        <?php if($info->authority >= 1):?>
                            <li><a href="#"><i class="fa fa-smile-o"></i><span>应用管理</span></a>
                                <ul class="sub-menu">
                                    <li class="<?php echo $tmp=='user/index'?'active':'';?>"><?php echo CHtml::link("用户管理",array("/user/index"));?></li>
                                    <li class="<?php echo $tmp=='report/index'?'active':'';?>"><?php echo CHtml::link("举报反馈",array("/report/index"));?></li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-list-alt"></i><span>管理</span></a>
                                <ul class="sub-menu">
                                    <li class="<?php echo $tmp=='manager/index'?'active':'';?>"><?php echo CHtml::link("人员管理",array("/manager/index"));?></li>
                                </ul>
                            </li>
                        <?php endif;?>
                </ul>
            </div>
        </div>
        <div class="text-right collapse-button" style="padding:7px 9px;">
            <span>优时管理平台v1.0</span>
            <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
        </div>
</div>
<!--    --><?php // $this->endCache();?>
<?php //endif;?>
