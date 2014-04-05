<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('reservation-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)); ?></h1>

<p>
You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo GxHtml::link(Yii::t('app', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form">
<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'reservation-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'reservation_number',
		array(
				'name'=>'people_id',
				'value'=>'GxHtml::valueEx($data->people)',
				'filter'=>GxHtml::listDataEx(People::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'secondary_contact_id',
				'value'=>'GxHtml::valueEx($data->secondaryContact)',
				'filter'=>GxHtml::listDataEx(People::model()->findAllAttributes(null, true)),
				),
		'beginning_date',
		'beginning_time',
		'reservation_notes',
		/*
		array(
					'name' => 'assistance_needed',
					'value' => '($data->assistance_needed === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		array(
					'name' => 'delivery_and_setup',
					'value' => '($data->delivery_and_setup === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		array(
					'name' => 'takedown_needed',
					'value' => '($data->takedown_needed === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		array(
				'name'=>'building_id',
				'value'=>'GxHtml::valueEx($data->building)',
				'filter'=>GxHtml::listDataEx(Location::model()->findAllAttributes(null, true)),
				),
		'location_description',
		array(
				'name'=>'reservation_status_id',
				'value'=>'GxHtml::valueEx($data->reservationStatus)',
				'filter'=>GxHtml::listDataEx(ReservationStatus::model()->findAllAttributes(null, true)),
				),
		'closure_notes',
		'end_date',
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>