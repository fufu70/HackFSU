<?php


/**
 *	Site Controller is there to controler the view and model inputs and outputs
 * 	based off of what the user has requested (via the urlManager). 

 	NOTE
 
 *	The action's themselves always call the initializeView function since the 
 * 	_view object is not remembered after a change in the action, and the same goes with
 * 	the _userRole.
 */
class EditController extends Controller
{
	private $_view;
	private $_model;
	private $_reportModel;
	private $_editModel;
	private $_addModel;
	private $_doorKeeperController;
	private $_userRole;
	private $_nonViewers;
	
	/**
	 *			|||||||||	||||||||	||||||||||    ||||||||||
	 *			||	   		||	   ||		||			  ||
	 *			||	   		||	   ||		||   		  ||
	 *			|||||||||	||	   ||		||   		  ||
	 *			||	   		||	   ||		||			  ||
	 *			||			||	   ||		||   		  ||
	 *			|||||||||	||||||||	||||||||||		  ||
	 */

	public function actionEditlocation()
	{
		$this->_editModel = new EditForm;
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$chosen = false;
		$num = false;
		$this->initializeView();


		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='edit-form')
			{
				echo CActiveForm::validate($this->_editModel);
				yii::app()->end();
			}
			
			if (isset($_POST['EditForm']))
			{
				$this->_editModel->attributes=$_POST['EditForm'];
				if (sizeof($_POST['EditForm']) == 1)
				{
					$info = $this->_reportModel->getLocationByID($_POST['EditForm']['buildingId']);
					$this->_view->renderViewWithModelAndTwoParam($this, 'editchange', $this->_editModel, 'formname', 'edit_location', 'location_info', $info);
					$chosen = true;
				}
				else
				{
					$this->_editModel->attributes = $_POST['EditForm'];
					$this->_editModel->editLocation();
					$this->_view->renderView($this, '../site/quickview');
					$num = true;
				}
			}

