<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="<?php echo $this->themePath;?>images/favicon.png">

	<title><?php echo $this->pageTitle;?></title>
	<!-- Bootstrap core CSS -->
	<link href="<?php echo $this->themePath;?>js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo $this->themePath;?>fonts/font-awesome-4/css/font-awesome.min.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<![endif]-->

	<!-- Custom styles for this template -->
	<link href="<?php echo $this->themePath;?>css/style.css" rel="stylesheet" />	

</head>

<body class="texture">
<div id="cl-wrapper" class="error-container">
	<div class="page-error">
		<h1 class="number text-center text-danger"><?php echo $error['code']?></h1>
		<h2 class="description text-center alert alert-danger"><span class="text-primary"><?php echo $error['message']?></span></h2>
		<h2 class="description text-center">Don't worry, there is a little turbulence!</h2>
		<h3 class="text-center"> 请稍后重试,或点 <a href="javascript:history.go(-2);">这里</a> 返回</h3>
	</div>
	<div class="text-center copy">&copy; 2013 <a href="https://www.cgtz.com">草根投资</a></div>

	
</div>

<script src="<?php echo $this->themePath;?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $this->themePath;?>js/behaviour/general.js"></script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <script src="js/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
