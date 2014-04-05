<?php

Yii::import('application.models._base.BaseReservation');

class Reservation extends BaseReservation
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}