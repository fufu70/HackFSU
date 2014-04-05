<?php

class ItemStatusController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'ItemStatus'),
		));
	}

	public function actionCreate() {
		$model = new ItemStatus;


		if (isset($_POST['ItemStatus'])) {
			$model->setAttributes($_POST['ItemStatus']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->status_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'ItemStatus');


		if (isset($_POST['ItemStatus'])) {
			$model->setAttributes($_POST['ItemStatus']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->status_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'ItemStatus')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('ItemStatus');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new ItemStatus('search');
		$model->unsetAttributes();

		if (isset($_GET['ItemStatus']))
			$model->setAttributes($_GET['ItemStatus']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}