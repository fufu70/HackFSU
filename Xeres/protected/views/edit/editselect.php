
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

<div id="content_frame" class="col-xs-12 col-sm-9">

  <div id="edit_equipment" <?php if($formname!='edit_equipment') echo 'class="hide"'; ?>>
    <!-- Edit Equipment -->
                <?php 
                    if ($formname=='edit_equipment')
                    {
                        echo '<div class="panel panel-default scroll-hor">';
                        echo '<table class="table table-hover" data-page-navigation=".pagination" data-page-size="8">';
                        echo '<thead>
                              <tr>
                                <th data-sort-ignore="true"></th>
                                <th data-type="numeric" class="col-fit">ID</th>
                                <th class="col-fit">Item<br>Type</th>
                                <th class="col-fit">Manufacturer</th>
                                <th class="col-fit">Model</th>
                                <th class="col-fit">Status</th>
                                <th>Accession<br>Date</th>
                                <th>Deaccession<br>Date</th>
                                <th data-sort-ignore="true">Serial Number</th>
                                <th data-sort-ignore="true">Barcode Number</th>
                                <th data-sort-ignore="true">SU Number</th>
                                <th data-sort-ignore="true">Description</th>
                              </tr>
                            </thead>
                            <tbody>';
                        for($i = 0; $i < sizeof($equipment_table); $i++)
                        {
                            echo '<tr><td><form class="form-edit" action="/index.php/edit/editequipment" method="post"><div style="display:none"><input name="EditForm[itemNumber]" type="text" class="form-control" id="EditForm_itemNumber" value="'.$equipment_table[$i]['item_number'].'"></div><button class="btn btn-default" type="submit" name="yt0">Edit</button></form></td><td>'.
                                                        $equipment_table[$i]['item_number'].'</td><td>'.
                                                        $equipment_table[$i]['type'].'</td><td>'.
                                                        $equipment_table[$i]['manufacturer'].'</td><td>'.
                                                        $equipment_table[$i]['model'].'</td><td>'.
                                                        $equipment_table[$i]['status'].'</td><td class="col-fit">'.
                                                        $equipment_table[$i]['accession_date'].'</td><td class="col-fit">'.
                                                        $equipment_table[$i]['de_accession_date'].'</td><td>'.
                                                        $equipment_table[$i]['serial_number'].'</td><td>'.
                                                        $equipment_table[$i]['barcode_number'].'</td><td>'.
                                                        $equipment_table[$i]['su_number'].'</td><td>'.
                                                        $equipment_table[$i]['description'].'</td></tr>';
                        }

						echo '</tbody>
							   <tfoot class="hide-if-no-paging">
								 <tr>
								   <td colspan="12">
									 <div class="paging text-center">
									   <ul class="pagination"></ul>
									 </div>
								   </td>
								 </tr>
							   </tfoot></table></div>';
                    }
                ?>
  </div>

  <div id="edit_person" <?php if($formname!='edit_person') echo 'class="hide"'; ?>>
    <!-- Edit Person -->
                <?php 
                    if ($formname=='edit_person')
                    {
                        echo '<div class="panel panel-default scroll-hor">';
                        echo '<table class="table table-hover" data-page-navigation=".pagination" data-page-size="8">';
                        echo '<thead>
                              <tr>
                                <th data-sort-ignore="true"></th>
                                <th data-type="numeric" class="col-fit">ID</th>
                                <th class="col-fit">Email Address</th>
                                <th>Last<br>Name</th>
                                <th>First<br>Name</th>
                                <th data-sort-ignore="true">Student ID</th>
                                <th data-sort-ignore="true">Campus Phone</th>
                                <th data-sort-ignore="true">Cell Phone</th>
                                <th class="col-fit">Role</th>
                              </tr>
                            </thead>
                            <tbody>';
                        for($i = 0; $i < sizeof($person_table); $i++)
                        {
                            if ($user_role == 'admin' && $person_table[$i]['role'] != 'Super' && $person_table[$i]['role'] != 'Admin')
                            {
                                echo '<tr><td><form class="form-edit" action="/index.php/edit/editperson" method="post"><div style="display:none"><input name="EditForm[personId]" type="text" class="form-control" id="EditForm_personid" value="'.$person_table[$i]['people_id'].'"></div><button class="btn btn-default" type="submit" name="yt0">Edit</button></form></td><td>'.
                                                        $person_table[$i]['people_id'].'</td><td>'.
                                                        $person_table[$i]['email_address'].'</td><td>'.
                                                        $person_table[$i]['last_name'].'</td><td>'.
                                                        $person_table[$i]['first_name'].'</td><td>'.
                                                        $person_table[$i]['student_id'].'</td><td class="col-fit">'.
                                                        $person_table[$i]['campus_phone'].'</td><td class="col-fit">'.
                                                        $person_table[$i]['cell_phone'].'</td><td>'.
                                                        $person_table[$i]['role'].'</td></tr>';
                            }
                            else if ($user_role == 'super')
                            {
                                echo '<tr><td><form class="form-edit" action="/index.php/edit/editperson" method="post"><div style="display:none"><input name="EditForm[personId]" type="text" class="form-control" id="EditForm_personid" value="'.$person_table[$i]['people_id'].'"></div><button class="btn btn-default" type="submit" name="yt0">Edit</button></form></td><td>'.
                                                        $person_table[$i]['people_id'].'</td><td>'.
                                                        $person_table[$i]['email_address'].'</td><td>'.
                                                        $person_table[$i]['last_name'].'</td><td>'.
                                                        $person_table[$i]['first_name'].'</td><td>'.
                                                        $person_table[$i]['student_id'].'</td><td class="col-fit">'.
                                                        $person_table[$i]['campus_phone'].'</td><td class="col-fit">'.
                                                        $person_table[$i]['cell_phone'].'</td><td>'.
                                                        $person_table[$i]['role'].'</td></tr>';
                            }
                        }

						echo '</tbody>
							   <tfoot class="hide-if-no-paging">
								 <tr>
								   <td colspan="9">
									 <div class="paging text-center">
									   <ul class="pagination"></ul>
									 </div>
								   </td>
								 </tr>
							   </tfoot></table></div>';
                    }
                ?>
  </div>

  <div id="edit_location" <?php if($formname!='edit_location') echo 'class="hide"'; ?>>
    <!-- Edit Location -->
                <?php 
                    if ($formname=='edit_location')
                    {
                        echo '<div class="col-xs-12 col-sm-4"><div class="panel panel-default">';
                        echo '<table class="table table-hover">';
                        echo '<thead>
                              <tr>
                                <th data-sort-ignore="true"></th>
                                <th>ID</th>
                                <th>Name</th>
                              </tr>
                            </thead>
                            <tbody>';
                        for($i = 0; $i < sizeof($location_table); $i++)
                        {
                            echo '<tr><td><form class="form-edit" action="/index.php/edit/editlocation" method="post"><div style="display:none"><input name="EditForm[buildingId]" type="text" class="form-control" id="EditForm_buildingid" value="'.$location_table[$i]->building_id.'"></div><button class="btn btn-default" type="submit" name="yt0">Edit</button></form></td><td>'.
                                            $location_table[$i]->building_id.'</td><td>'.
                                            $location_table[$i]->building_name.'</td></tr>';
                        }

                        echo '</tbody></table></div></div>';
                    }
                ?>
  </div>

  <div id="edit_equipment_type" <?php if($formname!='edit_equipment_type') echo 'class="hide"'; ?>>
    <!-- Edit Item Type -->
                <?php 
                    if ($formname=='edit_equipment_type')
                    {
                        echo '<div class="col-xs-12 col-sm-4"><div class="panel panel-default">';
                        echo '<table class="table table-hover">';
                        echo '<thead>
                              <tr>
                                <th data-sort-ignore="true"></th>
                                <th>ID</th>
                                <th>Name</th>
                              </tr>
                            </thead>
                            <tbody>';
                        for($i = 0; $i < sizeof($equipment_type_table); $i++)
                        {
                            echo '<tr><td><form class="form-edit" action="/index.php/edit/editequipmenttype" method="post"><div style="display:none"><input name="EditForm[equipmentTypeId]" type="text" class="form-control" id="EditForm_equipmenttypeid" value="'.$equipment_type_table[$i]->item_type_id.'"></div><button class="btn btn-default" type="submit" name="yt0">Edit</button></form></td><td>'.
                                            $equipment_type_table[$i]->item_type_id.'</td><td>'.
                                            $equipment_type_table[$i]->type.'</td></tr>';
                        }

                        echo '</tbody></table></div></div>';
                    }
                ?>
  </div>

  <div id="edit_equipment_status" <?php if($formname!='edit_equipment_status') echo 'class="hide"'; ?>>
    <!-- Edit Equipment Status -->
                <?php 
                    if ($formname=='edit_equipment_status')
                    {
                        echo '<div class="col-xs-12 col-sm-4"><div class="panel panel-default">';
                        echo '<table class="table table-hover">';
                        echo '<thead>
                              <tr>
                                <th data-sort-ignore="true"></th>
                                <th>ID</th>
                                <th>Name</th>
                              </tr>
                            </thead>
                            <tbody>';
                        for($i = 0; $i < sizeof($equipment_status_table); $i++)
                        {
                            echo '<tr><td><form class="form-edit" action="/index.php/edit/editequipmentstatus" method="post"><div style="display:none"><input name="EditForm[statusId]" type="text" class="form-control" id="EditForm_statusid" value="'.$equipment_status_table[$i]->status_id.'"></div><button class="btn btn-default" type="submit" name="yt0">Edit</button></form></td><td>'.
                                                        $equipment_status_table[$i]->status_id.'</td><td>'.
                                                        $equipment_status_table[$i]->status.'</td></tr>';
                        }

                        echo '</tbody></table></div></div>';
                    }
                ?>
  </div>

  <div id="edit_reservation_status" <?php if($formname!='edit_reservation_status') echo 'class="hide"'; ?>>
    <!-- Edit Reservation Status -->
                <?php 
                    if ($formname=='edit_reservation_status')
                    {
                        echo '<div class="col-xs-12 col-sm-4"><div class="panel panel-default">';
                        echo '<table class="table table-hover">';
                        echo '<thead>
                              <tr>
                                <th data-sort-ignore="true"></th>
                                <th>ID</th>
                                <th>Name</th>
                              </tr>
                            </thead>
                            <tbody>';
                        for($i = 0; $i < sizeof($reservation_status_table); $i++)
                        {
                            echo '<tr><td><form class="form-edit" action="/index.php/edit/editreservationstatus" method="post"><div style="display:none"><input name="EditForm[reservationStatusId]" type="text" class="form-control" id="EditForm_reservationstatusid" value="'.$reservation_status_table[$i]->reservation_status_id.'"></div><button class="btn btn-default" type="submit" name="yt0">Edit</button></form></td><td>'.
                                            $reservation_status_table[$i]->reservation_status_id.'</td><td>'.
                                            $reservation_status_table[$i]->status.'</td></tr>';
                        }

                        echo '</tbody></table></div></div>';
                    }
                 ?>
  </div>

  <div id="edit_people_role" <?php if($formname!='edit_people_role') echo 'class="hide"'; ?>>
    <!-- Edit People Role -->
              
                 <?php 
                    if ($formname =='edit_people_role')
                    {
                        echo '<div class="col-xs-12 col-sm-4"><div class="panel panel-default">';
                        echo '<table class="table table-hover">';
                        echo '<thead>
                              <tr>
                                <th data-sort-ignore="true"></th>
                                <th>ID</th>
                                <th>Name</th>
                              </tr>
                            </thead>
                            <tbody>';
                        for($i = 0; $i < sizeof($people_role_table); $i++)
                        {
                            echo '<tr><td><form class="form-edit" action="/index.php/edit/editpeoplerole" method="post"><div style="display:none"><input name="EditForm[roleId]" type="text" class="form-control" id="EditForm_roleid" value="'.$people_role_table[$i]->role_id.'"></div><button class="btn btn-default" type="submit" name="yt0">Edit</button></form></td><td>'.
                                            $people_role_table[$i]->role_id.'</td><td>'.
                                            $people_role_table[$i]->role.'</td></tr>';
                        }

                        echo '</tbody></table></div></div>';
                    } 
                 ?>
            </form>
  </div>

</div> <!-- /#content_frame -->

<!-- javascript -->
<script type="text/javascript" src="<?php Yii::app()->request->baseUrl; ?>/js/site/editselect.js"></script>
