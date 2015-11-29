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

                        <li><a href="<?=$this->getController()->createUrl('table/index')?>"><i class="fa fa-home"></i><span>建表</span></a>
                            <!--<ul class="sub-menu">
                                <li class="<?php /*echo ($tmp=='useradvise/index')?'active':'';*/?>">
                                    <?php /*echo CHtml::link("建表",array("/userAdvise/index"));*/?>
                                </li>
                            </ul>-->
                        </li>
                        <li><a href="<?=$this->getController()->createUrl('assess/index')?>"><i class="fa fa-home"></i><span>自评</span></a>
                            <!--<ul class="sub-menu">
                                <li class="<?php /*echo ($tmp=='useradvise/index')?'active':'';*/?>">
                                    <?php /*echo CHtml::link("客户反馈意见",array("/userAdvise/index"));*/?>
                                </li>
                            </ul>-->
                        </li>
                        <li><a href="#"><i class="fa fa-home"></i><span>会签</span></a>
                           <!-- <ul class="sub-menu">
                                <li class="<?php /*echo ($tmp=='useradvise/index')?'active':'';*/?>">
                                    <?php /*echo CHtml::link("客户反馈意见",array("/userAdvise/index"));*/?>
                                </li>
                            </ul>-->
                        </li>


                        <li><a href="<?=$this->getController()->createUrl('check/index')?>"><i class="fa fa-smile-o"></i><span>考核</span></a>
                           <!-- <ul class="sub-menu">
                                <li class="<?php /*echo $tmp=='operatecode/index'?'active':'';*/?>"><?php /*echo CHtml::link("跟踪代码设置",array("/OperateCode/index"));*/?></li>
                                <li class="<?php /*echo $tmp=='operatecode/create'?'active':'';*/?>"><?php /*echo CHtml::link("添加跟踪代码",array("/OperateCode/create"));*/?></li>
                                <li class="<?php /*echo $conName=='operatechannel'?'active':'';*/?>"><?php /*echo CHtml::link("推广渠道",array("/OperateChannel/index"));*/?></li>
                                <li class="<?php /*echo $conName=='coupontemplate'?'active':'';*/?>"><?php /*echo CHtml::link("投资券模板",array("/couponTemplate/index"));*/?></li>
                                <li class="<?php /*echo $conName=='yearcoupon'?'active':'';*/?>"><?php /*echo CHtml::link("年化券",array("/yearCoupon/index"));*/?></li>
                                <li class="<?php /*echo $conName=='newredpacket'?'active':'';*/?>"><?php /*echo CHtml::link("新红包模板",array("/NewRedPacket/index"));*/?></li>
                            </ul>-->
                        </li>


                        <?php if($info->authority >= 1):?>
                            <li><a href="#"><i class="fa fa-smile-o"></i><span>应用管理</span></a>
                                <ul class="sub-menu">
                                    <li class="<?php echo $tmp=='user/index'?'active':'';?>"><?php echo CHtml::link("用户管理",array("/user/index"));?></li>
                                    <li class="<?php echo $tmp=='report/index'?'active':'';?>"><?php echo CHtml::link("举报反馈",array("/report/index"));?></li>
                                    <li class="<?php echo $tmp=='stroe/view'?'active':'';?>"><?php echo CHtml::link("商铺列表",array("/store/view"));?></li>
                                    <li class="<?php echo $tmp=='coupontemplate'?'active':'';?>"><?php echo CHtml::link("投资券模板",array("/couponTemplate/index"));?></li>
                                    <li class="<?php echo $tmp=='yearcoupon'?'active':'';?>"><?php echo CHtml::link("年化券",array("/yearCoupon/index"));?></li>
                                    <li class="<?php echo $tmp=='newredpacket'?'active':'';?>"><?php echo CHtml::link("新红包模板",array("/NewRedPacket/index"));?></li>
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
