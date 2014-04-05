<?php
/* @var $this ObjectTypeController */
/* @var $model ObjectType */

$this->breadcrumbs=array(
	'Object Types'=>array('index'),
	$model->object_type_id=>array('view','id'=>$model->object_type_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ObjectType', 'url'=>array('index')),
	array('label'=>'Create ObjectType', 'url'=>array('create')),
	array('label'=>'View ObjectType', 'url'=>array('view', 'id'=>$model->object_type_id)),
	array('label'=>'Manage ObjectType', 'url'=>array('admin')),
);
?>

<h1>Update ObjectType <?php echo $model->object_type_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>