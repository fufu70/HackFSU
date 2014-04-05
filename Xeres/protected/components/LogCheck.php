<?php

/**
 *	Class LogCheck, checks all of the possible Log that can be created 
 *	from the list of different attributes given and returns an array of
 *	all of the items in a list of logs as per the log table of defining
 *	the object then the log and stating the current and previous values 
 *	of the log.
 *
 */
class LogCheck
{
	private $_editFormAttributes;
	private $_editFormAttributesNumerical;
	private $_editFormAttributesArrayKeys;
	private $_comparisonAttributes;
	private $_comparisonAttributesNumerical;
	private $_comparisonAttributesArrayKeys;
	private $_allObjectTypes;
	private $_objectType;
	private $_objectNumber;
	private $_objectChanges;
	private $_logArray;

	/*
	 *	Returns all the logs in an array
	 *
	 * 	The method itself sets up all the arrays and objects needed for creating the logs,
	 *	then creates each log based off of the change from the previous input to the current
	 *	one. Once that is finished it returns all of the changes in a log type format.
	 *	
	 */
	public function getAllLogs($attributes)
	{
		$this->setupLogCheck($attributes);
		$this->findAllChangesInObject();
		$this->setupLogArray();

		return $this->_logArray;
	}

	/*
	 *	Function sets up all objects and arrays, such as all the EditForm attributes
	 *	and their respective keys, and also the EditForm atributes in a numerical array
	 * 	format. The array also finds the object that it is logging and sets up the
	 *	attributes that need to be called later on.
	 *
	 */
	private function setupLogCheck($attributes)
	{
		$this->_editFormAttributes = $attributes;
		$this->_editFormAttributesNumerical = array_values($this->_editFormAttributes);
		$this->_editFormAttributeArrayKeys = array_keys($this->_editFormAttributes);
		$this->findObjectType();
		$this->setupAllAttributesForObjectType();
		$this->setupComparisonArray();
		$this->setupObjectNumber();
		$this->_objectChanges = array();
		$this->_logArray = array();
	}

	/*
	 *	The function takes in all of the objects stored in the Edit Form attributes and
	 *	finds the object based off of the objects that have been filled (all objects that
	 *	are not related to the object being changed will be null). So the object's number
	 *	will never be NULL so we compare all object with a "Number" in their arrayKey and
	 *	check to see if they are set and if they are related to one of the many objects 
	 *	stored in the tbl_object_type table. If the object in the EditForm attribute meets
	 *	those requirments then it will set the _objectType object to that object name
	 *	and break out of the loop.
	 */
	private function findObjectType()
	{
		$this->_allObjectTypes = ObjectType::model()->findAll();
		$foundObjectType = false;

		for($i = 0; $i < sizeof($this->_editFormAttributes); $i ++)
		{
			$info = explode("Number", $this->_editFormAttributeArrayKeys[$i]);
			$possibleObjectType = $info[0];
			if(sizeof($info) == 2)
			{
				for($j = 0; $j < sizeof($this->_allObjectTypes); $j ++)
				{
					if($possibleObjectType == $this->_allObjectTypes[$j]['object_type'] 
						&& isset($this->_editFormAttributesNumerical[$i]))
					{
						$this->_objectType = $possibleObjectType;
						$foundObjectType = true;
						break;
					}
				}
				if($foundObjectType)
				{
					break;
				}
			}
		}
	}

