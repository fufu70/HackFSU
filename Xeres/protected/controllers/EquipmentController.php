<?php

class EquipmentController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Equipment'),
		));
	}

	public function actionCreate() {
		$model = new Equipment;


		if (isset($_POST['Equipment'])) {
			$model->setAttributes($_POST['Equipment']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->item_number));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Equipment');


		if (isset($_POST['Equipment'])) {
			$model->setAttributes($_POST['Equipment']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->item_number));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Equipment')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Equipment');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Equipment('search');
		$model->unsetAttributes();

		if (isset($_GET['Equipment']))
			$model->setAttributes($_GET['Equipment']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}