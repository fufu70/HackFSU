<?php

class ReservationController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Reservation'),
		));
	}

	public function actionCreate() {
		$model = new Reservation;


		if (isset($_POST['Reservation'])) {
			$model->setAttributes($_POST['Reservation']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->reservation_number));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Reservation');


		if (isset($_POST['Reservation'])) {
			$model->setAttributes($_POST['Reservation']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->reservation_number));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Reservation')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Reservation');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Reservation('search');
		$model->unsetAttributes();

		if (isset($_GET['Reservation']))
			$model->setAttributes($_GET['Reservation']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}