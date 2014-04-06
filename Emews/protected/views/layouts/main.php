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
		<title>E-Mews</title>

		<!-- Latest compiled and minified Bootstrap CSS -->
		<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/bootstrap.css">
		<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/narrow.css">
        	<!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">-->
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">	

		<!-- Animate.css for some flare -->
		<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/animate.min.css">
        
        	<!-- Javascript -->
        	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery.min.js"></script>
        	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery-ui.min.js"></script>
        	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/bootstrap.min.js"></script>
	</head>

	<body>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=615150678563708";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
		<div class="container">
			<div class="header">
				<ul class="nav nav-pills pull-right">
					<li class="active"><a href="/index.php/RSSFeed/getrssfeed/">Home</a></li>
					<li><a href="#">Me</a></li>
				</ul>
				<a href=""><h3 class="text-muted">E-Mews</h3></a>
			</div>

			<div class="row marketing">
				<div class="col-lg-12">
                	<?php echo $content; ?>
				</div>
			</div>

			<div class="footer">
				<p>&copy; E-Mews 2014</p>
			</div>

		</div> <!-- /container -->
	</body>
</html>
