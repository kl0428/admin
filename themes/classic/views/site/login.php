<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>运营管理</title>
	<!-- Bootstrap core CSS -->
	<link href="<?php echo $this->themePath;?>js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $this->themePath;?>fonts/font-awesome-4/css/font-awesome.min.css">
	<!-- Custom styles for this template -->
	<link href="<?php echo $this->themePath;?>css/style.css" rel="stylesheet" />	
</head>
<body class="texture">

<div id="cl-wrapper" class="login-container">

	<div class="middle-login">
		<div class="block-flat">
			<div class="header">							
				<h3 class="text-center"><img class="logo-img" src="<?php echo $this->themePath;?>images/logo.png" alt="logo"/>草根投资管理系统</h3>
			</div>
			<div>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); ?>
					<div class="content">
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <?php echo $form->textField($model,'username',array("class"=>"form-control","placeholder"=>"请输入用户名"));?>

									</div>
									<div><?php echo $form->error($model,'username'); ?></div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <?php echo $form->passwordField($model,'password',array("class"=>"form-control"));?>

									</div>
									<div><?php echo $form->error($model,'password'); ?></div>
								</div>
							</div>

					</div>
					<div class="foot">
                        <?php echo CHtml::submitButton('系统登陆',array('class'=>'btn btn-info'));?>
					</div>
				<?php $this->endWidget();?>
			</div>
		</div>
		<div class="text-center out-links"><a href="https://www.cgtz.com" target="_blank">&copy; 2016 草根网络科技有限公司</a></div>
	</div> 
	
</div>

<script src="<?php echo $this->themePath;?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $this->themePath;?>js/behaviour/general.js"></script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo $this->themePath;?>js/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
