<?php


/**
 *	Site Controller is there to controler the view and model inputs and outputs
 * 	based off of what the user has requested (via the urlManager). 

 	NOTE
 
 *	The action's themselves always call the initializeView function since the 
 * 	_view object is not remembered after a change in the action, and the same goes with
 * 	the _userRole.
 */
class ReseController extends Controller
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
	 *			||||||||	|||||||||	 ||||||||	|||||||||	||||||||	||	    ||	
	 *			||	   ||	||	   		||	   		||			||	   ||	||	    ||
	 *			||	   ||	||	   		||	   		||			||	   ||	 ||	   ||
	 *			||||||||	|||||||||    |||||||	|||||||||	||||||||	 ||	   ||	 
	 *			||	   ||	||	  	 		   ||	||			||	   ||	  ||  ||	 ||||
	 *			||	   ||	||	   			   ||	||			||	   ||	   ||||		||||||
	 *			||	   ||	|||||||||	||||||||	|||||||||	||	   ||	    ||		 ||||
	 */


	public function actionReservationnew()
	{
		$this->_model = new ReservationForm;
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$this->initializeView();
		
		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_model);
				yii::app()->end();
			}
			
			if(isset($_POST['ReservationForm']))
			{
				$this->_model->attributes=$_POST['ReservationForm'];
				$info = $this->_model->checkCollisionEquipment($this->_model->equipment);
				if(empty($info))
				{
					$this->_model->makeReservation();
				$this->_view->renderView($this, '../site/quickview');
					$num = true;
				}
				else
				{
					$this->_view->renderViewWithModelAndTwoParam($this, 'reservationform', $this->_model, 'formname', 'new_reservation', 'wrong_items', $info);
					$num = true;
				}
			}
			if(!$num && $this->layout != null && $this->_userRole != "Agent")
			{
				$this->_view->renderViewWithModelAndParam($this, 'reservationform', $this->_model, 'formname', 'new_reservation');
			}
			else if(!$num && $this->layout != null && $this->_userRole == "Agent")
			{
				$this->_view->renderViewWithModelAndParam($this, 'reservationform', $this->_model, 'formname', 'new_reservation_agent');
			}
		}
	}

	public function actionReservationclose()
	{
		$this->_model = new ReservationForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_model);
				yii::app()->end();
			}
			
			if(isset($_POST['ReservationForm']))
			{
				$this->_model->attributes=$_POST['ReservationForm'];
				$this->_model->closeReservation();
				$this->_view->renderView($this, '../site/quickview');
				$num = true;
			}
			if(!$num && $this->layout != null)
			{
				if(isset($_GET['id']))
				{
					$info = $this->_model->getReservationByID($_GET['id']);
					$this->_view->renderViewWithModelAndTwoParam($this, 'reservationform', $this->_model, 'formname', 'close_reservation', 'reservation_table', $info);
				}
				else
				{
					$this->_view->renderViewWithModelAndParam($this, 'reservationform', $this->_model, 'formname', 'close_reservation');
				}
			}
		}
	}

	public function actionReservationcheckout()
	{
		$this->_model = new ReservationForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_model);
				yii::app()->end();
			}
			
			if(isset($_POST['ReservationForm']))
			{
				$this->_model->attributes=$_POST['ReservationForm'];
				$this->_model->checkoutReservation();
				$info = $this->_model->getReservationByID($this->_model->reservationNumber);
				$person_info = People::model()->findByPK($info->people_id);
				$this->_view->renderViewWithModelAndTwoParam($this, 'reservationagreement', $this->_model, 'reservation_table', $info, 'person_table', $person_info);
				$num = true;
			}
			if(!$num && $this->layout != null)
			{
				if(isset($_GET['id']))
				{
					$info = $this->_model->getReservationByID($_GET['id']);
					$this->_view->renderViewWithModelAndTwoParam($this, 'reservationform', $this->_model, 'formname', 'checkout_reservation', 'reservation_table', $info);
				}
				else
				{
					$this->_view->renderViewWithModelAndParam($this, 'reservationform', $this->_model, 'formname', 'checkout_reservation');
				}
			}
		}
	}

	public function actionReservationedit()
	{
		$this->_model = new ReservationForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_model);
				yii::app()->end();
			}
			
			if(isset($_POST['ReservationForm']))
			{
				$this->_model->attributes=$_POST['ReservationForm'];
				$info = $this->_model->checkCollisionEquipment($this->_model->objectsFromContrastingComparison($this->_model->equipment, $this->_model->oldEquipment));
				$table = $this->_model->getReservationByID($this->_model->reservationNumber);
				$table_items = $this->_model->getReservationItemsByID($this->_model->reservationNumber);
				if(empty($info))
				{
					$this->_model->editReservation();
					$this->_view->renderView($this, '../site/quickview');
					$num = true;
				}
				else
				{
					$this->_view->renderViewWithModelAndFourParam($this, 'reservationform', $this->_model, 'formname', 'edit_reservation', 'wrong_items', $info, 'reservation_table', $table, 'reservation_items_table', $table_items);
					$num = true;
				}
			}
			if(!$num && $this->layout != null)
			{
				$info = $this->_model->getReservationByID($_GET['id']);
				$info_items = $this->_model->getReservationItemsByID($_GET['id']);
				$this->_view->renderViewWithModelAndThreeParam($this, 'reservationform', $this->_model, 'formname', 'edit_reservation', 'reservation_table', $info, 'reservation_items_table', $info_items);
			}
		}
	}	
	
	public function actionReservationagreement()
	{
		$this->_model = new ReservationForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$this->initializeView();
		
		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='add-form')
			{
				echo CActiveForm::validate($this->_model);
				yii::app()->end();
			}
			
			if(isset($_GET['id']) && $this->layout != null)
			{
				$info = $this->_model->getReservationByID($_GET['id']);
				$person_info = People::model()->findByPK($info->people_id);
				$this->_view->renderViewWithModelAndTwoParam($this, 'reservationagreement', $this->_model, 'reservation_table', $info, 'person_table', $person_info);
			}
			else
			{
				$this->_view->renderView($this, 'quickview');
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