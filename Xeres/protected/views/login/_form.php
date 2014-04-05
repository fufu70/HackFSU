<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'login-form',
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
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model, 'password', array('maxlength' => 255)); ?>
		<?php echo $form->error($model,'password'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->