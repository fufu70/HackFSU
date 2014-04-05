<?php
/* @var $this ObjectTypeController */
/* @var $model ObjectType */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'object_type_id'); ?>
		<?php echo $form->textField($model,'object_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'object_type'); ?>
		<?php echo $form->textField($model,'object_type',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->