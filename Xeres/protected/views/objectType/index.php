<?php
/* @var $this ObjectTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Object Types',
);

$this->menu=array(
	array('label'=>'Create ObjectType', 'url'=>array('create')),
	array('label'=>'Manage ObjectType', 'url'=>array('admin')),
);
?>

<h1>Object Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
