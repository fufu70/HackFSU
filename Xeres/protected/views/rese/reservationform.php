
<!-- Sidebar -->
<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
  <div class="panel panel-default">
    <div class="panel-body">
      <ul class="nav nav-pills nav-stacked">
      <li class="<?php if($formname=='new_reservation' || $formname == 'new_reservation_agent') echo 'active'; ?>"><a href="/index.php/rese/reservationnew">New Reservation</a></li>
      <li class="<?php if($formname=='checkout_reservation') echo 'active'; ?>"><a href="/index.php/rese/reservationcheckout">Checkout Reservation</a></li>      
      <li class="<?php if($formname=='close_reservation') echo 'active'; ?>"><a href="/index.php/rese/reservationclose">Close Reservation</a></li>
      </ul>
	</div>
  </div>
</div> <!-- /.sidebar -->

<div id="content_frame" class="col-xs-12 col-sm-6">

  <!--New Reservation Form-->
  <div id="new_reservation" <?php if($formname!='new_reservation' && $formname!='new_reservation_agent') echo 'class="hide"'; ?>>
    <form class="form-signin" action="/index.php/rese/reservationnew" method="post">
      <?php
        if($formname =='new_reservation' && isset($wrong_items))
        {
          echo '<div class="row alert alert-danger margin-small"><p><strong>Sorry, some items you requested have already been reserved:</strong></p>';
          for($i = 0; $i < sizeof($wrong_items); $i++)
          {
            $equipment = Equipment::model()->findByPK($wrong_items[$i][0]['item_number']);
            $person = People::model()->findByPK($wrong_items[$i][0]['people_id']);
            echo '<p>Item '.$equipment->description.' '.$equipment->manufacturer.' '.$equipment->model.' for '.$person->first_name.' '.$person->last_name.' from '.$wrong_items[$i][0]['beginning_date'].' to '.$wrong_items[$i][0]['end_date'].'</p>';
          }
          echo '</div>';
        }
      ?>
        <div class="row col-xs-12">
            <h1>New Reservation Form</h1>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <a href="<?php if ($formname == 'new_reservation') { echo "../add/addperson"; } else if ($formname == 'new_reservation_agent') { echo "../add/addpersonagent"; } ?>"><button class="btn btn-default" type="button">Add Person</button></a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8">
                <div class="form-group">
                    <label for="ReservationForm_primaryEmail" class="control-label">Primary Contact</label>
                    <select name= "ReservationForm[primaryEmail]" type="email" class="form-control" id="ReservationForm_primaryEmail" required>
                        <option value=""></option>
                    <?php
                      if ($formname == 'new_reservation' || $formname == 'new_reservation_agent')
                      {
                        $res = People::model()->findAll();
                        for ($i = 0; $i < sizeof($res); $i++)
                        {
                        echo '<option value="'.$res[$i]->email_address.'">'.$res[$i]->email_address.' --- '.$res[$i]->first_name.' '.$res[$i]->last_name.'</option>'; 
                        }
                      }
                    ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8">
                <div class="form-group">
                    <label for="ReservationForm_secondaryEmail" class="control-label">Secondary Contact</label>
                    <select name="ReservationForm[secondaryEmail]" type="email" class="form-control" id="ReservationForm_secondaryEmail">
                        <option value=""></option>
                    <?php
                      if ($formname == 'new_reservation' || $formname == 'new_reservation_agent')
                      {
                        for ($i = 0; $i < sizeof($res); $i++)
                        {
                        echo '<option value="'.$res[$i]->email_address.'">'.$res[$i]->email_address.' --- '.$res[$i]->first_name.' '.$res[$i]->last_name.'</option>'; 
                        }
                      }
                    ?>
                    </select>
                </div>
            </div>
        </div>
		<div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8">
                <div class="form-group">
                    <label for='ReservationForm_equipmentNew' class='control-label'>Equipment</label>
                    <select multiple name='ReservationForm[equipment][]' id='ReservationForm_equipmentNew' class='form-control' required>
                    <?php
						if ($formname == 'new_reservation' || $formname == 'new_reservation_agent')
						{
							$type = EquipmentType::model()->findAll();
                            $reportForm = new ReportForm;
							$item = $reportForm->getAvailableEquipment();
							for ($t = 0; $t < sizeof($type); $t++)
							{
								echo '<optgroup label="'.$type[$t]->type.'" id="itemGroup_'.$type[$t]->item_type_id.'">';
								for ($i = 0; $i < sizeof($item); $i++)
								{
                                    $objectname = $item[$i]['item_type_id'];
									if ($type[$t]['item_type_id'] == $objectname)
									{
										echo '<option value="'.$item[$i]['item_number'].'">'.$item[$i]['description'].' '.$item[$i]['manufacturer'].' '.$item[$i]['model'].'</option>';   
									}
								}
								echo '</optgroup>';
							}
						}
                    ?>
                    </select>
                </div>
            </div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group">
					<label for="filter_equipment" class="control-label">Filter Equipment By</label>
					<select id="filter_equipment" class="form-control">
						<option value="All">All</option>
						<?php
							if ($formname == 'new_reservation' || $formname == 'new_reservation_agent')
							{
								$res = EquipmentType::model()->findAll();
								for ($i = 0; $i < sizeof($res); $i++)
								{
									echo '<option value="'.$res[$i]->item_type_id.'">'.$res[$i]->type.'</option>'; 
								}
							}
						?>
					</select>
				</div>
			</div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group Date">
                    <label for="ReservationForm_beginningDate" class="control-label">Beginning Date</label>
                    <div class="input-group">
                        <span class="input-group-btn add-on">
                        <button class="btn btn-default" type="button">
                            &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                        </button>
                        </span>
                        <input name ="ReservationForm[beginningDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReservationForm_beginningDate" required>
                    </div>
                </div>
                <div class="form-group Time">
                    <label for="ReservationForm_beginningTime" class="control-label">Beginning Time</label>
                    <div class="input-group">
                        <span class="input-group-btn add-on">
                        <button class="btn btn-default" type="button">
                            &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                        </button>
                        </span>
                        <input name ="ReservationForm[beginningTime]" data-format="hh:mm" type="Text" class="form-control" id="ReservationForm_beginningTime" required>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group Date">
                    <label for="ReservationForm_endDate" class="control-label">End Date</label>
                    <div class="input-group">
                        <span class="input-group-btn add-on">
                        <button class="btn btn-default" type="button">
                            &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                        </button>
                        </span>
                        <input name ="ReservationForm[endDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReservationForm_endDate" required>
                    </div>
                </div>
                <div class="form-group Time">
                    <label for="ReservationForm_endTime" class="control-label">End Time</label>
                    <div class="input-group">
                        <span class="input-group-btn add-on">
                        <button class="btn btn-default" type="button">
                            &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                        </button>
                        </span>
                        <input name ="ReservationForm[endTime]" data-format="hh:mm" type="Text" class="form-control" id="ReservationForm_endTime" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="ReservationForm_buildingName" class="control-label">Location Name</label>
                    <select name ="ReservationForm[buildingName]" type="text" class="form-control" id="ReservationForm_buildingName" required>
                        <option value=""></option>
                        <?php
                          if ($formname=='new_reservation' || $formname == 'new_reservation_agent')
                          {
                            $res = Location::model()->findAll();
                            for ($i = 0; $i < sizeof($res); $i++)
                            {
                              echo '<option value="'.$res[$i]->building_name.'">'.$res[$i]->building_name .'</option>';
                            } 
                          }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="ReservationForm_locationDescription" class="control-label">Location Description</label>
                    <input name="ReservationForm[locationDescription]" type="text" class="form-control" id="ReservationForm_locationDescription">
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label for="ReservationForm_assistanceNeeded" class="control-label">Assistance Needed</label>
                    <input type="checkbox" class="form-control" name="ReservationForm[assistanceNeeded]" id="ReservationForm_assistanceNeeded" value="1">
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label for="ReservationForm_deliveryAndSetup" class="control-label">Delivery and Setup</label>
                    <input type="checkbox" class="form-control" name="ReservationForm[deliveryAndSetup]" id="ReservationForm_deliveryAndSetup" value="1">
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label for="ReservationForm_takedownNeeded" class="control-label">Takedown Needed</label>
                    <input type="checkbox" class="form-control" name="ReservationForm[takedownNeeded]" id="ReservationForm_takedownNeeded" value="1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <label for="ReservationForm_reservationNotes" class="control-label" style="display: block">Reservation Notes</label>
                    <textarea name="ReservationForm[reservationNotes]" class="form-control" id="ReservationForm_reservationNotes" rows="4"></textarea>
                </div>
            </div>
        </div>
        <div class="row col-xs-12">
            <button class="btn btn-primary" type="submit" name="yt0">Create Reservation</button>
        </div>
    </form>
  </div>
  
  <!--Close Reservation Javascript-->
  <script type="text/javascript">
    jQuery(function($)
    {
        var closeResList =
            <?php 
                $statInfo = ReservationStatus::model()->find(array("select"=>'*', 'condition'=>'status=:resStat','params'=>array(':resStat'=>"Active")));
                $res = Reservation::model()->findAll(array("select"=>'*','condition'=>'reservation_status_id=:status','params'=>array(':status'=>$statInfo->reservation_status_id)));
                $resList = array();
                for ($i = 0; $i < sizeof($res); $i++)
                {
                    $resList[$res[$i]->reservation_number] = $res[$i]->getAttributes();
                }
                echo json_encode($resList, JSON_FORCE_OBJECT);
            ?>;
        $(document).ready(function() {
            $("#close_res_number").trigger("change");
        });
        $("#close_res_number").chosen({
            placeholder_text_single: " ",
            search_contains: true,
        });
        $("#close_res_number").change(function() {
            var res_number = $('#close_res_number :selected').val();
            if (res_number == "") {
                $("#close_reservation_form").get(0).reset();
            } else {
                timeParts = closeResList[res_number]["beginning_time"].split(' ');
                $("#close_beginningTime").val(timeParts[1].substring(0, 5));
                $("#close_beginningDate").val(closeResList[res_number]["beginning_date"]);
                timeParts = closeResList[res_number]["end_time"].split(' ');
                $("#close_endTime").val(timeParts[1].substring(0, 5));
                $("#close_endDate").val(closeResList[res_number]["end_date"]);
            }
        });
    });
  </script>
  
  <!--Close Reservation Form-->
  <div id="close_reservation" <?php if($formname!='close_reservation') echo 'class="hide"'; ?>>
    <form id="close_reservation_form" class="form-signin" action="/index.php/rese/reservationclose" method="post">
        <div class="row col-xs-12">
            <h1>Close Reservation Form</h1>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                    <label for="ReservationForm_reservationNumber" class="control-label">Reservation Number</label>
                    <select name= "ReservationForm[reservationNumber]" type="text" class="form-control" id="close_res_number" required>
                        <option value=""></option>
                    <?php
                      if ($formname == 'close_reservation')
                      {
                        for ($i = 0; $i < sizeof($res); $i++)
                        {
                          $peopleInfo = People::model()->find(array("select"=>'*','condition'=>'people_id=:people','params'=>array(':people'=>$res[$i]->people_id)));
                          $selected = '';
                          if (isset($reservation_table))
                          {
                            if ($res[$i]->people_id == $reservation_table->people_id) $selected = 'selected';
                          }
                          echo '<option value="'.$res[$i]->reservation_number.'" '.$selected.'>'.$res[$i]->reservation_number.' --- '.$peopleInfo->email_address.' --- '.$peopleInfo->first_name.' '.$peopleInfo->last_name.'</option>';
                        } 
                      } 
                    ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group Date">
                    <label for="close_beginningDate" class="control-label">Beginning Date</label>
                    <input id="close_beginningDate" type="Text" class="form-control" disabled>
                </div>
                <div class="form-group Time">
                    <label for="close_beginningTime" class="control-label">Beginning Time</label>
                    <input id="close_beginningTime" type="Text" class="form-control" disabled required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group Date">
                    <label for="close_endDate" class="control-label">End Date</label>
                    <input id="close_endDate" type="Text" class="form-control" disabled>
                </div>
                <div class="form-group Time">
                    <label for="close_endTime" class="control-label">End Time</label>
                    <input id="close_endTime" type="Text" class="form-control" disabled>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <label for="ReservationForm_closureNotes" class="control-label" style="display: block">Closure Notes</label>
                    <textarea name="ReservationForm[closureNotes]" class="form-control" id="ReservationForm_closureNotes" rows="4"></textarea>
                </div>
            </div>
        </div>
        <div class="row col-xs-12">
            <button class="btn btn-primary" type="submit" name="yt0">Close Reservation</button>
        </div>
    </form>
  </div>
  
  <!--Checkout Reservation Javascript-->
  <script type="text/javascript">
    jQuery(function($)
    {
        var resList =
            <?php 
                $statInfo = ReservationStatus::model()->find(array("select"=>'*', 'condition'=>'status=:resStat','params'=>array(':resStat'=>"Ready")));
                $res = Reservation::model()->findAll(array("select"=>'*','condition'=>'reservation_status_id=:status','params'=>array(':status'=>$statInfo->reservation_status_id)));
                $resList = array();
                for ($i = 0; $i < sizeof($res); $i++)
                {
                    $resList[$res[$i]->reservation_number] = $res[$i]->getAttributes();
                }
                echo json_encode($resList, JSON_FORCE_OBJECT);
            ?>;
        $(document).ready(function() {
            $("#checkout_res_number").trigger("change");
        });
        $("#checkout_res_number").chosen({
            placeholder_text_single: " ",
            search_contains: true,
        });
        $("#checkout_res_number").change(function() {
            var res_number = $('#checkout_res_number :selected').val();
            if (res_number == "") {
                $("#checkout_reservation_form").get(0).reset();
            } else {
                timeParts = resList[res_number]["beginning_time"].split(' ');
                $("#checkout_beginningTime").val(timeParts[1].substring(0, 5));
                $("#checkout_beginningDate").val(resList[res_number]["beginning_date"]);
                timeParts = resList[res_number]["end_time"].split(' ');
                $("#checkout_endTime").val(timeParts[1].substring(0, 5));
                $("#checkout_endDate").val(resList[res_number]["end_date"]);
                if (resList[res_number]["assistance_needed"] == 1) {
                    $("#assistanceNeeded").prop("checked", true);
                } else {
                    $("#assistanceNeeded").prop("checked", false);
                }
                if (resList[res_number]["delivery_and_setup"] == 1) {
                    $("#deliveryAndSetup").prop("checked", true);
                } else {
                    $("#deliveryAndSetup").prop("checked", false);
                }
                if (resList[res_number]["takedown_needed"] == 1) {
                    $("#takedownNeeded").prop("checked", true);
                } else {
                    $("#takedownNeeded").prop("checked", false);
                }
            }
        });
    });
  </script>

  <!--Checkout Reservation Form-->
  <div id="checkout_reservation" <?php if($formname!='checkout_reservation') echo 'class="hide"'; ?>>
    <form id="checkout_reservation_form" class="form-signin" action="/index.php/rese/reservationcheckout" method="post">
        <div class="row col-xs-12">
            <h1>Checkout Reservation Form</h1>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                    <label for="ReservationForm_reservationNumber" class="control-label">Reservation Number</label>
                    <select name= "ReservationForm[reservationNumber]" type="text" class="form-control" id="checkout_res_number" required>
                        <option value=""></option>
                    <?php
                      if ($formname == 'checkout_reservation')
                      {
                        for ($i = 0; $i < sizeof($res); $i++)
                        {
                          $peopleInfo = People::model()->find(array("select"=>'*','condition'=>'people_id=:people','params'=>array(':people'=>$res[$i]->people_id)));
                          $selected = '';
                          if (isset($reservation_table))
                          {
                            if ($res[$i]->people_id == $reservation_table->people_id) $selected = 'selected';
                          }
                          echo '<option value="'.$res[$i]->reservation_number.'" '.$selected.'>'.$res[$i]->reservation_number.' --- '.$peopleInfo->email_address.' --- '.$peopleInfo->first_name.' '.$peopleInfo->last_name.'</option>';  
                        } 
                      } 
                    ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group Date">
                    <label for="checkout_beginningDate" class="control-label">Beginning Date</label>
                    <input id="checkout_beginningDate" type="Text" class="form-control" disabled>
                </div>
                <div class="form-group Time">
                    <label for="checkout_beginningTime" class="control-label">Beginning Time</label>
                    <input id="checkout_beginningTime" type="Text" class="form-control" disabled required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group Date">
                    <label for="checkout_endDate" class="control-label">End Date</label>
                    <input id="checkout_endDate" type="Text" class="form-control" disabled>
                </div>
                <div class="form-group Time">
                    <label for="checkout_endTime" class="control-label">End Time</label>
                    <input id="checkout_endTime" type="Text" class="form-control" disabled>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label for="assistanceNeeded" class="control-label">Assistance Needed</label>
                    <input type="checkbox" class="form-control" id="assistanceNeeded" value="1" disabled>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label for="deliveryAndSetup" class="control-label">Delivery and Setup</label>
                    <input type="checkbox" class="form-control" id="deliveryAndSetup" value="1" disabled>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label for="takedownNeeded" class="control-label">Takedown Needed</label>
                    <input type="checkbox" class="form-control" id="takedownNeeded" value="1" disabled>
                </div>
            </div>
        </div>
        <div class="row col-xs-12">
            <button class="btn btn-primary" type="submit" name="yt0">Checkout Reservation</button>
        </div>
    </form>
  </div> 

  <!-- Edit Reservation -->
  <div id="edit_reservation" <?php if($formname!='edit_reservation') echo 'class="hide"'; ?>>
    <form class="form-signin" action="/index.php/rese/reservationedit" method="post">
        <?php
            if($formname =='edit_reservation' && isset($wrong_items))
            {
              echo '<div class="row alert alert-danger margin-small"><p><strong>Sorry, some items you requested have already been reserved:</strong></p>';
              for($i = 0; $i < sizeof($wrong_items); $i++)
              {
                $equipment = Equipment::model()->findByPK($wrong_items[$i][0]['item_number']);
                $person = People::model()->findByPK($wrong_items[$i][0]['people_id']);
                echo '<p>Item '.$equipment->description.' '.$equipment->manufacturer.' '.$equipment->model.' for '.$person->first_name.' '.$person->last_name.' from '.$wrong_items[$i][0]['beginning_date'].' to '.$wrong_items[$i][0]['end_date'].'</p>';
              }
              echo '</div>';
            }
        ?>
        <div class="row col-xs-12">
            <h1>Edit Reservation Form</h1>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8">
                <div class="form-group">
                    <label for="ReservationForm_primaryEmail" class="control-label">Primary Contact</label>
                    <select name= "ReservationForm[primaryEmail]" type="email" class="form-control" id="ReservationForm_primaryEmail" required>
                    <?php
                      if ($formname == 'edit_reservation')
                      {
                        $res = People::model()->findAll();
                        for ($i = 0; $i < sizeof($res); $i++)
                        {
                          if($res[$i]->people_id == $reservation_table->people_id)
                          {
                            echo '<option value="'.$res[$i]->email_address.'" selected>'.$res[$i]->email_address.' --- '.$res[$i]->first_name.' '.$res[$i]->last_name.'</option>'; 
                          }
                          else
                          {
                            echo '<option value="'.$res[$i]->email_address.'">'.$res[$i]->email_address.' --- '.$res[$i]->first_name.' '.$res[$i]->last_name.'</option>'; 
                          }
                        }
                      }
                    ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8">
                <div class="form-group">
                    <label for="ReservationForm_secondaryEmail" class="control-label">Secondary Contact</label>
                    <select name="ReservationForm[secondaryEmail]" type="email" class="form-control" id="ReservationForm_secondaryEmail">
                        <option value=""></option>
                    <?php
                      if ($formname == 'edit_reservation')
                      {
                        $res = People::model()->findAll();
                        for ($i = 0; $i < sizeof($res); $i++)
                        {
                          if($res[$i]->people_id == $reservation_table->secondary_contact_id)
                          {
                            echo '<option value="'.$res[$i]->email_address.'" selected>'.$res[$i]->email_address.' --- '.$res[$i]->first_name.' '.$res[$i]->last_name.'</option>'; 
                          }
                          else
                          {
                            echo '<option value="'.$res[$i]->email_address.'">'.$res[$i]->email_address.' --- '.$res[$i]->first_name.' '.$res[$i]->last_name.'</option>'; 
                          }
                        }
                      }
                    ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8">
                <div class="form-group">
                    <label for='ReservationForm_equipmentEdit' class='control-label'>Equipment</label>
                    <select multiple name='ReservationForm[equipment][]' id='ReservationForm_equipmentEdit' class='form-control' required>
                    <?php
						if ($formname == 'edit_reservation')
						{
							$type = EquipmentType::model()->findAll();
                            $reportForm = new ReportForm;
							$item = $reportForm->getAvailableEquipment();
							for ($t = 0; $t < sizeof($type); $t++)
							{
								echo '<optgroup label="'.$type[$t]->type.'" id="itemGroup_'.$type[$t]->item_type_id.'">';
								for ($i = 0; $i < sizeof($item); $i++)
								{
									if ($type[$t]->item_type_id == $item[$i]['item_type_id'])
									{
										$selected = '';
										for ($j = 0; $j < sizeof($reservation_items_table); $j++)
										{
											if ($item[$i]['item_number'] == $reservation_items_table[$j]['item_number'])
											{
												$selected = 'selected';
											}
										}
										echo '<option value="'.$item[$i]['item_number'].'" '.$selected.'>'.$item[$i]['description'].' '.$item[$i]['manufacturer'].' '.$item[$i]['model'].'</option>';
									}
								}
								echo '</optgroup>';
							}
						}
					?>
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group">
					<label for="filter_equipment" class="control-label">Filter Equipment By</label>
					<select id="filter_equipment" class="form-control">
						<option value="All">All</option>
						<?php
							if ($formname == 'edit_reservation')
							{
								$res = EquipmentType::model()->findAll();
								for ($i = 0; $i < sizeof($res); $i++)
								{
									echo '<option value="'.$res[$i]->item_type_id.'">'.$res[$i]->type.'</option>'; 
								}
							}
						?>
					</select>
				</div>
			</div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group Date">
                    <label for="ReservationForm_beginningDate" class="control-label">Beginning Date</label>
                    <div class="input-group">
                        <span class="input-group-btn add-on">
                        <button class="btn btn-default" type="button">
                            &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                        </button>
                        </span>
                        <input name ="ReservationForm[beginningDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReservationForm_beginningDate" value="<?php if ($formname == 'edit_reservation') { echo $reservation_table->beginning_date;} ?>" required>
                    </div>
                </div>
                <div class="form-group Time">
                    <label for="ReservationForm_beginningTime" class="control-label">Beginning Time</label>
                    <div class="input-group">
                        <span class="input-group-btn add-on">
                        <button class="btn btn-default" type="button">
                            &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                        </button>
                        </span>
                        <input name ="ReservationForm[beginningTime]" data-format="hh:mm" type="Text" class="form-control" id="ReservationForm_beginningTime" value="<?php 
                      if ($formname == 'edit_reservation') { 
                        $time_parts = explode(" ", $reservation_table->beginning_time);
                        echo substr($time_parts[1], 0, 5);
                        } 
                     ?>"  required>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group Date">
                    <label for="ReservationForm_endDate" class="control-label">End Date</label>
                    <div class="input-group">
                        <span class="input-group-btn add-on">
                        <button class="btn btn-default" type="button">
                            &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                        </button>
                        </span>
                        <input name ="ReservationForm[endDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="ReservationForm_endDate" value="<?php if ($formname == 'edit_reservation') { echo $reservation_table->end_date;} ?>" required>
                    </div>
                </div>
                <div class="form-group Time">
                    <label for="ReservationForm_endTime" class="control-label">End Time</label>
                    <div class="input-group">
                        <span class="input-group-btn add-on">
                        <button class="btn btn-default" type="button">
                            &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                        </button>
                        </span>
                        <input name ="ReservationForm[endTime]" data-format="hh:mm" type="Text" class="form-control" id="ReservationForm_endTime" value="<?php 
                      if ($formname == 'edit_reservation') { 
                        $time_parts = explode(" ", $reservation_table->end_time);
                        echo substr($time_parts[1], 0, 5);
                        } 
                     ?>"  required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="ReservationForm_buildingName" class="control-label">Location Name</label>
                    <select name ="ReservationForm[buildingName]" type="text" class="form-control" id="ReservationForm_buildingName" required>
                        <?php
                          if ($formname=='edit_reservation')
                          {
                            $res = Location::model()->findAll();
                            for ($i = 0; $i < sizeof($res); $i++)
                            {
                              if ($res[$i]->building_id == $reservation_table->building_id)
                              {
                               echo '<option value="'.$res[$i]->building_name.'" selected>'.$res[$i]->building_name .'</option>';
                              }
                              else
                              {
                                echo '<option value="'.$res[$i]->building_name.'">'.$res[$i]->building_name .'</option>';
                              }
                            } 
                          }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="ReservationForm_locationDescription" class="control-label">Location Description</label>
                    <input name ="ReservationForm[locationDescription]" type="text" class="form-control" id="ReservationForm_locationDescription" value="<?php if ($formname == 'edit_reservation') { echo $reservation_table->location_description;} ?>">
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label for="ReservationForm_assistanceNeeded" class="control-label">Assistance Needed</label>
                    <input type="checkbox" class="form-control" name="ReservationForm[assistanceNeeded]" id="ReservationForm_assistanceNeeded" value="1" <?php if ($formname == 'edit_reservation') { if ($reservation_table->assistance_needed) {echo "checked";}} ?>>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label for="ReservationForm_deliveryAndSetup" class="control-label">Delivery and Setup</label>
                    <input type="checkbox" class="form-control" name="ReservationForm[deliveryAndSetup]" id="ReservationForm_deliveryAndSetup" value="1" <?php if ($formname == 'edit_reservation') { if ($reservation_table->delivery_and_setup) {echo "checked";}} ?>>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label for="ReservationForm_takedownNeeded" class="control-label">Takedown Needed</label>
                    <input type="checkbox" class="form-control" name="ReservationForm[takedownNeeded]" id="ReservationForm_takedownNeeded" value="1" <?php if ($formname == 'edit_reservation') { if ($reservation_table->takedown_needed) {echo "checked";}} ?>>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="form-group">
                    <label for="ReservationForm_reservationNotes" class="control-label" style="display: block">Reservation Notes</label>
                    <textarea name="ReservationForm[reservationNotes]" class="form-control" id="ReservationForm_reservationNotes" rows="4"><?php 
                        if ($formname == 'edit_reservation')
                        {
                            echo $reservation_table->reservation_notes;
                        }
                    ?></textarea>
                </div>
            </div>
        </div>
        <div style="display: none">
            <input name ="ReservationForm[reservationNumber]" type="text" class="form-control" id="ReservationForm_reservationNumber" value="<?php if ($formname == 'edit_reservation') { echo $reservation_table->reservation_number;} ?>">
            <select multiple name="ReservationForm[oldEquipment][]">
              <?php
                if($formname == 'edit_reservation')
                {
                    for($i = 0; $i < sizeof($reservation_items_table); $i++)
                    {
                        echo '<option value="'.$reservation_items_table[$i]['item_number'].'" selected></option>';
                    }
                }
              ?>
            </select>
        </div>
        <div class="row col-xs-12">
            <button class="btn btn-primary" type="submit" name="yt0">Edit Reservation</button>
        </div>
    </form>
  </div> 
  
</div> <!-- /#content_frame -->

<!-- javascript -->
<script type="text/javascript" src="<?php Yii::app()->request->baseUrl; ?>/js/site/reservationform.js"></script>
