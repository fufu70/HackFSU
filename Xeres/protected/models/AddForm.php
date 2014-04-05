<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
 
class AddForm extends CFormModel
{
	/* Add Person */
	public $newEmailAddress;
	public $lastName;
	public $firstName;
	public $campusPhone;
	public $cellPhone;
	public $roleName;
	public $studentId;
	
  
	/* Add Equipment */
	public $suNumber;
	public $manufacturer;
	public $model;
	public $accessionDate;
	public $statusName;
	public $equipmentTypeName;
	public $serialNumber;
	public $barcodeNumber;
	public $description;
	
  
	/* Add Reservation */
	public $primaryEmail;
	public $secondaryEmail;
	public $beginningDate;
	public $beginningTime;
 	public $endDate;
 	public $endTime;
	public $assistanceNeeded;
	public $deliveryAndSetup;
	public $takedownNeeded;
	public $buildingName;
	public $locationDescription;
  	public $reservationNotes;
	public $closureNotes;
  	public $resStatusName;

  	public $equipment;
	
  
	/* Add Location */
	public $newBuildingName;
  
  
  	/* Add Equipment Status */
  	public $newEquipmentStatus;
  
  
  	/* Add Equipment Type */
 	public $newEquipmentType;
     
     
 	 /*  Add Reservation Status */
  	public $newResStatus;
  	
  
  	/* Add Person Role */
  	public $newPersonRole;
		
     
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('newEmailAddress, lastName, firstName, campusPhone, cellPhone, roleName, suNumber, manufacturer, model, accessionDate,
					statusName, equipmentTypeName, serialNumber, barcodeNumber, description, primaryEmail, secondaryEmail, beginningDate, beginningTime,
					endDate, endTime, assistanceNeeded, deliveryAndSetup, takedownNeeded, buildingName, locationDescription, reservationNotes, closureNotes,
						resStatusName, newBuildingName, newEquipmentStatus, newEquipmentType, newResStatus, newPersonRole, equipment, studentId', 'required'),
		);
	}

	/**
	 * 	Use crud to get the role_id from the roleName
	 */
	public function addPerson()
	{
		$match = People::model()->find(array("select"=>'email_address', 'condition'=>'email_address=:email', 'params'=>array(':email'=> $this->newEmailAddress)));
		// check for a matching database entry or a null value
		if ($match != null || $this->newEmailAddress == null)
		{
		  return false;
		}
		else
		{
			if ($this->studentId != '')
			{
			$this->studentId = '800'.$this->studentId;
			}
			$roleInfo = PersonRole::model()->find(array("select"=>'role_id', 'condition'=>'role=:rolename', 'params'=>array(':rolename'=> $this->roleName)));
			$people= new People;
			$people->email_address=$this->newEmailAddress;
			$people->first_name=$this->firstName;
			$people->last_name=$this->lastName;
			$people->campus_phone=$this->campusPhone;
			$people->cell_phone=$this->cellPhone;
			$people->student_id=$this->studentId;
			$people->role_id=$roleInfo->role_id;
			$people->save();

			//$peopleInfo = People::model()->find(array("select"=>'people_id', 'condition'=>'email_address=:emailaddress', 'params'=>array(':emailaddress'=>$this->newEmailAddress)));
			$login = new Login;
			$login->people_id = $people->people_id;
			$login->password = PBKDF2Hash::create_hash("password");
			$login->save();
			return true;
	    }
	}
	
	/**
	 *  Use crud to get the status_id from the statusName
	 * 	Use crud to get the item_type_id from the itemTypeName
	 */
	public function addEquipment()
	{
	 	$itemStatus = EquipmentStatus::model()->find(array("select"=>'status_id', 'condition'=>'status=:statusname', 'params'=>array(':statusname'=> $this->statusName)));
	 	$itemType = EquipmentType::model()->find(array("select"=>'item_type_id', 'condition'=>'type=:itemtype', 'params'=>array(':itemtype'=> $this->equipmentTypeName)));
    		$equipment= new Equipment;
		$equipment->su_number=$this->suNumber;
		$equipment->manufacturer=$this->manufacturer;
		$equipment->model=$this->model;
		$equipment->accession_date=$this->accessionDate;
		$equipment->de_accession_date=null;
		$equipment->status_id=$itemStatus->status_id;
		$equipment->item_type_id=$itemType->item_type_id;
		$equipment->serial_number=$this->serialNumber;
		$equipment->barcode_number=$this->barcodeNumber;
		$equipment->description=$this->description;
		$equipment->save();
	}
  
	/**
 	 *  Use crud to get the people_id from the primaryEmail
	 *  Use crud to get the people_id from the secondaryEmail
	 *  Use crud to get the building_id from the buildingName
	 *  Use crud to get the reservation_status_id from the resStatusName
	 */
	public function addReservation()
	{
		$primaryContact = People::model()->find(array("select"=>'people_id', 'condition'=>'email_address=:emailAddress', 'params'=>array(':emailAddress'=> $this->primaryEmail)));
		$secondaryContact = People::model()->find(array("select"=>'people_id', 'condition'=>'email_address=:emailAddress', 'params'=>array(':emailAddress'=> $this->secondaryEmail)));
		$buildingInfo = Location::model()->find(array("select"=>'building_id', 'condition'=>'building_name=:buildingName', 'params'=>array(':buildingName'=> $this->buildingName)));
		$resStatus = ReservationStatus::model()->find(array("select"=>'reservation_status_id', 'condition'=>'status=:resStatusName', 'params'=>array(':resStatusName'=> $this->resStatusName)));
	  	$reservation= new Reservation;

		$reservation->people_id=$primaryContact->people_id;
		if($this->secondaryEmail != '')
		{
			$reservation->secondary_contact_id=$secondaryContact->people_id;	
		}	
		else
		{
			$reservation->secondary_contact_id= $primaryContact->people_id;
		}
		$reservation->beginning_date=$this->beginningDate;
		$reservation->beginning_time=$this->beginningDate." ".$this->beginningTime.":00";
    		$reservation->end_date=$this->endDate;
    		$reservation->end_time=$this->endTime;
		$reservation->assistance_needed=$this->assistanceNeeded;
		$reservation->delivery_and_setup=$this->deliveryAndSetup;
		$reservation->takedown_needed=$this->takedownNeeded;
		$reservation->building_id=$buildingInfo->building_id;
		$reservation->location_description=$this->locationDescription;
   		$reservation->reservation_notes=$this->reservationNotes;
		$reservation->closure_notes=$this->closureNotes;
   		$reservation->reservation_status_id=$resStatus->reservation_status_id;
   		$reservation->save();

		$reservation_info = Reservation::model()->findAll();
		
		/*These if statements handle multiple equipments per reservation if needed. It simply concatinates 
		*SQL queries together
		*/
		for($i = 0; $i < sizeof($this->equipment); $i++)
		{
			$equipment = $this->equipment[$i];
			$sqlquery = "INSERT INTO `tbl_reservation_items` (`item_number`, `reservation_number`) VALUES ('$equipment','".$reservation_info[sizeof($reservation_info) - 1]->reservation_number."')";
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sqlquery);
			$command->execute();
		}
	}
	
	//Adds a new location
	public function addLocation()
	{
    		$match = Location::model()->find(array("select"=>'building_name', 'condition'=>'building_name=:buildingname', 'params'=>array(':buildingname'=> $this->newBuildingName)));
    		// check for a matching database entry or a null value
    		if ($match != null || $this->newBuildingName == null)
    		{
      			return false;
    		}
    		else
    		{
      			$location = new Location;
      			$location->building_name=$this->newBuildingName;
      			$location->save();
      			return true;
    		}
	}
  
	//Function for adding new equipment status
	public function addEquipmentStatus()
	{
    		$match = EquipmentStatus::model()->find(array("select"=>'status', 'condition'=>'status=:equipmentstatus', 'params'=>array(':equipmentstatus'=> $this->newEquipmentStatus)));
    		// check for a matching database entry or a null value
    		if ($match != null || $this->newEquipmentStatus == null)
    		{
      			return false;
    		}
    		else
    		{
      			$equipStatus = new EquipmentStatus;
      			$equipStatus->status=$this->newEquipmentStatus;
      			$equipStatus->save();
      			return true;
    		}
	}
  
  
	public function addEquipmentType()
	{
		$match = EquipmentType::model()->find(array("select"=>'type', 'condition'=>'type=:equipmenttype', 'params'=>array(':equipmenttype'=> $this->newEquipmentType)));
		// check for a matching database entry or a null value
		if ($match != null || $this->newEquipmentType == null)
		{
			return false;
		}
		else
		{
			$equipType = new EquipmentType;
			$equipType->type=$this->newEquipmentType;
			$equipType->save();
			return true;
		}
	}

  
	public function addReservationStatus()
	{
		$resStatus = new ReservationStatus;
		$resStatus->status=$this->newResStatus;
		$resStatus->save();
	}
  
  
	public function addPeopleRole()	
	{
		$personRole = new PersonRole;
		$personRole->role=$this->newPersonRole;
		$personRole->save();
	}
	
	/*This function takes in a ID being the reservation_id or Equipment_id
	*and takes in a type from the EditForm to determine if a reservation or equipment was edited
	*it then finds the current active user and puts into the log table their user_id and relates
	*it to the reservation or equipment they Edited as well as the current timestamp and date*/
	public function addLog($logArray)
	{
		if(isset($logArray['object_type']))
		{
			date_default_timezone_set("America/New_York");
			$people_info = People::model()->find(
				array('select'=>'people_id', 'condition'=>'email_address=:email', 'params'=>array(':email'=>Yii::app()->user->name)));
			$object_info = ObjectType::model()->find(
				array('select'=>'object_type_id', 'condition'=>'object_type=:objectname', 'params'=>array(':objectname'=>$logArray['object_type'])));
			$object_changes = $logArray['object_changes'];

			for($i = 0; $i < sizeof($object_changes); $i++)
			{
				$log_type_info = LogType::model()->find(
					array('select'=>'log_type_id', 'condition'=>'log_type=:logname', 'params'=>array(':logname'=>$object_changes[$i]['log_type_name'])));
				$log = new Log;
				$log->people_number=$people_info->people_id;
				$log->object_type_id = $object_info->object_type_id;
				$log->object_number = $logArray['object_number'];
				$log->log_type_id = $log_type_info->log_type_id;
				$log->previous_entry = $object_changes[$i]['previous_entry'];
				$log->current_entry = $object_changes[$i]['current_entry'];
				$log->log_time=date("Y-m-d H:i:s");
				$log->save();
			}
		}
	}
  
}
