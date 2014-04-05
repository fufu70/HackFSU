<?php

class ReservationForm extends CFormModel
{
	public $reservationNumber;
	public $peopleId;
	public $primaryEmail;
	public $secondaryContactId;
	public $secondaryEmail;	
	public $beginningDate;
	public $beginningTime;
	public $reservationNotes;
	public $assistanceNeeded;
	public $deliveryAndSetup;
	public $takedownNeeded;
	public $buildingId;
	public $buildingName;
	public $locationDescription;
	public $reservationStatus;
	public $reservationStatusId;
	public $resStatusName;
	public $closureNotes;
	public $endDate;
	public $endTime;

	/*
	 *	All of the items that are used with the reservation
	 */
	public $equipment;
	public $equipment1;
	public $equipment2;
	public $equipment3;
	public $equipment4;
	public $equipment5;

	/*
	 *	All of the previous reservation items
	 */
	public $oldEquipment;
	public $oldEquipment1;
	public $oldEquipment2;
	public $oldEquipment3;
	public $oldEquipment4;
	public $oldEquipment5;

	public $removableEquipment;
	public $addableEquipment;


	private $_addForm;
	private $_editForm;
	private $_reportForm;
	private $_reservationStatus;


	public function rules()
	{
		return array(
			array('primaryEmail, peopleId, secondaryEmail, secondaryContactId, beginDate, beginningDate, beginTime, beginningTime,
				 endDate, endTime, assistanceNeeded, deliveryAndSetup, takedownNeeded, buildingName, buildingId, locationDescription,
						reservationNotes, closureNotes, reservationStatus, reservationStatusId, addbleEquipment, removableEquipment, equipment, oldEquipment, oldEquipment1, oldEquipment2, oldEquipment3, oldEquipment4,
								oldEquipment5, reservationNumber', 'required'),
		);
	}

	public function makeReservation()
	{
	    $this->closureNotes = "";
	    $this->resStatusName = "Ready";
        $this->beginningTime=$this->beginningDate." ".$this->beginningTime.":00";
        $this->endTime=$this->endDate." ".$this->endTime.":00";
		$this->_addForm = new AddForm;
		$this->_addForm->attributes = $this->attributes;
		$this->_addForm->addReservation();
	}

	public function checkoutReservation()
	{
		$_reservationStatus = ReservationStatus::model()->find(array('select'=>'reservation_status_id', 'condition'=>'status=:stat', 'params'=>array(':stat'=>'Active')));
		$this->_reportForm = new ReportForm;
		$this->_editForm = new EditForm;
		$res = $this->_reportForm->getReservationByID($this->reservationNumber);
		$this->peopleId = $res->people_id;
		$this->secondaryContactId = $res->secondary_contact_id;
		$this->beginningDate = $res->beginning_date;
		$this->beginningTime = $res->beginning_time;
		$this->reservationNotes = $res->reservation_notes;
		$this->assistanceNeeded = $res->assistance_needed;
		$this->deliveryAndSetup = $res->delivery_and_setup;
		$this->takedownNeeded = $res->takedown_needed;
		$this->buildingId = $res->building_id;
		$this->locationDescription = $res->location_description;
		$this->reservationStatusId = $_reservationStatus->reservation_status_id;
		$this->endDate = $res->end_date;
		$this->endTime = $res->end_time;
		$this->_editForm->attributes=$this->attributes;
		$this->_editForm->editReservation();
	}
	
	public function closeReservation()
	{
		$_reservationStatus = ReservationStatus::model()->find(array('select'=>'reservation_status_id', 'condition'=>'status=:stat', 'params'=>array(':stat'=>'Closed')));
		$this->_reportForm = new ReportForm;
		$this->_editForm = new EditForm;
		$res = $this->_reportForm->getReservationByID($this->reservationNumber);
		$this->peopleId = $res->people_id;
		$this->secondaryContactId = $res->secondary_contact_id;
		$this->beginningDate = $res->beginning_date;
		$this->beginningTime = $res->beginning_time;
		$this->reservationNotes = $res->reservation_notes;
		$this->assistanceNeeded = $res->assistance_needed;
		$this->deliveryAndSetup = $res->delivery_and_setup;
		$this->takedownNeeded = $res->takedown_needed;
		$this->buildingId = $res->building_id;
		$this->locationDescription = $res->location_description;
		$this->reservationStatusId = $_reservationStatus->reservation_status_id;
		$this->endDate = $res->end_date;
		$this->endTime = $res->end_time;
		$this->_editForm->attributes=$this->attributes;
		$this->_editForm->editReservation();
	}

	public function editReservation()
	{
		$this->_editForm = new EditForm;
		$this->_reportForm = new ReportForm;
		$primaryContact = People::model()->find(array("select"=>'people_id', 'condition'=>'email_address=:emailAddress', 'params'=>array(':emailAddress'=> $this->primaryEmail)));
		$secondaryContact = People::model()->find(array("select"=>'people_id', 'condition'=>'email_address=:emailAddress', 'params'=>array(':emailAddress'=> $this->secondaryEmail)));
		$buildingInfo = Location::model()->find(array("select"=>'building_id', 'condition'=>'building_name=:buildingName', 'params'=>array(':buildingName'=> $this->buildingName)));
		$res = $this->_reportForm->getReservationByID($this->reservationNumber);
		$this->peopleId = $primaryContact->people_id;
        if($this->secondaryEmail != '')
        {
            $this->secondaryContactId = $secondaryContact->people_id;
		}	
		else
		{
            $this->secondaryContactId = $primaryContact->people_id;
		}
		$this->reservationStatusId = $res->reservation_status_id;
		$this->buildingId = $buildingInfo->building_id;
        $this->beginningTime=$this->beginningDate." ".$this->beginningTime.":00";
        $this->endTime=$this->endDate." ".$this->endTime.":00";

        $this->addableEquipment = $this->objectsFromContrastingComparison($this->equipment, $this->oldEquipment);
        $this->removableEquipment = $this->objectsFromContrastingComparison($this->oldEquipment, $this->equipment);

		$this->_editForm->attributes = $this->attributes;
		$this->_editForm->editReservation();
	}

	public function getReservationByID($ID)
	{
		$this->_reportForm = new ReportForm;
		$reservation = $this->_reportForm->getReservationByID($ID);
		return $reservation;
	}

	public function getReservationItemsByID($ID)
	{
		$this->_reportForm = new ReportForm;
		$reservation_items = $this->_reportForm->getReservationItemsByID($ID);
		return $reservation_items;
	}

	/*
	 * Compares 2 Arrays and appends the object that occurs in arrayOne but not in arrayTwo
	 * onto another array to be returned once the entirety of both arrayOne and arrayTwo
	 * are compared.
	 */
	public function objectsFromContrastingComparison($arrayOne, $arrayTwo)
	{
		$counter = 0;
		$dontcare = false;
		$arrayResult = array();

		for($i = 0; $i < sizeof($arrayOne); $i ++)
		{
			for($j = 0; $j < sizeof($arrayTwo); $j++)
			{
				if($arrayTwo[$j] != $arrayOne[$i])
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
				$arrayResult[] = $arrayOne[$i];
			}
		}
		return $arrayResult;
	}

	/*
	 *	Checks to see if there is an instance where on equipment equals another.
	 */
	public function checkCollisionEquipment($equipment)
	{
		$_reportForm = new ReportForm;
		$equipmentCollision = array();
		$_reportForm->queriedBeginningDate = $this->beginningDate;
		$_reportForm->queriedEndDate = $this->endDate;

		for($i = 0; $i < sizeof($equipment); $i ++)
		{
			$_reportForm->itemNumber = $equipment[$i];
			$info = $_reportForm->reservationItemsByNumber();
			if(!empty($info))
			{
				$equipmentCollision[] = $info;
			}
		}

		return $equipmentCollision;
	}
}
