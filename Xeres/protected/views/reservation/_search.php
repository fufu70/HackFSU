<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'reservation_number'); ?>
		<?php echo $form->textField($model, 'reservation_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'people_id'); ?>
		<?php echo $form->dropDownList($model, 'people_id', GxHtml::listDataEx(People::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'secondary_contact_id'); ?>
		<?php echo $form->dropDownList($model, 'secondary_contact_id', GxHtml::listDataEx(People::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'beginning_date'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'beginning_date',
			'value' => $model->beginning_date,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'beginning_time'); ?>
		<?php echo $form->textField($model, 'beginning_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'reservation_notes'); ?>
		<?php echo $form->textField($model, 'reservation_notes', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'assistance_needed'); ?>
		<?php echo $form->dropDownList($model, 'assistance_needed', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'delivery_and_setup'); ?>
		<?php echo $form->dropDownList($model, 'delivery_and_setup', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'takedown_needed'); ?>
		<?php echo $form->dropDownList($model, 'takedown_needed', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'building_id'); ?>
		<?php echo $form->dropDownList($model, 'building_id', GxHtml::listDataEx(Location::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'location_description'); ?>
		<?php echo $form->textField($model, 'location_description', array('maxlength' => 80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'reservation_status_id'); ?>
		<?php echo $form->dropDownList($model, 'reservation_status_id', GxHtml::listDataEx(ReservationStatus::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'closure_notes'); ?>
		<?php echo $form->textField($model, 'closure_notes', array('maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'end_date'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'end_date',
			'value' => $model->end_date,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
