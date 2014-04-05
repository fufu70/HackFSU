<?php
/* @var $this LogController */
/* @var $model Log */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'log_id'); ?>
		<?php echo $form->textField($model,'log_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'people_number'); ?>
		<?php echo $form->textField($model,'people_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'object_type_id'); ?>
		<?php echo $form->textField($model,'object_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'object_number'); ?>
		<?php echo $form->textField($model,'object_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'log_type_id'); ?>
		<?php echo $form->textField($model,'log_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'previous_entry'); ?>
		<?php echo $form->textField($model,'previous_entry',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'current_entry'); ?>
		<?php echo $form->textField($model,'current_entry',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'log_time'); ?>
		<?php echo $form->textField($model,'log_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->