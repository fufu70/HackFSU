<?php

/**
 * This is the model base class for the table "tbl_location".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Location".
 *
 * Columns in table "tbl_location" available as properties of the model,
 * followed by relations of table "tbl_location" available as properties of the model.
 *
 * @property integer $building_id
 * @property string $building_name
 *
 * @property Reservation[] $reservations
 */
abstract class BaseLocation extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_location';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Location|Locations', $n);
	}

	public static function representingColumn() {
		return 'building_name';
	}

	public function rules() {
		return array(
			array('building_name', 'length', 'max'=>45),
			array('building_name', 'default', 'setOnEmpty' => true, 'value' => null),
			array('building_id, building_name', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'reservations' => array(self::HAS_MANY, 'Reservation', 'building_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'building_id' => Yii::t('app', 'Building'),
			'building_name' => Yii::t('app', 'Building Name'),
			'reservations' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('building_id', $this->building_id);
		$criteria->compare('building_name', $this->building_name, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}