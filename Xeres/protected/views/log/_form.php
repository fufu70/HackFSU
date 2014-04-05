<?php
/* @var $this LogController */
/* @var $model Log */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'log-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'people_number'); ?>
		<?php echo $form->textField($model,'people_number'); ?>
		<?php echo $form->error($model,'people_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'object_type_id'); ?>
		<?php echo $form->textField($model,'object_type_id'); ?>
		<?php echo $form->error($model,'object_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'object_number'); ?>
		<?php echo $form->textField($model,'object_number'); ?>
		<?php echo $form->error($model,'object_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'log_type_id'); ?>
		<?php echo $form->textField($model,'log_type_id'); ?>
		<?php echo $form->error($model,'log_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'previous_entry'); ?>
		<?php echo $form->textField($model,'previous_entry',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'previous_entry'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'current_entry'); ?>
		<?php echo $form->textField($model,'current_entry',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'current_entry'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'log_time'); ?>
		<?php echo $form->textField($model,'log_time'); ?>
		<?php echo $form->error($model,'log_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->