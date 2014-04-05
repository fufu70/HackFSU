<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'location-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'building_name'); ?>
		<?php echo $form->textField($model, 'building_name', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'building_name'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('reservations')); ?></label>
		<?php echo $form->checkBoxList($model, 'reservations', GxHtml::encodeEx(GxHtml::listDataEx(Reservation::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->