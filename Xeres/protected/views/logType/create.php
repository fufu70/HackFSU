<?php
/* @var $this LogTypeController */
/* @var $model LogType */

$this->breadcrumbs=array(
	'Log Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LogType', 'url'=>array('index')),
	array('label'=>'Manage LogType', 'url'=>array('admin')),
);
?>

<h1>Create LogType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>