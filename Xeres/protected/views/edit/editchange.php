
<!-- Sidebar -->
<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
  <div class="panel panel-default">
    <div class="panel-body">
      <ul class="nav nav-pills nav-stacked">
      <li class="<?php if($formname=='edit_person') echo 'active'; ?>"><a href="/index.php/edit/editperson">Person</a></li>
      <li class="<?php if($formname=='edit_equipment') echo 'active'; ?>"><a href="/index.php/edit/editequipment">Equipment</a></li>					
      <li class="<?php if($formname=='edit_equipment_type') echo 'active'; ?>"><a href="/index.php/edit/editequipmenttype">Equipment Type</a></li>
      <li class="<?php if($formname=='edit_equipment_status') echo 'active'; ?>"><a href="/index.php/edit/editequipmentstatus">Equipment Status</a></li>
      <li class="<?php if($formname=='edit_location') echo 'active'; ?>"><a href="/index.php/edit/editlocation">Location</a></li>
      <li class="<?php if($formname=='edit_reservation_status') echo 'active'; ?>"><a href="/index.php/edit/editreservationstatus">Reservation Status</a></li>
      <li class="<?php if($formname=='edit_people_role') echo 'active'; ?>"><a href="/index.php/edit/editpeoplerole">People Role</a></li>
	  </ul>
	</div>
  </div>
</div> <!-- /.sidebar -->

