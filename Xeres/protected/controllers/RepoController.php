<?php


/**
 *	Site Controller is there to controler the view and model inputs and outputs
 * 	based off of what the user has requested (via the urlManager). 

 	NOTE
 
 *	The action's themselves always call the initializeView function since the 
 * 	_view object is not remembered after a change in the action, and the same goes with
 * 	the _userRole.
 */
class RepoController extends Controller
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
	 *			||||||||	|||||||||	||||||||	 ||||||||	||||||||	||||||||||
	 *			||	   ||	||	   		||	   || 	||		||	||	   ||	   	||
	 *			||	   ||	||	   		||	   ||	||		||	||	   ||	    ||
	 *			||||||||	|||||||||   ||||||||	||		||	||||||||	    ||
	 *			||	   ||	||	  	 	||	   		||		||	||	   ||	    ||
	 *			||	   ||	||	   		||	   		||		||	||	   ||	    ||
	 *			||	   ||	|||||||||	||			 ||||||||	||	   ||	    ||
	 */
	
	public function actionReportreservationsbytype()
	{
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$chosen = false;
		$this->initializeView();


		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='report-form')
			{
				echo CActiveForm::validate($this->_reportModel);
				yii::app()->end();
			}
			
			if (isset($_POST['ReportForm']['downloadReservationsByType']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->reservationItemsByType();
				$this->arrayToCSV($info, "ReportReservationsByType.csv");
				if(sizeof($info) > 0)
				{
					$num = true;
				}
			}
			else if (isset($_POST['ReportForm']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->reservationItemsByType();
				$this->_view->renderViewWithModelAndTwoParam($this, 'reportdisplay', $this->_reportModel, 'formname', 'ReservationsByType', 'table', $info);
				$chosen = true;
			}
			if(!$num && !$chosen && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'reportUserInput',$this->_reportModel, 'formname', 'reservations_by_type');
			}
		}
	}
	
	public function actionReportitemsbyperson()
	{
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$chosen = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='report-form')
			{
				echo CActiveForm::validate($this->_reportModel);
				yii::app()->end();
			}
			
			if (isset($_POST['ReportForm']['downloadItemsByPerson']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->reservationItemsByPerson();
				$this->arrayToCSV($info, "ReportItemsByPerson.csv");
				if(sizeof($info) > 0)
				{
					$num = true;
				}
			}
			else if (isset($_POST['ReportForm']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->reservationItemsByPerson();
				$this->_view->renderViewWithModelAndTwoParam($this, 'reportdisplay', $this->_reportModel, 'formname', 'ItemsByPerson', 'table', $info);
				$chosen = true;
			}
			if(!$num && !$chosen && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'reportUserInput',$this->_reportModel, 'formname', 'items_by_person');
			}
		}
	}
	
	public function actionReportitemsbynumber()
	{
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$chosen = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='report-form')
			{
				echo CActiveForm::validate($this->_reportModel);
				yii::app()->end();
			}
			
			if (isset($_POST['ReportForm']['downloadItemsByNumber']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->reservationItemsByNumber();
				$this->arrayToCSV($info, "ReportItemsByNumber.csv");
				if(sizeof($info) > 0)
				{
					$num = true;
				}
			}
			else if (isset($_POST['ReportForm']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->reservationItemsByNumber();
				$this->_view->renderViewWithModelAndTwoParam($this, 'reportdisplay', $this->_reportModel, 'formname', 'ItemsByNumber', 'table', $info);
				$chosen = true;
			}
			if(!$num && !$chosen && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'reportUserInput',$this->_reportModel, 'formname', 'items_by_number');
			}
		}
	}

	public function actionReportunreserveditems()
	{
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$chosen = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if(isset($_POST['ajax']) && $_POST['ajax'] === 'report-form')
			{
				echo CActiveForm::validate($this->_reportModel);
				yii::app()->end();
			}

			if (isset($_POST['ReportForm']['downloadUnreservedItems']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->unreservedItems();
				$this->arrayToCSV($info, "ReportUnreservedItems.csv");
				if(sizeof($info) > 0)
				{
					$num = true;
				}
			}
			else if (isset($_POST['ReportForm']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->unreservedItems();
				$this->_view->renderViewWithModelAndTwoParam($this, 'reportdisplay', $this->_reportModel, 'formname', 'UnreservedItems', 'table', $info);
				$chosen = true;
			}
			if(!$num && !$chosen && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'reportUserInput',$this->_reportModel, 'formname', 'unreserved_items');
			}
		}
	}
	
	public function actionReporttotalreservations()
	{
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$chosen = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='report-form')
			{
				echo CActiveForm::validate($this->_reportModel);
				yii::app()->end();
			}
			
			if (isset($_POST['ReportForm']['downloadTotalReservations']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->totalReservation();
				$this->arrayToCSV($info, "ReportTotalReservations.csv");
				if(sizeof($info) > 0)
				{
					$num = true;
				}
			}
			else if (isset($_POST['ReportForm']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->totalReservation();
				$this->_view->renderViewWithModelAndTwoParam($this, 'reportdisplay', $this->_reportModel, 'formname', 'TotalReservations', 'table', $info);
				$chosen = true;
			}
			if(!$num && !$chosen && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'reportUserInput',$this->_reportModel, 'formname', 'total_reservation');
			}
		}
	}
	
	public function actionReporttotalreservationitems()
	{
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$chosen = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='report-form')
			{
				echo CActiveForm::validate($this->_reportModel);
				yii::app()->end();
			}
			
			if (isset($_POST['ReportForm']['downloadTotalReservationItems']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->totalReservationItems();
				$this->arrayToCSV($info, "ReportTotalReservationItems.csv");
				if(sizeof($info) > 0)
				{
					$num = true;
				}
			}
			else if (isset($_POST['ReportForm']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->totalReservationItems();
				$this->_view->renderViewWithModelAndTwoParam($this, 'reportdisplay', $this->_reportModel, 'formname', 'TotalReservationItems', 'table', $info);
				$chosen = true;
			}
			if(!$num && !$chosen && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'reportUserInput',$this->_reportModel, 'formname', 'total_reservation_items');
			}
		}
	}
	
	public function actionReportreservationswithdeliveryandsetup()
	{
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$chosen = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='report-form')
			{
				echo CActiveForm::validate($this->_reportModel);
				yii::app()->end();
			}
			
			if (isset($_POST['ReportForm']['downloadReservationsWithDeliveryAndSetup']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->reservationWithDeliveryAndSetup();
				$this->arrayToCSV($info, "ReportReservationsWithDelivery.csv");
				if(sizeof($info) > 0)
				{
					$num = true;
				}
			}
			else if (isset($_POST['ReportForm']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->reservationWithDeliveryAndSetup();
				$this->_view->renderViewWithModelAndTwoParam($this, 'reportdisplay', $this->_reportModel, 'formname', 'ReservationsWithDeliveryAndSetup', 'table', $info);
				$chosen = true;
			}
			if(!$num && !$chosen && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'reportUserInput',$this->_reportModel, 'formname', 'reservations_with_delivery_and_setup');
			}
		}
	}
	
	public function actionReportreservationstatus()
	{
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$chosen = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='report-form')
			{
				echo CActiveForm::validate($this->_reportModel);
				yii::app()->end();
			}
			
			if (isset($_POST['ReportForm']['downloadReservationStatus']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->reservationStatus();
				$this->arrayToCSV($info, "ReportReservationStatus.csv");
				if(sizeof($info) > 0)
				{
					$num = true;
				}
			}
			else if (isset($_POST['ReportForm']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->reservationStatus();
				$this->_view->renderViewWithModelAndTwoParam($this, 'reportdisplay', $this->_reportModel, 'formname', 'ReservationStatus', 'table', $info);
				$chosen = true;
			}
			if(!$num && !$chosen && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'reportUserInput',$this->_reportModel, 'formname', 'reservation_status');
			}
		}
	}
	
	public function actionReportbyequipmentstatus()
	{
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$chosen = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='report-form')
			{
				echo CActiveForm::validate($this->_reportModel);
				yii::app()->end();
			}

			if (isset($_POST['ReportForm']['downloadByEquipmentStatus']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->reservationByEquipmentStatus();
				$this->arrayToCSV($info, "ReportByEquipmentStatus.csv");
				if(sizeof($info) > 0)
				{
					$num = true;
				}
			}
			else if (isset($_POST['ReportForm']))
			{
				$this->_reportModel->attributes=$_POST['ReportForm'];
				$info = $this->_reportModel->reservationByEquipmentStatus();
				$this->_view->renderViewWithModelAndTwoParam($this, 'reportdisplay', $this->_reportModel, 'formname', 'ByEquipmentStatus', 'table', $info);
				$chosen = true;
			}
			if(!$num && !$chosen && $this->layout != null)
			{
				$this->_view->renderViewWithModelAndParam($this, 'reportUserInput',$this->_reportModel, 'formname', 'by_equipment_status');
			}
		}
	}

	public function actionReportoverdueitems()
	{
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='report-form')
			{
				echo CActiveForm::validate($this->_reportModel);
				yii::app()->end();
			}

			if (isset($_POST['ReportForm']['downloadOverdueItems']))
			{
				$info = $this->_reportModel->overdueItems();
				$this->arrayToCSV($info, "ReportOverdueItems.csv");
				if(sizeof($info) > 0)
				{
					$num = true;
				}
			}

			if (!$num && $this->layout != null)
			{
				$info = $this->_reportModel->overdueItems();
				$this->_view->renderViewWithModelAndTwoParam($this, 'reportdisplay', $this->_reportModel, 'formname', 'OverdueItems', 'table', $info);	
			}
		}
	}
	
	public function actionReportlogitems()
	{
		$this->_reportModel = new ReportForm;
		$this->_nonViewers = array("User", "View Only");
		$num = false;
		$this->initializeView();

		if($this->canUserView())
		{
			if (isset($_POST['ajax']) && $_POST['ajax']==='report-form')
			{
				echo CActiveForm::validate($this->_reportModel);
				yii::app()->end();
			}

			if (isset($_POST['ReportForm']['downloadLogItems']))
			{
				$info = $this->_reportModel->logItems();
				$this->arrayToCSV($info, "ReportLogItems.csv");
				if(sizeof($info) > 0)
				{
					$num = true;
				}
			}

			if (!$num && $this->layout != null)
			{
				$info = $this->_reportModel->logItems();
				$this->_view->renderViewWithModelAndTwoParam($this, 'reportdisplay', $this->_reportModel, 'formname', 'LogItems', 'table', $info);	
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

	public function arrayToCSV($array, $filename = "export.csv", $delimeter = ",")
	{
		if (sizeof($array) != 0)
		{
			$f = fopen('php://memory', 'w');
			fputcsv($f, array_keys($array[0]), $delimeter);
			foreach($array as $line)
			{
				fputcsv($f, $line, $delimeter);
			}

			fseek($f, 0);
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename="'.$filename.'"');
			fpassthru($f);
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