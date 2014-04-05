
<!-- Sidebar -->
<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse_1">Reservations</a></h4>
			</div>
			<div id="collapse_1" class="panel-body panel-collapse collapse">
				<ul class="nav nav-pills nav-stacked">
				<li class="switch-link"><a href="#total_reservation">Total Reservations</a></li>
				<li class="switch-link"><a href="#reservation_status">By Status</a></li>
				<li class="switch-link"><a href="#items_by_person">By Person</a></li>
				<li class="switch-link"><a href="#reservations_by_type">By Item Type</a></li>
				<li class="switch-link"><a href="#items_by_number">By Barcode Number</a></li>
				<li class="switch-link"><a href="#reservations_with_delivery_and_setup">With Delivery And Setup</a></li>
				<li class="switch-link"><a href="#by_equipment_status">By Equipment Status</a></li>
				</ul>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse_2">Equipment</a></h4>
			</div>
			<div id="collapse_2" class="panel-body panel-collapse collapse">
				<ul class="nav nav-pills nav-stacked">
				<li class="switch-link"><a href="#total_reservation_items">Reserved Items</a></li>
				<li class="switch-link"><a href="#unreserved_items">Unreserved Items</a></li>
				</ul>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse_3">Misc</a></h4>
			</div>
			<div id="collapse_3" class="panel-body panel-collapse collapse">
				<ul class="nav nav-pills nav-stacked">
				<li><a href="/index.php/repo/reportoverdueitems">Overdue Items</a></li>
				<li><a href="/index.php/repo/reportlogitems">Log Items</a></li>
				</ul>
			</div>
		</div>
	</div>
</div> <!-- /.sidebar -->

