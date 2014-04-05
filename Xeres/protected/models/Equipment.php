<?php

Yii::import('application.models._base.BaseEquipment');

class Equipment extends BaseEquipment
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}