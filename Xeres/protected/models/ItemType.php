<?php

Yii::import('application.models._base.BaseItemType');

class ItemType extends BaseItemType
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}