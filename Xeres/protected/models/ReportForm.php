<?php

/**
 * ReportForm class.
 * The ReportForm is used to call all the neccessary SQL queries for
 * reports to be displayed. The methods are called in the siteController
 * and send into the view with the site controller.
 */
class ReportForm extends CFormModel
{

	public $queriedBeginningDate;
	public $queriedEndDate;
	
	public $extraInfo;
	
	public $peopleId;
	public $itemNumber;
	
	public $resStat;
	public $curDate;
	public $itemStatus;
	
	/*This is the return array for this class */
	public function rules()
	{
		return array(
			array('emailAddress, lastName, firstName, campusPhone, cellPhone, roleId,suNumber, manufacturer, model, accessionDate,
					deAccessionDate, statusId, itemType, serialNumber, barcodeNumber, description peopleId, secondaryContact, queriedBeginningDate,
					 beginningTime,reservationNotes, assistanceNeeded, deliveryAndSetup, takedownNeeded, buildingId, locationDescription,
						reservationStatus, closureNotes, queriedEndDate, buildingName, extraInfo, itemNumber, resStat,itemStatus', 'required'),
		);
		
		
	}
	/*This Query gets all the reservations between the 2 selected dates*/
	public function totalReservation()
	{
		$sqlquery = 
			"SELECT r.`reservation_number` AS 'Reservation Number',
					r.`people_id` AS 'Primary Contact ID',
					r.`secondary_contact_id` AS 'Secondary Contact ID',
					rs.`status` AS 'Reservation Status',
					r.`beginning_date` AS 'Beginning Date',
					r.`end_date` AS 'End Date',
					r.`beginning_time` AS 'Beginning Time',
					tbl_loc.`building_name` AS 'Location Name',
					r.`location_description` AS 'Location Description',
					r.`assistance_needed` AS 'Assistance Needed',
					r.`delivery_and_setup` AS 'Delivery And Setup',
					r.`takedown_needed` AS 'Takedown Needed',
					r.`reservation_notes` AS 'Reservation Notes',
					r.`closure_notes` AS 'Closure Notes'
					FROM `tbl_reservation` AS r
				INNER JOIN `tbl_reservation_status` AS rs ON rs.`reservation_status_id`= r.`reservation_status_id`
				INNER JOIN `tbl_location` AS tbl_loc ON tbl_loc.`building_id` = r.`building_id`
				WHERE `end_date` >= '$this->queriedBeginningDate' AND `beginning_date` <= '$this->queriedEndDate'";
				
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$res = $command->queryAll();
		
		return $res;
					
	}
	
	/* This Query gets all the reservations by a certain equipment type e.x. "Laptop" or "Projecter
	*and between the selected date range
	*/
	public function reservationItemsByType()
	{
		$sqlquery = 
			"SELECT r.`reservation_number` AS 'Reservation Number',
					r.`people_id` AS 'Primary Contact ID',
					r.`secondary_contact_id` AS 'Secondary Contact ID',
					rs.`status` AS 'Reservation Status',
					r.`beginning_date` AS 'Beginning Date',
					r.`end_date` AS 'End Date',
					r.`beginning_time` AS 'Beginning Time',
					tbl_loc.`building_name` AS 'Location Name',
					r.`location_description` AS 'Location Description',
					r.`assistance_needed` AS 'Assistance Needed',
					r.`delivery_and_setup` AS 'Delivery And Setup',
					r.`takedown_needed` AS 'Takedown Needed',
					r.`reservation_notes` AS 'Reservation Notes',
					r.`closure_notes` AS 'Closure Notes'
					FROM `tbl_reservation` AS r
				INNER JOIN `tbl_reservation_status` AS rs ON rs.`reservation_status_id`= r.`reservation_status_id`
				INNER JOIN `tbl_location` AS tbl_loc ON tbl_loc.`building_id` = r.`building_id`
				INNER JOIN `tbl_reservation_items` AS ri ON ri.`reservation_number` = r.`reservation_number`
				INNER JOIN `tbl_equipment` AS e ON e.`item_number` = ri.`item_number`
				INNER JOIN `tbl_equipment_type` AS et ON et.`item_type_id`
				WHERE et.`item_type_id` = '$this->extraInfo' 
					AND r.`end_date` >= '$this->queriedBeginningDate' 
					AND r.`beginning_date` <= '$this->queriedEndDate'";
							 
							 
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$res = $command->queryAll();
		return $res;
	
	}
	
	/*This Query shows all the reservations for a specific person and between the selected date range */
	public function reservationItemsByPerson()
	{
		$sqlquery = 
			"SELECT r.`reservation_number` AS 'Reservation Number',
					r.`people_id` AS 'Primary Contact ID',
					r.`secondary_contact_id` AS 'Secondary Contact ID',
					rs.`status` AS 'Reservation Status',
					r.`beginning_date` AS 'Beginning Date',
					r.`end_date` AS 'End Date',
					r.`beginning_time` AS 'Beginning Time',
					tbl_loc.`building_name` AS 'Location Name',
					r.`location_description` AS 'Location Description',
					r.`assistance_needed` AS 'Assistance Needed',
					r.`delivery_and_setup` AS 'Delivery And Setup',
					r.`takedown_needed` AS 'Takedown Needed',
					r.`reservation_notes` AS 'Reservation Notes',
					r.`closure_notes` AS 'Closure Notes'
					FROM `tbl_reservation` AS r
				INNER JOIN `tbl_reservation_status` AS rs ON rs.`reservation_status_id`= r.`reservation_status_id`
				INNER JOIN `tbl_location` AS tbl_loc ON tbl_loc.`building_id` = r.`building_id`
				WHERE `people_id` = '$this->extraInfo' AND `end_date` >= '$this->queriedBeginningDate' AND `beginning_date` <= '$this->queriedEndDate'";
				
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$res = $command->queryAll();
		
		return $res;
	
	
	}
	
	/*This  Query shows all the reservations by a selected equipment number or id and between the selected date range*/
	public function reservationItemsByNumber()
	{
		$sqlquery = 
			"SELECT r.`reservation_number` AS 'Reservation Number',
					r.`people_id` AS 'Primary Contact ID',
					r.`secondary_contact_id` AS 'Secondary Contact ID',
					rs.`status` AS 'Reservation Status',
					r.`beginning_date` AS 'Beginning Date',
					r.`end_date` AS 'End Date',
					r.`beginning_time` AS 'Beginning Time',
					tbl_loc.`building_name` AS 'Location Name',
					r.`location_description` AS 'Location Description',
					r.`assistance_needed` AS 'Assistance Needed',
					r.`delivery_and_setup` AS 'Delivery And Setup',
					r.`takedown_needed` AS 'Takedown Needed',
					r.`reservation_notes` AS 'Reservation Notes',
					r.`closure_notes` AS 'Closure Notes'
					FROM `tbl_reservation` AS r
				INNER JOIN `tbl_reservation_status` AS rs ON rs.`reservation_status_id`= r.`reservation_status_id`
				INNER JOIN `tbl_location` AS tbl_loc ON tbl_loc.`building_id` = r.`building_id`
				INNER JOIN `tbl_reservation_items` AS ri ON ri.`reservation_number` = r.`reservation_number`
				WHERE ri.`item_number` = '$this->extraInfo' AND r.`end_date` >= '$this->queriedBeginningDate' AND r.`beginning_date` <= '$this->queriedEndDate'";
							 
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$res = $command->queryAll();
		return $res;
	}

	public function unreservedItems()
	{
		$sqlqueryreserved = 
			"SELECT e.`item_number` AS 'Equipment Number',
					e.`su_number` AS 'SU Number',
					e.`manufacturer` AS 'Manufacturer',
					e.`model` AS 'Model',
					e.`accession_date` AS 'Accession Date',
					e.`de_accession_date` AS 'DeaccessionDate',
					eqp_sta.`status` AS 'Status',
					eqp_typ.`type` AS 'Item Type',
					e.`serial_number` AS 'Serial Number',
					e.`barcode_number` AS 'Barcode Number',
					e.`description` AS 'Description'
					FROM `tbl_equipment` AS e
				INNER JOIN `tbl_reservation_items` AS ri ON ri.`item_number` = e.`item_number`
				INNER JOIN `tbl_reservation` AS r ON r.`reservation_number` = ri.`reservation_number`
				INNER JOIN `tbl_location` AS tbl_loc ON tbl_loc.`building_id` = r.`building_id`
				INNER JOIN `tbl_equipment_status` AS eqp_sta ON eqp_sta.`status_id` = e.`status_id`
				INNER JOIN `tbl_equipment_type` AS eqp_typ ON eqp_typ.`item_type_id` = e.`item_type_id`
				INNER JOIN `tbl_reservation_status` AS rs ON rs.`reservation_status_id`= r.`reservation_status_id`
				WHERE r.`end_date` >= '$this->queriedBeginningDate' AND r.`beginning_date` <= '$this->queriedEndDate'";	

		$sqlqueryall = 
			"SELECT e.`item_number` AS 'Equipment Number',
					e.`su_number` AS 'SU Number',
					e.`manufacturer` AS 'Manufacturer',
					e.`model` AS 'Model',
					e.`accession_date` AS 'Accession Date',
					e.`de_accession_date` AS 'DeaccessionDate',
					eqp_sta.`status` AS 'Status',
					eqp_typ.`type` AS 'Item Type',
					e.`serial_number` AS 'Serial Number',
					e.`barcode_number` AS 'Barcode Number',
					e.`description` AS 'Description'
					FROM `tbl_equipment` AS e
				INNER JOIN `tbl_equipment_status` AS eqp_sta ON eqp_sta.`status_id` = e.`status_id`
				INNER JOIN `tbl_equipment_type` AS eqp_typ ON eqp_typ.`item_type_id` = e.`item_type_id`";		 
							 
		$connection = Yii::app()->db;
		$commandreserved = $connection->createCommand($sqlqueryreserved);
		$commandall = $connection->createCommand($sqlqueryall);
		$reserved = $commandreserved->queryAll();
		$allitemssetup = $commandall->queryAll();

		$allitems = $this->getAllEquipment();
		$unreserved = array();
		$p = 0;
		$dontcare = false;

		for($i = 0; $i < sizeof($allitems); $i++)
		{
			for($j = 0; $j < sizeof($reserved); $j ++)
			{
				if($allitems[$i]['item_number'] != $reserved[$j]['Equipment Number'])
				{
					$dontcare = false;
				}
				else
				{
					$dontcare = true;
					break;
				}
			}
			if(!$dontcare)
			{
				$unreserved[$p] = $allitemssetup[$i];
				$p++;
			}
		}
		return $unreserved;
	}
	
	/*This Query shows all of the equipment currently being reserered between the selected date range */
	public function totalReservationItems()
	{
		$sqlquery = 
			"SELECT e.`item_number` AS 'Equipment Number',
					e.`su_number` AS 'SU Number',
					e.`manufacturer` AS 'Manufacturer',
					e.`model` AS 'Model',
					e.`accession_date` AS 'Accession Date',
					e.`de_accession_date` AS 'DeaccessionDate',
					eqp_sta.`status` AS 'Status',
					eqp_typ.`type` AS 'Item Type',
					e.`serial_number` AS 'Serial Number',
					e.`barcode_number` AS 'Barcode Number',
					e.`description` AS 'Description'
					FROM `tbl_equipment` AS e
				INNER JOIN `tbl_reservation_items` AS ri ON ri.`item_number` = e.`item_number`
				INNER JOIN `tbl_reservation` AS r ON r.`reservation_number` = ri.`reservation_number`
				INNER JOIN `tbl_location` AS tbl_loc ON tbl_loc.`building_id` = r.`building_id`
				INNER JOIN `tbl_equipment_status` AS eqp_sta ON eqp_sta.`status_id` = e.`status_id`
				INNER JOIN `tbl_equipment_type` AS eqp_typ ON eqp_typ.`item_type_id` = e.`item_type_id`
				INNER JOIN `tbl_reservation_status` AS rs ON rs.`reservation_status_id`= r.`reservation_status_id`
				WHERE r.`end_date` >= '$this->queriedBeginningDate' AND r.`beginning_date` <= '$this->queriedEndDate'";			 
							 
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$res = $command->queryAll();
		return $res;
	}
	
	/*This Query shows all the reservations that need delivery and setup between the selected date range */
	public function reservationWithDeliveryAndSetup()
	{
	
		$sqlquery = 
			"SELECT r.`reservation_number` AS 'Reservation Number',
					r.`people_id` AS 'Primary Contact ID',
					r.`secondary_contact_id` AS 'Secondary Contact ID',
					rs.`status` AS 'Reservation Status',
					r.`beginning_date` AS 'Beginning Date',
					r.`end_date` AS 'End Date',
					r.`beginning_time` AS 'Beginning Time',
					tbl_loc.`building_name` AS 'Location Name',
					r.`location_description` AS 'Location Description',
					r.`assistance_needed` AS 'Assistance Needed',
					r.`delivery_and_setup` AS 'Delivery And Setup',
					r.`takedown_needed` AS 'Takedown Needed',
					r.`reservation_notes` AS 'Reservation Notes',
					r.`closure_notes` AS 'Closure Notes'
					FROM `tbl_reservation` AS r
				INNER JOIN `tbl_reservation_status` AS rs ON rs.`reservation_status_id`= r.`reservation_status_id`
				INNER JOIN `tbl_location` AS tbl_loc ON tbl_loc.`building_id` = r.`building_id`
				WHERE delivery_and_setup = 1 AND `end_date` >= '$this->queriedBeginningDate' AND `beginning_date` <= '$this->queriedEndDate'";
				
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$res = $command->queryAll();
		
		return $res;
	
	}
	
	/* This shows all the reservations by reservation status and between the selected date range */
	public function reservationStatus()
	{
		$sqlquery = 
			"SELECT r.`reservation_number` AS 'Reservation Number',
					r.`people_id` AS 'Primary Contact ID',
					r.`secondary_contact_id` AS 'Secondary Contact ID',
					rs.`status` AS 'Reservation Status',
					r.`beginning_date` AS 'Beginning Date',
					r.`end_date` AS 'End Date',
					r.`beginning_time` AS 'Beginning Time',
					tbl_loc.`building_name` AS 'Location Name',
					r.`location_description` AS 'Location Description',
					r.`assistance_needed` AS 'Assistance Needed',
					r.`delivery_and_setup` AS 'Delivery And Setup',
					r.`takedown_needed` AS 'Takedown Needed',
					r.`reservation_notes` AS 'Reservation Notes',
					r.`closure_notes` AS 'Closure Notes'
					FROM `tbl_reservation` AS r
				INNER JOIN `tbl_location` AS tbl_loc ON tbl_loc.`building_id` = r.`building_id`
				INNER JOIN `tbl_reservation_status` AS rs ON r.`reservation_status_id` = rs.`reservation_status_id`
				WHERE r.`reservation_status_id` = '$this->extraInfo' AND r.`end_date` >= '$this->queriedBeginningDate' AND r.`beginning_date` <= '$this->queriedEndDate'";
							 
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$res = $command->queryAll();
		
		return $res;
	}
	
	/* This shows all the reservations by equipment status between the selected date range*/
	public function reservationByEquipmentStatus()
	{
		$sqlquery = 
			"SELECT r.`reservation_number` AS 'Reservation Number',
					r.`people_id` AS 'Primary Contact ID',
					r.`secondary_contact_id` AS 'Secondary Contact ID',
					rs.`status` AS 'Reservation Status',
					r.`beginning_date` AS 'Beginning Date',
					r.`end_date` AS 'End Date',
					r.`beginning_time` AS 'Beginning Time',
					tbl_loc.`building_name` AS 'Location Name',
					r.`location_description` AS 'Location Description',
					r.`assistance_needed` AS 'Assistance Needed',
					r.`delivery_and_setup` AS 'Delivery And Setup',
					r.`takedown_needed` AS 'Takedown Needed',
					r.`reservation_notes` AS 'Reservation Notes',
					r.`closure_notes` AS 'Closure Notes'
					FROM `tbl_reservation` AS r
				INNER JOIN `tbl_reservation_status` AS rs ON rs.`reservation_status_id`= r.`reservation_status_id`
				INNER JOIN `tbl_location` AS tbl_loc ON tbl_loc.`building_id` = r.`building_id`
				INNER JOIN `tbl_reservation_items` AS ri ON ri.`reservation_number` = r.`reservation_number`
				INNER JOIN `tbl_equipment` AS e ON e.`item_number` = ri.`item_number`
				INNER JOIN `tbl_equipment_status` AS es ON es.`status_id` = e.`status_id`
				WHERE es.`status_id` = '$this->extraInfo' AND r.`end_date` >= '$this->queriedBeginningDate' AND r.`beginning_date` <= '$this->queriedEndDate'";
							 
							 
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$res = $command->queryAll();
		return $res;
	
	}
	
	/* This Query shows all the overdue items*/
	public function overdueItems()
	{
		$sqlquery = 
			"SELECT r.`reservation_number` AS 'Reservation Number',
					r.`people_id` AS 'Primary Contact ID',
					r.`secondary_contact_id` AS 'Secondary Contact ID',
					rs.`status` AS 'Reservation Status',
					r.`beginning_date` AS 'Beginning Date',
					r.`end_date` AS 'End Date',
					r.`beginning_time` AS 'Beginning Time',
					tbl_loc.`building_name` AS 'Location Name',
					r.`location_description` AS 'Location Description',
					r.`assistance_needed` AS 'Assistance Needed',
					r.`delivery_and_setup` AS 'Delivery And Setup',
					r.`takedown_needed` AS 'Takedown Needed',
					r.`reservation_notes` AS 'Reservation Notes',
					r.`closure_notes` AS 'Closure Notes'
					FROM `tbl_reservation` AS r
				INNER JOIN `tbl_reservation_status` AS rs ON rs.`reservation_status_id`= r.`reservation_status_id`
				INNER JOIN `tbl_location` AS tbl_loc ON tbl_loc.`building_id` = r.`building_id`
				WHERE `end_date` < CURDATE() && rs.`status` like 'Active'";
							 
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$res = $command->queryAll();
		return $res;
	
	}
	
	/*This Query shows all te log items to see whos been doing edits */
	public function logItems()
	{
				
		$sqlquery = "SELECT l.`log_id` as 'Log Number',
							CONCAT(p.`first_name`, ' ', p.`last_name`) as 'Person', 
							o.`object_type` as 'Object Type',
							l.`object_number` as 'Object Number',
							t.`log_type` as 'Log Type', 
							l.`previous_entry` as 'Previous Entry',
							l.`current_entry` as 'Current Entry',
							l.`log_time` as 'Log Time'  
						FROM `tbl_log` as l
						INNER JOIN `tbl_people` AS p ON p.`people_id` = l.`people_number`
						INNER JOIN `tbl_object_type` as o ON o.`object_type_id` = l.`object_type_id`
						INNER JOIN `tbl_log_type` as t ON t.`log_type_id` = l.`log_type_id`";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$res = $command->queryAll();
		return $res;
	}
	
	/* This gets all the reservation status */
	public function getAllReservationStatus()
	{
		$reservationStatuss = ReservationStatus::model()->findAll();
		return $reservationStatuss;
	}
	
	/*This gets all people */
	public function getAllPerson()
	{
		$sqlquery = 
			"SELECT persons.*, personrole.`role` AS role FROM `tbl_people` AS persons
				INNER JOIN `tbl_person_role` AS personrole ON persons.`role_id` = personrole.`role_id`";
							 
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$persons = $command->queryAll();
		return $persons;
	}
	
	public function getAllEquipmentType()
	{
		$equipmentTypes = EquipmentType::model()->findAll();
		return $equipmentTypes;
	}

	public function getAllEquipmentStatus()
	{
		$equipmentStatuss = EquipmentStatus::model()->findAll();
		return $equipmentStatuss;
	}

	public function getAllEquipment()
	{
		$sqlquery = 
			"SELECT equipments.*,
					equipmenttype.`type` AS type,
					equipmentstatus.`status` AS status
				FROM `tbl_equipment` AS equipments
				INNER JOIN `tbl_equipment_type` AS equipmenttype ON equipments.`item_type_id` = equipmenttype.`item_type_id`
				INNER JOIN `tbl_equipment_status` AS equipmentstatus ON equipments.`status_id` = equipmentstatus.`status_id`";
							 
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$equipments = $command->queryAll();
		return $equipments;
	}

	public function getAvailableEquipment()
	{	
		$sqlquery = "SELECT *
						FROM `tbl_equipment` as e
						INNER JOIN `tbl_equipment_status` AS es ON e.`status_id` = es.`status_id`
						WHERE (e.`de_accession_date` > CURDATE() or (e.`de_accession_date` is NULL or e.`de_accession_date` like '0000-00-00'))
							  AND es.`status` != 'Broken'";

		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$equipments = $command->queryAll();
		return $equipments;
	}

	public function getAllReservation()
	{
		$reservations = Reservation::model()->findAll();
		return $reservations;
	}

	public function getAllPeopleRole()
	{
		$roles = PersonRole::model()->findAll();
		return $roles;
	}
	
	public function getAllLocation()
	{
		$locations = Location::model()->findAll();
		return $locations;
	}

	public function getPeopleRoleByID($ID)
	{
		$peopleRoleInfo = PersonRole::model()->findByPK($ID);
		return $peopleRoleInfo;
	}	

	public function getLocationByID($ID)
	{
		$locationInfo = Location::model()->findByPK($ID);
		return $locationInfo;
	}

	public function getReservationByID($ID)
	{
		$reservationInfo = Reservation::model()->findByPK($ID);
		return $reservationInfo;
	}

	public function getReservationItemsByID($ID)
	{
		$sqlquery = "SELECT * FROM tbl_reservation_items WHERE reservation_number = $ID";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sqlquery);
		$reservationItems = $command->queryAll();
		return $reservationItems;
	}

	public function getEquipmentByID($ID)
	{
		$equipmentInfo = Equipment::model()->findByPK($ID);
		return $equipmentInfo;
	}

	public function getEquipmentStatusByID($ID)
	{
		$equipmentStatusInfo = EquipmentStatus::model()->findByPK($ID);
		return $equipmentStatusInfo;
	}

	public function getEquipmentTypeByID($ID)
	{
		$equipmentTypeInfo = EquipmentType::model()->findByPK($ID);
		return $equipmentTypeInfo;
	}

	public function getPersonByID($ID)
	{
		$personInfo = People::model()->findByPK($ID);
		return $personInfo;
	}

	public function getReservationStatusByID($ID)
	{
		$reservationStatusInfo = ReservationStatus::model()->findByPK($ID);
		return $reservationStatusInfo;
	}

	/*This function gets the users hash from the hashing library */
	public function getUserHash()
	{
		$person_id = People::model()->find(array('select'=>'people_id', 'condition'=>'email_address=:email', 'params'=>array(':email'=>Yii::app()->user->name)));
		$login_info = Login::model()->findByPK($person_id->people_id);
		return $login_info;
	}
}