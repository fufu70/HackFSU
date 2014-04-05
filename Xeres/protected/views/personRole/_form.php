<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'person-role-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->textField($model, 'role', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'role'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('peoples')); ?></label>
		<?php echo $form->checkBoxList($model, 'peoples', GxHtml::encodeEx(GxHtml::listDataEx(People::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->