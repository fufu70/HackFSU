<?php
  /* @var $this Controller */

  $baseUrl = Yii::app()->request->baseUrl;
  $parts = explode("@", Yii::app()->user->name);
  $username = $parts[0];
  date_default_timezone_set("America/New_York");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Title -->
		<title>Xeres - Super</title>

		<!-- Latest compiled and minified Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/bootstrap-theme.min.css">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
		
		<!-- Animate.css for some flare -->
		<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/animate.min.css">

        <!-- Local stylesheet -->
		<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/fullcalendar.css">
		<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/fullcalendar.print.css" media="print"> 
		<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/global.css">
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/chosen.css">
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/glyphicons.css">
		<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/footable.core.css">
        
        <!-- Javascript -->
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/fullcalendar.min.js"></script>
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery.maskedinput.js"></script>
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/chosen.jquery.js"></script>
		<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jqBootstrapValidation.js"></script>
		<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/footable.js"></script>
		<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/footable.sort.js"></script>
		<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/footable.paginate.js"></script>
	</head>

    <!-- Fixed navbar -->
    <body>
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
                    <!-- If screen size is too small for the entire navbar, condense it -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button> <!-- /navbar-toggle -->
					<a class="navbar-brand" href="/index.php/site/quickview">Emews</a>
				</div> <!-- /navbar-header -->
				<div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b><?php echo $username; ?></b>&nbsp;<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="/index.php/site/optionpassword">Settings</a></li>
								<li><a href="/index.php/site/logout">Log Out</a></li>
							</ul> <!-- /.dropdown-menu -->
						</li> <!-- /.dropdown -->
                    </ul> <!-- /.nav .navbar-nav .navbar-right -->
				</div> <!-- /.navbar-collapse -->
			</div> <!-- /.container -->
		</div> <!-- /.navbar -->
        
		<div class="container margin-small">
            <div class="row row-offcanvas row-offcanvas-left" style="margin-top:50px; margin-bottom:25px;">
                <?php echo $content; ?>
            </div>
		</div> <!-- /.container -->
	</body>	
</html>
