<?php

class PeopleController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'People'),
		));
	}

	public function actionCreate() {
		$model = new People;


		if (isset($_POST['People'])) {
			$model->setAttributes($_POST['People']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->people_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'People');


		if (isset($_POST['People'])) {
			$model->setAttributes($_POST['People']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->people_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'People')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('People');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new People('search');
		$model->unsetAttributes();

		if (isset($_GET['People']))
			$model->setAttributes($_GET['People']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}