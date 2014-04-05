<?php

Yii::import('application.models._base.BaseReservationStatus');

class ReservationStatus extends BaseReservationStatus
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}