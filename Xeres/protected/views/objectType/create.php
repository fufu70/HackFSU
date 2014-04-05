<?php
/* @var $this ObjectTypeController */
/* @var $model ObjectType */

$this->breadcrumbs=array(
	'Object Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ObjectType', 'url'=>array('index')),
	array('label'=>'Manage ObjectType', 'url'=>array('admin')),
);
?>

<h1>Create ObjectType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>