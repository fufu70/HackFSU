<?php

class PersonRoleController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'PersonRole'),
		));
	}

	public function actionCreate() {
		$model = new PersonRole;


		if (isset($_POST['PersonRole'])) {
			$model->setAttributes($_POST['PersonRole']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->role_id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'PersonRole');


		if (isset($_POST['PersonRole'])) {
			$model->setAttributes($_POST['PersonRole']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->role_id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'PersonRole')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('PersonRole');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new PersonRole('search');
		$model->unsetAttributes();

		if (isset($_GET['PersonRole']))
			$model->setAttributes($_GET['PersonRole']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}