<div id="content_frame" class="col-xs-12 col-sm-6">

    <div id="reservations_by_type" class="switch-group hide">
    <!-- Reservations By Item Type Form -->
    <form class="report-form" action="/index.php/repo/reportreservationsbytype" method="post" type="date">
      <div class="row col-xs-12">
        <h1>Report <small>Reservations By Item Type</small></h1>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-6">
          <div class="form-group Date">
            <label for="ReportForm_queriedBeginningDate" class="control-label">Beginning Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedBeginningDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedBeginningDate" required>
              </div>
          </div>
          <div class="form-group Date">
            <label for="ReportForm_queriedEndDate" class="control-label">End Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedEndDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedEndDate" required>
              </div>
          </div>
          <div class="form-group">
            <label for="ReportForm_extraInfo" class="control-label" >Item Type</label>
            <select name ="ReportForm[extraInfo]" type="text" class="form-control chosen" id="ReportForm_extraInfo" required>
              <option value=""></option>
              <?php
                  $res = EquipmentType::model()->findAll();
                  for ($i = 0; $i < sizeof($res); $i++)
                  {
                    echo '<option value="'.$res[$i]->item_type_id.'">'.$res[$i]->type.'</option>'; 
                  }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row col-xs-12">
        <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
      </div>
    </form>
  </div>

  <div id="items_by_person" class="switch-group hide">
    <!-- Reservations By Person Form -->
    <form class="report-form" action="/index.php/repo/reportitemsbyperson" method="post" type="date">
      <div class="row col-xs-12">
        <h1>Report <small>Reservations By Person</small></h1>
      </div>
	  <div class="row">
        <div class="col-xs-12 col-sm-6">
          <div class="form-group Date">
            <label for="ReportForm_queriedBeginningDate" class="control-label">Beginning Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedBeginningDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedBeginningDate" required>
              </div>
          </div>
          <div class="form-group Date">
            <label for="ReportForm_queriedEndDate" class="control-label">End Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedEndDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedEndDate" required>
              </div>
          </div>
          <div class="form-group">
            <label for="ReportForm_extraInfo" class="control-label" >Person</label>
            <div class="form-group">
              <select name ="ReportForm[extraInfo]" type="text" class="form-control chosen" id="ReportForm_extraInfo" required>
                <option value=""></option>
                <?php
                  $res = People::model()->findAll();
                  for ($i = 0; $i < sizeof($res); $i++)
                  {
                      echo '<option value="'.$res[$i]->people_id.'">'.$res[$i]->first_name.' '.$res[$i]->last_name.' --- '.$res[$i]->email_address.'</option>'; 
                  }
                ?>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row col-xs-12">
        <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
      </div>
    </form>
  </div>

  <div id="items_by_number" class="switch-group hide">
    <!-- Reservations By Barcode Number Form -->
    <form class="report-form" action="/index.php/repo/reportitemsbynumber" method="post" type="date">
      <div class="row col-xs-12">
        <h1>Report <small>Reservations By Barcode Number</small></h1>
      </div>
	  <div class="row">
        <div class="col-xs-12 col-sm-6">
          <div class="form-group Date">
            <label for="ReportForm_queriedBeginningDate" class="control-label">Beginning Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedBeginningDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedBeginningDate" required>
              </div>
          </div>
          <div class="form-group Date">
            <label for="ReportForm_queriedEndDate" class="control-label">End Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedEndDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedEndDate" required>
              </div>
          </div>
          <div class="form-group">
            <label for="ReportForm_extraInfo" class="control-label" >Barcode Number</label>
            <select name ="ReportForm[extraInfo]" type="text" class="form-control chosen" id="ReportForm_extraInfo" required>
              <option value=""></option>
              <?php
                  $res = Equipment::model()->findAll();
                  for ($i = 0; $i < sizeof($res); $i++)
                  {
                    echo '<option value="'.$res[$i]->item_number.'">'.$res[$i]->barcode_number.'</option>'; 
                  }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row col-xs-12">
        <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
      </div>
    </form>
  </div>

  <div id="unreserved_items" class="switch-group hide">
    <!-- Unreserved Items Form -->
    <form class="report-form" action="/index.php/repo/reportunreserveditems" method="post" type="date">
      <div class="row col-xs-12">
        <h1>Report <small>Unreserved Items</small></h1>
      </div>
	  <div class="row">
        <div class="col-xs-12 col-sm-6">
          <div class="form-group Date">
            <label for="ReportForm_queriedBeginningDate" class="control-label">Beginning Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedBeginningDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedBeginningDate" required>
              </div>
          </div>
          <div class="form-group Date">
            <label for="ReportForm_queriedEndDate" class="control-label">End Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedEndDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedEndDate" required>
              </div>
          </div>
        </div>
      </div>
      <div class="row col-xs-12">
        <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
      </div>
    </form>
  </div>

  <div id="total_reservation" class="switch-group hide">
    <!-- Total Reservations Form -->
    <form class="report-form" action="/index.php/repo/reporttotalreservations" method="post" type="date">
      <div class="row col-xs-12">
        <h1>Report <small>Total Reservations</small></h1>
      </div>
	  <div class="row">
        <div class="col-xs-12 col-sm-6">
          <div class="form-group Date">
            <label for="ReportForm_queriedBeginningDate" class="control-label">Beginning Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedBeginningDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedBeginningDate" required>
              </div>
          </div>
          <div class="form-group Date">
            <label for="ReportForm_queriedEndDate" class="control-label">End Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedEndDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedEndDate" required>
              </div>
          </div>
        </div>
      </div>
      <div class="row col-xs-12">
        <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
      </div>
    </form>
  </div>

  <div id="total_reservation_items" class="switch-group hide">
    <!-- Reserved Items Form -->
    <form class="report-form" action="/index.php/repo/reporttotalreservationitems" method="post" type="date">
      <div class="row col-xs-12">
        <h1>Report <small>Reserved Items</small></h1>
      </div>
	  <div class="row">
        <div class="col-xs-12 col-sm-6">
          <div class="form-group Date">
            <label for="ReportForm_queriedBeginningDate" class="control-label">Beginning Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedBeginningDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedBeginningDate" required>
              </div>
          </div>
          <div class="form-group Date">
            <label for="ReportForm_queriedEndDate" class="control-label">End Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedEndDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedEndDate" required>
              </div>
          </div>
        </div>
      </div>
      <div class="row col-xs-12">
        <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
      </div>
    </form>
  </div>

  <div id="reservations_with_delivery_and_setup" class="switch-group hide">
    <!-- Reservations With Delivery And Setup Form -->
    <form class="report-form" action="/index.php/repo/reportreservationswithdeliveryandsetup" method="post" type="date">
      <div class="row col-xs-12">
        <h1>Report <small>Reservations With Delivery And Setup</small></h1>
      </div>
	  <div class="row">
        <div class="col-xs-12 col-sm-6">
          <div class="form-group Date">
            <label for="ReportForm_queriedBeginningDate" class="control-label">Beginning Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedBeginningDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedBeginningDate" required>
              </div>
          </div>
          <div class="form-group Date">
            <label for="ReportForm_queriedEndDate" class="control-label">End Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedEndDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedEndDate" required>
              </div>
          </div>
        </div>
      </div>
      <div class="row col-xs-12">
        <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
      </div>
    </form>
  </div>

  <div id="reservation_status" class="switch-group hide">
    <!-- Reservations By Status Form -->
    <form class="report-form" action="/index.php/repo/reportreservationstatus" method="post" type="date">
      <div class="row col-xs-12">
        <h1>Report <small>Reservations By Status</small></h1>
      </div>
	  <div class="row">
        <div class="col-xs-12 col-sm-6">
          <div class="form-group Date">
            <label for="ReportForm_queriedBeginningDate" class="control-label">Beginning Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedBeginningDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedBeginningDate" required>
              </div>
          </div>
          <div class="form-group Date">
            <label for="ReportForm_queriedEndDate" class="control-label">End Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedEndDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedEndDate" required>
              </div>
          </div>
          <div class="form-group">
            <label for="ReportForm_extraInfo" class="control-label">Status</label>
            <select name="ReportForm[extraInfo]" id="ReportForm_extraInfo" class="form-control chosen" required>
              <option value=""></option>
              <?php
                  $res = ReservationStatus::model()->findAll();
                  for ($i = 0; $i < sizeof($res); $i++)
                  {
                    echo '<option value="'.$res[$i]->reservation_status_id.'">'.$res[$i]->status.'</option>'; 
                  }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row col-xs-12">
        <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
      </div>
    </form>
  </div>

  <div id="by_equipment_status" class="switch-group hide">
    <!-- Reservations By Equipment Status Form -->
    <form class="report-form" action="/index.php/repo/reportbyequipmentstatus" method="post" type="date">
      <div class="row col-xs-12">
        <h1>Report <small>Reservations By Equipment Status</small></h1>
      </div>
	  <div class="row">
        <div class="col-xs-12 col-sm-6">
          <div class="form-group Date">
            <label for="ReportForm_queriedBeginningDate" class="control-label">Beginning Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedBeginningDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedBeginningDate" required>
              </div>
          </div>
          <div class="form-group Date">
            <label for="ReportForm_queriedEndDate" class="control-label">End Date</label>
              <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                  <input name ="ReportForm[queriedEndDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReportForm_queriedEndDate" required>
              </div>
          </div>
          <div class="form-group">
            <label for="ReportForm_extraInfo" class="control-label">Equipment Status</label>
            <select name="ReportForm[extraInfo]" id="ReportForm_extraInfo" class="form-control chosen" required>
              <option value=""></option>
              <?php
                  $res = EquipmentStatus::model()->findAll();
                  for ($i = 0; $i < sizeof($res); $i++)
                  {
                    echo '<option value="'.$res[$i]->status_id.'">'.$res[$i]->status.'</option>'; 
                  }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row col-xs-12">
        <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
      </div>
    </form>
  </div>

</div> <!-- /#content_frame -->

<!-- javascript -->
<input type="hidden" id="formname" value="<?php echo $formname; ?>" />
<script type="text/javascript" src="<?php Yii::app()->request->baseUrl; ?>/js/site/reportUserInput.js"></script>
