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
	private $_optionForm;

	/**
	 *	The actionIndex function is there to act as the login page. It is only called on
	 *	an instance on initialization of the page or when the user has logged out.
	 */
	public function actionIndex()
	{
		$this->_view = new View;
		$this->_view->renderView($this, 'index');
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
		$this->_optionForm = new OptionForm;
		$num = false;
		$this->initializeView();

		if(isset($_POST['OptionForm']))
		{
			$this->_optionForm->attributes = $_POST['OptionForm'];
			$this->_optionForm->changeUserPassword();
			$this->actionIndex();
			$num = true;
		}

		if(!$num && $this->layout != null)
		{
			$this->_view->renderViewWithModel($this, 'option', $this->_optionForm);
		}
	}
}