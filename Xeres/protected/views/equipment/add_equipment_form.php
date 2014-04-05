<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content>
		<meta name="author" content>
		
		<!-- Title -->
		<title>Admin Layout</title>

		<!-- Latest compiled and minified Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		
		<!-- Animate.css for some flare -->
		<link rel="stylesheet" href="css/animate.min.css">

		<!-- Local stylesheet -->
		<link rel="stylesheet" href="css/global.css">
	</head>

<!-- Fixed navbar -->
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<!-- If screen size is too small for the entire navbar, condense it -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button> <!-- /navbar-toggle -->
					<a class="navbar-brand" href="./index.php">Xeres</a>
				</div> <!-- /navbar-header -->
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Quick View</a></li>
						<li class=""><a href="#">Reservation</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
							<!-- TODO: Need to take reports that require a specific item to be selected in order to generate.
						 	           Ultimately, we will migrate this to a side-bar nav (more than likely, though this is still TBA)
								   on a specific items page. E.g. 'Current Status'
							-->
							<ul class="dropdown-menu">
								<li class="dropdown-header">Total</li>
								<li><a href="#">Total Reservation Items</a></li>
								<li><a href="#">Total Reservation</a></li>

								<li class="dropdown-header">Items</li>
								<li><a href="#">Items by Type</a></li>
								<li><a href="#">Items by Number</a></li>
								<li><a href="#">Items by Person</a></li>

								<li class="dropdown-header">Misc</li>
								<li><a href="#">Reservation # with Delivery & Setup</a></li>
								<li><a href="#">Status Type</a></li>
								<li><a href="#">Current Status</a></li>
								<li><a href="#">Overdue Items</a></li>
							</ul> <!-- /dropdown-menu -->
						</li> <!-- /dropdown -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Add <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Person</a></li>
								<li><a href="#">Equipment</a></li>
								<li><a href="#">Location</a></li>
							</ul> <!-- /.dropdown-menu -->
						</li> <!-- /.dropdown -->
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Options <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#">Settings</a></li>
								<li><a href="#">Logout</a></li>
							</ul> <!-- /.dropdown-menu -->
						</li> <!-- /.dropdown -->
					</ul> <!-- /.nav .navbar-nav -->
					<form class="navbar-form navbar-right" role="search">
						<div class="form-group">
							<input id="search" type="text" class="form-control" placeholder="Search...">
						</div>
						<button type="submit" class="btn btn-primary">
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</form> <!-- /.navbar-form navbar-right -->
				</div> <!-- /.navbar-collapse -->
			</div> <!-- /.container -->
		</div> <!-- /.navbar -->

		<div class="container">
		<?php echo $content; ?>
		<!--div class="col-md-3">
        Add Person<br/>
        Add Equipment<br/>
        Add Location<br/>
      </!--div>
      <!-- Add Person Form -->
	  <div class="col-md-9">
        <div class="row">
          <h1>Add Equipment Form</h1>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="form-group">
            <label for="personType" class="control-label">Type</label>
            <select class="form-control" name="personType">
              <option value="0">Laptop</option>
              <option value="1">Keyboard</option>
              <option value="2">Mouse</option>
              <option value="3">Projector</option>
              <option value="4">Projector Screen</option>
            </select>
          </div>
          <div class="form-group">
            <label for="serialNumber" class="control-label">Serial Number</label>
            <input type="text" class="form-control" id="serialNumber" placeholder="Ex: 1L080B50230">
          </div>
          <div class="form-group">
            <label for="barcodeNumber" class="control-label" >Barcode Number</label>
            <input type="text" class="form-control" id="barcodeNumber" placeholder="Ex: 123456789999" >
          </div>

          <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <input type="text" class="form-control" id="description" placeholder="">
         </div>

         <div class="row">
          <button type="submit" class="btn btn-primary">Add Equipment</button>
          </div>

        </div>
        <div class="col-xs-12 col-md-6">
          <div class="form-group">
            <label for="manufacturer" class="control-label">Manufacturer</label>
            <input type="text" class="form-control" id="manufacturer" placeholder="Ex: Cisco">
          </div>
          <div class="form-group">
            <label for="model" class="control-label">Model</label>
            <input type="text" class="form-control" id="model" placeholder="Ex: 13WX78KS011">
          </div>
          <div class="form-group">
            <label for="accessionDate" class="control-label">Accession Date</label>
            <input type="text" class="form-control" id="accessionDate" placeholder="Ex: 10/26/2013">
          </div>

          <!--div class="form-group">
            <label for="cellPhone" class="control-label">                  </label>
            <input type="text" class="form-control" id="Text1" placeholder="xxx-xxx-xxxx">
          </div-->
        </div>
      </div>
		</div> <!-- /.container -->
	</body>

	<!-- JavaScript at the end of the file to improve loading times 
	     (we use the local versions so that the previews can be launched locally) -->
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script type="text/javascript"></script>
</html>
