<?php

/**
 * EditForm class.
 * EditForm is the form used for Updating all the info in the database using active records
 */
class EditForm extends CFormModel
{

	/*  
	*	   ____   ___ __    ___                      
	*	  / __/__/ (_) /_  / _ \___ _______ ___  ___ 
	*	 / _// _  / / __/ / ___/ -_) __(_-</ _ \/ _ \
	*	/___/\_,_/_/\__/ /_/   \__/_/ /___/\___/_//_/
	*/
	public $personId;
	public $personNumber;
	public $emailAddress;
	public $lastName;
	public $firstName;
	public $campusPhone;
	public $cellPhone;
	public $roleName;
	public $roleId;
	public $studentId;
	public $resetPassword;
	
	/*
	*       ____   ___ __    ____          _                     __ 
	* 	  / __/__/ (_) /_  / __/__ ___ __(_)__  __ _  ___ ___  / /_
	*	 / _// _  / / __/ / _// _ `/ // / / _ \/  ' \/ -_) _ \/ __/
	*	/___/\_,_/_/\__/ /___/\_, /\_,_/_/ .__/_/_/_/\__/_//_/\__/  
	*						   /_/      /_/                     
	*/
	public $itemNumber;
	public $equipmentNumber;
	public $suNumber;
	public $manufacturer;
	public $model;
	public $accessionDate;
	public $deAccessionDate;
	public $statusName;
	public $statusId;
	public $equipmentTypeName;
	public $itemTypeId;
	public $serialNumber;
	public $barcodeNumber;
	public $description;
	
	/*
	*	   ____   ___ __    ___                            __  _         
	*	  / __/__/ (_) /_  / _ \___ ___ ___ _____  _____ _/ /_(_)__  ___ 
	*	 / _// _  / / __/ / , _/ -_|_-</ -_) __/ |/ / _ `/ __/ / _ \/ _ \
	*	/___/\_,_/_/\__/ /_/|_|\__/___/\__/_/  |___/\_,_/\__/_/\___/_//_/
    *                                                            
    *                                                            
	*/
	public $reservationNumber;
	public $peopleId;
	public $secondaryContactId;
	public $beginningDate;
	public $beginningTime;
	public $reservationNotes;
	public $assistanceNeeded;
	public $deliveryAndSetup;
	public $takedownNeeded;
	public $locationDescription;
	public $closureNotes;
	public $endDate;
	public $endTime;

	public $addableEquipment;
	public $removableEquipment;
	public $equipment;
	public $oldEquipment;
	
	/*
	*       ____   ___ __    __                 __  _         
	*	  / __/__/ (_) /_  / /  ___  _______ _/ /_(_)__  ___ 
	*	 / _// _  / / __/ / /__/ _ \/ __/ _ `/ __/ / _ \/ _ \
	*	/___/\_,_/_/\__/ /____/\___/\__/\_,_/\__/_/\___/_//_/
    */   
	
	/*Edit Location */
	public $buildingId;
	public $buildingName;
	
	/*Edit Equipment Status */
	public $equipmentStatusId;
	public $equipmentStatus;
	
	/* Edit Equipment Types */
	public $equipmentTypeId;
	public $equipmentType;
	
	/* Edit Person Role */
	public $peopleRoleId;
	public $personRole;
	
	/* Edit Reservation Status */
	public $reservationStatusId;
	public $reservationStatus;

	/* LogCheck Component */
	private $_logCheck;
	private $_logs;

	/* All necessary LogCheck Components */
	/* Person Log */
	public $people_id; 
	public $email_address;
	public $last_name;
	public $first_name;
	public $campus_phone;
	public $cell_phone;
	public $role_id;
	public $student_id;

	/* Reservation Log */
	public $reservation_number;
	// public $people_id; <- already initialized
	public $secondary_contact_id;
	public $beginning_date;
	public $beginning_time;
	public $reservation_notes;
	public $assistance_needed;
	public $delivery_and_setup;
	public $takedown_needed;
	public $building_id;
	public $location_description;
	public $reservation_status_id;
	public $closure_notes;
	public $end_date;
	public $end_time;

