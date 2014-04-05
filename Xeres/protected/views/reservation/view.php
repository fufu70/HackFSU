<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->reservation_number)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->reservation_number), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'reservation_number',
array(
			'name' => 'people',
			'type' => 'raw',
			'value' => $model->people !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->people)), array('people/view', 'id' => GxActiveRecord::extractPkValue($model->people, true))) : null,
			),
array(
			'name' => 'secondaryContact',
			'type' => 'raw',
			'value' => $model->secondaryContact !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->secondaryContact)), array('people/view', 'id' => GxActiveRecord::extractPkValue($model->secondaryContact, true))) : null,
			),
'beginning_date',
'beginning_time',
'reservation_notes',
'assistance_needed:boolean',
'delivery_and_setup:boolean',
'takedown_needed:boolean',
array(
			'name' => 'building',
			'type' => 'raw',
			'value' => $model->building !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->building)), array('location/view', 'id' => GxActiveRecord::extractPkValue($model->building, true))) : null,
			),
'location_description',
array(
			'name' => 'reservationStatus',
			'type' => 'raw',
			'value' => $model->reservationStatus !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->reservationStatus)), array('reservationStatus/view', 'id' => GxActiveRecord::extractPkValue($model->reservationStatus, true))) : null,
			),
'closure_notes',
'end_date',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('logs')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->logs as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('log/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('reservationItems')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->reservationItems as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('reservationItems/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>