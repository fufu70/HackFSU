<?php


/**
 *	Site Controller is there to controler the view and model inputs and outputs
 * 	based off of what the user has requested (via the urlManager). 

 	NOTE
 
 *	The action's themselves always call the initializeView function since the 
 * 	_view object is not remembered after a change in the action, and the same goes with
 * 	the _userRole.
 */
class SiteController extends Controller
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
	 *	The actionIndex function is there to act as the login page. It is only called on
	 *	an instance on initialization of the page or when the user has logged out.
	 */
	public function actionIndex()
	{
		$this->_doorKeeperController = new DoorKeeperController("doorkeeper");
		$this->_doorKeeperController->actionIndex($this);
	}

	/**
	 *	After the user has been properly logged in from the use of the DoorKeeper
	 * 	Controller, the user is brought to the QuickView which allows him to view
	 * 	all of the reservations and make changes to them. It just calls the QuickViewForm
	 * 	class sends in all of the reservations that are of a certain date. Whenever there is
	 * 	a POST it will usually be about a change in a Reservation.
	 */
	public function actionQuickview()
	{
		$this->_nonViewers = array("User");
		$this->initializeView();

		if($this->canUserView())
		{
			$this->_view->renderView($this, 'quickview');
		}
	}

	/**
	 *			 ||||||||		||||||||	||||||||||
	 *			||		||		||	   ||		||
	 *			||		||		||	   ||		||
	 *			||		||		||||||||		||
	 *			||		||		||				||		 |||| 
	 *			||		||		||				||		||||||
	 *			 ||||||||		||				||		 ||||
	 */

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->actionIndex();
	}

	public function actionOptionpassword()
	{
		$this->_model = new OptionForm;
		$num = false;
		$this->initializeView();

		if(isset($_POST['OptionForm']))
		{
			$this->_model->attributes = $_POST['OptionForm'];
			$this->_model->changeUserPassword();
			$this->actionQuickview();
			$num = true;
		}

		if(!$num && $this->layout != null)
		{
			$this->_view->renderViewWithModel($this, 'option', $this->_model);
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
				$this->actionIndex();
				return false;
			}
		}

		return true;
	}
}