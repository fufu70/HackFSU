<?php

/**
 * This is the model class for table "tbl_log".
 *
 * The followings are the available columns in table 'tbl_log':
 * @property integer $log_id
 * @property integer $people_number
 * @property integer $object_type_id
 * @property integer $object_number
 * @property integer $log_type_id
 * @property string $previous_entry
 * @property string $current_entry
 * @property string $log_time
 *
 * The followings are the available model relations:
 * @property TblLogType $logType
 * @property TblObjectType $objectType
 * @property TblPeople $peopleNumber
 * @property TblReservation $objectNumber
 */
class Log extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('people_number, object_type_id, log_type_id', 'required'),
			array('people_number, object_type_id, object_number, log_type_id', 'numerical', 'integerOnly'=>true),
			array('previous_entry, current_entry', 'length', 'max'=>45),
			array('log_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('log_id, people_number, object_type_id, object_number, log_type_id, previous_entry, current_entry, log_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'logType' => array(self::BELONGS_TO, 'TblLogType', 'log_type_id'),
			'objectType' => array(self::BELONGS_TO, 'TblObjectType', 'object_type_id'),
			'peopleNumber' => array(self::BELONGS_TO, 'TblPeople', 'people_number'),
			'objectNumber' => array(self::BELONGS_TO, 'TblReservation', 'object_number'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'log_id' => 'Log',
			'people_number' => 'People Number',
			'object_type_id' => 'Object Type',
			'object_number' => 'Object Number',
			'log_type_id' => 'Log Type',
			'previous_entry' => 'Previous Entry',
			'current_entry' => 'Current Entry',
			'log_time' => 'Log Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('log_id',$this->log_id);
		$criteria->compare('people_number',$this->people_number);
		$criteria->compare('object_type_id',$this->object_type_id);
		$criteria->compare('object_number',$this->object_number);
		$criteria->compare('log_type_id',$this->log_type_id);
		$criteria->compare('previous_entry',$this->previous_entry,true);
		$criteria->compare('current_entry',$this->current_entry,true);
		$criteria->compare('log_time',$this->log_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Log the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
