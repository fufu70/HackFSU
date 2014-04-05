<?php
/* @var $this ObjectTypeController */
/* @var $model ObjectType */

$this->breadcrumbs=array(
	'Object Types'=>array('index'),
	$model->object_type_id,
);

$this->menu=array(
	array('label'=>'List ObjectType', 'url'=>array('index')),
	array('label'=>'Create ObjectType', 'url'=>array('create')),
	array('label'=>'Update ObjectType', 'url'=>array('update', 'id'=>$model->object_type_id)),
	array('label'=>'Delete ObjectType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->object_type_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ObjectType', 'url'=>array('admin')),
);
?>

<h1>View ObjectType #<?php echo $model->object_type_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'object_type_id',
		'object_type',
	),
)); ?>
