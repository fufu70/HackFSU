<?php
  /* @var $this Controller */

  $baseUrl = Yii::app()->request->baseUrl;
  $parts = explode("@", Yii::app()->user->name);
  $username = $parts[0];
  date_default_timezone_set("America/New_York");

  $facebook_user_info = array(
    'appId' => '615150678563708',
    'secret' => '9a333ac7acb6e11f0591647c00bb5d5d',
    'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
  );

  $facebook = new Facebook($facebook_user_info);
  $user_info = $facebook->getUser();

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
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

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
		<div class="container" style="background-color:#ECF1F0;min-width:750px">
			<div  class="header">

				<a href="/index.php/rssfeed/getrssfeed/"><h3 class="nav navbar-nav navbar-left" style="margin-right:50px;">E-Mews</h3></a>
				<div class="navbar-header btn-group navbar-right">
				<ul class="nav navbar-nav">
					<li>
					<form method="post" action="/index.php/rssfeed/getarticle/">
						<input style="display:none;" type="text" name="url" value="<?php if(isset($_GET['url_feed'])){echo $_GET['url_feed'];} ?>" />
						<input style="display:none;" type="text" name="mood_choose" value="0" />
						<button type="submit" style="margin-top:10px;margin:left:5px;margin-right:5px;<?php if(!isset($_GET['url_feed'])){echo 'display:none;';} ?>" class="btn btn-success">:)</button>
					</form>
					</li>
					<li>
					<form method="post" action="/index.php/rssfeed/getarticle/">
						<input style="display:none;" type="text" name="url" value="<?php if(isset($_GET['url_feed'])){echo $_GET['url_feed'];} ?>" />
						<input style="display:none;" type="text" name="mood_choose" value="1" />
						<button type="submit" style="margin-top:10px;margin:left:5px;margin-right:5px;<?php if(!isset($_GET['url_feed'])){echo 'display:none;';} ?>" class="btn btn-warning">:|</button>
					</form>
					</li>
					<li>
					<form method="post" action="/index.php/rssfeed/getarticle/">
						<input style="display:none;" type="text" name="url" value="<?php if(isset($_GET['url_feed'])){echo $_GET['url_feed'];} ?>" />
						<input style="display:none;" type="text" name="mood_choose" value="2" />
						<button type="submit" style="margin-top:10px;margin:left:5px;margin-right:5px;<?php if(!isset($_GET['url_feed'])){echo 'display:none;';} ?>" class="btn btn-danger">:(</button>
					</form>
					</li>
				</ul>
				</div>
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
