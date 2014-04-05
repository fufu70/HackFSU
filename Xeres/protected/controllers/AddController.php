<?php


/**
 *	Site Controller is there to controler the view and model inputs and outputs
 * 	based off of what the user has requested (via the urlManager). 

 	NOTE
 
 *	The action's themselves always call the initializeView function since the 
 * 	_view object is not remembered after a change in the action, and the same goes with
 * 	the _userRole.
 */
class AddController extends Controller
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
	 *			 |||||||	||||||||	||||||||
	 *			||	   ||	||	   ||	||	   ||
	 *			||	   ||	||	   ||	||	   ||
	 *			|||||||||	||	   ||	||	   ||
	 *			||	   ||	||	   ||	||	   ||
	 *			||	   ||	||	   ||	||	   ||
	 *			||	   ||	||||||||	||||||||
	 */

	/**
	 *	Connects the View with the AddForm class, then whenever a post occurs it takes in all
	 *	of the values that are necessary, and then calls the addPerson function inside of that
	 *	form.
	 */
	public function actionAddperson()
	{
		$this->_addModel = new AddForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$num = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_addModel);
				yii::app()->end();
			}
			
			if(isset($_POST['AddForm']))
			{
				$this->_addModel->attributes=$_POST['AddForm'];	
				$this->_addModel->addPerson();

				$message = "Person was submitted.";
				$this->_view->renderViewWithModelAndTwoParam($this, 'add',$this->_addModel, 'formname', 'add_person', 'success_alert', $message);
				$num = true;
			}
			if(!$num && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'add',$this->_addModel, 'formname', 'add_person');
			}
		}
	}

	public function actionAddpersonagent()
	{
		$this->_addModel = new AddForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_addModel);
				yii::app()->end();
			}
			
			if(isset($_POST['AddForm']))
			{
				$this->_addModel->attributes=$_POST['AddForm'];	
				$this->_addModel->addPerson();

				$message = "Person was submitted.";
				$this->_view->renderViewWithModelAndTwoParam($this, 'add',$this->_addModel, 'formname', 'add_person', 'success_alert', $message);
				$num = true;
			}
			if(!$num && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'add',$this->_addModel, 'formname', 'add_person_agent');
			}
		}
	}

	/**
	 *	Connects the View with the AddForm class, then whenever a post occurs it takes in all
	 *	of the values that are necessary, and then calls the addEquipment function inside of that
	 *	form.
	 */
	public function actionAddequipment()
	{
		$this->_addModel = new AddForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$num = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_addModel);
				yii::app()->end();
			}
			
			if(isset($_POST['AddForm']))
			{
				$this->_addModel->attributes=$_POST['AddForm'];	
				$this->_addModel->addEquipment();

				$message = "Equipment was submitted.";
				$this->_view->renderViewWithModelAndTwoParam($this, 'add',$this->_addModel, 'formname', 'add_equipment', 'success_alert', $message);
				$num = true;
			}
			if(!$num && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'add',$this->_addModel, 'formname', 'add_equipment');
			}
		}
	}

	/**
	 *	Connects the View with the AddForm class, then whenever a post occurs it takes in all
	 *	of the values that are necessary, and then calls the addEquipment function inside of that
	 *	form.
	 */
	public function actionAddlocation()
	{
		$this->_addModel = new AddForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$num = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_addModel);
				yii::app()->end();
			}
			
			if(isset($_POST['AddForm']))
			{
				$this->_addModel->attributes=$_POST['AddForm'];	
				$this->_addModel->addLocation();
				
				$message = "Location was submitted.";
				$this->_view->renderViewWithModelAndTwoParam($this, 'add',$this->_addModel, 'formname', 'add_location', 'success_alert', $message);
				$num = true;
			}
			if(!$num && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'add',$this->_addModel, 'formname', 'add_location');
			}
		}
	}
	
	public function actionAddequipmenttype()
	{
		$this->_addModel = new AddForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$num = false;
		$this->initializeView();


		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_addModel);
				yii::app()->end();
			}
			
			if (isset($_POST['AddForm']))
			{
				$this->_addModel->attributes=$_POST['AddForm'];
				$this->_addModel->addEquipmentType();
				
				$message = "Equipment type was submitted.";
				$this->_view->renderViewWithModelAndTwoParam($this, 'add',$this->_addModel, 'formname', 'add_equipment_type', 'success_alert', $message);
				$num = true;
			}
			if(!$num && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'add',$this->_addModel, 'formname', 'add_equipment_type');
			}
		}
	}
	
	public function actionAddequipmentstatus()
	{	
		$this->_addModel = new AddForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$num = false;
		$this->initializeView();


		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_addModel);
				yii::app()->end();
			}
			
			if (isset($_POST['AddForm']))
			{
				$this->_addModel->attributes=$_POST['AddForm'];
				$this->_addModel->addEquipmentStatus();
				
				$message = "Equipment status was submitted.";
				$this->_view->renderViewWithModelAndTwoParam($this, 'add',$this->_addModel, 'formname', 'add_equipment_status', 'success_alert', $message);
				$num = true;
			}
			if(!$num && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'add',$this->_addModel, 'formname', 'add_equipment_status');
			}
		}
	}
	
	public function actionAddreservationstatus()
	{
		
		$this->_addModel = new AddForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$num = false;
		$this->initializeView();


		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_addModel);
				yii::app()->end();
			}
			
			if (isset($_POST['AddForm']))
			{
				$this->_addModel->attributes=$_POST['AddForm'];
				$this->_addModel->addReservationStatus();
				
				$message = "Reservation status was submitted.";
				$this->_view->renderViewWithModelAndTwoParam($this, 'add',$this->_addModel, 'formname', 'add_reservation_status', 'success_alert', $message);
				$num = true;
			}
			if(!$num && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'add',$this->_addModel, 'formname', 'add_reservation_status');
			}
		}
	}
	
	public function actionAddpeoplerole()
	{
		
		$this->_addModel = new AddForm;
		$this->_nonViewers = array("User", "View Only", "Agent");
		$num = false;
		$this->initializeView();


		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_addModel);
				yii::app()->end();
			}
			
			if (isset($_POST['AddForm']))
			{
				$this->_addModel->attributes=$_POST['AddForm'];
				$this->_addModel->addPeopleRole();
				
				$message = "Person role was submitted.";
				$this->_view->renderViewWithModelAndTwoParam($this, 'add',$this->_addModel, 'formname', 'add_people_role', 'success_alert', $message);
				$num = true;
			}
			if(!$num && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'add',$this->_addModel, 'formname', 'add_people_role');
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