	/* Equipment Log */
	public $item_number;
	public $su_number;
	//public $manufacturer; <- already initialized
	//public $model; <- already initialized
	public $accession_date;
	public $de_accession_date;
	public $status_id;
	public $item_type_id;
	public $serial_number;
	public $barcode_number;
	//public $description; <- already initialized

	private $_addForm;



	//the rules for the tables, the first one in each array is required.
	public function rules()
	{
		return array(
			array('personId, emailAddress, lastName, firstName, campusPhone, cellPhone, roleName,reservationNumber, peopleId, secondaryContactId, beginningDate, beginningTime,
					reservationNotes, assistanceNeeded, resetPassword, deliveryAndSetup, takedownNeeded, buildingId, locationDescription,
						reservationStatus, closureNotes, endDate, endTime, itemNumber, suNumber, manufacturer, model, accessionDate,
							deAccessionDate, statusName, equipmentTypeName, serialNumber, barcodeNumber, description,buildingId, buildingName,equipmentStatusId, equipmentStatus,
								equipmentTypeId, equipmentType, peopleRoleId, personRole, reservationStatusId, reservationStatus, studentId, addableEquipment, removableEquipment, 
									equipment, oldEquipment', 'safe'),
		);
	}

	/* The function for editing everything in the person table in the
	 * database, if a field is left blank then it simply won't update that column.
	 * 
	 * After everything has been edited via in relation to the people field in 
	 * the database we then check to see if the resetPassword varialble has been set.
	 * If it has then we will reset the password of the user to "password".
	 * 
	 * Note: this is not a secure way of doing things ... it is only temporary, 
	 * what should happen is the user should be sent an email via php in which the 
	 * new password is to be randomly generated. This wwill be put on the issues list
	 * and will be tracked. Remove this "Note" once the change has been made.
	 */
	public function editPerson()
	{
		$this->personNumber = $this->personId; // for Logging purposes
		$roleInfo = PersonRole::model()->find(array("select"=>'role_id', 'condition'=>'role=:rolename', 'params'=>array(':rolename'=> $this->roleName)));
		$this->roleId = $roleInfo->role_id;
	    if ($this->studentId != '')
	    {
	      $this->studentId = '800'.$this->studentId;
	    }

		$this->_logCheck = new LogCheck;
		$this->_logs = $this->_logCheck->getAllLogs($this->attributes);

		People::model()->updateByPk($this->personId, array('email_address'=>$this->emailAddress,
			 'last_name'=>$this->lastName, 'first_name'=>$this->firstName, 'campus_phone'=>$this->campusPhone,
			 	 'cell_phone'=>$this->cellPhone, 'role_id'=>$this->roleId, 'student_id'=>$this->studentId));	

		$this->_addForm = new AddForm;
		$this->_addForm->addLog($this->_logs);	

		if($this->resetPassword)
		{
			$login_id = Login::model()->updateByPk($this->personId, array('password'=>PBKDF2Hash::create_hash("password")));
		}
	}

	/* The function for editing everything in the reservation table in the
	 * database, if a field is left blank then it simply won't update that column.
	 * 
	 * To get the changes in the equipment from the previous reservation compared to
	 * the new equipment in the revised reservation two for loops are used to find out
	 * which reservations have not been added to the database and which have been removed.
	 * This is done by utilizing a nested for loop finding the objects that do not occur in
	 * one for loop and then adding that object to the array. The method is utilized for both
	 * finding the objects that have not been added to the database, and finding the objects that
	 * have been removed from the list.
	 */
	public function editReservation()
	{
		$this->_logCheck = new LogCheck;
		$this->_logs = $this->_logCheck->getAllLogs($this->attributes);

		Reservation::model()->updateByPk($this->reservationNumber, array('people_id'=>$this->peopleId,
			 'secondary_contact_id'=>$this->secondaryContactId, 'beginning_date'=>$this->beginningDate,
			 	 'beginning_time'=>$this->beginningTime, 'reservation_notes'=>$this->reservationNotes,
			 	 	 'assistance_needed'=>$this->assistanceNeeded, 'delivery_and_setup'=>$this->deliveryAndSetup,
			 	 	 	 'takedown_needed'=>$this->takedownNeeded, 'building_id'=>$this->buildingId,
			 	 	 	 	 'location_description'=>$this->locationDescription, 'reservation_status_id'=>$this->reservationStatusId,
			 	 	 	 	 	 'closure_notes'=>$this->closureNotes, 'end_date'=>$this->endDate, 'end_time'=>$this->endTime));

		$this->_addForm = new AddForm;
		$this->_addForm->addLog($this->_logs);

		// adding equipment
		
		for($i = 0; $i < sizeof($this->addableEquipment); $i++)
		{
			$equipmentToBeAdded = $this->addableEquipment[$i];
			$sqlquery = "INSERT INTO `tbl_reservation_items` (`item_number`, `reservation_number`) VALUES ('$equipmentToBeAdded','$this->reservationNumber')";
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sqlquery);
			$command->execute();
		}

		//removing equipment

		for($i = 0; $i < sizeof($this->removableEquipment); $i++)
		{
			$equipmentToBeRemoved = $this->removableEquipment[$i];
			$sqlquery = "DELETE FROM tbl_reservation_items WHERE item_number = $equipmentToBeRemoved AND reservation_number = $this->reservationNumber";
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sqlquery);
			$command->execute();
		}
	}

	/*The function for editing everything in the equipment table in the
	*database, if a field is left blank then it simply won't update that column
	*/
	public function editEquipment()
	{
		$this->equipmentNumber = $this->itemNumber; // for Logging purposes
	    $itemStatus = EquipmentStatus::model()->find(array("select"=>'status_id', 'condition'=>'status=:statusname', 'params'=>array(':statusname'=> $this->statusName)));
	    $this->statusId = $itemStatus->status_id;
	    $itemType = EquipmentType::model()->find(array("select"=>'item_type_id', 'condition'=>'type=:itemtype', 'params'=>array(':itemtype'=> $this->equipmentTypeName)));
	    $this->itemTypeId = $itemType->item_type_id;

		$this->_logCheck = new LogCheck;
		$this->_logs = $this->_logCheck->getAllLogs($this->attributes);

		Equipment::model()->updateByPk($this->itemNumber, array('su_number'=>$this->suNumber,
			 'manufacturer'=>$this->manufacturer, 'model'=>$this->model, 'accession_date'=>$this->accessionDate,
			 	 'de_accession_date'=>$this->deAccessionDate, 'status_id'=>$this->statusId, 'item_type_id'=>$this->itemTypeId,
			 	 	 'serial_number'=>$this->serialNumber, 'barcode_number'=>$this->barcodeNumber,'description'=>$this->description));

		$this->_addForm = new AddForm;
		$this->_addForm->addLog($this->_logs);
	}

	/*The function for editing everything in the location table in the
	*database, if a field is left blank then it simply won't update that column
	*/
	public function editLocation()
	{
		Location::model()->updateByPk($this->buildingId, array('building_name'=>$this->buildingName));
	}
	
	public function editEquipmentStatus()
	{
		EquipmentStatus::model()->updateByPk($this->equipmentStatusId, array('status'=>$this->equipmentStatus));
	}
	
	public function editEquipmentType()
	{
		EquipmentType::model()->updateByPk($this->equipmentTypeId, array('type'=>$this->equipmentType));
	}
	
	public function editReservationStatus()
	{
		ReservationStatus::model()->updateByPk($this->reservationStatusId, array('status'=>$this->reservationStatus));		
	}
	
	public function editPeopleRole()
	{
		PersonRole::model()->updateByPk($this->peopleRoleId, array('role'=>$this->personRole));
	}

	public function editUserPassword($people_id, $password)
	{
		Login::model()->updateByPk($people_id, array('password'=>$password));
	}
}
