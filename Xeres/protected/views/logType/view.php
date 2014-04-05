<?php
/* @var $this LogTypeController */
/* @var $model LogType */

$this->breadcrumbs=array(
	'Log Types'=>array('index'),
	$model->log_type_id,
);

$this->menu=array(
	array('label'=>'List LogType', 'url'=>array('index')),
	array('label'=>'Create LogType', 'url'=>array('create')),
	array('label'=>'Update LogType', 'url'=>array('update', 'id'=>$model->log_type_id)),
	array('label'=>'Delete LogType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->log_type_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LogType', 'url'=>array('admin')),
);
?>

<h1>View LogType #<?php echo $model->log_type_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'log_type_id',
		'log_type',
	),
)); ?>
