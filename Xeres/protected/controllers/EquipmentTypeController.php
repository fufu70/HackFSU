<?php

class EquipmentTypeController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'EquipmentType'),
		));
	}

	public function actionCreate() {
		$model = new EquipmentType;


		if (isset($_POST['EquipmentType'])) {
			$model->setAttributes($_POST['EquipmentType']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->item_type_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'EquipmentType');


		if (isset($_POST['EquipmentType'])) {
			$model->setAttributes($_POST['EquipmentType']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->item_type_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'EquipmentType')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('EquipmentType');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new EquipmentType('search');
		$model->unsetAttributes();

		if (isset($_GET['EquipmentType']))
			$model->setAttributes($_GET['EquipmentType']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}