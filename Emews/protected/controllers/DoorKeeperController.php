<?php


class DoorKeeperController extends Controller
{
	private $_view;
	private $_model;
	private	$_siteController;

	public function actionIndex($site)
	{
		$this->_view = new View;
		$this->_model = new DoorKeeperForm;
		$this->_siteController = $site;
		$num = false;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='doorkeeper-form')
		{
			echo CActiveForm::validate($this->_model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['DoorKeeperForm']))
		{
			$this->_model->attributes=$_POST['DoorKeeperForm'];	
			// validate user input and redirect to the previous page if valid
			if($this->_model->validate() && $this->_model->login() != 0)
			{
				$this->_siteController->initializeView();
				$this->_siteController->actionQuickview();
				$num = true;
			}
		}
		if(!$num)
		{
			$this->_view->setLayout($this,"login");
			$this->_view->renderViewWithModel($this, 'index', $this->_model);
		}
	}

	public function getUserRole()
	{
		return $this->_model->getUserRole();
	}
    
    public function getLoginError($attribute)
	{
		return $this->_model->getError($attribute);
	}
	
}