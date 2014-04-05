<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'building_id'); ?>
		<?php echo $form->textField($model, 'building_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'building_name'); ?>
		<?php echo $form->textField($model, 'building_name', array('maxlength' => 45)); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
