<?php

class LoginController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Login'),
		));
	}

	public function actionCreate() {
		$model = new Login;


		if (isset($_POST['Login'])) {
			$model->setAttributes($_POST['Login']);

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
		$model = $this->loadModel($id, 'Login');


		if (isset($_POST['Login'])) {
			$model->setAttributes($_POST['Login']);

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
			$this->loadModel($id, 'Login')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Login');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Login('search');
		$model->unsetAttributes();

		if (isset($_GET['Login']))
			$model->setAttributes($_GET['Login']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}