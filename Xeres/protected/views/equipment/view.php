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
'item_number',
'su_number',
'manufacturer',
'model',
'accession_date',
'de_accession_date',
array(
			'name' => 'status',
			'type' => 'raw',
			'value' => $model->status !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->status)), array('equipmentStatus/view', 'id' => GxActiveRecord::extractPkValue($model->status, true))) : null,
			),
array(
			'name' => 'itemType',
			'type' => 'raw',
			'value' => $model->itemType !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->itemType)), array('equipmentType/view', 'id' => GxActiveRecord::extractPkValue($model->itemType, true))) : null,
			),
'serial_number',
'barcode_number',
'description',
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