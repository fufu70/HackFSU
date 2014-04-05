<?php

class ReservationItemsController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'ReservationItems'),
		));
	}

	public function actionCreate() {
		$model = new ReservationItems;


		if (isset($_POST['ReservationItems'])) {
			$model->setAttributes($_POST['ReservationItems']);

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
		$model = $this->loadModel($id, 'ReservationItems');


		if (isset($_POST['ReservationItems'])) {
			$model->setAttributes($_POST['ReservationItems']);

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
			$this->loadModel($id, 'ReservationItems')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('ReservationItems');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new ReservationItems('search');
		$model->unsetAttributes();

		if (isset($_GET['ReservationItems']))
			$model->setAttributes($_GET['ReservationItems']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}