<?php
/* @var $this LogTypeController */
/* @var $model LogType */

$this->breadcrumbs=array(
	'Log Types'=>array('index'),
	$model->log_type_id=>array('view','id'=>$model->log_type_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LogType', 'url'=>array('index')),
	array('label'=>'Create LogType', 'url'=>array('create')),
	array('label'=>'View LogType', 'url'=>array('view', 'id'=>$model->log_type_id)),
	array('label'=>'Manage LogType', 'url'=>array('admin')),
);
?>

<h1>Update LogType <?php echo $model->log_type_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>