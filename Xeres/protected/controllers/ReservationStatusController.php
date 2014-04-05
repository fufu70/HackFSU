<?php

class ReservationStatusController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'ReservationStatus'),
		));
	}

	public function actionCreate() {
		$model = new ReservationStatus;


		if (isset($_POST['ReservationStatus'])) {
			$model->setAttributes($_POST['ReservationStatus']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->reservation_status_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'ReservationStatus');


		if (isset($_POST['ReservationStatus'])) {
			$model->setAttributes($_POST['ReservationStatus']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->reservation_status_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'ReservationStatus')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('ReservationStatus');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new ReservationStatus('search');
		$model->unsetAttributes();

		if (isset($_GET['ReservationStatus']))
			$model->setAttributes($_GET['ReservationStatus']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}