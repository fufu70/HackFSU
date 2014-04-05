<?php

class LocationController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Location'),
		));
	}

	public function actionCreate() {
		$model = new Location;


		if (isset($_POST['Location'])) {
			$model->setAttributes($_POST['Location']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->building_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Location');


		if (isset($_POST['Location'])) {
			$model->setAttributes($_POST['Location']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->building_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Location')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Location');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Location('search');
		$model->unsetAttributes();

		if (isset($_GET['Location']))
			$model->setAttributes($_GET['Location']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}