			if(!$chosen && !$num && $this->layout != null)
			{
				$rows = $this->_reportModel->getAllLocation();
				$this->_view->renderViewWithModelAndTwoParam($this, 'editselect',$this->_editModel, 'formname', 'edit_location', 'location_table', $rows);
			}
		}
	}

	public function actionEditequipment()
	{
		$this->_editModel = new EditForm;
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$chosen = false;
		$num = false;
		$this->initializeView();


		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='edit-form')
			{
				echo CActiveForm::validate($this->_editModel);
				yii::app()->end();
			}
			
			if (isset($_POST['EditForm']))
			{
				$this->_editModel->attributes=$_POST['EditForm'];
				if (sizeof($_POST['EditForm']) == 1)
				{
					$info = $this->_reportModel->getEquipmentByID($_POST['EditForm']['itemNumber']);
					$this->_view->renderViewWithModelAndTwoParam($this, 'editchange', $this->_editModel, 'formname', 'edit_equipment', 'equipment_info', $info);
					$chosen = true;
				}
				else
				{
					$this->_editModel->attributes = $_POST['EditForm'];
					$this->_editModel->editEquipment();
					$this->initializeView();
					$this->_view->renderView($this, '../site/quickview');
					$num = true;
				}
			}

			if(!$chosen && !$num && $this->layout != null)
			{
				$rows = $this->_reportModel->getAllEquipment();
				$this->_view->renderViewWithModelAndTwoParam($this, 'editselect',$this->_editModel, 'formname', 'edit_equipment', 'equipment_table', $rows);
			}
		}
	}

	public function actionEditequipmenttype()
	{
		$this->_editModel = new EditForm;
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$chosen = false;
		$num = false;
		$this->initializeView();


		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='edit-form')
			{
				echo CActiveForm::validate($this->_editModel);
				yii::app()->end();
			}
			
			if (isset($_POST['EditForm']))
			{
				$this->_editModel->attributes=$_POST['EditForm'];
				if (sizeof($_POST['EditForm']) == 1)
				{
					$info = $this->_reportModel->getEquipmentTypeByID($_POST['EditForm']['equipmentTypeId']);
					$this->_view->renderViewWithModelAndTwoParam($this, 'editchange', $this->_editModel, 'formname', 'edit_equipment_type', 'equipment_type_info', $info);
					$chosen = true;
				}
				else
				{
					$this->_editModel->attributes = $_POST['EditForm'];
					$this->_editModel->editEquipmentType();
					$this->initializeView();
					$this->_view->renderView($this, '../site/quickview');
					$num = true;
				}
			}

			if(!$chosen && !$num && $this->layout != null)
			{
				$rows = $this->_reportModel->getAllEquipmentType();
				$this->_view->renderViewWithModelAndTwoParam($this, 'editselect',$this->_editModel, 'formname', 'edit_equipment_type', 'equipment_type_table', $rows);
			}
		}
	}

	public function actionEditequipmentstatus()
	{
		$this->_editModel = new EditForm;
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$chosen = false;
		$num = false;
		$this->initializeView();


		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='edit-form')
			{
				echo CActiveForm::validate($this->_editModel);
				yii::app()->end();
			}
			
			if (isset($_POST['EditForm']))
			{
				$this->_editModel->attributes=$_POST['EditForm'];
				if (sizeof($_POST['EditForm']) == 1)
				{
					$info = $this->_reportModel->getEquipmentStatusByID($_POST['EditForm']['statusId']);
					$this->_view->renderViewWithModelAndTwoParam($this, 'editchange', $this->_editModel, 'formname', 'edit_equipment_status', 'equipment_status_info', $info);
					$chosen = true;
				}
				else
				{
					$this->_editModel->attributes = $_POST['EditForm'];
					$this->_editModel->editEquipmentStatus();
					$this->_view->renderView($this, '../site/quickview');
					$num = true;
				}
			}

			if(!$chosen && !$num && $this->layout != null)
			{
				$rows = $this->_reportModel->getAllEquipmentStatus();
				$this->_view->renderViewWithModelAndTwoParam($this, 'editselect',$this->_editModel, 'formname', 'edit_equipment_status', 'equipment_status_table', $rows);
			}
		}
	}

	public function actionEditpeoplerole()
	{
		$this->_editModel = new EditForm;
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$chosen = false;
		$num = false;
		$this->initializeView();


		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='edit-form')
			{
				echo CActiveForm::validate($this->_editModel);
				yii::app()->end();
			}
			
			if (isset($_POST['EditForm']))
			{
				$this->_editModel->attributes=$_POST['EditForm'];
				if (sizeof($_POST['EditForm']) == 1)
				{
					$info = $this->_reportModel->getPeopleRoleByID($_POST['EditForm']['roleId']);
					$this->_view->renderViewWithModelAndTwoParam($this, 'editchange', $this->_editModel, 'formname', 'edit_people_role', 'people_role_info', $info);
					$chosen = true;
				}
				else
				{
					$this->_editModel->attributes = $_POST['EditForm'];
					$this->_editModel->editPeopleRole();
					$this->_view->renderView($this, '../site/quickview');
					$num = true;
				}
			}

			if(!$chosen && !$num && $this->layout != null)
			{
				$rows = $this->_reportModel->getAllPeopleRole();
				$this->_view->renderViewWithModelAndTwoParam($this, 'editselect',$this->_editModel, 'formname', 'edit_people_role', 'people_role_table', $rows);
			}
		}
	}

	public function actionEditperson()
	{
		$this->_editModel = new EditForm;
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$chosen = false;
		$num = false;
		$this->initializeView();


		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='edit-form')
			{
				echo CActiveForm::validate($this->_editModel);
				yii::app()->end();
			}
			
			if (isset($_POST['EditForm']))
			{
				$this->_editModel->attributes=$_POST['EditForm'];
				if (sizeof($_POST['EditForm']) == 1)
				{
					$info = $this->_reportModel->getPersonByID($_POST['EditForm']['personId']);
					$this->_view->renderViewWithModelAndTwoParam($this, 'editchange', $this->_editModel, 'formname', 'edit_person', 'person_info', $info);
					$chosen = true;
				}
				else
				{	
					$this->_editModel->attributes = $_POST['EditForm'];
					$this->_editModel->editPerson();
					$this->_view->renderView($this, '../site/quickview');
					$num = true;
				}
			}

			if(!$chosen && !$num && $this->layout != null)
			{
				$rows = $this->_reportModel->getAllPerson();
				$this->_view->renderViewWithModelAndThreeParam($this, 'editselect',$this->_editModel, 'formname', 'edit_person', 'person_table', $rows, 'user_role', $this->layout);
			}
		}
	}

	public function actionEditreservationstatus()
	{
		$this->_editModel = new EditForm;
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$chosen = false;
		$num = false;
		$this->initializeView();


		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='edit-form')
			{
				echo CActiveForm::validate($this->_editModel);
				yii::app()->end();
			}
			
			if (isset($_POST['EditForm']))
			{
				$this->_editModel->attributes=$_POST['EditForm'];
				if (sizeof($_POST['EditForm']) == 1)
				{
					$info = $this->_reportModel->getReservationStatusByID($_POST['EditForm']['reservationStatusId']);
					$this->_view->renderViewWithModelAndTwoParam($this, 'editchange', $this->_editModel, 'formname', 'edit_reservation_status', 'reservation_status_info', $info);
					$chosen = true;
				}
				else
				{
					$this->_editModel->attributes = $_POST['EditForm'];
					$this->_editModel->editReservationStatus();
					$this->_view->renderView($this, '../site/quickview');
					$num = true;
				}
			}

			if(!$chosen && !$num && $this->layout != null)
			{
				$rows = $this->_reportModel->getAllReservationStatus();
				$this->_view->renderViewWithModelAndTwoParam($this, 'editselect',$this->_editModel, 'formname', 'edit_reservation_status', 'reservation_status_table', $rows);
			}
		}
	}

	/**
	 *			||		||	  |||||||||		||				
	 *			||		||	  ||	   		||
	 *			||		||	  ||	   		||
	 *			||||||||||	  |||||||||		||
	 *			||		||	  ||			||		 		 |||| 
	 *			||		||	  ||			||				||||||
	 *			||		||	  |||||||||		||||||||||		 ||||
	 */

	public function initializeView()
	{
		$this->_view = new View;
		$this->initializeLayout();
	}

	/**
	 *	Needs to initialize the Layout by getting the role that the user needs, and then
	 *	sets the layout based off of that userRole.
	 */
	public function initializeLayout()
	{
		$this->setRole();
		if ($this->_userRole == null)
		{
			$this->layout = null;
		}
		else if ($this->_userRole == "Super")
		{
			$this->_view->setLayout($this, "super");
		}
		else if ($this->_userRole == "Admin")
		{
			$this->_view->setLayout($this,"admin");
		}
		else if ($this->_userRole == "Agent")
		{
			$this->_view->setLayout($this, "agent");
		}
		else if($this->_userRole == "View Only")
		{
			$this->_view->setLayout($this, "viewonly");
		}
	}

	public function setRole()
	{
		if (!Yii::app()->user->isGuest)
		{
			$people_info = People::model()->find(array("select"=>"role_id",
				"condition"=>"email_address=:name","params"=>array(":name"=>Yii::app()->user->name)));
			$this->_userRole = PersonRole::model()->findByPK($people_info->role_id);
		}
	}

	/*
	 *	Uses the _nonViewers array to decied wether the User role is not on that list.
	 * 	If the _userRole is in the array then the function sends the user back to the 
	 * 	login page, else the function returns true and continues into the aciton
	 */
	public function canUserView()
	{
		for($i = 0; $i < sizeof($this->_nonViewers); $i++)
		{
			if($this->_userRole == $this->_nonViewers[$i] && $this->layout != null)
			{
				$this->_view->renderView($this, '../doorkeeper/quickview');
				return false;
			}
		}

		return true;
	}
}