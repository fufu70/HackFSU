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
					<a class="navbar-brand" href="/index.php/site/quickview">Xeres</a>
				</div> <!-- /navbar-header -->
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reservation <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="/index.php/rese/reservationnew">New</a></li>
								<li><a href="/index.php/rese/reservationcheckout">Checkout</a></li>
                                <li><a href="/index.php/rese/reservationclose">Close</a></li>
							</ul> <!-- /.dropdown-menu -->
						</li> <!-- /.dropdown -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
							<!-- TODO: Need to take reports that require a specific item to be selected in order to generate.
						 	           Ultimately, we will migrate this to a side-bar nav (more than likely, though this is still TBA)
								   on a specific items page. E.g. 'Current Status'
							-->
							<ul class="dropdown-menu">
								<li class="dropdown-header">Reservations</li>
								<li><a href="/index.php/repo/reporttotalreservations">Total Reservations</a></li>
								<li><a href="/index.php/repo/reportreservationstatus">By Status</a></li>
								<li><a href="/index.php/repo/reportitemsbyperson">By Person</a></li>
								<li><a href="/index.php/repo/reportreservationsbytype">By Item Type</a></li>
								<li><a href="/index.php/repo/reportitemsbynumber">By Barcode Number</a></li>
								<li><a href="/index.php/repo/reportreservationswithdeliveryandsetup">With Delivery And Setup</a></li>
								<li><a href="/index.php/repo/reportbyequipmentstatus">By Equipment Status</a></li>
								<li class="dropdown-header">Equipment</li>
								<li><a href="/index.php/repo/reporttotalreservationitems">Reserved Items</a></li>
								<li><a href="/index.php/repo/reportunreserveditems">Unreserved Items</a></li>
								<li class="dropdown-header">Misc</li>
								<li><a href="/index.php/repo/reportoverdueitems">Overdue Items</a></li>
								<li><a href="/index.php/repo/reportlogitems">Log Items</a></li>
							</ul> <!-- /dropdown-menu -->
						</li> <!-- /dropdown -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Add <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="/index.php/add/addperson">Person</a></li>
								<li><a href="/index.php/add/addequipment">Equipment</a></li>
								<li><a href="/index.php/add/addequipmenttype">Equipment Type</a></li>
								<li><a href="/index.php/add/addequipmentstatus">Equipment Status</a></li>
								<li><a href="/index.php/add/addlocation">Location</a></li>
								<li><a href="/index.php/add/addreservationstatus">Reservation Status</a></li>
								<li><a href="/index.php/add/addpeoplerole">Role</a></li>
							</ul> <!-- /.dropdown-menu -->
						</li> <!-- /.dropdown -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Edit <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="/index.php/edit/editperson">Person</a></li>
								<li><a href="/index.php/edit/editequipment">Equipment</a></li>
								<li><a href="/index.php/edit/editequipmenttype">Equipment Type</a></li>								
								<li><a href="/index.php/edit/editequipmentstatus">Equipment Status</a></li>
								<li><a href="/index.php/edit/editlocation">Location</a></li>
								<li><a href="/index.php/edit/editreservationstatus">Reservation Status</a></li>
								<li><a href="/index.php/edit/editpeoplerole">Role</a></li>
							</ul> <!-- /.dropdown-menu -->
						</li> <!-- /.dropdown -->
					</ul> <!-- /.nav .navbar-nav -->
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
