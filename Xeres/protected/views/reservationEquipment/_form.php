<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'reservation-equipment-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'item_number'); ?>
		<?php echo $form->dropDownList($model, 'item_number', GxHtml::listDataEx(Reservation::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'item_number'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'reservation_number'); ?>
		<?php echo $form->dropDownList($model, 'reservation_number', GxHtml::listDataEx(Equipment::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'reservation_number'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->