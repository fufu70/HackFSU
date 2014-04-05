<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->item_number)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->item_number), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
array(
			'name' => 'itemNumber',
			'type' => 'raw',
			'value' => $model->itemNumber !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->itemNumber)), array('reservation/view', 'id' => GxActiveRecord::extractPkValue($model->itemNumber, true))) : null,
			),
array(
			'name' => 'reservationNumber',
			'type' => 'raw',
			'value' => $model->reservationNumber !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->reservationNumber)), array('equipment/view', 'id' => GxActiveRecord::extractPkValue($model->reservationNumber, true))) : null,
			),
	),
)); ?>

