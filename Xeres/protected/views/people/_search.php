<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'people_id'); ?>
		<?php echo $form->textField($model, 'people_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'email_address'); ?>
		<?php echo $form->textField($model, 'email_address', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'last_name'); ?>
		<?php echo $form->textField($model, 'last_name', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'first_name'); ?>
		<?php echo $form->textField($model, 'first_name', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'campus_phone'); ?>
		<?php echo $form->textField($model, 'campus_phone', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'cell_phone'); ?>
		<?php echo $form->textField($model, 'cell_phone', array('maxlength' => 45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'role_id'); ?>
		<?php echo $form->dropDownList($model, 'role_id', GxHtml::listDataEx(PersonRole::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'student_id'); ?>
		<?php echo $form->textField($model, 'student_id', array('maxlength' => 45)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
