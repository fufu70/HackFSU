<?php
/* @var $this LogTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Log Types',
);

$this->menu=array(
	array('label'=>'Create LogType', 'url'=>array('create')),
	array('label'=>'Manage LogType', 'url'=>array('admin')),
);
?>

<h1>Log Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
