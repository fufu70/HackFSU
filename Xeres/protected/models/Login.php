<?php

Yii::import('application.models._base.BaseLogin');

class Login extends BaseLogin
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}