<div id="content_frame" class="col-xs-12 col-sm-6">

  <div id="edit_equipment" <?php if($formname!='edit_equipment') echo 'class="hide"'; ?>>
    <!--Edit Equipment Form-->
    <form class="form-edit" action="/index.php/edit/editequipment" method="post">
        <div class="row col-xs-12">
          <h1>Edit Equipment Form</h1>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="form-group">
              <div style="display:none;"><input name="EditForm[itemNumber]" type="text" class="form-control" id="EditForm_itemNumber" value="<?php if($formname=='edit_equipment') echo $equipment_info->item_number; ?>" required></div>
              <label for="EditForm_equipmentTypeName" class="control-label">Type</label>
              <select name="EditForm[equipmentTypeName]" id="EditForm_equipmentTypeName" class="form-control chosen" required>
                <?php
                  if ($formname == 'edit_equipment')
                  {
                    $res = EquipmentType::model()->findAll();
                    for ($i = 0; $i < sizeof($res); $i++)
                    {
                      if ($res[$i]->item_type_id == $equipment_info->item_type_id)
                      {
                        echo '<option value="'.$res[$i]->type.'" selected>'.$res[$i]->type.'</option>'; 
                      }
                      else
                      {
                        echo '<option value="'.$res[$i]->type.'">'.$res[$i]->type.'</option>';  
                      }
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="EditForm_serialNumber" class="control-label">Serial Number</label>
              <input name ="EditForm[serialNumber]" type="text" class="form-control" id="EditForm_serialNumber" value="<?php if($formname=='edit_equipment') echo $equipment_info->serial_number; ?>" required>
            </div>
            <div class="form-group">
              <label for="EditForm_barcodeNumber" class="control-label" >Barcode Number</label>
              <input name ="EditForm[barcodeNumber]" type="text" class="form-control" id="EditForm_barcodeNumber" value="<?php if($formname=='edit_equipment') echo $equipment_info->barcode_number; ?>" required>
            </div>
            <div class="form-group">
              <label for="EditForm_suNumber" class="control-label" >SU Number</label>
              <input name ="EditForm[suNumber]" type="text" class="form-control" id="EditForm_suNumber" value="<?php if($formname=='edit_equipment') echo $equipment_info->su_number; ?>" required>
            </div>
            <div class="form-group">
              <label for="EditForm_description" class="control-label">Description</label>
              <input name="EditForm[description]" type="text" class="form-control" id="EditForm_description" value="<?php if($formname=='edit_equipment') echo $equipment_info->description; ?>">
            </div>
          </div>
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label for="EditForm_manufacturer" class="control-label">Manufacturer</label>
                <input name="EditForm[manufacturer]" type="text" class="form-control" id="EditForm_manufacturer" value="<?php if($formname=='edit_equipment') echo $equipment_info->manufacturer; ?>" required>
              </div>
              <div class="form-group">
                <label for="EditForm_model" class="control-label">Model</label>
                <input name="EditForm[model]" type="text" class="form-control" id="EditForm_model" value="<?php if($formname=='edit_equipment') echo $equipment_info->model; ?>" required>
              </div>
              <div class="form-group Date">
                <label for="EditForm_accessionDate" class="control-label">Accession Date <small>(Date Of Purchase)</small></label>
                  <div class="input-group">
                    <span class="input-group-btn add-on">
                    <button class="btn btn-default" type="button">
                        &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                    </button>
                    </span>
                      <input name ="EditForm[accessionDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="EditForm_accessionDate" value="<?php if($formname=='edit_equipment') echo $equipment_info->accession_date; ?>" required>
                  </div>
              </div>
              <div class="form-group Date">
                <label for="EditForm_deAccessionDate" class="control-label">Deaccession Date <small>(Date Of Decomission)</small></label>
                  <div class="input-group">
                      <span class="input-group-btn add-on">
                      <button class="btn btn-default" type="button">
                          &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                      </button>
                      </span>
                      <input name ="EditForm[deAccessionDate]" data-format="yyyy-MM-dd" type="Text" class="form-control" id="EditForm_deAccessionDate" value="<?php if($formname=='edit_equipment') echo $equipment_info->de_accession_date; ?>">
                  </div>
              </div>
              <div class="form-group">
                <label for="EditForm_statusName" class="control-label">Status <small>(Item Condition)</small></label>
                <select name="EditForm[statusName]" class="form-control chosen" value="<?php if($formname=='edit_equipment') echo $equipment_info->status_id; ?>" required>
                  <?php
                    if ($formname == 'edit_equipment')
                    {
                      $res = EquipmentStatus::model()->findAll();
                      for ($i = 0; $i < sizeof($res); $i++)
                      {
                        if ($res[$i]->status_id == $equipment_info->status_id)
                        {
                          echo '<option value="'.$res[$i]->status.'" selected>'.$res[$i]->status.'</option>'; 
                        }
                        else
                        {
                          echo '<option value="'.$res[$i]->status.'">'.$res[$i]->status.'</option>'; 
                        }
                      }
                    }
                  ?>
                </select>
              </div>
            </div>
        </div>
        <div class="row col-xs-12">
          <button name="yt0" type="submit" class="btn btn-primary">Edit Equipment</button>
        </div>
    </form>
  </div>

  <div id="edit_person" <?php if($formname!='edit_person') echo 'class="hide"'; ?>>
    <!-- Edit Person Form -->
    <form class="form-edit" action="/index.php/edit/editperson" method="post">
        <div class="row col-xs-12">
          <h1>Edit Person Form</h1>
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="form-group">
              <div style="display:none;"><input name="EditForm[personId]" type="text" class="form-control" id="EditForm_personId" value="<?php if($formname=='edit_person') echo $person_info->people_id; ?>"></div>
              <label for="EditForm_roleName" class="control-label">Type</label>
              <select name="EditForm[roleName]" id="EditForm_personRole" class="form-control chosen" <?php if ($formname == 'edit_person') { if ($person_info->role == 'Super') echo 'disabled'; } ?> required>
              <?php
                if ($formname == 'edit_person')
                {
                  $res = PersonRole::model()->findAll();
                  for ($i = 0; $i < sizeof($res); $i++)
                  {
                    if ($res[$i]->role != 'Super' || $person_info->role == 'Super')
                    {
                      if ($res[$i]->role_id == $person_info->role_id)
                      {
                        echo '<option value="'.$res[$i]->role.'" selected>'.$res[$i]->role.'</option>'; 
                      }
                      else
                      {
                        echo '<option value="'.$res[$i]->role.'">'.$res[$i]->role.'</option>'; 
                      }
                    }
                  }
                }
              ?>
              </select>
            </div>
            <div class="form-group control-group">
              <label for="EditForm_emailAddress" class="control-label">Email Address</label>
              <div class ="controls">
                <input name="EditForm[emailAddress]" type="email" class="form-control" id="EditForm_emailAddress" value="<?php if($formname=='edit_person') echo $person_info->email_address; ?>" required>
                <p class="help-block"></p>
              </div>
            </div>
            <div class="form-group">
              <label for="EditForm_firstName" class="control-label">First Name</label>
              <input name="EditForm[firstName]" type="text" class="form-control" id="EditForm_firstName" value="<?php if($formname=='edit_person') echo $person_info->first_name; ?>" required>
            </div>
            <div class="form-group">
              <label for="EditForm_lastName" class="control-label" >Last Name</label>
              <input name="EditForm[lastName]" type="text" class="form-control" id="EditForm_lastName" value="<?php if($formname=='edit_person') echo $person_info->last_name; ?>" required>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6">
            <div class="form-group control-group">
              <label for="EditForm_studentId" class="control-label">Student ID</label>
              <div class="controls">
                  <div class="input-group">
                    <span class="input-group-addon">800</span>
                    <input name="EditForm[studentId]" type="text" maxlength="6" class="form-control" id="EditForm_studentId" value="<?php if($formname=='edit_person') echo substr($person_info->student_id,3); ?>"
                    data-validation-regex-regex="[0-9]{6}$"
                    data-validation-regex-message="Must be numbers 0-9 and a length of 6">
                  </div>
                  <p class="help-block"></p>
              </div>
            </div>
            <div class="form-group">
              <label for="EditForm_campusPhone" class="control-label">Campus Phone</label>
              <input name="EditForm[campusPhone]" type="text" class="form-control phone" id="EditForm_campusPhone" value="<?php if($formname=='edit_person') echo $person_info->campus_phone; ?>">
            </div>
            <div class="form-group">
              <label for="EditForm_cellPhone" class="control-label">Cell Phone</label>
              <input name="EditForm[cellPhone]" type="text" class="form-control phone" id="EditForm_cellPhone" value="<?php if($formname=='edit_person') echo $person_info->cell_phone; ?>" required>
            </div>
            <div class="form-group">
              <label for="EditForm_resetPassword" class="control-label">Reset Password</label>
              <input name="EditForm[resetPassword]" type="checkbox" class="form-control" id="EditForm_resetPassword" value="1">
            </div>
          </div>
        </div>
        <div class="row col-xs-12">
          <button class="btn btn-primary" type="submit" name="yt0">Edit Person</button>
        </div>
    </form>
  </div>

  <div id="edit_location" <?php if($formname!='edit_location') echo 'class="hide"'; ?>>
    <!--Add Location Form-->
              <form class="form-edit" action="/index.php/edit/editlocation" method="post">
                <div id="edit_location_model">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h2 class="modal-title">Edit Location</h2>
                            </div>
                            <div class="modal-body">
                                 <div style="display:none;"><input name="EditForm[buildingId]" type="text" class="form-control" id="EditForm_buildingId" value="<?php if($formname=='edit_location') echo $location_info->building_id; ?>" required></div>
                                 <input name="EditForm[buildingName]" type="text" class="form-control" id="EditForm_buildingName" value="<?php if($formname=='edit_location') echo $location_info->building_name; ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </form>
  </div>

  <div id="edit_equipment_type" <?php if($formname!='edit_equipment_type') echo 'class="hide"'; ?>>
    <!--Add Item Type Form-->
              <form class="form-edit" action="/index.php/edit/editequipmenttype" method="post">
                <div id="edit_equipment_type_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h2 class="modal-title">Edit Equipment Type</h2>
                            </div>
                            <div class="modal-body">
                                 <div style="display:none;"><input name="EditForm[equipmentTypeId]" type="text" class="form-control" id="EditForm_equipmentTypeId" value="<?php if($formname=='edit_equipment_type') echo $equipment_type_info->item_type_id; ?>"></div>
                                 <input name="EditForm[equipmentType]" type="text" class="form-control" id="EditForm_equipmentType" value="<?php if($formname=='edit_equipment_type') echo $equipment_type_info->type; ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </form>
  </div>

  <div id="edit_equipment_status" <?php if($formname!='edit_equipment_status') echo 'class="hide"'; ?>>
    <!--Add Item Status Form-->
              <form class="form-edit" action="/index.php/edit/editequipmentstatus" method="post">
                <div id="edit_equipment_status_modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h2 class="modal-title">Edit Equipment Status</h2>
                            </div>
                            <div class="modal-body">
                                 <div style="display:none;"><input name="EditForm[equipmentStatusId]" type="text" class="form-control" id="EditForm_equipmentStatusId" value="<?php if($formname=='edit_equipment_status') echo $equipment_status_info->status_id; ?>"></div>
                                 <input name="EditForm[equipmentStatus]" type="text" class="form-control" id="EditForm_equipmentStatus" value="<?php if($formname=='edit_equipment_status') echo $equipment_status_info->status; ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </form>
  </div>

  <div id="edit_reservation_status" <?php if($formname!='edit_reservation_status') echo 'class="hide"'; ?>>
    <!--Add Reservation Status Form-->
              <form class="form-edit" action="/index.php/edit/editreservationstatus" method="post">
                <div id="edit_reservation_status_model">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h2 class="modal-title">Edit Reservation Status</h2>
                            </div>
                            <div class="modal-body">
                                 <div style="display:none;"><input name="EditForm[reservationStatusId]" type="text" class="form-control" id="EditForm_reservationStatusId" value="<?php if($formname=='edit_reservation_status') echo $reservation_status_info->reservation_status_id; ?>"></div>
                                 <input name="EditForm[reservationStatus]" type="text" class="form-control" id="EditForm_reservationStatus" value="<?php if($formname=='edit_reservation_status') echo $reservation_status_info->status; ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                </div>
                    <!-- /.modal-dialog -->
             </div>
                <!-- /.modal -->
            </form>
  </div>

  <div id="edit_people_role" <?php if($formname!='edit_people_role') echo 'class="hide"'; ?>>
    <!--Add People Role Form-->
              <form class="form-edit" action="/index.php/edit/editpeoplerole" method="post">
                 <div id="edit_people_role_model">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h2 class="modal-title">Edit People Role</h2>
                            </div>
                            <div class="modal-body">
                                 <div style="display:none;"><input name="EditForm[peopleRoleId]" type="text" class="form-control" id="EditForm_peopleRoleId" value="<?php if($formname=='edit_people_role') echo $people_role_info->role_id; ?>"></div>
                                 <input name="EditForm[personRole]" type="text" class="form-control" id="EditForm_personRole" value="<?php if($formname=='edit_people_role') echo $people_role_info->role; ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                </div>
                    <!-- /.modal-dialog -->
             </div>
                <!-- /.modal -->
            </form>
  </div>

</div> <!-- /#content_frame -->

<!-- javascript -->
<script type="text/javascript" src="<?php Yii::app()->request->baseUrl; ?>/js/site/editchange.js"></script>