	/*
	 *	The function sets the required values for specific objects. It follows the pattern of
	 *	"arrayKey name of the column in the table" = "arrayKey name of the id used in the form".
	 */
	private function setupAllAttributesForObjectType()
	{
		if($this->_objectType == "reservation")
		{
			$this->_editFormAttributes['reservation_number'] = $this->_editFormAttributes['reservationNumber'];
			$this->_editFormAttributes['people_id'] = $this->_editFormAttributes['peopleId'];
			$this->_editFormAttributes['secondary_contact_id'] = $this->_editFormAttributes['secondaryContactId'];
			$this->_editFormAttributes['beginning_date'] = $this->_editFormAttributes['beginningDate'];
			$this->_editFormAttributes['beginning_time'] = $this->_editFormAttributes['beginningTime'];
			$this->_editFormAttributes['reservation_notes'] = $this->_editFormAttributes['reservationNotes'];
			$this->_editFormAttributes['assistance_needed'] = $this->_editFormAttributes['assistanceNeeded'];
			$this->_editFormAttributes['delivery_and_setup'] = $this->_editFormAttributes['deliveryAndSetup'];
			$this->_editFormAttributes['takedown_needed'] = $this->_editFormAttributes['takedownNeeded'];
			$this->_editFormAttributes['building_id'] = $this->_editFormAttributes['buildingId'];
			$this->_editFormAttributes['location_description'] = $this->_editFormAttributes['locationDescription'];
			$this->_editFormAttributes['reservation_status_id'] = $this->_editFormAttributes['reservationStatusId'];
			$this->_editFormAttributes['closure_notes'] = $this->_editFormAttributes['closureNotes'];
			$this->_editFormAttributes['end_date'] = $this->_editFormAttributes['endDate'];
		}
		else if($this->_objectType == "equipment")
		{
			$this->_editFormAttributes['item_number'] = $this->_editFormAttributes['equipmentNumber'];
			$this->_editFormAttributes['su_number'] = $this->_editFormAttributes['suNumber'];
			$this->_editFormAttributes['manufacturer'] = $this->_editFormAttributes['manufacturer'];
			$this->_editFormAttributes['model'] = $this->_editFormAttributes['model'];
			$this->_editFormAttributes['accession_date'] = $this->_editFormAttributes['accessionDate'];
			$this->_editFormAttributes['de_accession_date'] = $this->_editFormAttributes['deAccessionDate'];
			$this->_editFormAttributes['status_id'] = $this->_editFormAttributes['statusId'];
			$this->_editFormAttributes['item_type_id'] = $this->_editFormAttributes['itemTypeId'];
			$this->_editFormAttributes['serial_number'] = $this->_editFormAttributes['serialNumber'];
			$this->_editFormAttributes['barcode_number'] = $this->_editFormAttributes['barcodeNumber'];
			$this->_editFormAttributes['description'] = $this->_editFormAttributes['description'];
		}
		else if($this->_objectType == "person")
		{
			$this->_editFormAttributes['people_id'] = $this->_editFormAttributes['personNumber'];
			$this->_editFormAttributes['email_address'] = $this->_editFormAttributes['emailAddress'];
			$this->_editFormAttributes['last_name'] = $this->_editFormAttributes['lastName'];
			$this->_editFormAttributes['first_name'] = $this->_editFormAttributes['firstName'];
			$this->_editFormAttributes['campus_phone'] = $this->_editFormAttributes['campusPhone'];
			$this->_editFormAttributes['cell_phone'] = $this->_editFormAttributes['cellPhone'];
			$this->_editFormAttributes['role_id'] = $this->_editFormAttributes['roleId'];
			$this->_editFormAttributes['student_id'] = $this->_editFormAttributes['studentId'];
		}
	}

	private function setupComparisonArray()
	{
		if($this->_objectType == "reservation")
		{
			$this->_comparisonAttributes = Reservation::model()->findByPK($this->_editFormAttributes['reservation_number'])->attributes;
			$this->_comparisonAttributesNumerical = array_values($this->_comparisonAttributes);
			$this->_comparisonAttributesArrayKeys = array_keys($this->_comparisonAttributes);
		}
		else if($this->_objectType == "equipment")
		{
			$this->_comparisonAttributes = Equipment::model()->findByPK($this->_editFormAttributes['item_number'])->attributes;
			$this->_comparisonAttributesNumerical = array_values($this->_comparisonAttributes);
			$this->_comparisonAttributesArrayKeys = array_keys($this->_comparisonAttributes);
		}
		else if($this->_objectType == "person")
		{
			$this->_comparisonAttributes = People::model()->findByPK($this->_editFormAttributes['people_id'])->attributes;
			$this->_comparisonAttributesNumerical = array_values($this->_comparisonAttributes);
			$this->_comparisonAttributesArrayKeys = array_keys($this->_comparisonAttributes);
		}
	}

	private function setupObjectNumber()
	{
		if($this->_objectType == "reservation")
		{
			$this->_objectNumber = $this->_editFormAttributes['reservation_number'];
		}
		else if($this->_objectType == "equipment")
		{
			$this->_objectNumber = $this->_editFormAttributes['item_number'];
		}
		else if($this->_objectType == "person")
		{
			$this->_objectNumber = $this->_editFormAttributes['people_id'];
		}
	}

	private function findAllChangesInObject()
	{
		for($i = 0; $i < sizeof($this->_comparisonAttributes); $i ++)
		{
			if($this->_editFormAttributes[$this->_comparisonAttributesArrayKeys[$i]] != $this->_comparisonAttributesNumerical[$i])
			{
				$this->_objectChanges[] = array('log_type_name'=>$this->_comparisonAttributesArrayKeys[$i], 
											'previous_entry'=>$this->_comparisonAttributesNumerical[$i], 
												'current_entry'=>$this->_editFormAttributes[$this->_comparisonAttributesArrayKeys[$i]]);
			}
		}
	}

	private function setupLogArray()
	{
		if(sizeof($this->_objectChanges) > 0)
		{
			$this->_logArray['object_type'] = $this->_objectType;
			$this->_logArray['object_number'] = $this->_objectNumber;
			$this->_logArray['object_changes'] = $this->_objectChanges;
		}
	}
}