<?php

/**
 * This is the model base class for the table "tbl_item_status".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ItemStatus".
 *
 * Columns in table "tbl_item_status" available as properties of the model,
 * followed by relations of table "tbl_item_status" available as properties of the model.
 *
 * @property integer $status_id
 * @property string $status
 *
 * @property Equipment[] $equipments
 */
abstract class BaseItemStatus extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_item_status';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'ItemStatus|ItemStatuses', $n);
	}

	public static function representingColumn() {
		return 'status';
	}

	public function rules() {
		return array(
			array('status', 'length', 'max'=>45),
			array('status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('status_id, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'equipments' => array(self::HAS_MANY, 'Equipment', 'status_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'status_id' => Yii::t('app', 'Status'),
			'status' => Yii::t('app', 'Status'),
			'equipments' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('status_id', $this->status_id);
		$criteria->compare('status', $this->status, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}