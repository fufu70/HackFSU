
<!-- Sidebar -->
<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation" <?php if($formname == 'add_person_agent') echo 'style="display:none"'; ?>>
  <div class="panel panel-default">
    <div class="panel-body">
	  <ul class="nav nav-pills nav-stacked">
      <li class="switch-link"><a href="#add_person">Person</a></li>
      <li class="switch-link"><a href="#add_equipment">Equipment</a></li>
      <li class="switch-link"><a href="#add_equipment_type">Equipment Type</a></li>
      <li class="switch-link"><a href="#add_equipment_status">Equipment Status</a></li>
      <li class="switch-link"><a href="#add_location">Location</a></li>
      <li class="switch-link"><a href="#add_reservation_status">Reservation Status</a></li>
      <li class="switch-link"><a href="#add_people_role">People Role</a></li>
	  </ul>
	</div>
  </div>
</div> <!-- /.sidebar -->

<div id="content_frame" class="col-xs-12 col-sm-6">

    <!-- Successful Submission Alert -->
    <div id="success_alert" class="alert alert-success <?php if (!isset($success_alert)) echo 'hide'; ?>">
        <strong>Success!</strong> <?php if (isset($success_alert)) echo $success_alert; ?>
    </div>

    <div id="add_equipment" class="switch-group hide">
        <!-- Add Equipment Form -->
        <form class="form-add" action="/index.php/add/addequipment" method="post">
            <div class="row col-xs-12">
                <h1>Add Equipment Form</h1>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <label for="AddForm_equipmentTypeName" class="control-label">Type</label>
                    <select name="AddForm[equipmentTypeName]" id="AddForm_equipmentTypeName" class="form-control chosen" required>
                        <option value=""></option>
                      <?php
                          $res = EquipmentType::model()->findAll();
                          for ($i = 0; $i < sizeof($res); $i++)
                          {
                            echo '<option value="'.$res[$i]->type.'">'.$res[$i]->type.'</option>'; 
                          }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="AddForm_serialNumber" class="control-label">Serial Number</label>
                    <input name ="AddForm[serialNumber]" type="text" class="form-control" id="AddForm_serialNumber" required>
                  </div>
                  <div class="form-group">
                    <label for="AddForm_barcodeNumber" class="control-label" >Barcode Number</label>
                    <input name ="AddForm[barcodeNumber]" type="text" class="form-control" id="AddForm_barcodeNumber" required>
                  </div>
                  <div class="form-group">
                    <label for="AddForm_suNumber" class="control-label" >SU Number</label>
                    <input name ="AddForm[suNumber]" type="text" class="form-control" id="AddForm_suNumber" required>
                  </div>
                  <div class="form-group">
                    <label for="AddForm_description" class="control-label">Description</label>
                    <input name="AddForm[description]" type="text" class="form-control" id="AddForm_description">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <label for="AddForm_manufacturer" class="control-label">Manufacturer</label>
                    <input name="AddForm[manufacturer]" type="text" class="form-control" id="AddForm_manufacturer" placeholder="e.g. Cisco" required>
                  </div>
                  <div class="form-group">
                    <label for="AddForm_model" class="control-label">Model</label>
                    <input name="AddForm[model]" type="text" class="form-control" id="AddForm_model" required>
                  </div>
                  <div class="form-group Date">
                    <label for="AddForm_accessionDate" class="control-label">Accession Date <small>(Date Of Purchase)</small></label>
                    <div class="input-group">
                  <span class="input-group-btn add-on">
                  <button class="btn btn-default" type="button">
                      &nbsp;<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                  </button>
                  </span>
                        <input name="AddForm[accessionDate]" data-format="yyyy-MM-dd" type="text" class="form-control" id="AddForm_accessionDate" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="AddForm_statusName" class="control-label">Status <small>(Item Condition)</small></label>
                    <select name="AddForm[statusName]" class="form-control chosen" id="AddForm_statusName" required>
                        <option value=""></option>
                      <?php
                          $res = EquipmentStatus::model()->findAll();
                          for ($i = 0; $i < sizeof($res); $i++)
                          {
                            echo '<option value="'.$res[$i]->status.'">'.$res[$i]->status.'</option>'; 
                          }
                      ?>
                    </select>
                  </div>
                </div>
            </div>
            <div class="row col-xs-12">
                <button name="yt0" type="submit" class="btn btn-primary">Add Equipment</button>
            </div>
        </form>
    </div>
  
    <div id="add_person" class="switch-group hide">
        <!-- Add Person Form -->
        <form class="form-add" action="/index.php/add/addperson" method="post">
                <div class="row col-xs-12">
                    <h1>Add Person Form</h1>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                          <label for="AddForm_roleName" class="control-label">Type</label>
                          <select name="AddForm[roleName]" id="AddForm_roleName" class="form-control chosen" required>
                            <option value="User">User</option>
                            <?php
                              $res = PersonRole::model()->findAll();
                              if ($formname != 'add_person_agent')
                              {
                                for ($i = 0; $i < sizeof($res); $i++)
                                {
                                  if ($res[$i]->role != 'User' && $res[$i]->role != 'Super')
                                  {
                                      echo '<option value="'.$res[$i]->role.'">'.$res[$i]->role.'</option>';
                                  }
                                }
                              }
                            ?>
                            </select>
                        </div>
                        <div class="form-group control-group">
                          <label for="AddForm_newEmailAddress" class="control-label">Email Address</label>
                          <div class ="controls">
                            <input name="AddForm[newEmailAddress]" type="email" class="form-control" id="AddForm_newEmailAddress" required>
                            <p class="help-block"></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="AddForm_firstName" class="control-label">First Name</label>
                          <input name="AddForm[firstName]" type="text" class="form-control" id="AddForm_firstName" required >
                        </div>
                        <div class="form-group">
                          <label for="AddForm_lastName" class="control-label" >Last Name</label>
                          <input name="AddForm[lastName]" type="text" class="form-control" id="AddForm_lastName" required>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group control-group">
                          <label for="AddForm_studentId" class="control-label" >Student ID</label>
                          <div class="controls">
                            <div class="input-group">
                              <span class="input-group-addon">800</span>
                              <input name="AddForm[studentId]" type="text" maxlength="6" class="form-control" id="AddForm_studentId"
                              data-validation-regex-regex="[0-9]{6}$"
                              data-validation-regex-message="Must be numbers 0-9 and a length of 6">
                            </div>
                            <p class="help-block"></p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="AddForm_campusPhone" class="control-label">Campus Phone</label>
                          <input name="AddForm[campusPhone]" type="text" class="form-control phone" id="AddForm_campusPhone">
                        </div>
                        <div class="form-group">
                          <label for="AddForm_cellPhone" class="control-label">Cell Phone</label>
                          <input name="AddForm[cellPhone]" type="text" class="form-control phone" id="AddForm_cellPhone" required>
                        </div>
                    </div>
                </div>
                <div class="row col-xs-12">
                  <button class="btn btn-primary" type="submit" name="yt0">Add Person</button>
                </div>
        </form>
    </div>

    <div id="add_location" class="switch-group hide">
        <!--Add Location Form-->
        <form class="form-add" action="/index.php/add/addlocation" method="post">
            <div class="row col-xs-12">
                <h1>Add Location</h1>
            </div>
            <div class="col-xs-12 col-sm-6 input-group">
                <input name="AddForm[newBuildingName]" type="text" class="form-control" id="AddForm_newBuildingName" required>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
                </span>
            </div>
        </form>
    </div>
  
    <div id="add_equipment_type" class="switch-group hide">
        <!-- Add Equipment Type Form -->
        <form class="form-add" action="/index.php/add/addequipmenttype" method="post">
            <div class="row col-xs-12">
                <h1>Add Equipment Type</h1>
            </div>
            <div class="col-xs-12 col-sm-6 input-group">
                <input name="AddForm[newEquipmentType]" type="text" class="form-control" id="AddForm_newEquipmentType" required>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
                </span>
            </div>
        </form>
    </div>

    <div id="add_equipment_status" class="switch-group hide">
        <!-- Add Equipment Status Form -->
        <form class="form-add" action="/index.php/add/addequipmentstatus" method="post">
            <div class="row col-xs-12">
                <h1>Add Equipment Status</h1>
            </div>
            <div class="col-xs-12 col-sm-6 input-group">
                <input name="AddForm[newEquipmentStatus]" type="text" class="form-control" id="AddForm_newEquipmentStatus" required>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
                </span>
            </div>
        </form>
    </div>
    
    <div id="add_reservation_status" class="switch-group hide">
        <!-- Add Reservation Status Form -->
        <form class="form-add" action="/index.php/add/addreservationstatus" method="post">
            <div class="row col-xs-12">
                <h1>Add Reservation Status</h1>
            </div>
            <div class="col-xs-12 col-sm-6 input-group">
                <input name="AddForm[newResStatus]" type="text" class="form-control" id="AddForm_newResStatus" required>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
                </span>
            </div>
        </form>
    </div>
    
    <div id="add_people_role" class="switch-group hide">
        <!-- Add People Role Form -->
        <form class="form-add" action="/index.php/add/addpeoplerole" method="post">
            <div class="row col-xs-12">
                <h1>Add Person Role</h1>
            </div>
            <div class="col-xs-12 col-sm-6 input-group">
                <input name="AddForm[newPersonRole]" type="text" class="form-control" id="AddForm_newPersonRole" required>
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name="yt0">Submit</button>
                </span>
            </div>
        </form>
    </div>

</div> <!-- /#content_frame -->

<!-- javascript -->
<input type="hidden" id="formname" value="<?php if($formname == 'add_person_agent') { echo 'add_person'; } else { echo $formname; } ?>" />
<script type="text/javascript" src="<?php Yii::app()->request->baseUrl; ?>/js/site/add.js"></script>
