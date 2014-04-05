<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'equipment-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'su_number'); ?>
		<?php echo $form->textField($model, 'su_number', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'su_number'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'manufacturer'); ?>
		<?php echo $form->textField($model, 'manufacturer', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'manufacturer'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'model'); ?>
		<?php echo $form->textField($model, 'model', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'model'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'accession_date'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'accession_date',
			'value' => $model->accession_date,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'accession_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'de_accession_date'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'de_accession_date',
			'value' => $model->de_accession_date,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'de_accession_date'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'status_id'); ?>
		<?php echo $form->dropDownList($model, 'status_id', GxHtml::listDataEx(EquipmentStatus::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'status_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'item_type_id'); ?>
		<?php echo $form->dropDownList($model, 'item_type_id', GxHtml::listDataEx(EquipmentType::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'item_type_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'serial_number'); ?>
		<?php echo $form->textField($model, 'serial_number', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'serial_number'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'barcode_number'); ?>
		<?php echo $form->textField($model, 'barcode_number', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'barcode_number'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model, 'description', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'description'); ?>
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