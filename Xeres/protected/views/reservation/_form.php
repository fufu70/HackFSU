<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'reservation-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'people_id'); ?>
		<?php echo $form->dropDownList($model, 'people_id', GxHtml::listDataEx(People::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'people_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'secondary_contact_id'); ?>
		<?php echo $form->dropDownList($model, 'secondary_contact_id', GxHtml::listDataEx(People::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'secondary_contact_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'beginning_date'); ?>
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
		<?php echo $form->error($model,'beginning_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'beginning_time'); ?>
		<?php echo $form->textField($model, 'beginning_time'); ?>
		<?php echo $form->error($model,'beginning_time'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reservation_notes'); ?>
		<?php echo $form->textField($model, 'reservation_notes', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'reservation_notes'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'assistance_needed'); ?>
		<?php echo $form->checkBox($model, 'assistance_needed'); ?>
		<?php echo $form->error($model,'assistance_needed'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'delivery_and_setup'); ?>
		<?php echo $form->checkBox($model, 'delivery_and_setup'); ?>
		<?php echo $form->error($model,'delivery_and_setup'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'takedown_needed'); ?>
		<?php echo $form->checkBox($model, 'takedown_needed'); ?>
		<?php echo $form->error($model,'takedown_needed'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'building_id'); ?>
		<?php echo $form->dropDownList($model, 'building_id', GxHtml::listDataEx(Location::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'building_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'location_description'); ?>
		<?php echo $form->textField($model, 'location_description', array('maxlength' => 80)); ?>
		<?php echo $form->error($model,'location_description'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reservation_status_id'); ?>
		<?php echo $form->dropDownList($model, 'reservation_status_id', GxHtml::listDataEx(ReservationStatus::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'reservation_status_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'closure_notes'); ?>
		<?php echo $form->textField($model, 'closure_notes', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'closure_notes'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>
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
		<?php echo $form->error($model,'end_date'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('logs')); ?></label>
		<?php echo $form->checkBoxList($model, 'logs', GxHtml::encodeEx(GxHtml::listDataEx(Log::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('reservationItems')); ?></label>
		<?php echo $form->checkBoxList($model, 'reservationItems', GxHtml::encodeEx(GxHtml::listDataEx(ReservationItems::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->