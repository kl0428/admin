<!DOCTYPE html>
<html lang="en" >
<head >
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <meta name="description" content="" >
    <meta name="author" content="" >

    <title ><?php echo Yii::app()->name; ?></title >
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $this->themePath; ?>js/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $this->themePath; ?>fonts/font-awesome-4/css/font-awesome.min.css" >

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" ></script >
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/jquery.gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/jquery.nanoscroller/nanoscroller.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/jquery.easypiechart/jquery.easy-pie-chart.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/bootstrap.switch/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/jquery.select2/select2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/bootstrap.slider/css/slider.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/intro.js/introjs.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/jquery.niftymodals/css/component.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/fuelux/css/fuelux.css" >
    <link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/fuelux/css/fuelux-responsive.min.css" >
    <link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/jquery.icheck/skins/square/blue.css" >

	<link rel="stylesheet" type="text/css" href="<?php echo $this->themePath; ?>js/webuploader/css/webuploader.css" >

    <!-- Custom styles for this template -->
    <link href="<?php echo $this->themePath; ?>css/style.css?v=<?php echo VERSION; ?>" rel="stylesheet" />
    <style type="text/css" >
        .errorMessage {
            color: red;
        }
    </style >
</head >
<body oncontextmenu="return true" >
<!-- Fixed navbar -->
<div id="head-nav" class="navbar navbar-default navbar-fixed-top" >
    <div class="container-fluid" >
        <div class="navbar-header" >
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
                <span class="fa fa-gear" ></span >
            </button >
            <a class="navbar-brand" href="#" ><span >运营平台</span ></a >
        </div >
        <div class="navbar-collapse collapse" >
            <?php if (!Yii::app()->user->isGuest): ?>
                <ul class="nav navbar-nav navbar-right user-nav" >

                    <li class="dropdown profile_menu" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><img alt="Avatar" src="<?php echo $this->themePath; ?>images/avatar2.jpg" />
                            <span ><?php echo Yii::app()->user->name ?></span > <b class="caret" ></b ></a >
                        <ul class="dropdown-menu" >
                            <li >
                                <?php echo CHtml::link("修改资料", array("/SysUser/profile", "id" => Yii::app()->user->getId())); ?>
                            </li >
                            <li class="divider" ></li >
                            <li >
                                <?php echo CHtml::link("退出", array("/site/logout")); ?>
                            </li >
                        </ul >
                    </li >
                </ul >
            <?php endif; ?>
            <!--         <ul class="nav navbar-nav navbar-right not-nav">
                  <li class="button dropdown open">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-globe"></i><span class="bubble" id="bubble">2</span>
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                        <div class="nano nscroller has-scrollbar">
                          <div style="right: -15px;" tabindex="0" class="content">
                            <ul id="messagelist">
                              <li><a href="#"><i class="fa fa-cloud-upload info"></i><b>Daniel</b> is now following you <span class="date">2 minutes ago.</span></a></li>
                            </ul>
                          </div>
                        <div style="display: block;" class="pane"><div style="height: 162px; top: 0px;" class="slider"></div></div></div>
                        <ul class="foot"><li><a href="#">View all activity </a></li></ul>
                      </li>
                    </ul> -->
            </li>
            </ul>
        </div >
        <!--/.nav-collapse animate-collapse -->

    </div >
</div >

<div id="cl-wrapper" class="fixed-menu" >
    <?php $this->widget("application.components.SlideMenu"); ?>
</div >
<div class="container-fluid" id="pcont" >
    <?php echo $content; ?>
</div >




<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.gritter/js/jquery.gritter.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.nanoscroller/jquery.nanoscroller.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/behaviour/general.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.sparkline/jquery.sparkline.min.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.easypiechart/jquery.easy-pie-chart.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.nestable/jquery.nestable.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/bootstrap.switch/bootstrap-switch.min.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.ui/jquery-ui.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/bootstrap.datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.select2/select2.min.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/skycons/skycons.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/intro.js/intro.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.niftymodals/js/jquery.modalEffects.js" ></script >

<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.parsley/parsley.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/bootstrap.slider/js/bootstrap-slider.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/fuelux/loader.min.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.icheck/icheck.min.js" ></script >
<!-- Bootstrap core JavaScript
  ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" >
    $(document).ready(function () {
        //initialize the javascript
        App.init();
        App.dashBoard();
        App.charts();
        App.wizard();
        // introJs().setOption('showBullets', false).start();
//        $('.md-trigger').modalEffects();
    });
</script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/behaviour/voice-commands.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.flot/jquery.flot.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.flot/jquery.flot.pie.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.flot/jquery.flot.resize.js" ></script >
<script type="text/javascript" src="<?php echo $this->themePath; ?>js/jquery.flot/jquery.flot.labels.js" ></script >
</body >
</html >
