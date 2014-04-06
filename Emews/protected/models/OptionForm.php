<?php

class OptionForm extends CFormModel
{
	public $currentPassword;
	public $newPasswordInputOne;
	public $newPasswordInputTwo;

	private $_reportModel;
	private $_editModel;

	public function rules()
	{
		return array(
			array('currentPassword, newPasswordInputOne, newPasswordInputTwo', 'required'),
		);
	}

	public function changeUserPassword()
	{
		$this->_editModel = new EditForm;
		$this->_reportModel = new ReportForm;
		$login_info = $this->_reportModel->getUserHash();
		if(PBKDF2Hash::validate_password($this->currentPassword,$login_info->password))
		{
			if($this->newPasswordInputOne == $this->newPasswordInputTwo)
			{
				$this->_editModel->editUserPassword($login_info->people_id, PBKDF2Hash::create_hash($this->newPasswordInputOne));
			}
		}
	}

}